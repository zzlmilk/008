<?php

$apiInterface = array(
    //食品接口 开始  array 0  为该方法传递的方式  1 为 验证的字段  可以用逗号隔开  2 为错误代码
    'User_checkUserLogin'=>array('GET','userEmail,userPassword','200001'),          //保留端口，以后将1去掉可以正式使用
    'Information_getSingleBusinessById'=> array('GET','businessId','200001'),  
    'Information_getRegionsInformationWithDistrictId'=> array('GET','districtId','200001'),
     'Information_getDealsByBusinessId'=> array('GET','businessId','200001'),
     'Information_getPlan'=>  array('GET','regions','200001'),
     'Information_getAllRegionsNameByDistrictId'=>array('GET','districtId','200001'),
);
return $apiInterface;
?>
