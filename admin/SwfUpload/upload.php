<?php

include '../include.php';
if ($_REQUEST['news_id'] > 0) {
    if ($_FILES['Filedata']['name'] != '') {
        $info = @getimagesize($_FILES["Filedata"]["tmp_name"]);
        $save_path = NEWSImagePath . $_REQUEST['news_id'];
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
            $name = $_REQUEST['news_id'] . '_' . date("YmdHis") . '_' . rand(10000, 99999) . '.' . $end;
            $size = $info[0] . ',' . $info[1];
            @move_uploaded_file($_FILES['Filedata']["tmp_name"], $save_path . '/' . $name);
            $news_all = new news_all($_REQUEST['news_id']);
            if ($news_all->vars['image_content'] != '' || $news_all->vars['image_content'] != 0) {
                $news_image = json_decode($news_all->vars['image_content']);
            } else {
                $news_image = array();
            }
            if ($news_all->vars['image_info'] != '' || $news_all->vars['image_content'] != 0) {
                $news_image_size = json_decode($news_all->vars['image_info']);
            } else {
                $news_image_size = array();
            }
            $news_image[] = $name;
            $news_image_array = json_encode($news_image);
            $news_image_size[] = $size;
            $news_image_size = json_encode($news_image_size);
        }
        $news_all->vars['image_content'] = $news_image_array;
        $news_all->vars['image_info'] = $news_image_size;
        $news_all->updateVars();
        $news_all->operatorsAction('news_all', $_REQUEST['user_id'], 'image_insert', $_REQUEST['news_id']);
        echo '1,' . $_REQUEST['news_id'];
    }
} else {
    if ($_FILES['Filedata']['name'] != '') {
        $info = @getimagesize($_FILES["Filedata"]["tmp_name"]);
        $save_path = GAMEShotPath . $_REQUEST['game_news_id'];
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
            $name = $_REQUEST['game_news_id'] . '_' . date("YmdHis") . '_' . rand(10000, 99999) . '.' . $end;
            $size = $info[0] . ',' . $info[1];
            @move_uploaded_file($_FILES['Filedata']["tmp_name"], $save_path . '/' . $name);
            $game_news = new game_news($_REQUEST['game_news_id']);
            if ($game_news->vars['image_content'] != '' || $game_news->vars['image_content'] != 0) {
                $news_image = json_decode($game_news->vars['image_content']);
            } else {
                $news_image = array();
            }
            if ($game_news->vars['image_info'] != '' || $game_news->vars['image_content'] != 0) {
                $news_image_size = json_decode($game_news->vars['image_info']);
            } else {
                $news_image_size = array();
            }
            $news_image[] = $name;
            $news_image_array = json_encode($news_image);
            $news_image_size[] = $size;
            $news_image_size = json_encode($news_image_size);
        }
        $game_news->vars['image_content'] = $news_image_array;
        $game_news->vars['image_info'] = $news_image_size;
        $game_news->updateVars();
        $game_news->operatorsAction('game_news', $_REQUEST['user_id'], 'game_new_image_insert', $_REQUEST['game_news_id']);
        echo '1,' . $_REQUEST['game_news_id'];
    }
}
?>