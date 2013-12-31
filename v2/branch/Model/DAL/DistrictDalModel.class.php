<?php

//添加店铺评论 底层数据处理
class DistrictDalModel extends Basic {

    private $tableName = 'district';
    private $dbName = '008v2';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        $this->changeDB($this->dbName);
        parent::__constructor($this->child_name);
    }

    /*
     * 获取地区信息
     */

    public function getDistrictInfo($data) {
        header('Content-type: text/html; charset=utf-8');
        $ary = $data['cities'][0];
//        print_r($ary['districts']);
        foreach ($ary['districts'] as $k => $v_business) {
            unset($ary['districts'][$k]['neighborhoods']);
            $this->insert($ary['districts'][$k]);
        }
    }

    public function getDistrictId($dis_name) {
        $this->clearUp();
        $this->initialize('district_name = "'.$dis_name.'"');
        return $this->vars;
    }
}

?>
