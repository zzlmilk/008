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

    public function getOncePlan($rankScore = 0, $avgConsume = 0, $stateTag = 0, $regions = 0) {
        $selectArray = array();
        $orderArray = array();
        $businessArray=array();
        $tagsArray=array();
        $stateLength=3;
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
        if($result){
            $resultNum=count($result);
            $randomNum=  rand(0, $resultNum-1);
            $result=$result[$randomNum];
               $tags=new tagsInformationDalModel();
               $resultTags=$tags->getManyTagsInformation($result['state_type']);
               foreach ($resultTags as $tag){
                   $tagsArray[]=$tag['tag_name'];
               }
                for ($i=1;$i<=$stateLength;$i++){
                    $BusinessInfo=new PlanBusinessInformationBllModel();
                    $stateId=$result['state_'.$i];
                       if(!empty($stateId)){
                       $resultBusiness=$BusinessInfo->getSinglePlanBusinessInformationWithId($stateId,1);
                       if($resultBusiness){
                           
                       $businessArray[]=$resultBusiness;
                       }                       
                       }
                       else{
                           break;
                       }
                    
                
            }
            $result["Business"]=$businessArray;
            $result["state_type"]=$tagsArray;
        $planObject = new stdClass();
        $planObject = $this->createDateObject($planObject, $result);
           
//        $planArray=  array();
//        $planArray["plan"]=$planObject;
        $this->AssemblyJson($planObject);
        }
        else{
            $this->echoErrorCode('3001');
        }
    }
    public function createCompletePlan(){
        $regions=new RegionsInformationDalModel();
       $result=$regions->getAllRegionsInformation(1);
       foreach ($result as $element){
           $this->createNewPlan($element["id"]);
       }
    }

    public  function createNewPlan($regions){
        $regions=185;
        $newPlanArray=array();
        $planOrderArray=  array("first_state_id","second_state_id","third_state_id");
        $Business=new BusinessInformationBllModel();
        $categories=0;
        $avgConsume=0;
        $avgScoreRank=0;
        foreach ($planOrderArray as $value){
            if($value=="first_state_id")
            {
                $categories=1;
            }
            else if ($value=="second_state_id") {
             $categories=2;
            }
            else if ($value=="third_state_id") {
             $categories=3;
            }
            $selectStr="regions='$regions' and categories='$categories'";
            $result= $Business-> getSingleBusinessInformationWithSelect($selectStr,1);
            $BusinessNumber=count($result);
            $randomBusiness=rand(0, $BusinessNumber-1);
            $BusinessId= $result[$randomBusiness]['business_id'];
            $avgConsume=$result[$randomBusiness]['avg_price']+$avgConsume;
            $avgScoreRank=$result[$randomBusiness]['rank_score']+$avgScoreRank;
            $newPlanArray[$value]=$BusinessId;
        }
      $avgNum=count($planOrderArray);
      $newPlanArray['avg_consume']=  $avgConsume/$avgNum;
      $newPlanArray['regions']=$regions;
      $newPlanArray['rank_score']=  round($avgScoreRank/$avgNum);
      $this->insertAutoPlan($newPlanArray);

        
    }

}

?>
