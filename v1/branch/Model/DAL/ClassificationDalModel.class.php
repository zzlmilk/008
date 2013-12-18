<?php

class ClassificationDalModel extends Basic {

    private $tableName = 'classification';
    private $dbName = '008v1';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        $this->changeDB($this->dbName);
        parent::__constructor($this->child_name);
    }

    /*
     * 获取详细分类分类
     */

    public function getClassification($data) {
        header('Content-type: text/html; charset=utf-8');
        $aryCate = $data['categories'];
        if (count($aryCate) > 0) {
            foreach ($aryCate as $k => $v_business) {
                $fic = new CategoryDalModel();
                $a = $fic->getClassificationIdByName($aryCate[$k]['category_name']);
                $ClassificationId = $a['id'];
                foreach ($aryCate[$k]['subcategories'] as $v) {
                    if (!empty($v)) {
                        $array['categories_id'] = $ClassificationId;
                        $array['classification_name'] = $v;
                        $this->insert($array);
                        unset($array);
                    }
                }
            }
        }
    }

    /*
     * 根据小分类名称获取大分类id
     */

    public function getCategoriesId($regions_name) {
        if (!empty($regions_name)) {
            header('Content-type: text/html; charset=utf-8');
            $this->initialize('classification_name = "' . $regions_name . '" ');
            $regions_Info = $this->vars;
            return $regions_Info['categories_id'];
        }
    }
}

?>
