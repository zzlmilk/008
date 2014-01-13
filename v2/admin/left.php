<?php

include 'include.php';
$smarty->assign('uname',$_SESSION['user_name']);
$smarty->display('left.tpl');
?>
