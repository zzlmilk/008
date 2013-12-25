<?php /* Smarty version Smarty-3.0-RC2, created on 2013-12-20 17:48:30
         compiled from "/Users/Lev/Sites/008/admin//templates/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:106912089452b4126ecdeb13-15759222%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9beb901dad09b0c14521751cd39ae3674f010f57' => 
    array (
      0 => '/Users/Lev/Sites/008/admin//templates/view.tpl',
      1 => 1387532904,
    ),
  ),
  'nocache_hash' => '106912089452b4126ecdeb13-15759222',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<script type="text/javascript">

    $(function(){
        if ($("#business_id3").val() == ''){
            $("#threeShopNF").hide();
        }

    })

    function editInfo(){
        $(":text").removeAttr("disabled");
    }

    //保存路线
    function saveData(){
                   $.ajax({
                    type: "GET",
                    data:{
//                        插入路线表
                        state_1 : $("#business_id1").val(),
                        state_2 : $("#business_id2").val(),
                        state_3 : $("#business_id3").val(),
                        state_type : '1,2',
                        regions : $("#regions").val(),
                        characteristic : $("#characteristic1").val(),
                        avg_consume : $("#avg_consume1").val(),
                        rank_score : $("#rank_score1").val()
                     },
                    url:"<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=listp&function=insertPlan",
                    success: function(res){
                        alert(res);
                        if( res == 1){
                        alert("数据保存成功");    
                        }
                    }
                });                
    }


               //更新第一家店铺信息
        function saveState1(){
                $.ajax({
                    type: "GET",
                    data:{
                        business_id1 : $("#business_id1").val(),
                        name1 : $("#name1").val(),
                        branch_name1 : $("#branch_name1").val(),
                        address1 : $("#address1").val(),
                        telephone1 : $("#telephone1").val(),
                        avg_consume1 : $("#avg_consume1").val(),
                        rank_score1 : $("#rank_score1").val(),
                        regions1 : $("#regions1").val(),
                        avg_rating1 : $("#avg_rating1").val(),
                        avg_price1 : $("#avg_price1").val(),
                        state_time1 : $("#state_time1").val(),
                        business_url1 : $("#business_url1").val(),
                        review_count1 : $("#review_count1").val(),
                        has_deal1 : $("#has_deal1").val(),

                     },
                    url:"<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=view&function=saveInfoOne",
                    success: function(res){
                        if( res == 1){
                        alert("数据保存成功");    
                        }
                    }
                });  
        }

          //更新第二家店铺信息
        function saveState2(){
                $.ajax({
                    type: "GET",
                    data:{
                        business_id2 : $("#business_id2").val(),
                        name2 : $("#name2").val(),
                        branch_name2 : $("#branch_name2").val(),
                        address2 : $("#address2").val(),
                        telephone2 : $("#telephone2").val(),
                        avg_consume2 : $("#avg_consume2").val(),
                        rank_score2 : $("#rank_score2").val(),
                        regions2 : $("#regions2").val(),
                        avg_rating2 : $("#avg_rating2").val(),
                        avg_price2 : $("#avg_price2").val(),
                        state_time2 : $("#state_time2").val(),
                        business_url2 : $("#business_url2").val(),
                        review_count2 : $("#review_count2").val(),
                        has_deal2 : $("#has_deal2").val(),

                     },
                    url:"<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=view&function=saveInfoTwo",
                    success: function(res){
                        if( res == 1){
                        alert("数据保存成功");    
                        }
                    }
                }); 
            
        }
        //更新第三家店铺信息
        function saveState3(){
                $.ajax({
                    type: "GET",
                    data:{
                        business_id2 : $("#business_id2").val(),
                        name2 : $("#name2").val(),
                        branch_name2 : $("#branch_name2").val(),
                        address2 : $("#address2").val(),
                        telephone2 : $("#telephone2").val(),
                        avg_consume2 : $("#avg_consume2").val(),
                        rank_score2 : $("#rank_score2").val(),
                        regions2 : $("#regions2").val(),
                        avg_rating2 : $("#avg_rating2").val(),
                        avg_price2 : $("#avg_price2").val(),
                        state_time2 : $("#state_time2").val(),
                        business_url2 : $("#business_url2").val(),
                        review_count2 : $("#review_count2").val(),
                        has_deal2 : $("#has_deal2").val(),

                     },
                    url:"<?php echo $_smarty_tpl->getVariable('URLController')->value;?>
redirst.php?action=view&function=saveInfoTwo",
                    success: function(res){
                        if( res == 1){
                        alert("数据保存成功");    
                        }
                    }
                }); 
        }

 </script>


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
margin-left:-12px;
margin-bottom: 2px;
line-height: 32px;
}
.btnstyle{
 cursor: pointer;
 width:60px;
 height:24px;
 margin-top: 8px;

}
</style>

<div id="planWarp" style="width:98%; margin: auto;">
    <div style=" width: 98%; height: 30px; text-align: center;">
                    <div class="rowStyle" style=" height: 40px;line-height: 40px; width: 105%;">
                     <span>路线名称：</span>
                     <span><input type="text" disabled="disabled" name="characteristic" id="characteristic" value="<?php echo $_smarty_tpl->getVariable('result1')->value['characteristic'];?>
"/></span>
                     <span>所处商区： </span>
                     <span><input type="text" disabled="disabled" id="regions" name="regions" value="<?php echo $_smarty_tpl->getVariable('result1')->value['regions_name'];?>
"></span>
                    </div>
                    
              
        <div style="float: right; margin-top: -39px; margin-right: 50px;">   
            <span>
            <input type="button" id="btnEdit" class="btnstyle"  name="btnEdit" onclick ="editInfo(<?php echo $_smarty_tpl->getVariable('result1')->value['id'];?>
)"value="编辑" />
            </span>

            <span>
            <input type="button" id="btnSave" class="btnstyle"  name="btnSave" onclick ="saveData(<?php echo $_smarty_tpl->getVariable('result1')->value['id'];?>
)"value="保存路线" />
            </span>
       </div>            
    </div>
    
    <div style = " width: 32%; float: left; margin-left:4%;">

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
                 <div class="rowStyle" style=" text-align:center">
                     <input type="button" id="btnSave1" style=" width: 100px;" class="btnstyle"  name="btnSave" onclick ="saveState1(<?php echo $_smarty_tpl->getVariable('result1')->value['business_id'];?>
)" value="保存店铺信息" />
                 </div>
                 
             </div>    


   <!--                 第二家店铺-->

    <div style = " width: 32%; float: left">             
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
                 <div class="rowStyle" style=" text-align:center">
                     <input type="button" id="btnSave2" style=" width: 100px;" class="btnstyle"  name="btnSave" onclick ="saveState2(<?php echo $_smarty_tpl->getVariable('result2')->value['business_id'];?>
)"value="保存店铺信息" />
                 </div>
             </div>     


<!--                 第三家店铺-->
<span id ="threeShopNF">
    <div style = " width: 32%; float:right">             
                  <div class="rowStyle">
                      <span class="fontStyle">(三)商铺ID：</span>
                      <span class="infoStyle"><input type="text"  disabled="disabled" id="business_id3" name="business_id" value="<?php echo $_smarty_tpl->getVariable('result3')->value['business_id'];?>
"></span>
                  </div>
                  <div class="rowStyle">
                      <span class="fontStyle">商铺名称：</span>
                      <span class="infoStyle"><input type="text" disabled="disabled" id="name3" name="name" value="<?php echo $_smarty_tpl->getVariable('result3')->value['name'];?>
"></span>
                  </div>
                 <div class="rowStyle">
                     <span class="fontStyle">商铺别名：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="branch_name3" name="branch_name" value="<?php echo $_smarty_tpl->getVariable('result3')->value['branch_name'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">商铺地址：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="address3" name="address" value="<?php echo $_smarty_tpl->getVariable('result3')->value['address'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">商铺电话：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="telephone3" name="telephone" value="<?php echo $_smarty_tpl->getVariable('result3')->value['telephone'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">产品等级：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="avg_consume3" name="avg_consume" value="<?php echo $_smarty_tpl->getVariable('result3')->value['product_grade'];?>
"></span>
                 </div>

                 <div class="rowStyle">
                     <span class="fontStyle">环境等级：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="rank_score3" name="rank_score" value="<?php echo $_smarty_tpl->getVariable('result3')->value['decoration_grade'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">服务等级：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="regions3" name = "regions" value="<?php echo $_smarty_tpl->getVariable('result3')->value['service_grade'];?>
"></span>
                 </div>
                  <div class="rowStyle">
                     <span class="fontStyle">平均等级：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="avg_rating3" name = "avg_rating" value="<?php echo $_smarty_tpl->getVariable('result3')->value['avg_rating'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">平均花费：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="avg_price3" name = "avg_price" value="<?php echo $_smarty_tpl->getVariable('result3')->value['avg_price'];?>
"></span>
                 </div>
                  <div class="rowStyle">
                     <span class="fontStyle">游玩时间：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="state_time3" name = "state_time" value="<?php echo $_smarty_tpl->getVariable('result3')->value['state_time'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">店铺链接：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="business_url3" name = "business_url" value="<?php echo $_smarty_tpl->getVariable('result3')->value['business_url'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">评论数量：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="review_count3" name = "review_count" value="<?php echo $_smarty_tpl->getVariable('result3')->value['review_count'];?>
"></span>
                 </div>
                 <div class="rowStyle">
                     <span class="fontStyle">是否团购：</span>
                     <span class="infoStyle"><input type="text" disabled="disabled" id="has_deal3" name = "has_deal" value="<?php echo $_smarty_tpl->getVariable('result3')->value['has_deal'];?>
"></span>
                 </div>
                 <div class="rowStyle" style=" text-align:center">
                     <input type="button" id="btnSave3" class="btnstyle" style=" width: 100px;" name="btnSave" onclick ="saveState3(<?php echo $_smarty_tpl->getVariable('result3')->value['business_id'];?>
)"value="保存店铺信息" />
                 </div>
             </div>     
        </span>
          
</div>

