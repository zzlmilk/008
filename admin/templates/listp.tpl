<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript" src="{$URLController}js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript">
                //删除审核路线
                function delInfo(tid){
                   $.ajax({
                    type: "GET",
                    data:{
                     tid : tid
                     },
                    url:"{$URLController}redirst.php?action=listp&function=delInfo",
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
                    url:"{$URLController}redirst.php?action=listp&function=auditInfo",
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
             function impData(){
                  $.ajax({
                    type: "GET",
                    url:"{$URLController}redirst.php?action=listp&function=impData",
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
 
             {section name=sn loop=$planInfo}
            <tr class="trStyle">
                <td>{$planInfo[sn].characteristic}</td>
                <td>{$planInfo[sn].regions}</td>
                <td>{$planInfo[sn].state_type}</td>
                <td style=" width: 100px; text-align: center;"><input type="button" id="btnView" class="btnstyle" name="btnAudit" onclick ="viewInfo({$planInfo[sn].characteristic},{$planInfo[sn].state_1},{$planInfo[sn].state_2},{$planInfo[sn].state_3})"value="预览" /></td>
                <td style=" width: 100px;"><input type="button" id="btnEdit" class="btnstyle" name="btnAudit" onclick ="auditInfo({$planInfo[sn].id})"value="通过" /></td>
                <td style=" width: 100px;"><input type="button" id="btnDel" class="btnstyle" name="btnDelete" onclick ="delInfo({$planInfo[sn].id})" value="删除" /></td>
            </tr>
            {/section}

        </table>
            <div style=" margin-left: 243px;margin-top: 44px;color: red;">
                <span>数据审核完毕，点击此处将数据全部录入路线表--></span>
                <input type="button" id = 'impData' name="impData" style=" width: 135px; height: 32px; cursor: pointer;" value="录入全部数据" onclick="impData()">
            </div>
      </div>
    </body>
</html>