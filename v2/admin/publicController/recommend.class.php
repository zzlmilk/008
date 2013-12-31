<?php

class recommendController extends BaseController {

    protected $templateFile = "recommend.tpl";

    function __construct($smarty, $function = 'index') {
//        ini_set("max_execution_time", 14000); //设置PHP文件最大执行时间 
        parent::__construct($smarty);
        $this->$function();
    }

    function index() {
        if(isset($_REQUEST['planId'])){
             $this->assign("historyPlanId", $_REQUEST['planId']);
        }
        $plan = new plan();
        $plan->initialize();
        $planInfo = $plan->vars_all;
        if ($planInfo) {
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
        } else {
            $this->assign("planInfo", 'Nodate');
        }
        $this->display();
    }

    function addRecommend() {
        $extNameArray = array('jpg', 'png', 'bmp');
        $extFlag = false;
            if(!isset($_POST['planId'])){
               echo  '非法登入页面，请通过正确的方式连接本页面';
               die;
            }
            else if($_POST['planId']==''){
               echo  '路线信息错误，请刷新页面之后重新输入';
               die;
            }
            else{
                $planId=$_POST['planId'];
            }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(empty($_POST['recommendTitle'])){
               echo  '路线标题不能为空';
              $this->upLoadErrorReturnURL($planId);
            }
            else{
                $recommendTitle=$_POST['recommendTitle'];
            }
            if (isset($_FILES['upLoadPic'])) {
                $fileName = $_FILES['upLoadPic']['name'];
                $fileNameInfo = pathinfo($fileName);
                $fileNameExtension = $fileNameInfo['extension'];
                foreach ($extNameArray as $ext) {
                    if (strtolower($fileNameExtension) == $ext) {
                        $extFlag = true;
                    }
                }
                if (!$extFlag) {
                    echo '非法的文件后缀名';
                   $this->upLoadErrorReturnURL($planId);
                }

                $fileTmp = $_FILES['upLoadPic']['tmp_name'];
                $imageinfo = getimagesize($fileTmp);
                if ($imageinfo[0] != 640 || $imageinfo[1] != 340) {
                    echo '非法的图片大小';
                    $this->upLoadErrorReturnURL($planId);
                }


                $expName = substr(strrchr($fileName, "."), 0);
                $fileUpDateTime = date("ymdhis" . rand(0, 800));
                $storeDir = "/008/v2/branch/images/";
                $overWrite = 1;
                $uploadsize = $_FILES['upLoadPic']['size'];
                $fileSizeMax = 1024 * 1024 * 9;
                if ($uploadsize > $fileSizeMax) {
                    $requestMessage = '文件超出大小';
                    //return false;
                } else if (file_exists($storeDir . $fileName) && !$overWrite) {
                    $requestMessage = '文件重名';
                    //return false;
                } else if (!move_uploaded_file($fileTmp, $_SERVER["DOCUMENT_ROOT"] . $storeDir . $fileUpDateTime . $expName)) {
                    $requestMessage = '文件无法复制';
                    //return false;
                } else {
                    
                    $insertData['plan_id']=$planId;
                    $insertData['url'] =$fileUpDateTime . $expName;
                    $insertData['title']=$recommendTitle;
                    $insertData['created_at']= date("Y-m-d h:i:s");
                    $recommend=new recommend();
                    $insertReturnNum=$recommend->insert($insertData);
                    if($insertReturnNum>0){
                        echo '添加成功';
                    }
                    else{
                       echo '添加失败';
                    }
                    
                }
            }
        }
    }
        function getTagsNameById($tagsId) {
        $tags = new tags();
        $array = array();
        $aryTagsId = explode(',', $tagsId);
        for ($i = 0; $i < count($aryTagsId); $i++) {
            $tid = $aryTagsId[$i];
            $tags->clearup();
            $tags->initialize('id = ' . $tid);

            $tagesInfo = $tags->vars;
            $tagesName = $tagesInfo['tag_name'];
            array_push($array, $tagesName);
        }

        return implode(',', $array);
    }
        /*
     * 根据商区id获取商区名称
     */

    function getRegionsNameById($regionsId) {
        $regions = new regions();
        $regions->initialize('id ="' . $regionsId . '"');
        $regionsInfo = $regions->vars;
        $regionsName = $regionsInfo['regions_name'];
        return $regionsName;
    }
    function upLoadErrorReturnURL($planId){
         echo '<br/>'.'<a href="'.URLController.'redirst.php?action=recommend&planId='.$planId.'">继续输入路线</a>';
       die;
    }

}

?>
