<?php

$apiInterface = array(
    //首字母必须小写开始  array 0  为该方法传递的方式  1 为 验证的字段  可以用逗号隔开  2 为错误代码
    'User_checkUserLogin' => array('GET', 'userEmail,userPassword', '200001'), //保留端口，以后将1去掉可以正式使用
    'Information_getSingleBusinessById' => array('GET', 'businessId', '200001'),
    'Information_getRegionsInformationWithDistrictId' => array('GET', 'districtId', '200001'),
    'Information_getDealsByBusinessId' => array('GET', 'businessId', '200001'),
    'Information_getPlan' => array('GET', 'regions', '200001'),
    'Information_getAllRegionsNameByDistrictId' => array('GET', 'districtId', '200001'),
    "Fnformation_addFavorite" => array('GET', 'userId,planId', '200001'),
    "Fnformation_delFavorite" => array('GET', 'userId,planId', '200001'),
    "Fnformation_getUserFavorite" => array('GET', 'userId', '200001'),
    "Position_getNearbyPlan" => array('GET', 'latitude,longitude', '200001'),
);
return $apiInterface;
?>
