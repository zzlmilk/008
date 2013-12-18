<?php

class adminController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function getAllArea() {
        $adminBll = new adminBllModel();
        $result = $adminBll->getAllArea();
    }

    /*
     * 根据id获取对应商区
     */

    public function getAllBusiness() {
        $sid = $_GET['sid'];
        $adminBll = new adminBllModel();
        $result = $adminBll->getAllbusiness($sid);
    }

}

?>
