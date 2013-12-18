<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of planDalModel
 *
 * @author Administrator
 */
class planDalModel extends Basic {

    private $id;
    private $tableName = 'plan';

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

    //排序以后再添加一个参数以判断如何排序
    public function getSingleBasicPalnById($planId) {
        if (!empty($planId) && ctype_digit($planId)) {
            $this->clearup();
            $this->initialize("id = '$planId' ");
            return $this->vars;
        } else {
            $this->echoErrorCode('3003');
        }
    }

    public function getBasicPalnSingal($extOrderStr = 0, $selectArray = 0, $sort = 0) {
//        if(!empty($DistrictId)){
        $basicOrderStr = array();
        $basicOrderStr[] = "rank_score";
        $basicOrderStr[] = "regions";
        $orderStr = "";
        $selectStr = "";
        if (!empty($extOrderStr)) {
            if (is_array($extOrderStr)) {
                array_merge($basicOrderStr, $extOrderStr);
            }
        }
        if (!empty($selectArray)) {
            if (is_array($selectArray)) {
                $selectStr = implode(" and ", $selectArray);
            }
        }
        $orderStr = implode(",", $basicOrderStr);
        $this->clearup();
        $this->addOrderBy($orderStr);
        $this->initialize($selectStr);
        return $this->vars_all;

//    }
    }

    public function getPlanByWhereString($where) {
        if (!empty($where)) {
            $this->clearup();
            $this->initialize($where);
            return $this->vars_all;
        }
        else {
            $this->echoErrorCode("4001");
        }
    }

    /*
     * 插入自动生成路线
     */

    public function insertAutoPlan($planArray) {
        if (is_array($planArray)) {
            $insertArray = array();
            foreach ($planArray as $planKey => $planValue) {
                $insertArray[$planKey] = $planValue;
            }
            $this->insert($insertArray);
        }
    }

}

?>
