/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


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