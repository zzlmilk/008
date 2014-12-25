<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InformationController
 *
 * @author Administrator
 */
class InformationController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleBusinessById() {
        $BusinessId = $this->request['businessId'];

 
//        $BusinessId='3205237';
        $Business = new BusinessInformationBllModel();
        $Business->getSingleBusinessInformationWithId($BusinessId);
    }

    public function AllRegionsInformation() {
        $Regions = new RegionsInformationBllModel();
        $Regions->getAllRegionInformation();
    }

    public function AllDistrictInformation() {
        $dis = new RegionsInformationBllModel();
        $dis->getDistrictInformation();
    }

    public function getRegionsInformationWithDistrictId() {
       
        $DistrictId = $this->request['districtId'];
        $Regions = new RegionsInformationBllModel();
        $Regions->getManyRegionsInformationWithDistrictId($DistrictId);
    }
    public function getAllRegionsNameByDistrictId(){
        $DistrictId = $this->request['districtId'];
          $Regions = new RegionsInformationBllModel();
           $Regions->getAllRegionsNameWithDistrictId($DistrictId);
    }

    public function getRegTest() {
        $Business = new BusinessInformationBllModel();
        $a = $Business->testGetRegionsValue($Id);
        var_dump($a);
    }

    public function getAllTags() {
        $Tags = new tagsInformationBllModel();
        $Tags->getTags();
    }

    public function getPlan() {
        $regions = isset($this->request['regions'])?$this->request['regions']:null;
        $avgConsume = isset($this->request['avgConsume'])?$this->request['avgConsume']:null;
        $rankScore = isset($this->request['$rankScore'])?$this->request['$rankScore']:null;
        $stateTag = isset($this->request['$stateTag'])?$this->request['$stateTag']:null;
        /*
         * 获取条件搜索条件值
         */
        $Plan = new planBllModel();
        $Plan->getOncePlan($rankScore, $avgConsume, $stateTag, $regions);//获取路线
    }
    public function getPlanByPlanId(){
         $planId = $this->request['planId'];
        $Plan = new planBllModel();
        $Plan->getOncePlanById($planId,0,1);
    }
    public function getPlanByTypeId(){
        $typeId = $this->request['typeId'];  //获取路线分类ID
        $plan=new PlanBllModel();
        $plan->getPlanByType($typeId);//按照分类获取路线
    }
    public function getPlanBusinessById(){
        $BusinessId = $this->request['businessId'];
        $planBusiness=new PlanBusinessInformationBllModel();
        $planBusiness->getSinglePlanBusinessInformationWithId($BusinessId);
    }

    public function getDealsByBusinessId() {
        $BusinessId = $this->request['businessId'];
        $deals = new DealsInformationBllModel();
        $deals->getDealsInformationWithBusinessId($BusinessId);
    }

    public function getAllDeals() {
        $deals = new DealsInformationBllModel();
        $deals->getAllDealsInformation();
    }
    public function getRecommendPlan(){
        $recommend=new recommendInformationBllModel();
        $recommend->getSpecifiedNumberRecommendMessage();
    }
    public function getRecommendPlanWithLimit(){
        $limit=$this->request['limit']; // 返回推荐的最大数量，0为返回所有，通过post参数获取
        $recommend=new recommendInformationBllModel();
        $recommend->getSpecifiedNumberRecommendMessage(1,$limit); //获取推荐路线
    }

    public function test() {
      echo  $_SERVER['SERVER_NAME'];
//        $test = new RegionsInformationDalModel();
//        $test1=new RegionsInformationBllModel();
//        $test2=new planDalModel();
//        $test3=new planBllModel();
//        $test3->createNewPlan();
//        $selectStr="regions='185' and categories='1'";
//        $Business=new BusinessInformationBllModel();
//       $a= $Business->getSingleBusinessInformationWithSelect($selectStr,1);
//        var_dump($a);
//        $test4=new  tagsInformationBllModel();
//        $test4->getTags();
//        $test1->getAllRegionInformation();
//        $test->getAllDistrictInformation();
//        $test->getRegionsInformationById('185,186,187');
//        $test5 = new DealsInformationDalModel();
//        $aarr = array("312002", "312001");
//        $test5->getDealsInformationByBusinessId($aarr);
    }

}

?>
