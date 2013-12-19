<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FavoriteBllModel
 *
 * @author Administrator
 */
class FavoriteBllModel extends FavoriteDalModel {

    var $object;

    public function __construct() {

        parent::__construct();
    }
    //   获取某用户的收藏数据并对数据输出格式进行处理
    public function getFavorite($userId) {
        if (!empty($userId) && ctype_digit($userId)) {
            $result = $this->getFavoriteByUserId($userId);
            $planArray=array();
            foreach ($result as $favoriteVal) {
                $plan = new PlanBllModel();
                $favoritePlan = $plan->getOncePlanById($favoriteVal['plan_id'],1);
                $planArray[]= $favoritePlan;
            }
            $this->AssemblyJson($planArray);
        }
        else{
            $this->echoErrorCode('3002');
        }
    }

}

?>
