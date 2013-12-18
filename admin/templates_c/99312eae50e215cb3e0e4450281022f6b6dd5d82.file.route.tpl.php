<?php /* Smarty version Smarty-3.0-RC2, created on 2013-12-16 09:52:46
         compiled from "/Users/Lev/Sites/008/admin//templates/route.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94493304152ae5cee6b0c73-65297091%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99312eae50e215cb3e0e4450281022f6b6dd5d82' => 
    array (
      0 => '/Users/Lev/Sites/008/admin//templates/route.tpl',
      1 => 1387111892,
    ),
  ),
  'nocache_hash' => '94493304152ae5cee6b0c73-65297091',
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
        <script src="./js/addcontext.js"></script>
        <script src="./js/sha.js"></script>
        <script>
            urlString='http://192.168.0.103/008/v1/branch/';
            $(document).ready(function(){
            
            $.ajax({
                    type: "GET",
                    url: "<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=route&function=getArea",
                    success: function(mes){
                        $("#a").html(mes);
                    }
                });
                $.ajax(
                {
                    type: "GET",
                    url: urlString+"Information/getAllTags",
                    success: function(rData){
                    var checkStr='';
//                    alert(JSON.stringify(rData));
                        var jsonRData=  eval(rData);
                            for(var i=0;i<jsonRData.length;i++){
                                checkStr+="<span><input name='checkBox[]' type='checkbox' value='"+jsonRData[i].id+"' id='check"+jsonRData[i].id+"'>"+
                                    "<label for='check"+jsonRData[i].id+"'>"+jsonRData[i].tag_name+"</label></span>";
                                if((i+1)%3==0){
                                checkStr+="<br/>";
                            }
                        } 
                        $("#c").html(checkStr);
                    }
                }
            )


        });
                function changeArea(){
                    var options=$("#business option:selected"); //获取选中的项 
                  var  sid = options.val();
                    //var sname = options.text();
                    if(sid!=0){
                    getBusiness(sid);
                    }else{
                    $("#b").html('');
                    }
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
                <span class='tiFont mustInsert'>路线名称:</span>
                <span><input type='text' id='characteristic' name="characteristic" value="" class="textstyle" style=" width: 150px;"></span>
            </div>
            
            <div class="rowStyle">
                <span class='tiFont mustInsert'>地区:</span>
                <span id ="a">
                    <select name="selectAge" id="selectAge" style=" height: 24px;">   
                        <option value="">加载中...</option>   
                      </select>   
                </span>
<!--                <span>商区</span>-->
                 <span id = "b"></span>
            </div>
            
            <div class="rowStyle" style="height: 75px;">
                <span class='tiFont mustInsert'>标签:</span>
                <div id="c" style="margin-left: 70px; height: 150px;">
                    加载中....
                </div>
            </div>
            <div id="Context" style="margin-left: 20px;">
                <input id='ContextNum'type='hidden' value='1'>
            </div>
            <button id="addContext" >添加一个商铺</button>
            <div class="rowBtn">
                <input type="submit" id="submit" name= "sbumit" class="btnStyle" style=" margin-left: 68px;" value="提交">
                <input type="reset" id='reset' value="取消" class="btnStyle"  style=" margin-left: 20px;">
            </div>
        </form>
            <div id="d"></div>
    </body>
</html>
