$(document).ready(function() {
    $(".bulk_ope").click(function(){
        if ($(this).attr('checked')) {
            $(".manage_list :checkbox").attr("checked",true);
        }
        else{
            $(".manage_list :checkbox").attr("checked",false);
        }
    })
});
function All_action(){
    if($('#action_type').val()==1){
        var str ='';
        var i = 0;
        $('.selectUserAadmin').each(function(){
            if($(this).attr('checked') == true){
                if(i ==0 ){
                    str +=$(this).val();
                } else{
                    str +=','+$(this).val();
                }
                i++
            }
        })
        if(str.length >0){
            if(confirm("确认删除吗？")){
                window.location.href='../publicController/management_action.php?action=delete&idstr='+str;
            }else{
                return false;
            }
        }
        else{
            alert('未选中用户!');
        }
    }
}

function All_change(){
    if($('#change_type').val()!=0){
        var c_str ='';
        var i = 0;
        $('.selectUserAadmin').each(function(){
            if($(this).attr('checked') == true){
                if(i ==0 ){
                    c_str +=$(this).val();
                } else{
                    c_str +=','+$(this).val();
                }
                i++
            }
        })
        if(c_str.length >0){
            if(confirm("确认更改吗？")){
                window.location.href='../publicController/management_action.php?action=edit&changestr='+c_str+'&ctype='+$('#change_type').val();
            }else{
                return false;
            }
        }
        else{
            alert('未选中用户!');
        }
    }
}
function selectTypechange(selected_value){
    $(".change_type_selected option[value='"+selected_value+"']").attr('selected','selected');
}
function selectUserchange(selected_value){
    $(".change_Usertype_selected option[value='"+selected_value+"']").attr('selected','selected');
}

function registcheck(name,pass){
    if(name==''){
	$('#namenonecheck').css('display','block');
	$('#passnonecheck').css('display','none');
	$('#user_name').focus();
	if(pass==''){
	    $('#passnonecheck').css('display','block');
	}
    }else{
	if(pass==''){
	    $('#passnonecheck').css('display','block');
	    $('#namenonecheck').css('display','none');
	    $('#user_password').focus();
	}else{
	    $.ajax({
		type : "POST",
		url : "../ajaxfile/RegistCheck.php",
		data : "admin_name="+name,
		    success : function(data){
			if(data==1){
			    $('#namecheck').css('display','block');
			    $('#namenonecheck').css('display','none');
			    $('#passnonecheck').css('display','none');
			    $('#user_name').focus();
			}else{
			    $('#namenonecheck').css('display','none');
			    $('#passnonecheck').css('display','none');
			    $('#namecheck').css('display','none');
			    $('#regist_form').submit();
			}
		    }
		});
	}
    }
	
}