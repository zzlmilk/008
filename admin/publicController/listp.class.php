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

        $this->assign("planInfo", $planInfo);

        $this->display("planp");
    }

    /*
     * 删除不符合要求的信息
     */

    function delInfo() {
        $tid = $_REQUEST['tid'];
        if (!empty($tid) && $tid > 0) {
            $listp = new listp();
            $listp->initialize('id ="' . $tid . '"');
            $listp->remove();
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
        
        echo 1;
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
