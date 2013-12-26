<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FavoriteDalModel
 *
 * @author Administrator
 */
class FavoriteDalModel extends Basic {

    private $id;
    private $tableName = 'user_favorite';

    public function __construct() {
        $this->child_name = strtolower($this->tableName);
        parent::__constructor($this->child_name);
    }

    public function __get($name) {
        return isset($this->$name) ? $this->$name : null;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function getFavoriteByUserId($userId) {
        if (!empty($userId) && ctype_digit($userId)) {
            $this->clearup();
            $this->initialize("user_id in (" . $userId . ")");
            return $this->vars_all;
        } else {
            $this->echoErrorCode('3002');
        }
    }

    public function getFavoriteMessageByWhereString($where) {
        if (!empty($where)) {
            $this->clearup();
            $this->initialize($where);
            return $this->vars_all;
        } else {
            $this->echoErrorCode("4001");
        }
    }

    public function addFavoriteByUserId($userId, $favoriteId) {
        if (empty($userId) || !ctype_digit($userId)) {
            $this->echoErrorCode('3002');
        } else if (empty($favoriteId) || !ctype_digit($favoriteId)) {
            $this->echoErrorCode('3003');
        } else {
            $this->initialize("user_id ='$userId' and plan_id='$favoriteId'");
            $FavoriteNum = $this->vars_number;
            if ($FavoriteNum <= 0) {
                $FavoriteVal['user_id'] = $userId;
                $FavoriteVal['plan_id'] = $favoriteId;
                $a = $this->insert($FavoriteVal);
                if (!($a > 0)) {
                    $this->echoErrorCode('3004');
                }
                else{
                    $json['state']='success';
                    $this->AssemblyJson($json);
                }
            }
            else{
                 $this->echoErrorCode('3006');
            }
        }
    }

    public function delFavoriteByUserId($userId, $favoriteId) {
        if (empty($userId) || !ctype_digit($userId)) {
            $this->echoErrorCode('3002');
        } else if (empty($favoriteId) || !ctype_digit($favoriteId)) {
            $this->echoErrorCode('3003');
        } else {
            $FavoriteVal['user_id'] = $userId;
            $FavoriteVal['plan_id'] = $favoriteId;
            $this->initialize("user_id ='$userId' and plan_id='$favoriteId'");
            $FavoriteNum = $this->vars_number;
            if ($FavoriteNum > 0) {
                $this->remove();
                    $json['state']='success';
                    $this->AssemblyJson($json);
            } else {
                $this->echoErrorCode('3005');
            }
        }
    }

}

?>
