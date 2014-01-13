<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript" src="{$URLController}js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript">
                //删除审核路线 lid 审核表中路线id  tid1 第一家店铺id,tid2 第二家店铺id,tid3 第三家店铺id
                function delInfo(idGroup){
                if(idGroup==''){
                    return false;
                }
              var group=idGroup.split(',');
                   $.ajax({
                    type: "GET",
                    data:{
                     lid : group[0],
                     tid1 : group[1],
                     tid2 : group[2],
                     tid3 : group[3]
                     },
                    url:"{$URLController}redirst.php?action=listp&function=delInfo",
                    success: function(res){
                        if(res == 1){
                        alert('ok');
                        location.reload();        
                        }else{
                            alert("删除失败，请稍后再试");
                        }
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
                    url:"{$URLController}redirst.php?action=listp&function=auditInfo",
                    success: function(res){
                    if(res == 1){
                    location.reload();
                     }
                    }
                }); 
              }
              //预览  tid1 第一家店铺id,tid2 第二家店铺id,tid3 第三家店铺id,characteristic 路线名称
              function viewInfo(infoGroup){

                if(infoGroup==''){
                    return false;
                }
                var group=infoGroup.split(',');
               $.ajax({
                    type: "GET",
                    data:{
                     characteristic :group[3],
//                     state_type : state_type,
                     tid1 : group[0],
                     tid2 : group[1],
                     tid3 : group[2]
                     },
                    url:"{$URLController}redirst.php?action=view&function=viewInfo",
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
         //     function impData(){
         //          $.ajax({
         //            type: "GET",
         //            url:"{$URLController}redirst.php?action=listp&function=impData",
         //            success: function(res){
         //                if(res == 1){
         //                    alert("数据已全部成功录入");
         //                }
         //            }
         //      });     
         // }
         
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
                /*border: solid 1px #ccc;*/
                width: 44px;
                height: 52px;
                line-height: 50px;
                text-align: center;
                font-size: 29px;
                color: red;
                float: right;
                display: block;
            }
            
            .closeView:hover{
            text-align: center; 
            background: black; 
            opacity: 0.5; 
            width: 44px;
            height: 52px;
            line-height: 50px;
            cursor: pointer;
            color: red; 
            font-size: 29px;
            float: right; 
            display: block;
            }
        </style>
        
    </head>
    <body>
        <div id="mask" style=" width: 100%; height: 100%; opacity: 0.5; background: black; display: none; position: fixed; z-index: 100"></div>
        <div id="dataWarp" style=" width:99%; margin: 0 auto; height: 100%; border: solid 1px #ccc; display: none; position: fixed; z-index: 300">
            <div style=" width: 100%; height:52px; text-align: right; margin-right: 20px; background: #fff; " >
                <span style="text-align: center;display: block;float: left;height: 52px;line-height: 50px;width: 96%;
                      font-size: 24px;background: #ccc;">审核路线预览 </span>
                <span onclick="closeView()" class="closeView" >X</span>
            </div>
            <div id="dataInfo" style=" background: #fff; width: 100%; height: 100%;"></div>
        </div>
    <div id="warp">
        <div style=" text-align: center; font-size: 34px; margin-bottom: 10px;">008v2.0待审核路线列表 </div>
        <table>
            <tr style=" font-weight: bold; background-color: #ccc">
                    <td>路线名称</td>
                    <td>商区</td>
                    <td>标签</td>
                    {if $authority eq "2"}
                         {else}
                    <td style=" width: 100px;">预览</td>
                    <td style=" width: 100px;">审核</td>
<!--                    <td>编辑</td>-->
                    <td style=" width: 100px;">删除</td>
                    {/if}
                </tr>
            {if $planInfo eq "Nodate"}
                <tr class="trStyle">
                    <td colspan="6">现在暂时还没有待审核数据哦</td>
                </tr>
                {else}
             {section name=sn loop=$planInfo}
            <tr class="trStyle">
                <td>{$planInfo[sn].characteristic}</td>
                <td>{$planInfo[sn].regions_name}</td>
                <td>{$planInfo[sn].tags_name}</td>
                {if $authority eq "2"}
                         {else}
                <td style=" width: 100px; text-align: center;"><input type="button" id="btnView" class="btnstyle" name="btnAudit" onclick ="viewInfo('{$planInfo[sn].state_1},{$planInfo[sn].state_2},{$planInfo[sn].state_3},{$planInfo[sn].characteristic}')"value="预览" /></td>
                <td style=" width: 100px;"><input type="button" id="btnEdit" class="btnstyle" name="btnAudit" onclick ="auditInfo({$planInfo[sn].id})"value="通过" /></td>
                <td style=" width: 100px;"><input type="button" id="btnDel" class="btnstyle" name="btnDelete" onclick ="delInfo('{$planInfo[sn].id},{$planInfo[sn].state_1},{$planInfo[sn].state_2},{$planInfo[sn].state_3}')" value="删除" /></td>
                {/if}
            </tr>
            {/section}
           {/if}
        </table>
      </div>
    </body>
</html>