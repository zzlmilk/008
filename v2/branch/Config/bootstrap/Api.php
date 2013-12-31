<?php

$apiInterface = array(
    //首字母必须小写开始  array 0  为该方法传递的方式  1 为 验证的字段  可以用逗号隔开  2 为错误代码
    'User_checkUserLogin' => array('GET', 'userEmail,userPassword', '104'), //保留端口，以后将1去掉可以正式使用
    'Information_getSingleBusinessById' => array('GET', 'businessId', '104'),
    'Information_getRegionsInformationWithDistrictId' => array('GET', 'districtId', '104'),
    'Information_getDealsByBusinessId' => array('GET', 'businessId', '104'),
    'Information_getPlanBusinessById' => array('GET', 'businessId', '104'),
    'Information_getPlanByPlanId' => array('GET', 'planId', '104'),
    'Information_getPlan' => array('GET', 'regions', '104'),
    'Information_getAllRegionsNameByDistrictId' => array('GET', 'districtId', '104'),
    'Information_getPlanByTypeId' => array('GET', 'typeId', '104'),
    "Favorite_addFavorite" => array('GET', 'userId,planId', '104'),
    "Favorite_delFavorite" => array('GET', 'userId,planId', '104'),
    "Favorite_getUserFavorite" => array('GET', 'userId', '104'),
    "Position_getNearbyPlan" => array('GET', 'latitude,longitude', '104'),
);
return $apiInterface;
?>
