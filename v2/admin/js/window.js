function selectTag(tag_id,obj){
    var input_val = $(obj).val();
    var html ='<input onclick="TagOpenAndEnd('+tag_id+')"  type="checkbox" id="tag_name_'+tag_id+'" value="'+input_val+'" class="selectTags" ">';
    html+='<span id="tag_'+tag_id+'">'+input_val+'</span>';
    var input_data = $('#mygame #tag_'+tag_id).parent().find('input').attr('checked');
    if(input_data == false){
        $('#selectResult #tag_'+tag_id).remove();
        $('#selectResult #tag_name_'+tag_id).remove();
    } else{
        $('#selectResult').append(html);
        $('#selectResult').find('input').attr('checked','checked');
    }
}
function TagOpenAndEnd(tag_id){
     $('#selectResult #tag_'+tag_id).remove();
     $('#selectResult #tag_name_'+tag_id).remove();
     $('#mygame #tag_'+tag_id).parent().find('input').attr('checked',false);
}
function ccc(action,search_name,type){
    var array_ =["tag","game","operators",'news'];
    searchClean();
    var searchResult='';
    switch(action){
        case 'tag':
            var html = $('#tagList').html().replace(/(^\s*)|(\s*$)/g, "");
            var i =0;
            var url = '../js/Ajax/tag/ajax.php';
            $('#selectResult .selectTags').each(function(){
                if($(this).attr('checked')==true){
                    if(i==0){
                        searchResult+=$(this).val();
                    } else{
                        searchResult+=','+$(this).val();
                    }
                    i++;
                }
            })
            break;
        case 'game':
            var html = $('#game').html().replace(/(^\s*)|(\s*$)/g, "");
            var url='../js/Ajax/game/ajax.php';
            break;
        case 'operators':
            var html = $('#operator').html().replace(/(^\s*)|(\s*$)/g, "");
            var url='../js/Ajax/operators/ajax.php';
            break;
        case 'news':
            var checked_type = $('#operations').val();
            var html = $('#news_select'+checked_type).html().replace(/(^\s*)|(\s*$)/g, "");
            var url='../js/Ajax/news/ajax.php';
            searchResult = $('#news_type2').val() < 1 ? '': $('#news_type2').val();
            var cccc=$('#news_type2  option[value="1"]').val();
            if(checked_type==0 && cccc==1){
                $('#news_type2 option').each(function(){
                    if($(this).val()!=1){
                        $(this).hide();
                    } else{
                        $(this).attr('selected','selected');
                    }
                })
                searchResult = 1;
            } else{
                $('#news_type2 option').each(function(){
                    if($(this).val()!=1){
                        $(this).show();
                    }
                })
            }
            break;
        case 'main_news':
            var checked_type = $('#operations').val();
            var html = $('#news_select'+checked_type).html().replace(/(^\s*)|(\s*$)/g, "");
            var url='../js/Ajax/news/ajax.php';
            searchResult = $('#news_type2').val() < 1 ? '': $('#news_type2').val();
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
            if(action=='tag'){        
                var data_str = eval(mes);
                $('#mygame').html(data_str[0]);
                if(data_str[1] !=''){
                   $('#selectResult').html(data_str[1]);
                }
            } else{
                $('#mygame').html(mes);
            }
            $('#tagAction').val(action);
            $('#dialog-form').dialog('open');
        }
    });
}
function addTag(){
    $.ajax({
        type: "POST",
        url: "../js/Ajax/tag/ajax.php",
        data:"&action=insertTag",
        success: function(mes){
            $('#tagAction').val('insertTag');
            $("#dialog").dialog("destroy");
            $('#dialog-form').dialog('open');
            $('#mygame').html(mes);
        }
    });
}
function SearchStart(){
    searchClean();
    var tags='';
    var i=0;
    var str =$('#tagAction').val();
    var search_name =  $('#'+str+'name').val();
    ccc(str,search_name);
}
function searchClean(name){
    var str =$('#tagAction').val();
    if(name==undefined){
        name =  $('#'+str+'name').val();
    }
    if(name=='输入标签名'  || name=='输入游戏名'|| name=='输入运营商' || name=='输入新闻标题'){
        $('#'+str+'name').val('');
    }
}
$(function(){
    $("#dialog").dialog("destroy");
    $("#dialog-form").dialog({
        autoOpen: false,
        width: 850,
        modal: true,
        buttons: {
            确定: function() {
                var action=$('#tagAction').val();
                if(action=='tag'){  //操作为标签查询与面板显示
                    var  tags = '';
                    var i = 0;
                    $('#selectResult .selectTags').each(function(){
                        if($(this).attr('checked')==true){
                            if(i==0){
                                tags+=$(this).val();
                            } else{
                                tags+=','+$(this).val();
                            }
                            i++;
                        }
                    })
                    $('#news_tag').val(tags);
                    $('#tagList').html(tags);
                    $(this).dialog('close');
                }
                else if(action=='insertTag'){  //标签插入
                    $.ajax({
                        type: "POST",
                        url: "../js/Ajax/tag/ajax.php",
                        data:"&action=addtag&tag_name="+$('#tag_name').val(),
                        success: function(mes){
                            if(mes==1){
                                ccc('tag','');
                            } else{
                                alert(mes);
                            }
                        }
                    });
                }
                else if(action=='game'){  //游戏列表选择
                    var game_name = $('input[name="game_check"]:checked').val();
                    $('#game').html(game_name);
                    $('#game_name').val(game_name);
                    $(this).dialog('close');
                } else if(action=='operators'){
                    var operatlio_name = $('input[name="operators_check"]:checked').val();
                    $('#operator').html(operatlio_name);
                    $('#operator_name').val(operatlio_name);
                    $(this).dialog('close');
                }else if(action=='news'){
                    var news_id = $('input[name="news_check"]:checked').val();
                    var news_title = $('#span'+news_id).html();
                    var checked_type = $('#operations').val();
                    $('#news_'+checked_type).val(news_id);
                    $('#news_select'+checked_type).html(news_title);
                    $(this).dialog('close');
                }else if(action=='main_news'){
                    var news_id = $('input[name="news_check"]:checked').val();
                    var news_title = $('#span'+news_id).html();
                    var checked_type = $('#operations').val();
                    $('#news_'+checked_type).val(news_id);
                    $('#news_select'+checked_type).html(news_title);
                    $(this).dialog('close');
                }
            },
            取消: function() {
                $(this).dialog('close');
            }
        }
    });
})
