function checkword(alltxt,name)  //职位联想
{
    var wordvalue=document.getElementById(name).value.toLowerCase();
    //var alltxt="admin管理员|apple苹果|all全|big大|bad坏|cut剪切|car车|daph8|eeg|egg|eat|fuck|fuck you|fix|good|hand|hidden|ill|jack|jad|kevin|long|man|number|oio|part|pp|quit|QQ|rest|reg|set|submit|time|tag|uuzo.cn|uuzo|view|windows|want|xy|xun|young|yuyu|zoo|Zzz|锋.David|David|哈哈|www.uuzo.cn|www.uuzo.com";
    var alltxtpp=alltxt.toLowerCase();
    var alltxt_xiang=alltxt.split("|");
    var alltxt_xiang1=alltxtpp.split("|");
    var inhtml="<ul>"
    var isyou=0;
    for (i=0;i<alltxt_xiang1.length;i++)
    {
        if (alltxt_xiang1[i].substr(0,wordvalue.length)==wordvalue)
        {
            inhtml=inhtml+"<li onclick=\"document.getElementById('"+name+"').value=this.innerHTML;document.getElementById('showmenu').style.display='none';\" onmouseover=\"this.style.backgroundColor='#e2eaff'\" onmouseout=\"this.style.backgroundColor=''\">"+alltxt_xiang[i]+"</li>";
            isyou=1;
        }
    }
    inhtml=inhtml+"</ul>";
    if (isyou==1)
    {
        document.getElementById("showmenu").innerHTML=inhtml;
        document.getElementById("showmenu").style.display="";
    }
    else
    {
        document.getElementById("showmenu").innerHTML="";
        document.getElementById("showmenu").style.display="none";
    }
    if (wordvalue=="")
    {
        document.getElementById("showmenu").innerHTML="";
        document.getElementById("showmenu").style.display="none";
    }
}
function wordReplace(str){
    var str_replace = str.replace("&amp;","&");
    document.getElementById('company_name').value=str_replace;
    document.getElementById('showmenu1').style.display='none';
}


function checkword1(alltxt,name) //公司联想
{
    var wordvalue=document.getElementById(name).value.toLowerCase();
    //var alltxt="admin管理员|apple苹果|all全|big大|bad坏|cut剪切|car车|daph8|eeg|egg|eat|fuck|fuck you|fix|good|hand|hidden|ill|jack|jad|kevin|long|man|number|oio|part|pp|quit|QQ|rest|reg|set|submit|time|tag|uuzo.cn|uuzo|view|windows|want|xy|xun|young|yuyu|zoo|Zzz|锋.David|David|哈哈|www.uuzo.cn|www.uuzo.com";
    var alltxtpp=alltxt.toLowerCase();
    var alltxt_xiang=alltxt.split("|");
    var alltxt_xiang1=alltxtpp.split("|");
    var inhtml="<ul>"
    var isyou=0;
    for (i=0;i<alltxt_xiang1.length;i++)
    {
        if (alltxt_xiang1[i].substr(0,wordvalue.length)==wordvalue)
        {
            inhtml=inhtml+"<li onclick=\"wordReplace(this.innerHTML)\" onmouseover=\"this.style.backgroundColor='#e2eaff'\" onmouseout=\"this.style.backgroundColor=''\">"+alltxt_xiang[i]+"</li>";
            isyou=1;
        }
    }
    inhtml=inhtml+"</ul>";
    if (isyou==1)
    {
        document.getElementById("showmenu1").innerHTML=inhtml;
        document.getElementById("showmenu1").style.display="";
    }
    else
    {
        document.getElementById("showmenu1").innerHTML="";
        document.getElementById("showmenu1").style.display="none";
    }
    if (wordvalue=="")
    {
        document.getElementById("showmenu1").innerHTML="";
        document.getElementById("showmenu1").style.display="none";
    }
}
function backwangye(){
    var yl=CheckBrowser();
    if(yl=='IE'){
        history.back();
        history.go(0);
    }
    else{
        history.back();
    }
}
function CheckBrowser(){

    var cb = "Unknown";

    if(window.ActiveXObject){

        cb = "IE";

    }else if(navigator.userAgent.toLowerCase().indexOf("firefox") != -1){

        cb = "Firefox";

    }else if((typeof document.implementation != "undefined") && (typeof document.implementation.createDocument != "undefined") && (typeof HTMLDocument != "undefined")){

        cb = "Mozilla";

    }else if(navigator.userAgent.toLowerCase().indexOf("opera") != -1){

        cb = "Opera";

    }

    return cb;

}
document.onmouseup = function(e)
{
    e=window.event?window.event:e;
    srcE=e.srcElement?e.srcElement:e.target;
    if (document.getElementById("showmenu") && srcE.id != "showmenu")
    {
        document.getElementById('showmenu').style.display='none';
    }
}

function location1(v,m,f){
    if(v==1){
        window.location.href="video.php";
    } else if(v==2){
        window.location.href='video.php?action=insert'
    }
}
function asd(txt){
    $.prompt(txt,{
        callback: location1,
        buttons: {
            '确定': '1',
            '继续添加': '2'
        }
    });
}
function asd1(txt){
    $.prompt(txt,{
        callback: location1,
        buttons: {
            '确定': '1'
        }
    });
}
function asd2(txt){
    $.prompt(txt,{
        callback: backwangye,
        buttons: {
            '确定': '1'
        }
    });
}
function queding(txt){
    $.prompt(txt,{
        callback: aaaaa,
        buttons: {
            '继续提交': '1',
            '取消': '2'
        }
    });
}
function aaaaa(v,m,f){
    if(v==1){
        $('#form1').submit();
    } else if(v==2){
       
    }
}