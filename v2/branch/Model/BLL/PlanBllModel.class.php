<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlanBllModel
 *
 * @author Administrator
 */
class PlanBllModel extends planDalModel {

    var $object;

    public function __construct() {

        parent::__construct();
    }
    //通过坐标获取附近的路线
    public function getPlanByPosition($latitude, $longitude) {
        $stateLength = 3;
        $planArray=array();
        if (!is_numeric($latitude) || empty($latitude)) {
            $this->echoErrorCode("2014");
        } else if (!is_numeric($longitude) || empty($longitude)) {
            $this->echoErrorCode("2015");
        } else {
            $range = $this->computeDistanceAndPosition($latitude, $longitude);
            $selectStr = "longitude  BETWEEN '" . $range['minLng'] . "' and '" . $range['maxLng'] .
                    "' and latitude BETWEEN '" . $range['minLat'] . "'and '" . $range['maxLat'] . "'";
            $PlanBusiness = new PlanBusinessInformationBllModel();
            $result = $PlanBusiness->getPlanBusinessByWhereString($selectStr);
            if($result==''){
                $this->echoErrorCode('3001');
            }
            foreach ($result as $PlanBusinessValue) {
                $firstStatePlanBusinessId[] = $PlanBusinessValue["id"];
            }
            $resultPlan = $this->getManyBasicPalnByStateId($firstStatePlanBusinessId);
            if ($resultPlan) {
                //遍历所有获取到的路线得到商铺的详细信息
                foreach ($resultPlan as $planValue) {
                    $tags = new tagsInformationDalModel();
                    $resultTags = $tags->getManyTagsInformation($planValue['state_type']);
                    foreach ($resultTags as $tag) {
                        $tagsArray[] = $tag['tag_name'];
                    }
                     //遍历stateid获取类型；
                    for ($i = 1; $i <= $stateLength; $i++) {
                        $BusinessInfo = new PlanBusinessInformationBllModel();
                        $stateId = $planValue['state_' . $i];
                        if (!empty($stateId)) {
                            $resultBusiness = $BusinessInfo->getSinglePlanBusinessInformationWithId($stateId, 1);
                            if ($resultBusiness) {

                                $businessArray[] = $resultBusiness;
                            }
                        } else {
                            break;
                        }
                    }
                    $planValue["Businesses"] = $businessArray;
                    $planValue["state_type"] = $tagsArray;
                    $planArray=$planValue;
                }
             $this->AssemblyJson($planArray);
            }
            else{
               $this->echoErrorCode('3001');
            }
        }
    }
    //计算经纬度范围
    public function computeDistanceAndPosition($myLat, $myLng, $Distance = 1) {
        if (empty($Distance) || !is_numeric($Distance)) {
            $this->echoErrorCode('2016');
        }
        $range = 180 / pi() * $Distance / 6372.797;     //里面的 1 就代表搜索 1km 之内，单位km  
        $lngR = $range / cos($myLat * pi() / 180);
        $maxLat = $myLat + $range; //最大纬度  
        $minLat = $myLat - $range; //最小纬度  
        $maxLng = $myLng + $lngR; //最大经度  
        $minLng = $myLng - $lngR; //最小经度  
        $Position['maxLat'] = $maxLat;
        $Position['minLat'] = $minLat;
        $Position['maxLng'] = $maxLng;
        $Position['minLng'] = $minLng;
        return $Position;
    }

    //$JSONReturnType 1为返回plan对象
    public function getOncePlanById($planId, $JSONReturnType=0) {
        $businessArray = array();
        $tagsArray = array();
        $stateLength = 3;
//        $rankScore=30;
//        $avgConsume=50;
//        $stateType=3;
        if(!ctype_digit($planId)&&!is_numeric($planId)){
            $this->echoErrorCode('3003');
        }
        $result = $this->getSingleBasicPalnById($planId);
        if ($result) {
            $tags = new tagsInformationDalModel();
            $resultTags = $tags->getManyTagsInformation($result['state_type']);
            foreach ($resultTags as $tag) {
                $tagsArray[] = $tag['tag_name'];
            }
            for ($i = 1; $i <= $stateLength; $i++) {
                $BusinessInfo = new PlanBusinessInformationBllModel();
                $stateId = $result['state_' . $i];
                if (!empty($stateId)) {
                    $resultBusiness = $BusinessInfo->getSinglePlanBusinessInformationWithId($stateId, 1);
                    if ($resultBusiness) {

                        $businessArray[] = $resultBusiness;
                    }
                } else {
                    break;
                }
            }
            $result["Businesses"] = $businessArray;
            $result["state_type"] = $tagsArray;
            $planObject = new stdClass();
            $planObject = $this->createDateObject($planObject, $result);

//        $planArray=  array();
//        $planArray["plan"]=$planObject;
            if ($JSONReturnType == 1) {
                return $planObject;
            } else {
                $this->AssemblyJson($planObject);
            }
        } else {
            $this->echoErrorCode('3001');
        }
    }

    public function getOncePlan($rankScore = 0, $avgConsume = 0, $stateTag = 0, $regions = 0) {
        $selectArray = array();
        $orderArray = array();
        $businessArray = array();
        $tagsArray = array();
        $stateLength = 3;
//        $rankScore=30;
//        $avgConsume=50;
//        $stateType=3;
        if (!empty($rankScore)) {
            $selectArray[] = "rank_score>='" . $rankScore . "'";
        }
        if (!empty($avgConsume)) {
            $selectArray[] = "avg_consume <='" . $avgConsume . "'";
            $orderArray[] = "avg_consume";
        }
        if (!empty($stateTag)) {
            $selectArray[] = "state_tag='" . $stateTag . "'";
            $orderArray[] = "state_tag";
        }
        if (!empty($regions)) {
            $selectArray[] = "regions='" . $regions . "'";
        }
        $result = $this->getBasicPalnSingal($orderArray, $selectArray);
        if ($result) {
            $resultNum = count($result);
            $randomNum = rand(0, $resultNum - 1);
            $result = $result[$randomNum];
            $tags = new tagsInformationDalModel();
            $resultTags = $tags->getManyTagsInformation($result['state_type']);
            foreach ($resultTags as $tag) {
                $tagsArray[] = $tag['tag_name'];
            }
            //遍历stateid获取类型；
            for ($i = 1; $i <= $stateLength; $i++) {
                $BusinessInfo = new PlanBusinessInformationBllModel();
                $stateId = $result['state_' . $i];
                if (!empty($stateId)) {
                    $resultBusiness = $BusinessInfo->getSinglePlanBusinessInformationWithId($stateId, 1);
                    if ($resultBusiness) {

                        $businessArray[] = $resultBusiness;
                    }
                } else {
                    break;
                }
            }
            $result["Business"] = $businessArray;
            $result["state_type"] = $tagsArray;
            $planObject = new stdClass();
            $planObject = $this->createDateObject($planObject, $result);

//        $planArray=  array();
//        $planArray["plan"]=$planObject;
            $this->AssemblyJson($planObject);
        } else {
            $this->echoErrorCode('3001');
        }
    }

    public function createCompletePlan() {
        $regions = new RegionsInformationDalModel();
        $result = $regions->getAllRegionsInformation(1);
        foreach ($result as $element) {
            $this->createNewPlan($element["id"]);
        }
    }

    public function createNewPlan($regions) {
        $regions = 185;
        $newPlanArray = array();
        $planOrderArray = array("first_state_id", "second_state_id", "third_state_id");
        $Business = new BusinessInformationBllModel();
        $categories = 0;
        $avgConsume = 0;
        $avgScoreRank = 0;
        foreach ($planOrderArray as $value) {
            if ($value == "first_state_id") {
                $categories = 1;
            } else if ($value == "second_state_id") {
                $categories = 2;
            } else if ($value == "third_state_id") {
                $categories = 3;
            }
            $selectStr = "regions='$regions' and categories='$categories'";
            $result = $Business->getSingleBusinessInformationWithSelect($selectStr, 1);
            $BusinessNumber = count($result);
            $randomBusiness = rand(0, $BusinessNumber - 1);
            $BusinessId = $result[$randomBusiness]['business_id'];
            $avgConsume = $result[$randomBusiness]['avg_price'] + $avgConsume;
            $avgScoreRank = $result[$randomBusiness]['rank_score'] + $avgScoreRank;
            $newPlanArray[$value] = $BusinessId;
        }
        $avgNum = count($planOrderArray);
        $newPlanArray['avg_consume'] = $avgConsume / $avgNum;
        $newPlanArray['regions'] = $regions;
        $newPlanArray['rank_score'] = round($avgScoreRank / $avgNum);
        $this->insertAutoPlan($newPlanArray);
    }

}

?>
