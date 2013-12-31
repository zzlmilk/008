<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="{$URLController}js/jquery-1.7.2.min.js"></script>
        <script>
            
            $(document).ready(function(){
                if($("#planIdVal").val()!=''){
                $("#dataWarp").show();
            }
            $("#submit").click(function(){
            
            if($("#recommendTitle").val()==''){
                    alert("必须为推荐的路线填写名称");
                    return false;
                }
                if($("#upLoadPic").val()==''){
                    alert("必须上传一个图片");
                    return false;
                }
            });
            $("#closeWarp").click(function(){
            $("#dataWarp").hide();
            });
        });
        function recommendPlan(planId){
        $("#planIdVal").val(planId);
        $("#dataWarp").show();
        }
        </script>
        <style>
            .rowStyle{
                margin-bottom: 15px;
                margin-left: 15px;
            }
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
        <div id="warp">
            <div style=" text-align: center; font-size: 34px; margin-bottom: 10px;">008v2.0待审核路线列表</div>
            <table>
                <tr style=" font-weight: bold; background-color: #ccc">
                    <td>路线名称</td>
                    <td>商区</td>
                    <td>标签</td>
                    <td style=" width: 100px;">推荐</td>
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
                            <td style=" width: 100px;"><input type="button" id="btnDel" class="btnstyle" name="btnDelete" onclick ="recommendPlan('{$planInfo[sn].id}')" value="推荐" /></td>
                        </tr>
                    {/section}
                {/if}
            </table>
        </div>
        <div id="dataWarp" src="{$URLController}/templates/upLoadImageModel.html" style=" width:500px; margin: 0 auto; height: 300px; border: solid 1px #ccc;display: none;position: fixed; left: 30%;top: 20%; z-index: 300">
            <div style=" width: 100%; height:52px; text-align: right; margin-right: 20px; background: #fff; " >
                <span style="text-align: center;display: block;float: left;height: 52px;line-height: 50px;width: 456px;
                      font-size: 24px;background: #ccc;">审核路线预览</span>
                <span id='closeWarp' class="closeView" >X</span>
            </div>
            <div id="dataInfo" style=" background: #fff;height: 280px;padding-left: 100px; padding-top: 20px;">
                <form action="{$URLController}redirst.php?action=recommend&function=addRecommend" enctype="multipart/form-data" method="Post">
                    <input id='planIdVal' name='planId' type="hidden" value="{$historyPlanId}">
                    <div class="rowStyle">
                        <span class='tiFont mustInsert'>推荐名称:</span>
                        <span><input type='text' id='recommendTitle' name="recommendTitle" value="" class="textstyle" style=" width: 150px;"></span>
                    </div>
                    <div class="rowStyle">
                        <span class='tiFont mustInsert'>推荐图片:</span>
                        <span><input type='file' id='upLoadPic' name="upLoadPic"  class="textstyle"></span>
                    </div>
                    <div class="rowStyle" style="margin-left: 50px;">
                        <input type="submit" id="submit" name= "sbumit" class="btnStyle"  value="提交">
                        <input type="reset" id='reset' value="取消" class="btnStyle"  style=" margin-left: 20px;">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>