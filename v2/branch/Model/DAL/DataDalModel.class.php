<?php

//添加店铺评论 底层数据处理
class DataDalModel extends Basic {

    private $tableName = 'business_message';
    private $dbName = '008v1';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        $this->changeDB($this->dbName);
        parent::__constructor($this->child_name);
    }

    /*
     * 大众点评数据入库
     */

    public function getDataApi($data) {
//        var_dump($data);
//        die;  
        $dealsArray = $data['businesses']['deals'];
        if (count($data['businesses']) > 0) {
            foreach ($data['businesses'] as $k => $v_business) {
                unset($data['businesses'][$k]['deals']);
                header('Content-type: text/html; charset=utf-8');
                $data['businesses'][$k]['regions'] = implode(',', $data['businesses'][$k]['regions']);
                $data['businesses'][$k]['categories'] = implode(',', $data['businesses'][$k]['categories']);

                $a = $data['businesses'][$k]['review_count'];
                $b = $data['businesses'][$k]['avg_rating'];
                $c = $data['businesses'][$k]['product_grade'];
                $d = $data['businesses'][$k]['decoration_grade'];
                $e = $data['businesses'][$k]['service_grade'];
                $f = $data['businesses'][$k]['has_deal'];
                
                $aryData=array('review_count'=>$a,'avg_rating'=>$b,'product_grade'=>$c,'decoration_grade'=>$d,'service_grade'=>$e,'has_deal'=>$f);
                $ast = new DataBllModel();
//                var_dump($aryData);
                $result = $ast->gradeBusiness($aryData); //根据相关数据获取综合分数
                $data['businesses'][$k]['rank_score'] = $result;
                $regions_number = $data['businesses'][$k]['regions'];
                $regions_ary = explode(',', $regions_number);
                $regions = new DataBllModel();
                $regions_id = $regions->getRegions_id($regions_ary[1]);//根据商区名称获取商区号
                $data['businesses'][$k]['regions'] = $regions_id;
                
                $regions_name = $data['businesses'][$k]['categories'];
                $categories = new ClassificationDalModel();
                $categories_id = $categories->getCategoriesId($regions_name);//根据小分类名称获取大分类的id
                $data['businesses'][$k]['categories'] = $categories_id;
                $this->insert($data['businesses'][$k]);
            }
        }
    }
}

?>
