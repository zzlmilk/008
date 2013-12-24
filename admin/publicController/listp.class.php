<?php

class listpController extends BaseController {

    protected $templateFile = "listp.tpl";

    function __construct($smarty, $function = 'index') {
//        ini_set("max_execution_time", 14000); //设置PHP文件最大执行时间 
        parent::__construct($smarty);
        $this->$function();
    }

    function index() {
        $listp = new listp();
        $listp->initialize();
        $planInfo = $listp->vars_all;
    foreach ($planInfo as $k => $v_regions) {
            $aryRegionsId = $planInfo['regions'] = $v_regions;
            $regionsId = $aryRegionsId['regions'];

            $aryTagsId = $planInfo['state_type'] = $v_regions;
            $tagsId = $aryTagsId['state_type'];

            $tagsName = $this->getTagsNameById($tagsId);

            $regionsName = $this->getRegionsNameById($regionsId);
            $planInfo[$k]['regions_name'] = $regionsName;
            $planInfo[$k]['tags_name'] = $tagsName;
        }
        unset($planInfo['regions']);
        unset($planInfo['state_type']);
        $this->assign("planInfo", $planInfo);
        $this->display("planp");
    }

    /*
     *根据商区id获取商区名称
     */
    function getRegionsNameById($regionsId){
        $regions = new regions();
        $regions -> initialize('id ="' . $regionsId . '"');
        $regionsInfo = $regions -> vars;
        $regionsName = $regionsInfo['regions_name'];
        return $regionsName;
    }

    /*
     * 根据标签id获取标签名称
     */
    function getTagsNameById($tagsId){
            $tags = new tags();
            $array = array();
            $aryTagsId = explode(',', $tagsId);
            for ($i=0 ; $i <count($aryTagsId) ; $i++ ) { 
                $tid = $aryTagsId[$i];
                $tags->clearup();
                $tags->initialize('id = '.$tid);
               
                $tagesInfo = $tags -> vars;
                $tagesName = $tagesInfo['tag_name'];
                array_push($array, $tagesName);
            }

            return implode(',', $array);
           
    }

    /*
     * 删除不符合要求的信息
     */

    function delInfo() {
        $tid1 = $_REQUEST['tid3'];
        $tid2 = $_REQUEST['tid3'];
        $tid3 = $_REQUEST['tid3'];
        $lid = $_REQUEST['lid'];
        if (!empty($lid) && $lid > 0) {
            $plan_business = new plan_business();
            $listp = new listp();
            $listp->initialize('id ="' . $lid . '"');
            $plan_business->initialize('business_id ="' . $tid1 . '"');
            $plan_business->initialize('business_id ="' . $tid2 . '"');
            $plan_business->initialize('business_id ="' . $tid3 . '"');
            $plan_business->remove();
            $listp->remove();
            echo "1";
        }
    }

    /*
     * 审核通过单条路线
     */

    function auditInfo() {
        header('Content-type: text/html; charset=utf-8');
        $tid = $_REQUEST['tid'];
        if (!empty($tid) && $tid > 0) {
            $listp = new listp();
            $listp->initialize('id ="' . $tid . '"');
            $resultArry = $listp->vars_all;
            $plan = new plan();
            $plan->initialize();
            foreach ($resultArry as $k => $v_business) {
                $data['first_state_id'] = $resultArry[$k]['first_state_id'];
                $data['state_type'] = $resultArry[$k]['state_type'];
                $data['regions'] = $resultArry[$k]['regions'];
                $plan->insert($data);
            }
            $this->delAuditPlan($tid);
        }
    }

    /*
     * 审核通过删除数据
     */

    function delAuditPlan($tid) {
        if (!empty($tid) && $tid > 0) {
            $listp = new listp();
            $listp->initialize('id ="' . $tid . '"');
            $listp->remove();
            echo '1';
        }
    }

    /*
     * 插入路线
     */

    function insertPlan() {

        $array = array('state_1','state_2','state_3','state_type','avg_consume','rank_score','regions','characteristic'); 
        foreach($array as $v){
            if(!empty($_REQUEST[$v])){
                $insert[$v] = $_REQUEST[$v];
            }
        }

        $plan = new plan();
        $plan->insert($insert);
        
        echo '1';
    }


    /*
     * 批量从审核表导入数据到路线表
     */

    function impData() {
        $query = new Query();
        $sql = 'insert into plan(first_state_id,regions,state_type) select first_state_id,regions,state_type from listp';
        $reslut = $query->execute($sql);
        echo $reslut;
    }

}

?>
