<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserDalModel extends Basic {

    private $id;
//    private $user_age;
    private $email;
    private $password;
    private $user_name;
    private $user_tags;
    private $user_photo;
    private $user_weibo_token;
    private $tableName = 'user';
    protected $tableField = array('id', 'user_name', 'email', 'user_photo', 'user_tags', 'password');

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

    public function searchUserArray() {
        $this->initialize();
        return $this->vars_all;
    }

    public function valSet($c) {
        foreach ($this->tableField as $v) {
            if (!empty($c[$v])) {
                $this->$v = $c[$v];
            }
        }
    }

    /*
     * 验证用户名是否重复
     */

    public function repeatName($userNickName) {
        $this->initialize('user_name =  "' . $userNickName . '"');
        return $this->vars;
    }

    /*
     * 验证邮箱是否重复
     */

    public function repeatEmail($userEmail) {
        $this->clearUp();
        $this->initialize('email =  "' . $userEmail . '"');
        return $this->vars;
    }

    /*
     * 用户注册
     */

    public function userRegistration($userEmail, $userNickName, $userPassWord) {
        if (!empty($userEmail) && !empty($userNickName) && !empty($userPassWord)) {
            $data['email'] = $userEmail;
            $data['user_name'] = $userNickName;
            $data['password'] = $userPassWord;
            $this->insert($data);
            return $data;
        }
    }

    public function getOneUserByAccountAndPassword($account, $password) {
        if (!empty($account) && !empty($password)) {
            $this->clearup();
            $this->initialize("email='" . $account . "' and password='" . $password . "'");
            return $this->vars;
        } else {
            return 0;
        }
    }

    public function getOneUserById($id = 1) {

        $this->clearup();
        $this->initialize('user_id = ' . $id);
        return $this->vars;
    }

}
?>

