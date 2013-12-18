<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InformationDalModel
 *
 * @author Administrator
 */
/*
 * 获取biusiness信息的模块
 */
class planBusinessInformationDalModel extends Basic {

    private $id;
    private $tableName = 'plan_business';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        parent::__constructor($this->child_name);
    }

    public function __get($name) {
        return isset($this->$name) ? $this->$name : null;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function getOncePlanBusinessInformationById($BusinessId = 0) {
        if (!empty($BusinessId)&&  ctype_digit($BusinessId)) {
            $this->clearup();
            $this->initialize("id in (" . $BusinessId . ")");
            return $this->vars;
        } else {
            $this->echoErrorCode('2001');
        }
    }

}
class BusinessInformationDalModel extends Basic {

    private $id;
    private $tableName = 'business_message';

//    private $user_age;
//    private $email;
//    private $password;
//    private $user_name;
//    private $user_tags;
//    private $user_photo;
//    private $user_weibo_token;
//    protected $tableField = array('id', 'user_name', 'email','user_photo','user_tags','password');

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        parent::__constructor($this->child_name);
    }

    public function __get($name) {
        return isset($this->$name) ? $this->$name : null;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function createDateObject($dataObject, $result) {
        foreach ($result as $key => $value) {
            $dataObject->$key = $value;
        }
        return $dataObject;
    }

    public function getOneBusinessInformationById($BusinessId = 0) {
        if (!empty($BusinessId)&&ctype_digit($BusinessId)) {
            $this->clearup();
            $this->initialize("business_id in (" . $BusinessId . ")");
            return $this->vars;
        } else {
            $this->echoErrorCode('2001');
        }
    }
    public function getOneBusinessInformationBySelectString($selectStr,$limit=0){
        if (!empty($selectStr)){
            $this->clearup();
            if(!empty($limit)){
                $this->addOffset(0,$limit);
            }
           $this->addOrderBy("rank_score");
           if(!is_string($selectStr)){
               $this->echoErrorCode("2008");
            }
            $this->initialize($selectStr);
            return $this->vars_all;
        }
    }

    public function getManyBusinessInformationById($BusinessId = 0) {
        if (!empty($BusinessId)) {
            $this->clearup();
            $this->initialize("business_id in (" . $BusinessId . ")");
            return $this->vars_all;
        } else {
            $this->echoErrorCode('2001');
        }
    }

}

/*
 * 获取地区信息模块
 */

class RegionsInformationDalModel extends Basic {

    private $id;
    private $tableName = 'regions';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        parent::__constructor($this->child_name);
    }

    public function __get($name) {
        return isset($this->$name) ? $this->$name : null;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
    public function getRegionsNamebyDistrictId($DistrictId) {
        $this->initialize('district_id = "'.$DistrictId.'" ');
        return $this->vars_all;
    }

    public function getRegionsInformationById($RegionsId = 0) {
        if (!empty($RegionsId)) {
            $this->clearup();
//            $RegionsIdArray = explode(",", $RegionsId);
//            $RegionsIdLenth = count($RegionsIdArray);
//            if ($RegionsIdArray[$RegionsIdLenth - 1] == '') {
//                array_pop($RegionsIdArray);
//            }
           $RegionsIdArray= $this->checkStrignArrayLastElement($RegionsId);
            $RegionsIdFinalLenth = count($RegionsIdArray);
            $RegionsIdNewStr = implode($RegionsIdArray, ",");
//            foreach ($RegionsIdArray as $RegionsIdElement) {
//                if (!ctype_digit($RegionsIdElement)) {
//                    $this->echoErrorCode('2002');
//                }
//            }
            $this->checkArrayAllDigit($RegionsIdArray,"2002");
//            $selectFiled=  array("area_name","regions_name");
//            $this->addSelect($selectFiled);
            $this->changeTable("regions");
            $join_str = array(array("district", "regions.district_id", "district.id"));
            $this->addJoin($join_str);
            $this->initialize("regions.id in (" . $RegionsIdNewStr . ")");
            if($this->vars_number<=0){
                $this->echoErrorCode('2010');
            }
            if ($RegionsIdFinalLenth > 1) {
                return $this->vars_all;
            } else {
                return $this->vars;
            }
        } else {
            $this->echoErrorCode('2002');
        }
    }

    public function getManyRegionsInformationByDistrictId($DistrictId = 0, $returnVarType = 0) {
        if (!empty($DistrictId)) {
            $this->clearup();
//            $selectFiled=  array("area_name","regions_name");
//            $this->addSelect($selectFiled);
            $RegionsIdArray = explode(",", $DistrictId);
            $RegionsIdLenth = count($RegionsIdArray);
            if ($RegionsIdLenth != 1) {
                $this->echoErrorCode('2004');
            }
            foreach ($RegionsIdArray as $RegionsIdElement) {
                if (!ctype_digit($RegionsIdElement)) {
                    $this->echoErrorCode('2002');
                }
            }

            $this->changeTable("regions");
            $join_str = array(array("district", "regions.district_id", "district.id"));
            if ($returnVarType == 1) {
                 $fildStr = "regions.id,regions_name";
            } else {
                $fildStr = "regions.id,regions_name,district_name,district_id";
               
            }
             $this->addSelect($fildStr);
            $this->addJoin($join_str);
            $this->initialize("regions.district_id in (" . $DistrictId . ")");
            $var = $this->vars_all;
            $this->clearUp();
            return $var;
        } else {
            $this->echoErrorCode('2002');
        }
    }

    public function getAllRegionsInformation($complete=0) {
        $this->clearup();
//            $selectFiled=  array("area_name","regions_name");
//            $this->addSelect($selectFiled);
        $this->changeTable("regions");
        if($complete==1){
            
        }else{
        $join_str = array(array("district", "regions.district_id", "district.id"));
        $this->addJoin($join_str);
        }
        $this->initialize();
        return $this->vars_all;
    }

    public function getAllDistrictInformation($type = 0) {
        $this->clearup();
//            $selectFiled=  array("area_name","regions_name");
//            $this->addSelect($selectFiled);
        $this->changeTable("district");
        $this->initialize();
        return $this->vars_all;
    }

}

/*
 * 获取团购信息
 */

class DealsInformationDalModel extends Basic {

    private $id;
    private $tableName = 'deal';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        parent::__constructor($this->child_name);
    }

    public function __get($name) {
        return isset($this->$name) ? $this->$name : null;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function getDealsInformationById($DealsId = 0) {
        if (!empty($DealsId)) {
            $this->clearup();
            $RegionsIdArray = explode(",", $DealsId);
            $RegionsIdLenth = count($RegionsIdArray);
            if ($RegionsIdLenth != 1) {
                $this->echoErrorCode('2007');
            }
            foreach ($RegionsIdArray as $RegionsIdElement) {
                if (!ctype_digit($RegionsIdElement)) {
                    $this->echoErrorCode('2003');
                }
            }
            $this->initialize("deal_id in (" . $DealsId . ")");
            return $this->vars;
        } else {
            $this->echoErrorCode('2003');
        }
    }
    public function getDeals(){
        $this->initialize();
        return $this->vars_all;
    }
    public function getDealsInformationByBusinessId($BusinessId=0){
         if(!empty($BusinessId)){
             $BusinessIdNewStr="";
             if(is_array($BusinessId)){
                $check= $this->checkArrayAllDigit($BusinessId, "2001");
                 if($check){
                 $BusinessIdNewStr=  implode(",", $BusinessId);
                 }
             }
             if(is_string($BusinessId)){
                $BusinessIdArray= $this->checkStrignArrayLastElement($BusinessId);
                 $BusinessIdNewStr = implode($BusinessIdArray, ",");
             }
             $this->initialize("business_id in (" . $BusinessIdNewStr . ")");
            if($this->vars_number<=0){
                $this->echoErrorCode('2010');
            }
//                 $a=$this->vars_all;
//                  var_dump($a);
                  return $this->vars_all;
            
             
         }
         else{
             $this->echoErrorCode("2001");
         }
    }

//    public function getManyDealsInformationById($BusinessId = 0) {
//        if (!empty($BusinessId)) {
//            $this->clearup();
//            $this->initialize("deal_id in (" . $DealsId . ")");
//            return $this->vars_all;
//        } else {
//            $this->echoErrorCode('2003');
//        }
//    }

}

class tagsInformationDalModel extends Basic {

    private $id;
    private $tableName = 'tags';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        parent::__constructor($this->child_name);
    }

    public function __get($name) {
        return isset($this->$name) ? $this->$name : null;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function getAlltagsInformation() {
        $this->clearup();
//            $selectFiled=  array("area_name","regions_name");
//            $this->addSelect($selectFiled);
        $this->initialize();
        return $this->vars_all;
    }
        public function getManyTagsInformation($id) {
        $this->clearup();
//            $selectFiled=  array("area_name","regions_name");
//            $this->addSelect($selectFiled);
        $this->initialize("id in ($id)");
        return $this->vars_all;
    }

}

?>