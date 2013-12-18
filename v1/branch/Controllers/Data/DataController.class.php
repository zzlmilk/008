<?php

class DataController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    /*
     * 根据点评Api返回数据 入库 店铺信息
     */

    public function getDataApi() {
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
//            'latitude' => '31.2204200000392',
//            'longitude' => '121.41163000018',
//            'radius' => '5000',
//            'offset_type' => '1',
//            'sort' => '7',
//            'has_deal' => '1',
//            'has_coupon' => '1',
//            'category' => '美食',
//            'region' => '长宁区',
//            'limit' => '40',
//            'keyword' => '上海菜'
        );
        $dataBll = new DataBllModel();
        $dataBll->getDataApi($params);
    }
    
    /*
     * 获取地区信息
     */

    public function getDistrictInfo() {
        //AppKey
        define('APPKEY', '803330508');
        //AppSecret
        define('SECRET', '4f653e229d4c4bea93ae8814e4e64d71');
        //API 请求地址
        define('URL', 'http://api.dianping.com/v1/metadata/get_regions_with_businesses');
        //示例请求参数
        $params = array(
            'format' => 'json',
            'city' => '上海',
        );
        $dataBll = new DataBllModel();
        $dataBll->getDistrictInfo($params);
    }

    /*
     * 获取商区信息
     */

    public function getRegionsInfo() {
        //AppKey
        define('APPKEY', '803330508');
        //AppSecret
        define('SECRET', '4f653e229d4c4bea93ae8814e4e64d71');
        //API 请求地址
        define('URL', 'http://api.dianping.com/v1/metadata/get_regions_with_businesses');
        //示例请求参数
        $params = array(
            'format' => 'json',
            'city' => '上海',
        );
        $dataBll = new DataBllModel();
        $dataBll->getRegionsInfo($params);
    }

    /*
     * 获取团购id
     */

    public function getDealId() {
        //AppKey
        define('APPKEY', '803330508');
        //AppSecret
        define('SECRET', '4f653e229d4c4bea93ae8814e4e64d71');
        //API 请求地址
        define('URL', 'http://api.dianping.com/v1/deal/get_all_id_list');
        //示例请求参数
        $params = array(
            'format' => 'json',
            'city' => '上海',
        );
        $dataBll = new DataBllModel();
        $dataBll->getDealId($params);
    }

    /*
     * 获取大分类列表
     */

    public function getCategory() {
        //AppKey
        define('APPKEY', '803330508');
        //AppSecret
        define('SECRET', '4f653e229d4c4bea93ae8814e4e64d71');
        //API 请求地址
        define('URL', 'http://api.dianping.com/v1/metadata/get_categories_with_coupons');
        //示例请求参数
        $params = array(
            'format' => 'json',
        );
        $dataBll = new DataBllModel();
        $dataBll->getCategory($params);
    }
    
    /*
     * 获取详细分类列表
     */
        public function getClassification() {
        //AppKey
        define('APPKEY', '803330508');
        //AppSecret
        define('SECRET', '4f653e229d4c4bea93ae8814e4e64d71');
        //API 请求地址
        define('URL', 'http://api.dianping.com/v1/metadata/get_categories_with_deals');
        //示例请求参数
        $params = array(
            'format' => 'json',
        );
        $dataBll = new DataBllModel();
        $dataBll->getClassification($params);
    }
    /*
     * 获取团购信息
     */

    public function getDealInfo() {
        //AppKey
        define('APPKEY', '803330508');
        //AppSecret
        define('SECRET', '4f653e229d4c4bea93ae8814e4e64d71');
        //API 请求地址
        define('URL', 'http://api.dianping.com/v1/deal/find_deals');
        //示例请求参数
        $params = array(
            'city' => '上海',
        );
        $dealBll = new DataBllModel();
        $dealBll->getDealInfo($params);
    }

}

?>
