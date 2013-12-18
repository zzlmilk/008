<?php

include 'include.php';
session_start();
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
        $_SESSION['user_id'] = $admin->vars['admin_id'];
        $_SESSION['user_name'] = $admin->vars['admin_username'];
        $_SESSION['version'] = $_REQUEST['version'];
        echo '<script type="text/javascript">window.location="index.php";</script>';
    } else {
        echo '<script type="text/javascript">alert("用户名或密码错误！");window.location="login.html";</script>';
    }
}


?>