<?php

ob_start();

/**
 *  自动加载 配置文件
 * @param type $filePath  路径地址
 * 2013-8-6 by zxp
 */
function fileRead($filePath) {
    if ($handle = opendir($filePath)) {
        /* to include all files that in the class folder what a way to include classes!!! */
        while (false !== ($file = readdir($handle))) {
            $fileName = $filePath . $file;
            //echo $file.'<br />';
            if ($file != '.' && $file != '..' && $file != '.svn' && $file!='.DS_Store') {
                if (is_file($fileName)) {
                    include_once($fileName);
                } else if (is_dir($fileName)) {
                    fileRead($fileName . '/');
                }
            }
        }
        closedir($handle);
    }
}

/**
 * 去除数组中的空值
 *  $var 为 传进来的数组
 */
function filter($array) {
    $newArray = array();
    foreach ($array as $v) {
        if ($v != '') {
            $newArray[] = $v;
        }
    }
    return $newArray;
}

/**
 * 对象数组排序
 */

/**
 *  php:sorted object in array according to a object's field.
 * 
 * @param array $List
 * @param var $by sort filed
 * @param var $order desc/asc
 * @param var $type sort type（num/string）
 * @return array
 */
function ArraySort(array $List, $by, $order = '', $type = '') {
    if (empty($List))
        return $List;
    foreach ($List as $key => $row) {
        //    $sortby[$key] = $row[$by] ;
        $sortby[$key] = $row->$by;
    }
    if ($order == "DESC") {
        if ($type == "num") {
            array_multisort($sortby, SORT_DESC, SORT_NUMERIC, $List);
        } else {
            array_multisort($sortby, SORT_DESC, SORT_STRING, $List);
        }
    } else {
        if ($type == "num") {
            array_multisort($sortby, SORT_ASC, SORT_NUMERIC, $List);
        } else {
            array_multisort($sortby, SORT_ASC, SORT_STRING, $List);
        }
    }
    return $List;
}

/**
 * 处理 URL
 */
function urlAction($url, $count) {
    $urlCount = (count($url) - $count < 0 ) ? 0 : count($url) - $count;
    return $urlCount;
}

/**
 *  错误日志
 */
function log_write($msg, $log_file, $type, $functionname = 'null') {
    if (LOG_STATE == 0) {
        if ($log_file == "") {
            return false;
        }

        $type = ($type != '') ? $type : 'DEFAULT';

        $now = date("M d H:i:s ");


        /**
         *  判断日志文件大小是否超过预设的文件大小
         */
        if (is_file($log_file) && floor(LOG_FILE_SIZE) <= filesize($log_file)) {

            rename($log_file, dirname($log_file) . '/' . time() . '-' . basename($log_file));
        }
        $message = $now . '[' . $type . ']' . '_' . $functionname . '_' . get_client_ip() . '_' . $_SERVER['REQUEST_URI'] . "\r\n" . $msg . "\r\n";

        $fp = fopen($log_file, "a");
        flock($fp, LOCK_EX);
        fputs($fp, $message);
        fclose($fp);
        return TRUE;
    }
}

/**
 * 创建文件夹目录  
 * $path string  文件夹目录  如/home/wwwroot/cloud/name 
 */
function mkdirPath($path) {
    $new = @iconv("UTF-8", "GBK", $path);
    if (!file_exists($new)) {
        mkdir($new, 0777);
    }
}

/**
 * 通过经纬度 和 距离 计算出 4个点
 * @param int $latitude  
 * @param int $longitude
 * @param int $raidus  距离  单位为 千米
 * @return array 
 */
function getAround($latitude, $longitude, $raidus) {
    $result = array();
    $degree = (24901 * 1609) / 360.0;
    $raidusMile = $raidus;
    $dpmLat = 1 / $degree;
    $radiusLat = $dpmLat * $raidusMile;
    $mpdLng = $degree * cos($latitude * (3.14159265 / 180));
    $dpmLng = 1 / $mpdLng;
    $radiusLng = $dpmLng * $raidusMile;

    $minLat = $latitude - $radiusLat;
    $maxLat = $latitude + $radiusLat;

    $minLng = $longitude - $radiusLng;
    $maxLng = $longitude + $radiusLng;


    $result['minLat'] = $minLat;
    $result['maxLat'] = $maxLat;
    $result['minLng'] = $minLng;
    $result['maxLng'] = $maxLng;

    return $result;
}

/**
 * 根据经纬度计算距离
 * @param float $lng1
 * @param float $lat1
 * @param float $lng2
 * @param float $lat2
 * @return int
 */
function getdistance($lng1, $lat1, $lng2, $lat2) {//
    //将角度转为狐度 
    $array = array();
    $radLat1 = deg2rad($lat1);
    $radLat2 = deg2rad($lat2);
    $radLng1 = deg2rad($lng1);
    $radLng2 = deg2rad($lng2);
    $a = $radLat1 - $radLat2; //两纬度之差,纬度<90
    $b = $radLng1 - $radLng2; //两经度之差纬度<180
    $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137;
    if ($s < 1) {
        $m = $s * 1000;
        $array['val'] = $m;
        $array['type'] = 1;
    } else {
        $array['val'] = $s;
        $array['type'] = 0;
    }
    return $array;
}

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 */
function get_client_ip($type = 0) {
    $type = $type ? 1 : 0;
    static $ip = NULL;
    if ($ip !== NULL)
        return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown', $arr);
        if (false !== $pos)
            unset($arr[$pos]);
        $ip = trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u", ip2long($ip));
    $ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

/**
 *  使用CURL 函数 获取远程地址的数据
 */
function curl_get($url, $method, $headers = '') {
    $ch = curl_init($url);  //CURL 函数初始化

    curl_setopt($ch, CURLOPT_URL, $url); //抓取指定网页

    switch ($method) {
        case 'GET':
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
            break;
        case 'POST':
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            break;
    }

    //设置头信息
    if (count($headers) > 0) {

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($ch, CURLOPT_HEADER, 0);  //是否输出头部信息

    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function getApiArray($name) {
    $api = include_once 'Api.php';

    
    if (!empty($api[$name])) {
        return $api[$name];
    } else {
        return 0;
    }
}

/**
 * 自动加载 相关配置文件
 * @param type $dirName  为 引入的文件夹名称
 * @param type $fileKey  当在同一个文件夹 有2个内容 需要引入  将数组定义成二维数组时 为同一个文件夹
 */
function include_path_file($dirName, $fileKey) {
    $filePath = '';
    if (is_array($dirName)) {
        foreach ($dirName as $dirValue) {
            if (!empty($dirValue) && $dirValue != '') {
                $filePath = ROOT_DIR . $fileKey . '/' . $dirValue . '/';
                //echo $filePath.'<br />';
                fileRead($filePath);
            }
        }
    } else {
        $filePath = ROOT_DIR . $dirName . '/';
        fileRead($filePath);
    }
}

?>
