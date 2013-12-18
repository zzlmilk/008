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
                    url: "{$URLController}redirst.php?action=route&function=getArea",
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
                        url: "{$URLController}redirst.php?action=route&function=getBusiness",
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
        <form action="{$URLController}redirst.php?action=route&function=insertListp" method="Post">
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
