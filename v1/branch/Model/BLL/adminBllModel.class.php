<?php

class adminBllModel extends UserDalModel {

    var $object;

    public function __construct() {

        parent::__construct();
    }
    /*
     * 获取全部地区
     */
    public function getAllArea() {
        $adminDal = new AdminDalModel();
        $result = $adminDal->getAllArea();
        $this->AssemblyJson($result);
    }
    /*
     * 根据id获取对应商区
     */
        public function getAllbusiness($sid) {
        $adminDal = new AdminBusinessDalModel();
        $result = $adminDal->getAllbusiness($sid);
        $this->AssemblyJson($result);
    }
    
}

?>
