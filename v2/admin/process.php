<?php

include 'include.php';
//session_start();
if (isset($_GET['login'])) {
    session_unset();
    echo '<script type="text/javascript">window.location="login.html";</script>';
}
if (isset($_POST['user'])) {
    $admin = new admin();
    $ad['admin_username'] = $_POST['user'];
    $ad['admin_password'] = $_POST['password'];
    $admin->initialize($ad);
    if (count($admin->vars) > 0) {
        $admin->vars['last_time'] = date('Y-m-d H:i:s');
        $admin->updateVars();
        $_SESSION['user_id'] = $admin->vars['id'];
        $_SESSION['user_name'] = $admin->vars['admin_username'];
        $_SESSION['authority']=$admin->vars['authority'];
//        $_SESSION['version'] = $_REQUEST['version'];
        echo '<script type="text/javascript">window.location="index.php";</script>';
    } else {
              header('charset=utf-8');
        echo '<script type="text/javascript">alert("\u7528\u6237\u540d\u6216\u5bc6\u7801\u9519\u8bef");window.location="login.html";</script>';
        //打印用户名或密码错误
    }
}


?>