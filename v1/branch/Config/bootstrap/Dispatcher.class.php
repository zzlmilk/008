<?php

class Dispatcher {

    public function dispatcher() {
        if (!empty($_SERVER['PATH_INFO'])) {
            $pathInfo = explode(URL_PATHINFO_DEPR, trim($_SERVER['PATH_INFO'], URL_PATHINFO_DEPR));
            $this->DataProcess($pathInfo);
        }
    }

    /**
     * 处理数组 来获取方法和操作
     */
    private function DataProcess($pathArray) {
        /**
         * shop/shopInfo
         * shop/user/usershoped
         * 第一个为文件夹的名称 如 数组只存在2个 那么 第一个 既为文件夹名称 也为controller 名称
         * 最后一个  为 该模块运行的方法  
         */
        defined('MODULE_NAME_CONTROLLER') or define('MODULE_NAME_CONTROLLER',$pathArray[count($pathArray) - 2] . 'Controller');
        defined('MODULE_DIR_NAME') or define('MODULE_DIR_NAME', $pathArray[0]);
        defined('ACTION_NAME') or define('ACTION_NAME', $pathArray[count($pathArray) - 1]);
        defined('MODULE_NAME') or define('MODULE_NAME', $pathArray[count($pathArray) - 2]);
        /**
         * 载入该目录的Controller
         */
        include_path_file(array('Controller' => MODULE_DIR_NAME), 'Controllers');
    }

}

?>