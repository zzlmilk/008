<?php

//添加店铺评论 底层数据处理
class AdminBusinessDalModel extends Basic {

    private $tableName = 'regions';
    private $dbName = '008v2';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        $this->changeDB($this->dbName);
        parent::__constructor($this->child_name);
    }

    public function getAllbusiness($sid) {
        $this->initialize('district_id = "'.$sid.'" ');
        return $this->vars_all;
    }

}

?>
