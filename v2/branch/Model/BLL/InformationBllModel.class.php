<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InformationBllModel
 *
 * @author Administrator
 */
class PlanBusinessInformationBllModel extends planBusinessInformationDalModel{
         var $object;

    public function __construct() {

        parent::__construct();
    }
        
        public function getSinglePlanBusinessInformationWithId($Id,$returnType=0) {
        if (!empty($Id)) {
            $result = $this->getOncePlanBusinessInformationById($Id);
            if ($result) {
                $PlanBusinessObject = new stdClass();
                $PlanBusinessObject=$this->createDateObject($PlanBusinessObject, $result);
                $reg=new RegionsInformationDalModel();
                if(!ctype_digit($PlanBusinessObject->regions)){
                  $this->echoErrorCode("2005");
                }
                $catch=$reg->getRegionsInformationById($PlanBusinessObject->regions);
//                $w=$reg->getAreaInformationById($catch["id"]);
                $cacheArray=array();
                $cacheArray['regions_name']= $catch['regions_name'] ;
                $cacheArray['district_name']= $catch['district_name'];

                $PlanBusinessObject->regions=$cacheArray;
                
                if($returnType==1){
                    return $PlanBusinessObject;
                }else{
                $BusinessArray['Business'] = $PlanBusinessObject;
                $this->AssemblyJson($BusinessArray);
                
                }
            } else {
                $this->echoErrorCode("2010");
            }
        }
        else{
           $this->echoErrorCode("2013");
        }
    }
    public  function getPlanBusinessByWhereString($whereString){
        $result=$this->getPlanBusinessInformationByWhereString($whereString);
        return $result;
        
    }
}
class BusinessInformationBllModel extends BusinessInformationDalModel{
     var $object;

    public function __construct() {

        parent::__construct();
    }
    
        public function getSingleBusinessInformationWithId($BusinessId,$returnType=0) {
        if (!empty($BusinessId)) {
            $result = $this->getOneBusinessInformationById($BusinessId);
            if ($result) {
                $BusinessObject = new stdClass();
                $BusinessObject=$this->createDateObject($BusinessObject, $result);
                $reg=new RegionsInformationDalModel();
                if(!ctype_digit($BusinessObject->regions)){
                  $this->echoErrorCode("2005");
                }
                $catch=$reg->getRegionsInformationById($BusinessObject->regions);
//                $w=$reg->getAreaInformationById($catch["id"]);
                $cacheArray=array();
                $cacheArray['regions_name']= $catch['regions_name'] ;
                $cacheArray['district_name']= $catch['district_name'];

                $BusinessObject->regions=$cacheArray;
                
                if($returnType==1){
                    return $BusinessObject;
                }else{
                $BusinessArray['Business'] = $BusinessObject;
                $this->AssemblyJson($BusinessArray);
                
                }
            } else {
                $this->echoErrorCode("2010");
            }
        }
        else{
           $this->echoErrorCode("2013");
        }
    }
    public  function  getSingleBusinessInformationWithSelect($selectStr=0,$returnType=0){
         $result = $this->getOneBusinessInformationBySelectString($selectStr,5);
         if($result){
             if($returnType==1){
                 return $result;
             }
             else{
              $BusinessArray['Business'] = $result;
              $this->AssemblyJson($BusinessArray);
             }
         }
         else{
                $this->echoErrorCode("2009");
         }
    }

}
class DealsInformationBllModel extends DealsInformationDalModel{
             var $object;

    public function __construct() {

        parent::__construct();
    }
    public function getDealsInformationWithBusinessId($BusinessId = 0) {
        if(!empty($BusinessId)){
           $result= $this->getDealsInformationByBusinessId($BusinessId) ;
            if($result){
               // $DealsInformation['Deals']=$result;
                $this->AssemblyJson($result);
            }
        }
        else{
            $this->echoErrorCode("2001");
        }
    }
    public function getAllDealsInformation(){
          $result= $this->getDeals();
//          $DealsInformation['Deals']=$result;
            $this->AssemblyJson($result);
    }
//      public function getDealsInformationWithId($DealsId){
//            if (!empty($BusinessId)) {
//            $result = $this->getOneBusinessInformationById($BusinessId);
//            if ($result) {
//                $BusinessObject = new stdClass();
//                $BusinessObject=$this->createDateObject($BusinessObject, $result);
//                $reg=new RegionsInformationDalModel();
//                if(!ctype_digit($BusinessObject->regions)){
//                    $this->echoErrorCode("2005");
//                }
//                $catch=$reg->getRegionsInformationById($BusinessObject->regions);
////                $w=$reg->getAreaInformationById($catch["id"]);
//                $cacheArray=array();
//                $cacheArray['regions_name']= $catch['regions_name'] ;
//                $cacheArray['district_name']= $catch['district_name'];
//
//                $BusinessObject->regions=$cacheArray;
//                $BusinessArray['Business'] = $BusinessObject;
//                $this->AssemblyJson($BusinessArray);
//            } else {
//                $errorArray=array();
//                $errorArray["is_scuess"]=0;
//                $errorArray['errorCode'] = 1;
//                $this->AssemblyJson($errorArray);
//            }
//        }
//      }
}
class RegionsInformationBllModel extends RegionsInformationDalModel{
         var $object;

    public function __construct() {

        parent::__construct();
    }
    
    public function getAllRegionsNameWithDistrictId($DistrictId) {
        if(!empty($DistrictId)&&  ctype_digit($DistrictId)){
        $result = $this->getRegionsNamebyDistrictId($DistrictId);
        $this->AssemblyJson($result);
        }
        else{
            $this->echoErrorCode('2011');
        }
    }
    /*
     * 通过地区ID取得商区
     * $DistrictId地区ID
     * $isJSONCodeReturn 是否直接返回json或者以对象形式返回  0为直接返回json对象并结束应用程序
     *  1为只返回带有商区名称的对象 3为返回完整的商区对象；
     * $returnValType 0为获取所有字段 ，1为获取ID与商区名称；
     * 
     */
    public function getManyRegionsInformationWithDistrictId($DistrictId,$isJSONCodeReturn=0,$returnValType=0){
        if(!empty($DistrictId)){
            if($returnValType==1){
                $result=$this->getManyRegionsInformationByDistrictId($DistrictId,$returnValType);
            }
            else{
         $result=$this->getManyRegionsInformationByDistrictId($DistrictId);
         }
         if($result){
             if($isJSONCodeReturn==3){
             return $result;
             }
             $catchArray=array();
             $ca=array();
//             foreach ($result as $resultArray){
//             $catchArray['id']=$resultArray['id'];
//             $catchArray['regions_name']=$resultArray['regions_name'];
//             array_push($ca, $catchArray);
//             }
             if($isJSONCodeReturn==0){
            foreach ($result as $resultArray){
             $catchArray['id']=$resultArray['id'];
             $catchArray['regions_name']=$resultArray['regions_name'];
             array_push($ca, $catchArray);
             }
                 $RegionsArray=array();
                 $RegionsArray['Regions']=$ca;
                 $this->AssemblyJson($RegionsArray);
             }
             else if($isJSONCodeReturn==1){
            foreach ($result as $resultArray){
             array_push($catchArray, $resultArray['regions_name']);
             }
                 return $catchArray;
             }
         }

        }
        else{
            $userArray['errorCode'] = 2;
            $this->AssemblyJson($userArray);
        }
    }
    public function getDistrictInformation(){
        $result=$this->getAllDistrictInformation();
        if($result){
              $this->AssemblyJson($result);
        }
    }
    public function getAllRegionInformation(){
       $result= $this->getAllDistrictInformation();
       if($result){
        $catchArray=array();
       foreach ($result as $resultArray){
         $resultName=$resultArray['district_name'];

         $regionsResult=$this->getManyRegionsInformationWithDistrictId($resultArray['id'],3,1);
        $catchArray[$resultName]=$regionsResult;
         
       }
        $this->AssemblyJson($catchArray);
//       var_dump($catchArray);
       
       }
    }
}
class tagsInformationBllModel extends tagsInformationDalModel{
         var $object;

    public function __construct() {

        parent::__construct();
    }
    public function getTags(){
        $result= $this->getAlltagsInformation();
        if($result){
             $this->AssemblyJson($result);
        }else{
            $this->echoErrorCode('2006');
        }
    }
}
 
?>
