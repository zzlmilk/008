<?php
//$c=3;
//$b=6;
//if($c=4or$b=4){
//    $c++;
//    $b++;
//}
//echo $c.$b;
const URLAPI = "http://112.124.25.155/008";
/*
 * 调用获取单个商铺信息
 * 传入string类型的商铺ID
 */
function getReturnValue($url){
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
    $returnVal=json_decode($contents);
     if(isset($returnVal->error)){
         return "<span style='color:red;'>$contents</span> ";
     }else{
    return $contents;
     }
}
function getSingleBusinessById($businessId) {
    $url = URLAPI . "/v2/branch/Information/getSingleBusinessById?businessId=$businessId";
    echo '接口名称: ./Information/getSingleBusinessById <br><br>';
    echo getReturnValue($url);
    
    echo '<br>----------------- <br>';
}

/*
 * 调用获取单个路线内的商铺信息
 * 传入string类型的商铺ID,商铺ID为路线中state_*字段中的ID
 */

function getPlanBusinessById($businessId) {
    $url = URLAPI . "/v2/branch/Information/getPlanBusinessById?businessId=$businessId";
    echo '接口名称: ./Information/getPlanBusinessById <br><br>';
    echo getReturnValue($url);
    echo '<br>----------------- <br>';
}

/*
 * 获取指定区域内的商区
 * 传入区域ID
 */

function getRegionsInformationWithDistrictId($districtId) {
    $url = URLAPI . "/v2/branch/Information/getRegionsInformationWithDistrictId?districtId=$districtId";
    echo '接口名称: ./Information/getRegionsInformationWithDistrictId<br><br>';
    echo getReturnValue($url);
    echo '<br>----------------- <br>';
}

/*
 * 获取指定区域内的商区的完整信息
 * 传入区域ID
 */

function getAllRegionsNameByDistrictId($districtId) {
    $url = URLAPI . "/v2/branch/Information/getAllRegionsNameByDistrictId?districtId=$districtId";
    echo '接口名称: ./Information/getAllRegionsNameByDistrictId<br><br>';
    echo getReturnValue($url);
    echo '<br>----------------- <br>';
}
/*
 * 获取指定路线
 * 传入商区的ID号,
 * 人均消费 （小于等于，可选）,
 * 综合评分（大于等于，可选）,
 * 类型的ID号（可选）
 */

function getPlan($regions,$avgConsume=0,$rankScore=0,$stateTag=0) {
    $url = URLAPI . "/v2/branch/Information/getPlan?regions=$regions";
    if($avgConsume!=0){
         $url .="&avgConsume=$avgConsume&rankScore=$rankScore&stateTag=$stateTag";
    }
    if($rankScore!=0){
         $url .="&rankScore=$rankScore&stateTag=$stateTag";
    }
    if($stateTag!=0){
         $url .="&stateTag=$stateTag";
    }
    echo '接口名称: ./Information/getPlan<br><br>';
    echo getReturnValue($url);
    echo '<br>----------------- <br>';
}
/*
 * 获取附近路线
 * 传入经纬度 获取坐标内一公里的商铺
 */
function getNearbyPlan($longitude,$latitude){
    $url = URLAPI . "/v2/branch/Position/getNearbyPlan?longitude=$longitude&latitude=$latitude";
    echo '接口名称: ./Position/getNearbyPlan<br><br>';
    echo getReturnValue($url);
    echo '<br>----------------- <br>';
}
/*
 * 通过路线ID获取指定路线
 * 传入路线ID
 */
function getPlanByPlanId($planId){
        $url = URLAPI . "/v2/branch/Information/getPlanByPlanId?planId=$planId";
    echo '接口名称: ./Information/getPlanByPlanId<br><br>';
    echo getReturnValue($url);
    echo '<br>----------------- <br>';
}

/*
 * 通过类型获取指定路线
 * 传入类型的编号ID
 */
function getPlanByTypeId($typeId){
    $url = URLAPI . "/v2/branch/Information/getPlanByTypeId?typeId=$typeId";
    echo '接口名称: ./Information/getPlanByTypeId<br><br>';
    echo getReturnValue($url);
    echo '<br>----------------- <br>';
}
/*
 * 获取用户收藏的所有路线信息
 * 传入用户ID
 */
function getUserFavorite($userId){
    $url = URLAPI . "/v2/branch/Favorite/getUserFavorite?userId=$userId";
    echo '接口名称: ./Favorite/getUserFavorite<br><br>';
    echo getReturnValue($url);
    echo '<br>----------------- <br>';
}
getSingleBusinessById('3205237');
getSingleBusinessById('c');
getPlanBusinessById('2');
getRegionsInformationWithDistrictId('1');
getAllRegionsNameByDistrictId('1');
getPlan("185",'113','398','4');
getNearbyPlan('121.48060876','31.23096027');
getPlanByPlanId('1');
getPlanByTypeId('4');
getUserFavorite('80');




?>
