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

    public function addFavoriteByUserId($userId, $favoriteId) {
        if (empty($userId) || !ctype_digit($userId)) {
            $this->echoErrorCode('3002');
        } else if (empty($favoriteId) || !ctype_digit($favoriteId)) {
            $this->echoErrorCode('3003');
        } else {
            $FavoriteVal['user_id'] = $userId;
            $FavoriteVal['plan_id'] = $favoriteId;
            $a = $this->insert($FavoriteVal);
            if (!($a > 0)) {
                $this->echoErrorCode('3004');
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
             $a =$this->vars_number;
            if ($a > 0) {
                $this->remove();
            }
        }
    }

}

?>
