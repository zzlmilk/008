<?php

class viewController extends BaseController {

    protected $templateFile = "view.tpl";

    function __construct($smarty, $function = 'index') {
//        ini_set("max_execution_time", 14000); //设置PHP文件最大执行时间 
        parent::__construct($smarty);
        $this->$function();
    }

    function index() {
        $this->display();
    }

    /*
     * 预览审核路线
     */

    function viewInfo() {
        echo "1";
        die;
        $characteristic = $_REQUEST['characteristic'];
        $tid1 = $_REQUEST['tid1'];
        $tid2 = $_REQUEST['tid2'];
        $tid3 = $_REQUEST['tid3'];
        if (!empty($tid1) && $tid1 > 0 && !empty($tid2) && $tid2 > 0) {
            $plan_business1 = new plan_business();
            $plan_business1->initialize('id ="' . $tid1 . '"');
            $plan_business2 = new plan_business(); 
            $plan_business2->initialize('id ="' . $tid2 . '"');
            $plan_business3 = new plan_business(); 
            $plan_business3->initialize('id ="' . $tid3 . '"');
            $result1 = $plan_business1->vars;
            $result2 = $plan_business2->vars;
            $result3 = $plan_business3->vars;
//            array_push($result1, $lid);
            array_push($result1, $characteristic);
            $this->assign("result1", $result1);
            $this->assign("result2", $result2);
            $this->assign("result3", $result3);
            $this->display("view");
        }
    }


    /*
     * 更新第一家店铺信息
     */
    function saveInfoOne(){
        $business_id = $_REQUEST['business_id1'];

        $plan_business = new plan_business();
        $plan_business->initialize('business_id = "' . $business_id . '"');

        $update['business_id'] = $_REQUEST['business_id1'];
        $update['name'] = $_REQUEST['name1'];
        $update['branch_name'] = $_REQUEST['branch_name1'];
        $update['address'] = $_REQUEST['address1'];
        $update['telephone'] = $_REQUEST['telephone1'];
        $update['regions'] = $_REQUEST['regions1'];
        $update['decoration_grade'] = $_REQUEST['avg_consume1'];
        $update['state_time'] = $_REQUEST['state_time1'];
        $update['avg_rating'] = $_REQUEST['avg_rating1'];
        $update['avg_price'] = $_REQUEST['avg_price1'];
        $update['rank_score'] = $_REQUEST['rank_score1'];
        $update['business_url'] = $_REQUEST['business_url1'];
        $update['review_count'] = $_REQUEST['review_count1'];
        $update['has_deal'] = $_REQUEST['has_deal1'];

        $plan_business->update($update);
        echo "1";


    }
    /*
     *更新第二家店铺信息
     */
    function saveInfoTwo(){

        $business_id = $_REQUEST['business_id2'];

        $plan_business = new plan_business();
        $plan_business->initialize('business_id = "' . $business_id . '"');

        $update['business_id'] = $_REQUEST['business_id2'];
        $update['name'] = $_REQUEST['name2'];
        $update['branch_name'] = $_REQUEST['branch_name2'];
        $update['address'] = $_REQUEST['address2'];
        $update['telephone'] = $_REQUEST['telephone2'];
        $update['regions'] = $_REQUEST['regions2'];
        $update['decoration_grade'] = $_REQUEST['avg_consume2'];
        $update['state_time'] = $_REQUEST['state_time2'];
        $update['avg_rating'] = $_REQUEST['avg_rating2'];
        $update['avg_price'] = $_REQUEST['avg_price2'];
        $update['rank_score'] = $_REQUEST['rank_score2'];
        $update['business_url'] = $_REQUEST['business_url2'];
        $update['review_count'] = $_REQUEST['review_count2'];
        $update['has_deal'] = $_REQUEST['has_deal2'];

        $plan_business->update($update);
        echo "1";
    }

    function saveInfoThree(){
        $business_id = $_REQUEST['business_id3'];

        $plan_business = new plan_business();
        $plan_business->initialize('business_id = "' . $business_id . '"');

        $update['business_id'] = $_REQUEST['business_id3'];
        $update['name'] = $_REQUEST['name3'];
        $update['branch_name'] = $_REQUEST['branch_name3'];
        $update['address'] = $_REQUEST['address3'];
        $update['telephone'] = $_REQUEST['telephone3'];
        $update['regions'] = $_REQUEST['regions3'];
        $update['decoration_grade'] = $_REQUEST['avg_consume3'];
        $update['state_time'] = $_REQUEST['state_time3'];
        $update['avg_rating'] = $_REQUEST['avg_rating3'];
        $update['avg_price'] = $_REQUEST['avg_price3'];
        $update['rank_score'] = $_REQUEST['rank_score3'];
        $update['business_url'] = $_REQUEST['business_url3'];
        $update['review_count'] = $_REQUEST['review_count3'];
        $update['has_deal'] = $_REQUEST['has_deal3'];

        $plan_business->update($update);
        echo "1";

    }

}

?>
