            window.onload=function(){
            var sub=document.getElementById('submit');
            sub.onclick=function(){
            
            
            var checkType=document.getElementById('checkType').value;
            var flag=true;
            var errorMessage='';
            //alert(checkType);
            switch (checkType){
            case '1':
            var firstName=document.getElementById('firstName').value;
            var middleName=document.getElementById('middleName').value;
            var lastName=document.getElementById('lastName').value;
            var npi=document.getElementById('npi').value;
            var graduationYear=document.getElementById('graduationYear').value;
            var specialty=document.getElementById('specialty').value;
            var specialty2=document.getElementById('specialty2').value;
            var doctorTelephone=document.getElementById('doctorTelephone').value;
//            var doctorEmail=document.getElementById('doctorEmail').value;
            var rexNpi=/^\d{10}$/;
            var rexYear=/^\d{4}$/g;
            var rexTelephone=/^\d{3}-\d{3}-\d{4}$/;
            
            if(firstName==''||firstName.length>30){
                flag=false;
                errorMessage+='firstName 不能为空或大于30 \n'
            }
            if(lastName==''||lastName.length>30){
                flag=false;
                errorMessage+='lastName 不能为空或大于30 \n'
            }
            if(middleName.length>30){
                flag=false;
                errorMessage+='middleName 不能为大于30 \n'
            }
            if(npi==""||!(rexNpi.test(npi))){
                flag=false;
                errorMessage+='npi 必须为10字符长的数字 \n'
            }
            if(!(rexYear.test(graduationYear))&&graduationYear!=''){
                flag=false;
                errorMessage+='graduationYear长度必须为4 \n'
            }
            if(specialty==""){
                flag=false;
                errorMessage+='specialty不能为空 \n'
            }
            if(specialty2==""){
                flag=false;
                errorMessage+='specialty2不能为空 \n'
            }
            if(doctorTelephone!=''&&!rexTelephone.test(doctorTelephone)){
                flag=false;
                errorMessage+='doctorTelephone格式错误  for example：000-000-0000 \n'
            }
            
                break;
            case '2':
                var hospitalName=document.getElementById('hospitalName').value;
                if(hospitalName==""){
                 flag=false;
                errorMessage+='hospitalName不能为空 \n'
                }
                break;
            case '3':
            var code_id=document.getElementById('code_id').value;
            var city=document.getElementById('city').value;
            var state=document.getElementById('state').value;
            var rexCode=/^\d*$/
            if(code_id==""){
                 flag=false;
                errorMessage+='code_id不能为空 \n'
                }
                if(city==""){
                 flag=false;
                errorMessage+='city不能为空 \n'
                }
                if(state==""){
                 flag=false;
                errorMessage+='state不能为空 \n'
                }
                if(!rexCode.test(code_id)){
                flag=false;
                errorMessage+='code_id只能为数字 \n'
                }                break;
            case '4':
                  var proceduresId=document.getElementById('proceduresId').value;
                  var procedures=document.getElementById('procedures').value;
                if(proceduresId==""){
                 flag=false;
                errorMessage+='proceduresId不能为空 \n'
                }
                if(procedures==""){
                 flag=false;
                errorMessage+='procedures不能为空 \n'
                }
                break;
                default:
                alert("发生预知外错误"); 
                break;
            }
            if(!flag){
            alert(errorMessage);
            return false;
            }
        }
        }