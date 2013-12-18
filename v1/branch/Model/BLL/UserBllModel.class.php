<?php

/*
 * 用户  业务逻辑
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserBllModel extends UserDalModel {

    var $object;

    public function __construct() {

        parent::__construct();
    }

    /**
     *  多条数据
     */
    public function test() {
        $array = $userArray = array();
        $result = $this->searchUserArray();
        if (count($result) > 0) {

            foreach ($result as $b => $c) {

                /**
                 *  创建一个新的对象
                 */
                $userObject = new stdClass();

                /**
                 * 将数据库查询出来的值  统一赋值给模型库
                 */
                $this->valSet($c);


                /**
                 *  通过模型库的 魔法方法  获取  用户ID 并 把获取出来的值  传递给对象
                 */
                $userObject->user_id = $this->user_id;
                array_push($array, $userObject);
            }
        }
        $userArray['user'] = $array;
        $this->AssemblyJson($userArray);
    }

    /*
     * 单条数据
     */

    public function test1() {
        $result = $this->getOneUserById(1);
        if ($result['user_id'] > 0) {
            $userObject = new stdClass();
            $this->valSet($result);

            $userObject->user_name = $this->user_name;
            $userObject->user_age = $this->user_age;
            $userArray['user'] = $userObject;
            $this->AssemblyJson($userArray);
        }
    }

    /*
     * 用户注册
     */

    public function userRegistration($userEmail, $userNickName, $userPassWord) {
        if (strlen($userEmail) > 0 && strlen($userNickName) > 0 && strlen($userNickName) < 20 && strlen($userPassWord) > 0 && strlen($userPassWord) >= 6) {
            if (preg_match("/^(\w+([+-.]\w+)*@\w+([.-]\w+)*[.][a-zA-Z]{2,6})?$/", $userEmail)) {
                //验证密码是否包含中文
                if (preg_match("/([\x81-\xfe][\x40-\xfe])/", $userPassWord)) {
                    $this->echoErrorCode(1004);
                } else {
                    $userDal = new UserDalModel();
                    $reName = $userDal->repeatName($userNickName); //验证昵称是否存在
                    $reEmail = $userDal->repeatEmail($userEmail); //验证邮箱是否存在
                    if (is_array($reName)) {
                        $this->echoErrorCode(1006);
                    } elseif (is_array($reEmail)) {
                        $this->echoErrorCode(1007);
                    } else {
                        $result = $userDal->userRegistration($userEmail, $userNickName, $userPassWord);
                        $userRate['regInfo'] = $result;
                        $this->sendRegisteredMail('008注册验证测试', $userEmail, 'aaaaaaaaaaaaaa');
                        $this->AssemblyJson($userRate);
                    }
                }
            } else {
                $this->echoErrorCode(1003);
            }
        } else {
            if (strlen($userPassWord) < 6) {
                $this->echoErrorCode(1005);
            }
        }
    }

    /*
     * 注册成功 发送验证邮件
     */

    public function sendRegisteredMail($emailTitle, $userEmail, $emailContent) {
        $emailTitle = '008注册验证测试';
        $emailContent = 'aaaaaaaaaaaaaa';
        $mail = new PHPMailer();
        $mail->sendData($emailTitle, $userEmail, $emailContent);
        $mail->Send();
    }

    //登录验证
    public function checkUserLoginIsTrue($account, $password) {
        if (!empty($account) && !empty($password)) {
            $result = $this->getOneUserByAccountAndPassword($account, $password);
            if ($result) {
                $userObject = new stdClass();
                $userObject->is_scuess = 1;
                $userObject->user_name = $result["user_name"];
                $userObject->email = $result['email'];
                $userObject->user_tags = $result['user_tags'];
                $userObject->user_photo = $result['user_photo'];
                $userObject->user_weibo_token = $result['user_weibo_token'];
                $userArray['user'] = $userObject;
                $this->AssemblyJson($userArray);
            } else {
                $userArray = array();
                $userArray["is_scuess"] = 0;
                $userArray['errorCode'] = 1;
                $this->AssemblyJson($userArray);
            }
        } else {
            $userArray['errorCode'] = 2;
            $this->AssemblyJson($userArray);
        }
    }

}

?>
