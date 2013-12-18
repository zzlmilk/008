
    function editInfo(){
        $(":text").removeAttr("disabled");
    }

    //保存路线
    function saveData(){
                   $.ajax({
                    type: "GET",
                    data:{
//                        插入路线表
                        state_1 : $("#business_id1").val(),
                        state_2 : $("#business_id2").val(),
                        state_type : '1,2',
                        regions : $("#regions").val(),
                        characteristic : $("#characteristic1").val(),
                        avg_consume : $("#avg_consume1").val(),
                        rank_score : $("#rank_score1").val()
                     },
                    url:"{$URLController}redirst.php?action=listp&function=insertPlan",
                    success: function(res){
                        alert(res);
                        if( res == 1){
                        alert("数据保存成功");    
                        }
                    }
                });                
    }


               //更新第一家店铺信息
        function saveState1(){
            alert(1);
                $.ajax({
                    type: "GET",
                    data:{
                        business_id1 : $("#business_id1").val(),
                        name1 : $("#name1").val(),
                        branch_name1 : $("#branch_name1").val(),
                        address1 : $("#address1").val(),
                        telephone1 : $("#telephone1").val(),
                        avg_consume1 : $("#avg_consume1").val(),
                        rank_score1 : $("#rank_score1").val(),
                        regions1 : $("#regions1").val(),
                        avg_rating1 : $("#avg_rating1").val(),
                        avg_price1 : $("#avg_price1").val(),
                        state_time1 : $("#state_time1").val(),
                        business_url1 : $("#business_url1").val(),
                        review_count1 : $("#review_count1").val(),
                        has_deal1 : $("#has_deal1").val(),

                     },
                    url:"{$URLController}redirst.php?action=view&function=saveInfoOne",
                    success: function(res){
                        alert(res);
                        if( res == 1){
                        alert("数据保存成功");    
                        }
                    }
                });  
        }

          //更新第二家店铺信息
        function saveState2(){
            alert(1);
                $.ajax({
                    type: "GET",
                    data:{
                        business_id2 : $("#business_id2").val(),
                        name2 : $("#name2").val(),
                        branch_name2 : $("#branch_name2").val(),
                        address2 : $("#address2").val(),
                        telephone2 : $("#telephone2").val(),
                        avg_consume2 : $("#avg_consume2").val(),
                        rank_score2 : $("#rank_score2").val(),
                        regions2 : $("#regions2").val(),
                        avg_rating2 : $("#avg_rating2").val(),
                        avg_price2 : $("#avg_price2").val(),
                        state_time2 : $("#state_time2").val(),
                        business_url2 : $("#business_url2").val(),
                        review_count2 : $("#review_count2").val(),
                        has_deal2 : $("#has_deal2").val(),

                     },
                    url:"{$URLController}redirst.php?action=view&function=saveInfoTwo",
                    success: function(res){
                        alert(res);
                        if( res == 1){
                        alert("数据保存成功");    
                        }
                    }
                }); 
            
        }
