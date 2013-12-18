<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <input type="text" style="width: 30%" id="functionName" placeholder="functionModel">
        <br>
        <input type="text" id="paramName"style="width: 30%" placeholder="GetParam">
        <br>
        <button id="buttom">start</button>
        <div id="a" style="border: 1px solid black">此处显示信息</div>
    </body>

    <script src="./jquery-1.9.1.min.js"></script>
    <script>
        $("#buttom").click(function(){
            var setUrl="http://localhost/008/v1/branch/"+$("#functionName").val()+"?"+$("#paramName").val();
           // 'http://localhost/008/v1/branch/Information/AllDistrictInformation'
        $.ajax({
            url:setUrl,
            type:'GET',
            //crossDomain:true,
//            data:{},
            beforeSend:function(){
   
            },
            success:function(rData){
                //alert(rData);
              var a=  JSON.stringify(rData);
                    $("#a").html(a);
            }
        }); 
        })
    </script>
</html>
