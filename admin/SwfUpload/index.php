<?php
session_start();
$_SESSION["file_info"] = array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>SWFUpload PHP Ajax上传示例</title>
        <link href="css/swfupload.css" rel="stylesheet" type="text/css" />
        <link href="css/idtabs.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="js/swfupload/handlers.js"></script>
        <script type="text/javascript" src="js/swfupload/fileprogress.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
        <script type="text/javascript">
            var swfu;
            window.onload = function () {
                swfu = new SWFUpload({
                    // Backend Settings
                    upload_url: "upload.php",
                    post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},

                    // File Upload Settings
                    file_size_limit : "2 MB",	// 2MB
                    file_types : "*.jpg",
                    file_types_description : "JPG Images",
                    file_upload_limit : "0",

                    // Event Handler Settings - these functions as defined in Handlers.js
                    //  The handlers are not part of SWFUpload but are part of my website and control how
                    //  my website reacts to the SWFUpload events.
                    file_queued_handler : fileQueued,
                    file_queue_error_handler : fileQueueError,
                    file_dialog_complete_handler : fileDialogComplete,
                    upload_progress_handler : uploadProgress,
                    upload_error_handler : uploadError,
                    upload_success_handler : uploadSuccess,
                    upload_complete_handler : uploadComplete,

                    // Button Settings
                    button_image_url : "images/SmallSpyGlassWithTransperancy_17x18.png",
                    button_placeholder_id : "spanButtonPlaceholder",
                    button_width: 180,
                    button_height: 18,
                    button_text : '<span class="button">选择图片<span class="btn_startupload">(最大 2 MB)</span></span>',
                    button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12px; }',
                    button_text_top_padding: 0,
                    button_text_left_padding: 18,
                    button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
                    button_cursor: SWFUpload.CURSOR.HAND,

                    // Flash Settings
                    flash_url : "js/swfupload/swfupload.swf",

                    custom_settings : {
                        progressTarget : "fsUploadProgress",
                        cancelButtonId : "btnCancel"
                    },

                    // Debug Settings
                    debug: false
                });
            };

            $("document").ready(function(){
                $("#uploadpanel ul").idTabs();
            });

        </script>
    </head>
    <body>
        <div id="uploadpanel" class="usual">
            <ul>
                <li>
                    <a class=selected href="#tab1">Flash上传</a>
                </li>
                <li>
                    <a href="#tab2">普通上传</a>
                </li>
            </ul>
            <div id="tab1" class="div">
                <div id="content">
                    <h2>Swfupload PHP Ajax上传示例</h2>
                    <p>图片由SWFUpload上传，然后无刷新显示缩略图</p>
                    <?php
                    if( !function_exists("imagecopyresampled") ) {
                        ?>
                    <div class="message">
                        <h4><strong>错误:</strong> </h4>
                        <p>服务器端并没有安装GD库</p>
                        <p>请在php.ini中把<code>;extension=php_gd2.dll</code>修改为<code>extension=php_gd2.dll</code> and making sure your extension_dir is pointing in the right place. <code>extension_dir = "c:\php\extensions"</code></p>
                    </div>
                        <?php
                    } else {
                        ?>
                    <form>
                        <div class="fieldset flash" id="fsUploadProgress">
                            <span class="legend">上传队列</span>
                        </div>
                        <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
                            <span id="spanButtonPlaceholder"></span>&nbsp;
                            <input type="button" value="开始上传" class="btn_startupload" onclick="swfu.startUpload();"/>
                        </div>
                    </form>
                        <?php
                    }
                    ?>
                    <div id="thumbnails"></div>
                </div>
            </div>
            <div id="tab2" class="div">自己写去....</div>
        </div>
    </body>
</html>