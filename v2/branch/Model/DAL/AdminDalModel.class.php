<?php

//添加店铺评论 底层数据处理
class AdminDalModel extends Basic {

    private $tableName = 'district';
    private $dbName = '008v1';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        $this->changeDB($this->dbName);
        parent::__constructor($this->child_name);
    }

    public function getAllArea() {
        $this->initialize();
        return $this->vars_all;
    }

}

?>
