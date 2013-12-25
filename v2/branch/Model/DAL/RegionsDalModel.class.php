<?php

//添加店铺评论 底层数据处理
class RegionsDalModel extends Basic {

    private $tableName = 'regions';
    private $dbName = '008v1';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        $this->changeDB($this->dbName);
        parent::__constructor($this->child_name);
    }

    /*
     * 获取商区信息
     */

    public function getRegionsInfo($data) {
        header('Content-type: text/html; charset=utf-8');
        $ary = $data['cities'][0];
        $aryDisInfo = $ary['districts'];
        $disDal = new DistrictDalModel();
        foreach ($aryDisInfo as $k => $v_business) {
            $dis_name = $aryDisInfo[$k]['district_name'];
            $disInfo = $disDal->getDistrictId($dis_name);
            $disId = $disInfo['id'];
            if (!empty($disId) && $disId > 0 && count($v_business['neighborhoods']) > 0) {
                foreach ($v_business['neighborhoods'] as $v) {
                    if (!empty($v)) {
                        $array['district_id'] = $disId;
                        $array['regions_name'] = $v;
                        $this->insert($array);
                        unset($array);
                    }
                }
            }
        }
    }

    /*
     * 根据商区名称获取商区id
     */

    public function getRegions_id($regions_name) {
        header('Content-type: text/html; charset=utf-8');
        $this->initialize('regions_name = "' . $regions_name . '" ');
        
        $regions_Info= $this->vars;
        return $regions_Info['id'];
        
    }

}

?>
