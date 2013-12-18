<?php /* Smarty version Smarty-3.0-RC2, created on 2013-12-18 14:51:03
         compiled from "/Users/Lev/Sites/008/admin//templates/listp.tpl" */ ?>
<?php /*%%SmartyHeaderCode:194618186852b145d7ed27c2-36113532%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf82fac9eee56cb6b2d02260aaf73dd597c41ebe' => 
    array (
      0 => '/Users/Lev/Sites/008/admin//templates/listp.tpl',
      1 => 1387349458,
    ),
  ),
  'nocache_hash' => '194618186852b145d7ed27c2-36113532',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript">
                //删除审核路线
                function delInfo(tid){
                   $.ajax({
                    type: "GET",
                    data:{
                     tid : tid
                     },
                    url:"<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=listp&function=delInfo",
                    success: function(res){
                        alert('ok');
                        location.reload();
                    }
                }); 
             }
             
            //通过审核
            function auditInfo(tid){
                   $.ajax({
                    type: "GET",
                    data:{
                     tid : tid
                     },
                    url:"<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=listp&function=auditInfo",
                    success: function(res){
                    if(res == 1){
                    location.reload();
                        }
                    }
                }); 
              }
              //预览
              function viewInfo(characteristic,tid1,tid2,tid3){
                alert(characteristic);
               $.ajax({
                    type: "GET",
                    data:{
                     characteristic : characteristic,
//                     state_type : state_type,
                     tid1 : tid1,
                     tid2 : tid2,
                     tid3 : tid3
                     },
                    url:"<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=view&function=viewInfo",
                    success: function(res){
                    $("#dataWarp").show();            
                    $("#dataInfo").html(res);
                    }
                }); 
          }
          //关闭预览
          function closeView(){
//              $("#mask").hide();
           $("#dataWarp").hide();
      }
              
             //批量导入审核路线
             function impData(){
                  $.ajax({
                    type: "GET",
                    url:"<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=listp&function=impData",
                    success: function(res){
                        if(res == 1){
                            alert("数据已全部成功录入");
                        }
                    }
              });     
         }
         
    </script> 
        <style>
            *{
                font-family: "华文细黑";
                letter-spacing: 1px;
                color: #262626;
             }
            table
            {
                width:100%;
                margin:0 auto;
                border-collapse: collapse;
            }
            .trStyle{
              border:1px solid black;
            }
            td{
            border: solid 1px #ccc;
            text-align: center;
            height : 30px;
            }
            .btnstyle{
                height:28px;
                width:60px;
                cursor: pointer;
            }
            .closeView{
                border: solid 1px #ccc;
                width: 30px;
                height: 50px;
                line-height: 50px;
                text-align: center;
                font-size: 29px;
                color: red;
                float: left;
                display: block;
            }
            
            .closeView:hover{
            text-align: center; 
            background: black; 
            opacity: 0.5; 
            width: 30px;
            height: 50px;
            line-height: 50px;
            cursor: pointer;
            color: red; 
            font-size: 29px;
            float: left; 
            display: block;
            }
        </style>
        
    </head>
    <body>
        <div id="mask" style=" width: 100%; height: 100%; opacity: 0.5; background: black; display: none; position: fixed; z-index: 100"></div>
        <div id="dataWarp" style=" width:99%; margin: 0 auto; height: 100%; border: solid 1px #ccc; display: none; position: fixed; z-index: 300">
            <div style=" width: 100%; height:52px; text-align: right; margin-right: 20px; background: #fff;  border: solid 1px #ccc;" >
                <span style="text-align: center;display: block;float: left;height: 52px;line-height: 50px;width: 96%;
                      font-size: 24px;background: #ccc;">审核路线预览</span>
                <span onclick="closeView()" class="closeView" >X</span></div>
            <div id="dataInfo" style=" background: #fff; width: 100%; height: 100%;"></div>
        </div>
        
    <div id="warp">
        <div style=" text-align: center; font-size: 34px; margin-bottom: 10px;">008v1.0待审核路线列表</div>
        <table>
            <tr style=" font-weight: bold; background-color: #ccc">
                    <td>路线名称</td>
                    <td>商区</td>
                    <td>标签</td>
                    <td style=" width: 100px;">预览</td>
                    <td style=" width: 100px;">审核</td>
<!--                    <td>编辑</td>-->
                    <td style=" width: 100px;">删除</td>
                </tr>
 
             <?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['name'] = 'sn';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('planInfo')->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sn']['total']);
?>
            <tr class="trStyle">
                <td><?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['characteristic'];?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['regions'];?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['state_type'];?>
</td>
                <td style=" width: 100px; text-align: center;"><input type="button" id="btnView" class="btnstyle" name="btnAudit" onclick ="viewInfo(<?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['characteristic'];?>
,<?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['state_1'];?>
,<?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['state_2'];?>
,<?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['state_3'];?>
)"value="预览" /></td>
                <td style=" width: 100px;"><input type="button" id="btnEdit" class="btnstyle" name="btnAudit" onclick ="auditInfo(<?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['id'];?>
)"value="通过" /></td>
                <td style=" width: 100px;"><input type="button" id="btnDel" class="btnstyle" name="btnDelete" onclick ="delInfo(<?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['id'];?>
)" value="删除" /></td>
            </tr>
            <?php endfor; endif; ?>

        </table>
            <div style=" margin-left: 243px;margin-top: 44px;color: red;">
                <span>数据审核完毕，点击此处将数据全部录入路线表--></span>
                <input type="button" id = 'impData' name="impData" style=" width: 135px; height: 32px; cursor: pointer;" value="录入全部数据" onclick="impData()">
            </div>
      </div>
    </body>
</html>