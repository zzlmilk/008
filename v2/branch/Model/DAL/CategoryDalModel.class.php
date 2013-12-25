<?php

class CategoryDalModel extends Basic {

    private $tableName = 'categories';
    private $dbName = '008v1';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        $this->changeDB($this->dbName);
        parent::__constructor($this->child_name);
    }

    /*
     * 获取分类
     */

    public function getCategory($data) {
        header('Content-type: text/html; charset=utf-8');
        $aryCate = $data['categories'];
        if (count($aryCate) > 0) {
            foreach ($aryCate as $k => $v_business) {
                $arry['categories_name'] = $aryCate[$k];
                $this->insert($arry);
            }
        }
    }

    /*
     * 根据分类名称获取分类的id
     */

    public function getClassificationIdByName($category_name) {
//        $category_name = '购物';
        $this->initialize('categories_name = "'.$category_name.'"');
        $reslut = $this->vars;
        return $reslut;
    }

}

?>
