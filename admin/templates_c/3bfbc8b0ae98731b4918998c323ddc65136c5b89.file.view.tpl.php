<?php /* Smarty version Smarty-3.0-RC2, created on 2013-12-13 18:24:32
         compiled from "C:/Apache24/htdocs/008/admin//templates\view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1563752aae0603856d2-55318416%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3bfbc8b0ae98731b4918998c323ddc65136c5b89' => 
    array (
      0 => 'C:/Apache24/htdocs/008/admin//templates\\view.tpl',
      1 => 1386930263,
    ),
  ),
  'nocache_hash' => '1563752aae0603856d2-55318416',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<style>
.fontStyle{
 display:block;
 width: 37%;
height: 30px;
line-height: 30px;
 text-align:right;
float:left;
}
.infoStyle{
 display:block;
 width: 53%;
height: 30px;
line-height: 30px;
 text-align:left;
float:left;
text-indent:20px;
}
.rowStyle{
width: 98%;
height: 32px;
border: solid 1px #ccc;
margin-left:-13px;
}
.btnstyle{
 cursor: pointer;
 width:60px;
 height:24px;
}
</style>

<div id="planWarp" style="width:98%; margin: auto;">
    <div style=" width: 98%; height: 30px; text-align: center;">
                    <div class="rowStyle" style=" height: 40px;line-height: 40px; width: 103%;">
                     <span>路线名称：</span>
                     <span><input type="text" disabled="disabled" name="characteristic" id="characteristic" value="<?php echo $_smarty_tpl->getVariable('result1')->value[0];?>
"/></span>
                     <span>所处商区： </span>
                     <span><input type="text" disabled="disabled" id="regions" name="regions" value="<?php echo $_smarty_tpl->getVariable('result1')->value['regions'];?>
"></span>
                    </div>
                    
              
        <div style="float: right; margin-top: -32px; margin-right: 50px;">   
        <span>
        <input type="button" id="btnEdit" class="btnstyle"  name="btnEdit" onclick ="editInfo(<?php echo $_smarty_tpl->getVariable('result1')->value['id'];?>
)"value="编辑" />
        </span>
        <span>
        <input type="button" id="btnSave" class="btnstyle"  name="btnSave" onclick ="saveData(<?php echo $_smarty_tpl->getVariable('result1')->value['id'];?>
)"value="保存" />
        </span>
       </div>            
    </div>
    
    <div style = " width: 330px; float: left;">

                  <div class="rowStyle">
                      <span class="fontStyle">(一)商铺ID：</span>
                      <span class="infoStyle"><input type="text"  disabled="disabled" id="business_id1" name="business_id" value="<?php echo $_smarty_tpl->getVariable('result1')->value['business_id'];?>
"></span>
                  </div>
                  <div class="rowStyle"> 
                      <span class="fontStyle">商铺名称：</span>
                      <span class="infoStyle"><input type="text" disabled="disabled" id="name1" name="name" value="<?php echo $_smarty_tpl->getVariable('result1')->value['name'];?>
"></span>
                  </div>
                 <div class="rowStyle">
                     <span class="fontStyle">商铺别名：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="branch_name1" name="branch_name" value="<?php echo $_smarty_tpl->getVariable('result1')->value['branch_name'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">商铺地址：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="address1" name="address" value="<?php echo $_smarty_tpl->getVariable('result1')->value['address'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">商铺电话：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="telephone1" name="telephone" value="<?php echo $_smarty_tpl->getVariable('result1')->value['telephone'];?>
"></span>
                 </div>

                 <div class="rowStyle">
                     <span class="fontStyle">产品等级：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="avg_consume1" name="avg_consume" value="<?php echo $_smarty_tpl->getVariable('result1')->value['product_grade'];?>
"></span>
                 </div>

                 <div class="rowStyle">
                     <span class="fontStyle">环境等级：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="rank_score1" name="rank_score" value="<?php echo $_smarty_tpl->getVariable('result1')->value['decoration_grade'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">服务等级：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="regions1" name = "regions" value="<?php echo $_smarty_tpl->getVariable('result1')->value['service_grade'];?>
"></span>
                 </div>
                  <div class="rowStyle">
                     <span class="fontStyle">平均等级：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="avg_rating1" name = "avg_rating" value="<?php echo $_smarty_tpl->getVariable('result1')->value['avg_rating'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">平均花费：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="avg_price1" name = "avg_price" value="<?php echo $_smarty_tpl->getVariable('result1')->value['avg_price'];?>
"></span>
                 </div>
                  <div class="rowStyle">
                     <span class="fontStyle">游玩时间：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="state_time1" name = "state_time" value="<?php echo $_smarty_tpl->getVariable('result1')->value['state_time'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">店铺链接：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="business_url1" name = "business_url" value="<?php echo $_smarty_tpl->getVariable('result1')->value['business_url'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">评论数量：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="review_count1" name = "review_count" value="<?php echo $_smarty_tpl->getVariable('result1')->value['review_count'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">是否团购：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="has_deal1" name = "has_deal" value="<?php echo $_smarty_tpl->getVariable('result1')->value['has_deal'];?>
"></span>
                 </div>
                 <div class="rowStyle" style=" margin: 0 auto;">
                     <input type="button" id="btnSave1" style="" class="btnstyle"  name="btnSave" onclick ="saveState1(<?php echo $_smarty_tpl->getVariable('result1')->value['business_id'];?>
)" value="保存" />
                 </div>
                 
             </div>    
<!--                 第二家店铺-->

    <div style = " width: 330px; float: left">             
                  <div class="rowStyle">
                      <span class="fontStyle">(二)商铺ID：</span>
                      <span class="infoStyle"><input type="text"  disabled="disabled" id="business_id2" name="business_id" value="<?php echo $_smarty_tpl->getVariable('result2')->value['business_id'];?>
"></span>
                  </div>
                  <div class="rowStyle">
                      <span class="fontStyle">商铺名称：</span>
                      <span class="infoStyle"><input type="text" disabled="disabled" id="name2" name="name" value="<?php echo $_smarty_tpl->getVariable('result2')->value['name'];?>
"></span>
                  </div>
                 <div class="rowStyle">
                     <span class="fontStyle">商铺别名：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="branch_name2" name="branch_name" value="<?php echo $_smarty_tpl->getVariable('result2')->value['branch_name'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">商铺地址：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="address2" name="address" value="<?php echo $_smarty_tpl->getVariable('result2')->value['address'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">商铺电话：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="telephone2" name="telephone" value="<?php echo $_smarty_tpl->getVariable('result2')->value['telephone'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">产品等级：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="avg_consume2" name="avg_consume" value="<?php echo $_smarty_tpl->getVariable('result2')->value['product_grade'];?>
"></span>
                 </div>

                 <div class="rowStyle">
                     <span class="fontStyle">环境等级：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="rank_score2" name="rank_score" value="<?php echo $_smarty_tpl->getVariable('result2')->value['decoration_grade'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">服务等级：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="regions2" name = "regions" value="<?php echo $_smarty_tpl->getVariable('result2')->value['service_grade'];?>
"></span>
                 </div>
                  <div class="rowStyle">
                     <span class="fontStyle">平均等级：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="avg_rating2" name = "avg_rating" value="<?php echo $_smarty_tpl->getVariable('result2')->value['avg_rating'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">平均花费：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="avg_price2" name = "avg_price" value="<?php echo $_smarty_tpl->getVariable('result2')->value['avg_price'];?>
"></span>
                 </div>
                  <div class="rowStyle">
                     <span class="fontStyle">游玩时间：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="state_time2" name = "state_time" value="<?php echo $_smarty_tpl->getVariable('result2')->value['state_time'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">店铺链接：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="business_url2" name = "business_url" value="<?php echo $_smarty_tpl->getVariable('result2')->value['business_url'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">评论数量：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="review_count2" name = "review_count" value="<?php echo $_smarty_tpl->getVariable('result2')->value['review_count'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">是否团购：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="has_deal2" name = "has_deal" value="<?php echo $_smarty_tpl->getVariable('result2')->value['has_deal'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <input type="button" id="btnSave2" class="btnstyle"  name="btnSave" onclick ="saveState2(<?php echo $_smarty_tpl->getVariable('result2')->value['business_id'];?>
)"value="保存" />
                 </div>
             </div>     
</div>

<script src="./js/jquery-1.7.2.min.js"></script>
<script>
    
    function editInfo(){
        $(":text").removeAttr("disabled");
    }
    
    function saveData(){
                   $.ajax({
                    type: "GET",
                    data:{
//                        插入路线表
                        state_1 : $("#business_id1").val(),
                        state_2 : $("#business_id2").val(),
                        state_type : '1,2',
                        regions : $("#regions").val(),
                        characteristic : $("#characteristic1").val(),
                        avg_consume : $("#avg_consume1").val(),
                        rank_score : $("#rank_score1").val()
                     },
                    url:"<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=listp&function=insertPlan",
                    success: function(res){
                        if( res == 1){
                        alert("数据保存成功");    
                        }
                    }
                });                
    }
               //保存第一家店铺信息
        function saveState1(business_id){
            alert(business_id);
            
        }
             //保存第二家店铺信息
        function saveState(business_id){
            alert(business_id);
            
        }
</script>