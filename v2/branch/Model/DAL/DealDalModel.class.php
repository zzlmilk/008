<?php

//添加店铺评论 底层数据处理
class DealDalModel extends Basic {

    private $tableName = 'deal';
    private $dbName = '008v2';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        $this->changeDB($this->dbName);
        parent::__constructor($this->child_name);
    }

    /*
     * 获取团购信息
     */

    public function getDealSectionInfo($data) {
        header('Content-type: text/html; charset=utf-8');
        $ary = $data['deals'][0];
//        var_dump($ary);
//        die;
//        
        foreach ($ary as $k => $v_business) {
            $data['deal_id'] = $ary[$k]['deal_id'];
            $data['publish_date'] = $ary[$k]['publish_date'];
            $data['purchase_deadline'] = $ary[$k]['purchase_deadline'];
            $data['publish_date'] = $ary[$k]['publish_date'];

            $businesses[] = $ary[$k]['businesses'];
//            var_dump($businesses);
//            die;
            foreach ($businesses as $v => $v_info) {
                $array['businesses_id'] = $businesses[$v]['id'];
                $this->insert($array);
                unset($array);
            }
        }
    }
}

?>
