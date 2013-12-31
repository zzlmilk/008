<?php

//添加店铺评论 底层数据处理
class DealIdDalModel extends Basic {

    private $tableName = 'deal_info';
    private $dbName = '008v2';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        $this->changeDB($this->dbName);
        parent::__constructor($this->child_name);
    }

    /*
     * 获取团购Id
     */

    public function getDealId($data) {
        header('Content-type: text/html; charset=utf-8');
        $ary = $data['id_list'];
        foreach ($ary as $k => $v_business) {
            $deal_id = $array['deal_id'] = $v_business;
            $this->getDealInfo($deal_id);
//            $this->insert($array);
        }
    }

    public function getDealInfo($deal_id) {
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
            'deal_ids' => $deal_id,
        );
        $dataBll = new DataBllModel();
        $dataBll->getDealInfoById($params);
    }

    public function getDealInfoById($data) {
        header('Content-type: text/html; charset=utf-8');
        $ary = $data['deals'];
        foreach ($ary as $k => $v_business) {
            $array['deal_id'] = $ary['deal_id'];

            $this->insert($array);
        }
        print_r($data);
    }

}

?>
