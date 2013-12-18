<?php

$apiInterface = array(
    //首字母必须小写开始  array 0  为该方法传递的方式  1 为 验证的字段  可以用逗号隔开  2 为错误代码
    'user_checkUserLogin'=>array('GET','userEmail,userPassword','200001'),          //保留端口，以后将1去掉可以正式使用
    'information_getSingleBusinessById'=> array('GET','businessId','200001'),  
    'information_getRegionsInformationWithDistrictId'=> array('GET','districtId','200001'),
     'information_getDealsByBusinessId'=> array('GET','businessId','200001'),
     'information_getPlan'=>  array('GET','regions','200001'),
     'information_getAllRegionsNameByDistrictId'=>array('GET','districtId','200001'),
    "favorite_addFavorite"=>array('GET','userId,planId','200001'),
    "favorite_delFavorite"=>array('GET','userId,planId','200001'),
    "favorite_getUserFavorite"=>array('GET','userId','200001'),
    "position_getNearbyPlan"=>array('GET','latitude,longitude','200001'),
);
return $apiInterface;
?>
