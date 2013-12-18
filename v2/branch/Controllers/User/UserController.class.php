<?php

class UserController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function test() {
//        $userBll = new UserBllModel();
//        $userBll->test();
        if (null) {
            $c = 0;
        }
        echo $c;
    }

    /*
     * 用户注册接口
     */

    public function userRegistration() {
        $userEmail = $this->request['userEmail'];
        $userNickName = $this->request['userNickName'];
        $userPassWord = $this->request['userPassWord'];
        $userEmail = '892615431@qq.com';
        $userNickName = 'Xbruence1122221';
        $userPassWord = '111111';
        $userBll = new UserBllModel();
        $userBll->userRegistration($userEmail, $userNickName, $userPassWord);
    }
    /*
     * 根据点评Api返回数据 入库店铺信息
     */
    public function getDpDataApi() {
        //AppKey
        define('APPKEY', '803330508');
        //AppSecret
        define('SECRET', '4f653e229d4c4bea93ae8814e4e64d71');
        //API 请求地址
        define('URL', 'http://api.dianping.com/v1/business/find_businesses');
        //示例请求参数
        $params = array(
            'format' => 'json',
            'city' => '上海',
            'latitude' => '31.2204200000392',
            'longitude' => '121.41163000018',
            'radius' => '5000',
            'offset_type' => '1',
            'sort' => '7',
            'has_deal' => '1',
            'has_coupon' => '1',
            'category' => '美食',
            'region' => '长宁区',
            'limit' => '40',
            'keyword' => '上海菜'
        );
        $userBll = new UserBllModel();
        $userBll->getDpDataApi($params);
    }
    

    public function checkUserLogin() {
        $userEmail = $this->request['userEmail'];
        $userPassword = $this->request['userPassword'];
//        die();

        $userBll = new UserBllModel();
        $userBll->checkUserLoginIsTrue($userEmail, $userPassword);
    }

    public function test1() {
        $userBll = new UserBllModel();
        $userBll->test1();
    }

}
?>
