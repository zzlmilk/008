<?php

/*
 * Created on 2009-11-12
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
ini_set('date.timezone', 'Asia/Shanghai');

include_once '2DB_con.php';
class Basic extends Query {

    protected $vars;
    protected $vars_all;
    protected $vars_number;
    protected $col_name;
    protected $error;
    protected $mem;
    protected $child_name;
    protected $error_code = 0;

    public function __construct() {
        try {
            parent::__constructor($this->child_name);
        } catch (Exception $e) {
            echo $e;
        }
    }

    function getVar() {
        $records = $this->selectQuery();
        if ($records) {
            $this->vars = $records[0];
            $this->vars_all = $records[1];
            $this->vars_number = count($this->vars_all);
        } else {
            $this->vars_number = 0;
        }
    }

    function initialize($condition = null) {
        if ($condition != null) {
            $this->addCondition($condition);
        }
        $this->getVar();
    }

    function overrideCondition($condition) {
        if ($condition != null) {
            $this->addCondition($condition, 1);
        }
    }

    function loadAll() {
        $orderBy[] = array($this->table . '_id' => 'ASC');
        $this->addOrderBy($orderBy);
        $records = $this->selectQuery(2);
        $return_data = array();
        if ($records) {
            foreach ($records as $key => $value) {
                $return_data[$value[$this->table . '_id']] = $value;
            }
        }
        return $return_data;
    }

    function selectObject($condition) {
        $this->clearUp();
        $this->addCondition($condition);
    }

    function showError($message) {
        echo $message;
        exit();
    }

    function changeTable($table) {
        $this->changeDataTable($table);
        $this->clearUp();
    }

    function t($text, $parse_br = false, $quote_style = ENT_NOQUOTES) {
        if (is_numeric($text))
            $text = (string) $text;

        if (!is_string($text))
            return null;

        if (!$parse_br) {
            $text = str_replace(array("\r", "\n", "\t"), ' ', $text);
        } else {
            $text = nl2br($text);
        }

        $text = stripslashes($text);
        $text = htmlspecialchars($text, $quote_style, 'UTF-8');

        return $text;
    }

    function updateVars($update = null) {
        $this->addUpdate($this->vars);
        $this->updateQuery();
    }

    /**
     * 用于更新已经定义了的类属性自动过滤不属于类的数组内element
     * @param <type> $array
     */
    function updateAttributes($array) {
        foreach ($array as $key => $val) {
            if (isset($this->vars[$key])) {
                $this->vars[$key] = $val;
            }
        }
        $this->updateVars();
    }

    public function update($update = null, $mode = 0) {
        parent::addUpdate($update, $mode);
        parent::updateQuery();
    }

    function remove() {
        $this->deleteQuery();
    }

    function insert($insert) {
        $id = $this->insertQuery($insert);
        return $id;
    }

    function getTotalRecord($condition = null) {
        if ($condition != null) {
            $this->selectObject($condition);
        }
        return $this->getRecordRow();
    }

    function setQueryMode($mode) {
        $this->mode = $mode;
    }

    function getColumns() {
        $this->col_name = $this->getTableColumn($this->table);
        return $this->col_name;
    }

    public function setOffset($offset) {
        $this->addOffset($offset, $this->_limit);
    }

    public function setLimit($limit) {

        $this->_limit = $limit;
    }

    /**
     * set limit of class
     * @param <type> $limit
     */
    public function changeLimit($limit) {
        $this->limit = $limit;
    }

    public function totalRow() {
        return $this->getTotalRow();
    }

    /**
     * 用于将var_all的参数转化成数组needle是需要转换的名称，$restrict是大于0的标准
     * @param <type> $needle
     * @param <type> $restrict
     * @return <type> array
     */
    public function varsToArray($needle, $restrict = NULL) {
        $array = array();
        if ($this->vars_all) {
            foreach ($this->vars_all as $purchase) {
                if (!empty($restrict)) {
                    if ($purchase[$restrict] > 0) {
                        $array[] = $purchase[$needle];
                    }
                } else {
                    $array[] = $purchase[$needle];
                }
            }
        }
        return $array;
    }

    /**
     *  使用对象的形式来添加数组
     */
    public function insertObject($object, $tableField) {
        foreach ($tableField as $fieldValue) {
            if (!empty($object->$fieldValue)) {
                $insert[$fieldValue] = $object->$fieldValue;
            }
        }
        $id = $this->insert($insert);
        return $id;
    }

    /**
     * 组装成json  如错误代码 则直接返回错误代码的json
     * 判断传进来的值 是否为数组 如不为数组 则定义数组类型
     * 调用setErrorrCode 函数 判断是否有PHP 错误 如有PHP 错误 则优先把错误代码设置为PHP错误代码
     * 调用getErrorInfo 函数 获取该错误代码的提示内容
     * 返回json
     */
    public function AssemblyJson($jsonArray = null, $type = 0, $type = 'json') {
        $logs = apiLog . date("Y_m_d") . '.log';
        if (count($jsonArray) == 0) {
            $jsonArray = array();
        }
        $this->setErrorCode($this->error_code);
        if ($this->error_code != 0) {
            $errorStatus = $this->getErrorInfo($this->error_code);
            $errorObject = new stdClass();
            $errorObject->error_status = $this->error_code;
            $errorObject->status_info = $errorStatus;
            $jsonArray['error'] = $errorObject;
        }
        $encodeJsonEncode = json_encode($jsonArray);
        log_write($encodeJsonEncode, $logs, 'RETURN');
        switch (strtoupper($type)) {
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                exit($encodeJsonEncode);
                break;
        }
    }

    /**
     * 设定错误代码
     */
    public function setErrorCode($errorCode) {
        /**
         * 判断是否有PHP错误
         */
        if (count(error_get_last()) > 0) {
            $error_array = error_get_last();
            if ($error_array['type'] != 8192) {
                $this->error_code = 100;
            }
        } else {
            $this->error_code = $errorCode;
        }
    }

    /**
     * 设定错误代码 并显示到页面上
     */
    public function echoErrorCode($errorCode) {
        $this->setErrorCode($errorCode);
        $this->AssemblyJson();
    }

    /**
     * 获取错误代码表达的内容
     */
    public function getErrorInfo() {
        $errorListArray = include ROOT_DIR . 'Config/bootstrap/error_list.php';
        if (!empty($errorListArray[$this->error_code])) {
            return $errorListArray[$this->error_code];
        }
    }

    /**
     * 
     */
    public function echoTableField() {
        $result = $this->getTableColumn();
        $str = '';
        foreach ($result as $v) {
            $str.="'$v'" . ',';
        }
        echo $str;
    }
    /*
     * 绑定数据模型
     */
        public function createDateObject($dataObject, $result) {
        foreach ($result as $key => $value) {
            $dataObject->$key = $value;
        }
        return $dataObject;
    }
    //检查string参数最后一个值是否为空
        public function checkStrignArrayLastElement($array){
            $explodeArray = explode(",", $array);
            $RegionsIdLenth = count($explodeArray);
            if ($explodeArray[$RegionsIdLenth - 1] == '') {
                array_pop($explodeArray);
            }
            return $explodeArray;
    }
        //检查数组参数是否都为数字
    public function checkArrayAllDigit($array,$errorCode){
            $right=false;
            foreach ($array as $RegionsIdElement) {
                if (!ctype_digit($RegionsIdElement)) {
                    $this->echoErrorCode($errorCode);
                }
                else{
                     $right=true;
                }
                
            }
            return $right;
    }

}

?>
