<?php

/*
 * 用户  业务逻辑
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DataBllModel extends UserDalModel {

    var $object;

    public function __construct() {

        parent::__construct();
    }

    public function appScin($params) {
        //按照参数名排序
        ksort($params);
        //print($params);
        //连接待加密的字符串
        $codes = APPKEY;
        //请求的URL参数
        $queryString = '';
        while (list($key, $val) = each($params)) {
            $codes .=($key . $val);
            $queryString .=('&' . $key . '=' . urlencode($val));
        }
        $codes .=SECRET;
        //print($codes);
        $sign = strtoupper(sha1($codes));
        $url = URL . '?appkey=' . APPKEY . '&sign=' . $sign . $queryString;
        $curl = curl_init();
        // 设置你要访问的URL
        curl_setopt($curl, CURLOPT_URL, $url);

        // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_ENCODING, 'UTF-8');
        // 运行cURL，请求API
        $data = json_decode(curl_exec($curl), true);
        // 关闭URL请求
        curl_close($curl);
        return $data;
    }

    /*
     * 大众点评获取数据入库
     */

    public function getDataApi($params) {
        print_r($params);
        $data = $this->appScin($params);
//        var_dump($data);

        $dataDal = new DataDalModel();
        $result = $dataDal->getDataApi($data);

//        $dpData['dpData'] = $result;
//        $this->AssemblyJson($dpData);
    }

    /*
     * 获取地区信息
     */

    public function getDistrictInfo($params) {
        $data = $this->appScin($params);
        $dataDal = new DistrictDalModel();
        $result = $dataDal->getDistrictInfo($data);
    }

    /*
     * 获取商区信息
     */

    public function getRegionsInfo($params) {
        $data = $this->appScin($params);
        $dataDal = new RegionsDalModel();
        $result = $dataDal->getRegionsInfo($data);
    }

    /*
     * 获取团购ID
     */

    public function getDealId($params) {
        $data = $this->appScin($params);
        $dataDal = new DealIdDalModel();
        $result = $dataDal->getDealId($data);
    }

    /*
     * 根据id获取团购信息
     */

    public function getDealInfoById($params) {
        $data = $this->appScin($params);
        $dataDal = new DealIdDalModel();
        $result = $dataDal->getDealInfoById($data);
    }

    /*
      /*
     * 获取分类列表
     */

    public function getCategory($params) {
        $data = $this->appScin($params);
        $dataDal = new CategoryDalModel();
        $result = $dataDal->getCategory($data);
    }

    /*
     * 获取详细分类
     */

    public function getClassification($params) {
        $data = $this->appScin($params);
        $dataDal = new ClassificationDalModel();
        $result = $dataDal->getClassification($data);
    }

    /*
     * 获取团购信息
     */

    public function getDealInfo($params) {
        $data = $this->appScin($params);
        $dealDal = new DealDalModel();
        $result = $dealDal->getDealSectionInfo($data);
    }

    /*
     * 计算商铺的综合评分并返回
     */

    public function gradeBusiness($scoreVal) {
        $gradeScore = 0;
        $rankGrade = 0;
        if (!empty($scoreVal["avg_rating"]) && ctype_digit($scoreVal["avg_rating"])) {
            $gradeScore = $scoreVal["avg_rating"] * 0.3 + $gradeScore;
        }
        if (!empty($scoreVal["review_count"]) && ctype_digit($scoreVal["review_count"])) {
            if ($scoreVal["review_count"] > 100) {
                $gradeScore = ($scoreVal["review_count"] - 100) * 0.3 + $gradeScore;
            }
        }
        if (!empty($scoreVal["product_grade"]) && ctype_digit($scoreVal["product_grade"])) {
            $rankGrade = $scoreVal["product_grade"] + $rankGrade;
        }
        if (!empty($scoreVal["decoration_grade"]) && ctype_digit($scoreVal["decoration_grade"])) {
            $rankGrade = $scoreVal["decoration_grade"] + $rankGrade;
        }
        if (!empty($scoreVal["service_grade"]) && ctype_digit($scoreVal["service_grade"])) {
            $rankGrade = $scoreVal["service_grade"] + $rankGrade;
        }
        $gradeScore = $rankGrade * 0.2 + $gradeScore;
        if ($scoreVal["has_deal"] == 1) {
            $gradeScore = $scoreVal["has_deal"] * 0.2 + $gradeScore;
        }
        return $gradeScore;
    }

    /*
     * 根据商区名称获取商区id
     */

    public function getRegions_id($regions_name) {
        print_r($regions_name);
        $dealDal = new RegionsDalModel();
        $result = $dealDal->getRegions_id($regions_name);
        return $result;
    }

}

?>
