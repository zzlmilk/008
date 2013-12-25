<?php

class BaseController {

    protected $request;
    private $functionname;

    public function __construct() {



        // 拼写方法  
        $this->functionname = MODULE_NAME. '_' . ACTION_NAME;


        // 获取 该接口的 传递信息 以及 错误代码
        $array = getApiArray($this->functionname);

       
        // 处理GET和POST 传递过来的值
        $this->functionsRequest($array);
    }

    private function functionsRequest($array) {
        $i = $check_field_count = 0;
        $result = '';
        if (!empty($array) && is_array($array)) {


            // 判断该方法用哪种形式传值
            if (!empty($array[0])) {
                switch (strtoupper($array[0])) {
                    case 'GET': $result = $_GET;
                        unset($_GET);
                        break;
                    case 'POST':$result = $_POST;
                        unset($_POST);
                        break;
                }
            }
            // 将需要检查的字段转换成数组
            if (!empty($array[1])) {
                $check_field = explode(',', $array[1]);
                $check_field_count = count($check_field);
            } else {
                $check_field = '';
            }

            if (count($result) > 0) {

                // 验证字段是否不为空  并且大于0 
                if ($check_field_count > 0) {
                    foreach ($result as $k => $v) {
                        $this->request[$k] = $v;
                        foreach ($check_field as $key => $value) {
                            if (!empty($result[$value])) {
                                $i++;
                                unset($check_field[$key]);
                            }
                        }
                    }
                }
            }
        }
        /**
         * 写入日志文件
         */
        $logs = apiLog . date("Y_m_d") . '.log';
        log_write(json_encode($result), $logs, 'VISIT', $this->functionname);

        // 判断 检查的字段的个数 是否 和 实际需要检查的个数符合 如不符合 则直接显示报错信息
        if ($check_field_count != $i) {
            $basic = new Basic();
            $basic->echoErrorCode($array[2]);
        }
    }

}

?>