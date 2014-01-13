<?php

class routeController extends BaseController {

    protected $templateFile = "route.tpl";

    function __construct($smarty, $function = 'index') {
//        ini_set("max_execution_time", 14000); //设置PHP文件最大执行时间 
        parent::__construct($smarty);
        $this->$function();
    }

    function index() {
        $this->display();
    }

    function insertListp() {
        $stateLength = 3;
//        $listp = new listp();
//        $listp->initialize();
//        $data['first_state_id'] = $shopId;
//        $data['regions'] = $regionsId;
//        $data['state_tag'] = $tagName;
//        $listp->insert($data);
//        echo '数据录入成功4，已进入审核状态！';
//        var_dump($_POST);die;
        if (isset($_POST['checkBox'])) {
            $state_type = implode(",", $_POST['checkBox']);
        } else {
            exit("必须选择一个或者一个以上标签");
        }
        if (isset($_POST['characteristic'])) {
            
        } else {
            exit("必须填写主题名称");
        }
        if (isset($_POST['regions'])) {
            
        } else {
            exit("必须选择一个商区");
        }
        if (isset($_POST['business_id1'])) {
            
        } else {
            exit("必须添加至少一个商铺");
        }
        $insertValue = array();
        $insertValue['state_type'] = $state_type;
        $insertValue['characteristic'] = $_POST['characteristic'];
        $insertValue['regions'] = $_POST['regions'];
        $ScoreRankTotal = 0;
        $ConsumeTotal = 0;
        $avgNum = 0;
        for ($i = 1; $i <= $stateLength; $i++) {
            $scoreVal = array();
            $insertPlanBusinessVal = array();
            if (isset($_POST['business_id' . $i])) {

                $businessId = $_POST['business_id' . $i];
                $avgRating = $_POST['avg_rating' . $i];
                $productGrade = $_POST['product_grade' . $i];
                $decorationGrade = $_POST['decoration_grade' . $i];
                $serviceGrade = $_POST['service_grade' . $i];
                $avgPrice = $_POST['avg_price' . $i];
                $state_time = $_POST['state_time' . $i];
                $name = $_POST['name' . $i];
                $branchName = $_POST['branch_name' . $i];
                $address = $_POST['address' . $i];
                $telephone = $_POST['telephone' . $i];
                $reviewCount = $_POST['review_count' . $i];
                $hasDeal = $_POST['has_deal' . $i];
                $businessUrl = $_POST['business_url' . $i];
                $latitude = $_POST['latitude' . $i];
                $longitude = $_POST['longitude' . $i];
                $businessregions = $_POST['regions' . $i];
                $photoUrl = $_POST['business_image' . $i];
                $insertValue['state_' . $i] = $businessId;
//                $ruslt = $this->getBusinessInfoById($businessId);
                $scoreVal['avg_rating'] = $avgRating;
                $scoreVal['product_grade'] = $productGrade;
                $scoreVal['decoration_grade'] = $decorationGrade;
                $scoreVal['service_grade'] = $serviceGrade;
                $scoreVal['review_count'] = $reviewCount; //添加为隐藏属性
                $scoreVal['has_deal'] = $hasDeal; // 添加为隐藏的属性

                $ScoreRank = $this->gradeBusiness($scoreVal);
                $ScoreRankTotal+=$ScoreRank;
                $ConsumeTotal+=$avgPrice;
                $insertPlanBusinessVal['latitude'] = $latitude;
                $insertPlanBusinessVal['longitude'] = $longitude;
                $insertPlanBusinessVal['rank_score'] = $ScoreRank;
                $insertPlanBusinessVal['avg_rating'] = $avgRating;
                $insertPlanBusinessVal['product_grade'] = $productGrade;
                $insertPlanBusinessVal['decoration_grade'] = $decorationGrade;
                $insertPlanBusinessVal['service_grade'] = $serviceGrade;
                $insertPlanBusinessVal['business_id'] = $businessId;
                $insertPlanBusinessVal['name'] = $name;
                $insertPlanBusinessVal['branch_name'] = $branchName;
                $insertPlanBusinessVal['address'] = $address;
                $insertPlanBusinessVal['telephone'] = $telephone;
                $insertPlanBusinessVal['review_count'] = $reviewCount;
                $insertPlanBusinessVal['has_deal'] = $hasDeal;
                $insertPlanBusinessVal['business_url'] = $businessUrl;
                $insertPlanBusinessVal['avg_price'] = $avgPrice;
                $insertPlanBusinessVal['state_time'] = $state_time;
                $insertPlanBusinessVal['photo_url'] = $photoUrl;
                $regionsData = new regions();
                $regionsData->initialize("regions_name like '%$businessregions%'");
                $regionsVal = $regionsData->vars;
                $regionsId = $regionsVal['id'];
                $insertPlanBusinessVal['regions'] = $regionsId;
                $planBusiness = new plan_business();
                $planBusinessId = $planBusiness->insert($insertPlanBusinessVal);
                $insertValue['state_' . $i] = $planBusinessId;

                $avgNum++;
            }
        }
        $insertValue['avg_consume'] = round($ConsumeTotal / $avgNum);
        $insertValue['rank_score'] = round($ScoreRankTotal / $avgNum);
        $insertValue['is_auto_create'] = 1;
        $listp = new listp();
        $listp->insert($insertValue);
        echo '数据录入成功，已进入审核状态！<br> <a href="' . URLController . 'redirst.php?action=route">继续输入路线</a>';
    }

    function getBusinessInfoById($id) {
        $buns = new business_message();
        $buns->initialize("business_id='" . $id . "'", 1);
        $a = $buns->vars;
        return $a;
    }

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

    function getArea() {
        // $smarty = new Smarty();
        $url = URLAPI . '/v2/branch/Information/AllDistrictInformation';
        $html = file_get_contents($url);
        $area = json_decode($html, true);
        $str = '';
        $str.='<select id="business" onchange="changeArea();" style="height:24px;">';
        $str.= '<option value="0" selected>=请选择地区=</option>';
        for ($i = 0; $i < count($area); $i++) {
            $str.= '<option value="' . $area[$i]['id'] . '">' . $area[$i]['district_name'] . '</option>';
        }
        $str.='</select>';
        echo $str;
    }

    function getBusiness() {
        $sid = $_REQUEST['sid'];
        $url = URLAPI . "/v2/branch/Information/getAllRegionsNameByDistrictId?districtId=$sid";

        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        //在需要用户检测的网页里需要增加下面两行
        //curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        //curl_setopt($ch, CURLOPT_USERPWD, US_NAME.":".US_PWD); 
        $contents = curl_exec($ch);
        curl_close($ch);

        $business = json_decode($contents, true);
        $str = '<a style="font-family: serif; color: #716F6C;">商区:</a>';
        $str.='<select id="regions" name= "regions"style="height:24px;">';
//        $str.= '<option selected>=请选择商区=</option>';
        for ($i = 0; $i < count($business); $i++) {
            $str.= '<option value="' . $business[$i]['id'] . '">' . $business[$i]['regions_name'] . '</option>';
        }
        $str.='</select>';
        echo $str;
    }

    function getBusinessUrl() {
        $businessId = isset($_REQUEST["BusinessId"]) ? $_REQUEST["BusinessId"] : 0;
        $ch = curl_init(); //��ʼ��curl
        $url = 'http://www.dianping.com/shop/' . $businessId;

        curl_setopt($ch, CURLOPT_URL, $url); //ץȡָ����ҳ
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json", "User-Agent:Mozilla/5.0 (Windows NT 6.1; rv:24.0) Gecko/20100101 Firefox/24.0"));
        $output = curl_exec($ch);
        curl_close($ch);
        preg_match_all("/<title>(.+?)<\/title>/s", $output, $isHave);
        $businesses = '';
        if (trim($isHave[1][0]) == '商户不存在-大众点评网') {
            $content['sucress'] = 1;
        } else {
//preg_match_all("/<div class=\"J_brief-cont\">(.+?)<\/div>/s", $output, $content);//��
            preg_match_all("/<span class=\"rst\">(.+?)<strong>(.+?)<\/strong><\/span>/s", $output, $scores); //clear! 需要循环取值
            preg_match_all("/<span class=\"region\" (.+?)>(.+?)<\/span>/s", $output, $region); //�$content[2][0]
            preg_match_all("/<span itemprop=\"street-address\">(.+?)<\/span>/s", $output, $address); //$content[1][0]↑相加
            preg_match_all("/<span itemprop=\"tel\" (.+?)>(.+?)<\/span>/s", $output, $tel); //trim($content[2][0])
            preg_match_all("/<strong class=\"stress\">(.+?)<\/strong>/s", $output, $price); //mb_substr(trim($content[1][0]),1,50,'utf-8')
            preg_match_all("/<h1 class=\"shop-title\" itemprop=\"name itemreviewed\">(.+?)<\/h1>/s", $output, $name); //$content[1][0]
            preg_match_all("/<span class=\"bread-name\" itemprop=\"title\">(.+?)<\/span>/s", $output, $regMessage);
            $reg = array($regMessage[1][1], $regMessage[1][2]);
            preg_match_all("/<li data-name=\"all\">(.+?)<\/li>/s", $output, $review);
            preg_match_all("/<em class=\"col-exp\">(.+?)<\/em>/s", $review[1][0], $review1);
            $reviewNum = str_replace(array('(', ')'), '', $review1[1][0]);

            preg_match_all("/<div class=\"promo-list alone-promo promo-deal-box\">(.+?)<\/div>/s", $output, $deal);
            $deal = empty($deal[0]) ? 0 : 1;

            preg_match_all('/<div class=\"thumb-switch\">(.+?)<\/div>/s', $output, $pic);
            preg_match_all('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/s', $pic[0][0], $pic1);
            preg_match_all('/ <span title=\"(.+?)商户\" class=\"item-rank-rst irr-star(.+?)\">/s', $output, $rating);
            $ratingVal = round((($rating[2][0]) / 10), 1);
//---------------------将获取的数据编译为json--------------------------
            $businesses['name'] = $name[1][0];
            $businesses['avg_price'] = mb_substr(trim($price[1][0]), 1, 50, 'utf-8');
            $businesses['telephone'] = trim($tel[2][0]);
            $businesses['address'] = $region[2][0] . $address[1][0];
            $businesses['regions'] = $reg;
            $businesses['review_count'] = $reviewNum;
            $businesses['photo_url'] = $pic1[1][0];
            $businesses['avg_rating'] = $ratingVal;
            $businesses['has_deal'] = $deal;
            $businesses['business_id'] = $businessId;
            $businesses['business_url'] = $url;


            $scoresArray = array('product_grade', 'decoration_grade', 'service_grade');
            foreach ($scoresArray as $k => $scoreName) {
                $businesses[$scoreName] = $scores[2][$k];
            }
            $content['sucress'] = 0;
        }
        $content['businesses'] = array($businesses);
        $content = json_encode($content);
        header('Content-Type:application/json; charset=utf-8');
        exit($content);
    }

    function getBusinessFindUrl() {
        $BusinessId = $_GET['BusinessId'];
        //AppKey
        define('APPKEY', '803330508');
//AppSecret
        define('SECRET', '4f653e229d4c4bea93ae8814e4e64d71');
//API 请求地址
        define('URL', 'http://api.dianping.com/v1/business/get_single_business');
//示例请求参数
        $params = array(
            'format' => 'json',
            'business_id' => $BusinessId,
            'platform' => 2,
        );
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
        $returnValue = curl_exec($curl);
// 关闭URL请求
        curl_close($curl);

//        print('Your request based on: ');
//        print('<br/>');
//print_r($params);
//        print('<br/>');
//print('Result:');
//print('<hr/>');
        header('Content-Type:application/json; charset=utf-8');
        exit($returnValue);
    }

}

?>
