 
$(document).ready(function(){
    $("#submit").click(function(){
        var flag=true;
        var checkboxFlag=false;
        var ContextNum = $("#ContextNum").val();
        var rexString=/^[0-9]{2}[:]{1}[0-9]{2}[-]{1}[0-9]{2}[:]{1}[0-9]{2}$/;
        var waringStr='';
        var isSameRegions=true;
        var regionsName=$("#regions option:selected").html();
        if($("#characteristic").val()==""){
            waringStr+="路线名称必须填写\r\n";
            flag=false;
        }
        if($("#business option:selected").val()==0){
            waringStr+="请选择一个地区\r\n";
            flag=false;
        }
        else if($("#b").html()==''){
            waringStr+="请选择一个商区\r\n";
            flag=false;
        }
        $("#c :checkbox").each(function(){
            if($(this).prop("checked")){
                checkboxFlag=true;
            }
        })
        if(!checkboxFlag){
            waringStr+="请选择至少一个类型\r\n";
            flag=false; 
        }
        if(ContextNum<3){
            waringStr+="请至少添加2个商铺\r\n";
            flag=false; 
        }
        for(var i=1;i< ContextNum;i++){
                   
            //                   alert(regionsName!=$("#regions"+i).val()
            if($("#business_url"+i).val()==undefined||$("#business_url"+i).val()==''){
                waringStr+="请完整填写第"+i+"个商铺信息\r\n";
                flag=false;
            }
            else if(!rexString.test($("#state_time"+i).val())||$("#state_time"+i).val()==''){
                        
                waringStr+="请正确填写第"+i+"个游玩时间\r\n";
                flag=false;
            }
            else if(regionsName!=$("#regions"+i).val()){
                if(i==1){
                    waringStr+="第一个商铺商区必须与路线相同\r\n";
                    flag=false;
                }
                else{
                }
                isSameRegions=false;
            }
                   

                  
        } 
                

        if(!flag){
            alert(waringStr);
            return false;
        }else{
            if(!isSameRegions){
                if( !window.confirm("路线中有店铺与路线所在的店铺不在同一商区确认要插入吗？")){
                    return false;
                }
            }
        }
    });

    $("#addContext").on("click",function(){
        var ContextNum=  $("#ContextNum").val();
        if(ContextNum>3){
            alert("目前一条路线最多只能添加3个商铺");
            return false;
        }
        var Addstring="<div style='margin-bottom: 30px;'>"+
        "<div>商铺"+ContextNum+"：</div>"+
        "<div>"+
        "<span class='tiFont mustInsert' style='width:auto'>商铺"+ContextNum+"id:&nbsp;</span>"+
        "<span style='padding-left: 23px;'><input type='text' id='business_id"+ContextNum+"' name='business_id"+ContextNum+"' value='' class='textstyle  lockText"+ContextNum+"' style=' width: 150px;'></span>"+
        "<span><button onclick='findBusiness("+ContextNum+");return false;'>搜索商铺</button></span>"+
        "</div>"+
        "<div>"+
        "<span>商铺名称：</span><span><input  type='text' id='name"+ContextNum+"' name='name"+ContextNum+"' value='' class='textstyle lockText"+ContextNum+"' style=' width: 150px;'></span>"+
        "</div>"+
        "<div>"+
        "<span>分店名称：</span><span><input  type='text' id='branch_name"+ContextNum+"' name='branch_name"+ContextNum+"' value='' class='textstyle lockText"+ContextNum+"' style=' width: 150px;'></span>"+
        "</div>"+
        "<div>"+
        "<span>商铺地址：</span><span><textarea  id='address"+ContextNum+"' name='address"+ContextNum+"' class='textstyle lockText"+ContextNum+"' style='width: 150px; height: 65px; font-size:12px;'></textarea></span>"+
        "</div>"+
        "<div>"+
        "<span>联系电话：</span><span><input type='text' id='telephone"+ContextNum+"' name='telephone"+ContextNum+"' value='' class='textstyle lockText"+ContextNum+"' style=' width: 150px;'></span>"+
        "</div>"+
        "<div>"+
        "<span>环境评分：</span><span><input  type='text' id='product_grade"+ContextNum+"' name='product_grade"+ContextNum+"' value='' class='textstyle lockText"+ContextNum+"' style=' width: 150px;'></span>"+
        "</div>"+
        "<div>"+
        "<span>口味评分：</span><span><input  type='text' id='decoration_grade"+ContextNum+"' name='decoration_grade"+ContextNum+"' value='' class='textstyle lockText"+ContextNum+"' style=' width: 150px;'></span>"+
        "</div>"+
        "<div>"+
        "<span>服务评分：</span><span><input type='text' id='service_grade"+ContextNum+"' name='service_grade"+ContextNum+"' value='' class='textstyle lockText"+ContextNum+"' style=' width: 150px;'></span>"+
        "</div>"+
        "<div>"+
        "<span>综合评分：</span><span><input  type='text' id='avg_rating"+ContextNum+"' name='avg_rating"+ContextNum+"' value='' class='textstyle lockText"+ContextNum+"' style=' width: 150px;'></span>"+
        "</div>"+
        "<div>"+
        "<span>人均消费：</span><span><input  type='text' id='avg_price"+ContextNum+"' name='avg_price"+ContextNum+"' value='' class='textstyle lockText"+ContextNum+"' style=' width: 150px;'></span>"+
        "</div>"+
        "<div>"+
        "<span class='mustInsert'>游玩时间段（必须填写 例如19:00-22:00）：</span><span><input type='text' id='state_time"+ContextNum+"' name='state_time"+ContextNum+"' value='' class='textstyle' style=' width: 150px;'></span>"+
        "</div>"+
        "<div>"+
        "<input type='hidden' id='business_url"+ContextNum+"' name='business_url"+ContextNum+"' value='' >"+
        "</div>"+
        "<div>"+
        "<input type='hidden' id='review_count"+ContextNum+"' name='review_count"+ContextNum+"' value='' >"+
        "</div>"+
        "<div>"+
        "<input type='hidden' id='has_deal"+ContextNum+"' name='has_deal"+ContextNum+"' value='' >"+
        "</div>"+
        "<div>"+
        "<input type='hidden' id='longitude"+ContextNum+"' name='longitude"+ContextNum+"' value='' >"+
        "</div>"+
        "<div>"+
        "<input type='hidden' id='latitude"+ContextNum+"' name='latitude"+ContextNum+"' value='' >"+
        "</div>"+
        "<div>"+
        "<input type='hidden' id='regions"+ContextNum+"' name='regions"+ContextNum+"' value='' >"+
        "</div>"+
        "<div>"+
        "<input type='hidden' id='business_image"+ContextNum+"' name='business_image"+ContextNum+"' value='' >"+
        "</div>"+
        "</div>";
        $("#Context").append(Addstring);
        $("#ContextNum").val(parseInt(ContextNum)+1);
        //        $('.lockText').attr("readonly","readonly");
        return false;

    })
});
function findBusiness(whoFind){
    var businessId=$("#business_id"+whoFind+"").val();
    if(businessId==''){
        alert("请输入一个商铺ID");
        return false;
    }
    var hostName="localhost";
    var urlString="/008/admin/redirst.php?action=route&function=getBusinessFindUrl";
    $.ajax({
        type: "GET",
        url: urlString,
        beforeSend:function(){
            $("#d").html('正在读取');
        },                       
        data:{
            BusinessId : businessId
        },
        success: function(rData){
            //            $("#d").html( JSON.stringify(rData));
            $("#d").html( "读取完成");
            var jsonRData=  eval(rData);
            var businessesClass=jsonRData.businesses[0];
            $("#name"+whoFind).val(businessesClass.name);
            $("#branch_name"+whoFind).val(businessesClass.branch_name);
            $("#address"+whoFind).html(businessesClass.address);
            $("#telephone"+whoFind).val(businessesClass.telephone);
            $("#product_grade"+whoFind).val(businessesClass.product_grade);
            $("#decoration_grade"+whoFind).val(businessesClass.decoration_grade);
            $("#service_grade"+whoFind).val(businessesClass.service_grade);
            $("#avg_rating"+whoFind).val(businessesClass.avg_rating);
            $("#avg_price"+whoFind).val(businessesClass.avg_price); 
            $("#business_url"+whoFind).val(businessesClass.business_url); 
            $("#review_count"+whoFind).val(businessesClass.review_count); 
            $("#has_deal"+whoFind).val(businessesClass.has_deal); 
            $("#longitude"+whoFind).val(businessesClass.longitude); 
            $("#latitude"+whoFind).val(businessesClass.latitude); 
            $("#business_image"+whoFind).val(businessesClass.photo_url); 
            $("#regions"+whoFind).val(businessesClass.regions[1]); 
            $('.lockText'+whoFind).attr("readonly","readonly");
        }
    });  
}
 
 
function getBusinessFindUrl(businessId)
{
    
    var serverUrl = "http://api.dianping.com/";
    var apiPath = "v1/business/get_single_business";
    var appkey = "803330508";
    var secret = "4f653e229d4c4bea93ae8814e4e64d71";
    var param = {};
    param["format"]="json";
    param["business_id"]=businessId;
	 
    var array = new Array();
    for(var key in param)
    {
        array.push(key);
    }
    array.sort();
	
    var paramArray = new Array();
    paramArray.push(appkey);
    for(var index in array)
    {
        var key = array[index];
        paramArray.push(key + param[key]);
    }
    paramArray.push(secret);

    var shaSource = paramArray.join("");
    var sign = new String(CryptoJS.SHA1(shaSource)).toUpperCase();
    var queryArray = new Array();
    queryArray.push("appkey=" + appkey);
    queryArray.push("sign=" + sign);
    for(var key in param)
    {
        queryArray.push(key + "=" + param[key]);
    }
    var queryString = queryArray.join("&");
	 
    var url = serverUrl + apiPath + "?" + queryString;
         
    return url;
}
// Addstring="<div style='margin-bottom: 30px;'>"+
//                "<div>商铺（填充）：</div>"+
//                "<div>"+
//                "<span class='tiFont' style='width:auto'>商铺（填充）id:</span>"+
//                    "<span><input type='text' id='business_id' name='business_id' value='' class='textstyle' style=' width: 150px;'></span>"+
//                    "<span><button>搜索商铺</button></span>"+
//                "</div>"+
//                "<div>"+
//                    "<span>商铺名称：</span><span><input type='text' id='name' name='name' value='' class='textstyle' style=' width: 150px;'></span>"+
//                "</div>"+
//                "<div>"+
//                    "<span>商铺地址：</span><span><input type='text' id='address' name='address' value='' class='textstyle' style=' width: 150px;'></span>"+
//                "</div>"+
//                "<div>"+
//                    "<span>联系电话：</span><span><input type='text' id='telephone' name='telephone' value='' class='textstyle' style=' width: 150px;'></span>"+
//                "</div>"+
//                "<div>"+
//                    "<span>环境评分：</span><span><input type='text' id='product_grade' name='product_grade' value='' class='textstyle' style=' width: 150px;'></span>"+
//                "</div>"+
//                "<div>"+
//                    "<span>口味评分：</span><span><input type='text' id='decoration_grade' name='decoration_grade' value='' class='textstyle' style=' width: 150px;'></span>"+
//                "</div>"+
//                "<div>"+
//                    "<span>服务评分：</span><span><input type='text' id='service_grade' name='service_grade' value='' class='textstyle' style=' width: 150px;'></span>"+
//                "</div>"+
//                "<div>"+
//                    "<span>综合评分：</span><span><input type='text' id='avg_rating' name='avg_rating' value='' class='textstyle' style=' width: 150px;'></span>"+
//                "</div>"+
//                "<div>"+
//                    "<span>人均消费：</span><span><input type='text' id='avg_price' name='avg_price' value='' class='textstyle' style=' width: 150px;'></span>"+
//                "</div>"+
//                "<div>"+
//                    "<span>游玩时间段（必须填写）：</span><span><input type='text' id='state_time' name='state_time' value='' class='textstyle' style=' width: 150px;'></span>"+
//                "</div>"+
//            "</div>"