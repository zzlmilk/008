function tool(action,search_name,type){
    var array_ =["upload","tool"];
    var searchResult='';
    var i = $('#operatorsAction').val();
    switch(action){
        case 'upload':
            var html='';
            var i =0;
            var url = '../js/Ajax/tool/upload.php';
            break;
        case 'tool':
            var html = $('#tools_'+i+'_id').val();
            var url = '../js/Ajax/tool/ajax.php';
            var type_id = $('#tool_type').val();
            searchResult = type_id;
            break;
    }
    for(var number=0;number<array_.length;number++){
        $('#'+array_[number]+'Html').css('display','none');
        if(action==array_[number]){
            $('#'+action+'Html').css('display','block');
        }
    }
    $.ajax({
        type: "POST",
        url: url,
        data:"&action="+action+"&result="+html+'&search_name='+search_name+'&searchResult='+searchResult,
        success: function(mes){
            $('#action').val(action);
            $('#dialog-form').dialog('open');
            $('#mygame').html(mes);
        }
    });
}
$(function(){
    $("#dialog").dialog("destroy");
    $("#dialog-form").dialog({
        autoOpen: false,
        width: 850,
        modal: true,
        buttons: {
            确定: function() {
                var opearaction = $('#action').val();
                switch(opearaction){
                    case 'upload' :
                        uploadSuccess();
                        break;
                    case 'tool':
                        toolSuccess();
                        break;
                }
            },
            取消: function() {
                $(this).dialog('close');
            }
        }
    });
})
function SearchStart(){
    var str =$('#action').val();
    var search_name =  $('#'+str+'name').val();
    tool(str,search_name);
}
function toolSuccess(){
    var i = $('#operatorsAction').val();
    var tool_id = $('input[name="tool_check"]:checked').val();
    var tool_name = $('#tools'+tool_id).html();
    $('#tools_'+i+'_name').html(tool_name);
    $('#slide_toolid').val(tool_id);
    $("#dialog-form").dialog('close');
}
function uploadSuccess(){
    $.ajaxFileUpload
    (
    {
        url:'../js/Ajax/tool/upload.php?action=UploadImage&opstion='+$('#operatorsAction').val()+'&imageold_name='+$('#slide_imgname').val(),
        secureuri:false,
        fileElementId:'upload',
        dataType: 'text',
        success: function (data)
        {
            var image_data = data.split(',');
            if(image_data[0]==1){
                var i = $('#operatorsAction').val();
                var html = '<img src="http://yx.188zhaopin.com/public/GameTools/image/slide/'+image_data[1]+'">';
                $('#slide_'+i+'_img').show();
                $('#slide_'+i+'_img').html(html);
                $('#slide_imgname').val(image_data[1]);
                $("#dialog-form").dialog('close');
            }else{
                alert(data);
                return false;
            }
        }
    }
    )
}