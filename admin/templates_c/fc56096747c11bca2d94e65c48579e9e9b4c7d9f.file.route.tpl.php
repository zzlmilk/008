<?php /* Smarty version Smarty-3.0-RC2, created on 2013-12-10 15:19:41
         compiled from "C:/Apache24/htdocs/admin//templates\route.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4352a6c08d3661f4-44227196%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc56096747c11bca2d94e65c48579e9e9b4c7d9f' => 
    array (
      0 => 'C:/Apache24/htdocs/admin//templates\\route.tpl',
      1 => 1386648803,
    ),
  ),
  'nocache_hash' => '4352a6c08d3661f4-44227196',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="./css/admin.css" rel="stylesheet" type="text/css" />
        <script src="./js/jquery-1.7.2.min.js"></script>
        <script>

                $.ajax({
                    type: "GET",
                    url: "<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=route&function=getArea",
                    success: function(mes){
                        $("#a").html(mes);
                    }
                });    
                function changeArea(){
                    var options=$("#business option:selected"); //获取选中的项 
                    sid = options.val();
                    //var sname = options.text();
                    getBusiness(sid);
                }
                
                function getBusiness(sid){
                    $.ajax({
                        type: "GET",
                        url: "<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=route&function=getBusiness",
                        data:{
                            sid : sid
                        },
                        success: function(mes){
                            $("#b").html(mes);
                        }
                    });  
                } 
        </script>
    </head>
    <body>
        <form action="<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=route&function=insertListp" method="Post">
            <div class="rowStyle">
                <span class='tiFont'>店铺ID:</span>
                <span><input type='text' id='shopId' name="shopName" value="" class="textstyle" style=" width: 150px;"></span>
            </div>
            
            <div class="rowStyle">
                <span class='tiFont'>地区:</span>
                <span id ="a">
                    <select name="selectAge" id="selectAge" style=" height: 24px;">   
                        <option value="">加载中...</option>   
                      </select>   
                </span>
<!--                <span>商区</span>-->
                 <span id = "b"></span>
            </div>
            
            <div class="rowStyle">
                <span class='tiFont'>标签:</span>
                <span><input type='text' id='tagId' name="tagName" value=""class="textstyle"style=" width: 185px;" placeholder="多个请以逗号分隔"></span>
            </div>
            <div class="rowBtn">
                <input type="submit" id="submit" name= "sbumit" class="btnStyle" style=" margin-left: 68px;" value="提交">
                <input type="reset" id='reset' value="取消" class="btnStyle"  style=" margin-left: 20px;">
            </div>
        </form>

    </body>
</html>
