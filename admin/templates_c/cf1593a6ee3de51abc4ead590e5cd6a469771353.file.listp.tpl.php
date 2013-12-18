<?php /* Smarty version Smarty-3.0-RC2, created on 2013-12-05 11:07:52
         compiled from "C:/Apache24/htdocs/admin//templates\listp.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31136529fee08392975-91043674%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf1593a6ee3de51abc4ead590e5cd6a469771353' => 
    array (
      0 => 'C:/Apache24/htdocs/admin//templates\\listp.tpl',
      1 => 1386212697,
    ),
  ),
  'nocache_hash' => '31136529fee08392975-91043674',
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
        <script src="./js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript">
            
                function delInfo(gid){
                   $.ajax({
                    type: "GET",
                    data:{
                     gid : gid
                     },
                    url:"<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=listp&function=delInfo",
                    success: function(res){
                        //alert(res);
                        location.reload();
                    }
                }); 
             }
             
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
                font-family: "Microsoft Yahei";
                letter-spacing: 1px;
             }
            table
            {
                width:60%;
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
        </style>
        
    </head>
    <body>

        <table>
            <tr style=" font-weight: bold">
                    <td>店铺ID</td>
                    <td>区域</td>
                    <td>商区</td>
                    <td>标签</td>
<!--                    <td>编辑</td>-->
                    <td>删除</td>
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
                <td><?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['first_state_id'];?>
</td>
                <td>--</td>
                <td><?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['regions'];?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['state_tag'];?>
</td>
<!--                <td><input type="button" id="btnEdit" name="btnEdit" value="编辑" /></td>-->
                <td><input type="button" id="btnDel" name="btnDelete" style=" cursor: pointer" onclick ="delInfo(<?php echo $_smarty_tpl->getVariable('planInfo')->value[$_smarty_tpl->getVariable('smarty')->value['section']['sn']['index']]['id'];?>
)" value="删除" /></td>
            </tr>
            <?php endfor; endif; ?>

        </table>
            <div style=" margin-left: 243px;margin-top: 44px;color: red;">
                <span>数据审核完毕，点击此处将数据全部录入路线表--></span>
                <input type="button" id = 'impData' name="impData" style=" width: 135px; height: 32px; cursor: pointer;" value="录入全部数据" onclick="impData()">
            </div>
    </body>
</html>