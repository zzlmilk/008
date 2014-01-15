<?php
session_start();

defined('IPADDRESS') or define('IPADDRESS', 'http://112.124.25.155');
//const IPADDRESS='http://127.0.0.1';
defined('SERVERADDRESS') or define('SERVERADDRESS', IPADDRESS);      
defined('FOOT_') or define('FOOT_', $_SERVER['DOCUMENT_ROOT']);
defined('FOOT') or define('FOOT', FOOT_ . '/008/v2/admin/');
defined('FOOTBASIC') or define('FOOTBASIC', FOOT_ . '/008/v2/admin/basicClasses/');
defined('FOOTCLASS') or define('FOOTCLASS', FOOT_ . '/008/v2/admin/classes/');
defined('FOOTController') or define('FOOTController', FOOT_ . '/008/v2/admin/publicController/');
defined('URLController') or define('URLController', IPADDRESS.'/008/v2/admin/');
defined('URLAjaxController') or define('URLAjaxController', IPADDRESS.'/008/v2/admin/ajax');
defined('URLJsController') or define('URLJsController', IPADDRESS.'/008/v2/admin/js');
defined('URLAPI') or define('URLAPI', IPADDRESS.'/008');
defined('EXCELREAD') or define('EXCELREAD', FOOT . 'excelfile/');
require_once FOOT . 'js/smarty.php';
require_once FOOT . '/plug/reader.php';   //excel 文件问题


if ($handle = opendir(FOOTBASIC)) {
    /* to include all files that in the class folder what a way to include classes!!! */
    while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..' && $file != '.svn') {
            include_once(FOOTBASIC . $file);
        }
    }
    closedir($handle);
}
if ($handle = opendir(FOOTController)) {
    /* to include all files that in the class folder what a way to include classes!!! */
    while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..' && $file != '.svn') {
            include_once(FOOTController . $file);
        }
    }
    closedir($handle);
}
if ($handle = opendir(FOOTCLASS)) {
    /* to include all files that in the class folder what a way to include classes!!! */
    while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..' && $file != '.svn') {
            include_once(FOOTCLASS . $file);
        }
    }
    closedir($handle);
}
$smarty->assign('URLController', URLController);
$smarty->assign('URLAjaxController', URLAjaxController);
$smarty->assign('URLJsController', URLJsController);
$smarty->assign('URLAPI', URLAPI);
?>