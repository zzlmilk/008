<?php

include '../include.php';
if ($_FILES['Filedata']['name'] != '') {
    $info = @getimagesize($_FILES["Filedata"]["tmp_name"]);
    $save_path = TOOLShotPath . $_REQUEST['tool_id'];
    if (!file_exists($save_path)) {
        mkdir($save_path);
    }
    switch ($info['mime']) {
        case 'image/pjpeg': $ok = 1;
            $end = 'jpg';
            break;
        case 'image/jpeg': $ok = 1;
            $end = 'jpg';
            break;
        case 'image/gif': $ok = 1;
            $end = 'gif';
            break;
        case 'image/png': $ok = 1;
            $end = 'png';
            break;
        case 'image/jpg': $ok = 1;
            $end = 'jpg';
            break;
    }
    if ($ok == 1) {
        $name = $_REQUEST['tool_id'] . '_' . date("YmdHis") . '_' . rand(10000, 99999) . '.' . $end;
        $size = $info[0] . ',' . $info[1];
        @move_uploaded_file($_FILES['Filedata']["tmp_name"], $save_path . '/' . $name);
        $tool = new tool($_REQUEST['tool_id']);
        if ($tool->vars['tool_shot'] != '' || $tool->vars['tool_shot'] != 0) {
            $news_image = json_decode($tool->vars['tool_shot']);
        } else {
            $news_image = array();
        }
        $news_image[] = $name;
        $news_image_array = json_encode($news_image);
    }
    $tool->vars['tool_shot'] = $news_image_array;
    $tool->updateVars();
    $tool->operatorsAction('tool_image', $_REQUEST['user_id'], 'insert', $_REQUEST['tool_id']);
    echo '1,' . $_REQUEST['tool_id'];
}
?>