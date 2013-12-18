<?php
class PositionController extends BaseController{
    public function __construct() {
        parent::__construct();
    }

    public function getPosition(){
        $myLat=31.21015549;
        $myLng=121;
        $b=  is_numeric($myLng);
        $range = 180 / pi() * 1 / 6372.797;     //里面的 1 就代表搜索 1km 之内，单位km  
        $lngR = $range / cos($myLat * pi() / 180);  
        $maxLat = $myLat + $range;//最大纬度  
        $minLat = $myLat - $range;//最小纬度  
        $maxLng = $myLng + $lngR;//最大经度  
        $minLng = $myLng - $lngR;//最小经度  
        $a['maxLat']=$maxLat;
        $a['minLat']=$minLat;
        $a['maxLng']=$maxLng;
        $a['minLng']=$minLng;
        var_dump($b);
    }
}

?>
