<?php

class website {

    public function __construct() {
        /**
         * 初始化 加载配置文件
         */
        include_once 'defined.php';
        /**
         * 引入扩展函数库
         */
        include_once 'extends.php';
        /**
         * 载入 路由 规则
         */
        include_once 'Dispatcher.class.php';
    }

    public function run() {
        /**
         * 加载Model以及DB层
         */
        $file_path = array('Config' => array('DB'), 'Model' => array('DAL', 'BLL'),'Plug');
        foreach ($file_path as $fileKey => $fileValue) {
            include_path_file($fileValue, $fileKey);
        }

        /**
         * 处理URL 以及 执行Action
         */
        $this->initializationWebsiteUrl();
    }

    private function initializationWebsiteUrl() {
        /**
         * 路由处理
         */
        $url = new Dispatcher();
        $url->dispatcher();


        /**
         * 判断模块是否存在
         */
        if (class_exists(MODULE_NAME_CONTROLLER)) {
            /**
             * 实例化类
             */
            $className = MODULE_NAME_CONTROLLER;
            $module = new $className();

            if ($module) {
                /**
                 * 执行方法
                 */
                call_user_func(array(&$module, ACTION_NAME));
            }
        }  
    }

}

?>
