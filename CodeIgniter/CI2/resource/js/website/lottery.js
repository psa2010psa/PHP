function set_recordinfo(gettpye,value,offset){  ///抽奖记录列表异步加载
    var html = "";
    if(value==""){
        html = '<tr> <td height="90" colspan="7">无抽奖记录</td></tr>';
    }else{
        var obj = {};
        obj[gettpye] = value;
        obj["offset"] = offset;
        $.post('/website/lottery/record_list', obj, function(data){

            if(data.errorCode == 0){
                var recordInfo = data.info.record;
                var pages = data.info.pages;
                pages = pages.replace(/href/g, "data-offset")
                var nowpage = data.info.now;
                var total = data.info.total;
                $("#DataTables_Table_1_info_record").html("显示："+nowpage+"  总共："+total);
                $("#DataTables_Table_1_paginate_record").html(pages);
                if(pages!=""){
                    $("#DataTables_Table_1_paginate_record .paginate_button").on("click",function(){
                        var offset = $(this).data('offset').substr(1);
                        set_recordinfo(gettpye,value,offset);
                    });
                }
                if(recordInfo.length>0){
                    recordInfo.forEach(function(record_tmp){
                        html+='<tr style="text-align: center;" height="35px">';
                        html+='<td></td>';
                        html+='<td>'+record_tmp.nickname+'</td>';
                        html+='<td>'+record_tmp.create_time+'</td>';
                        html+='<td>'+record_tmp.activity_name+'</td>';
                        html+='<td>'+record_tmp.prize_name+'</td>';
                        html+='<td>'+record_tmp.prize_level+'</td>';
                        html+='<td></td>';
                        html+='</tr>';

                    });
                }else{
                    html = '<tr> <td height="90" colspan="7">无抽奖记录</td></tr>';
                }
            }
            $("#record table tbody").html(html);
        }, 'json');
    }
}

$('.recordclose').live('click', function(){
    $("#record table tbody").html("<td colspan='7'>正在努力加载中...</td>");
});

$('.lotterylib').live('click', function(){
    var user_id = $(this).data('user_id');
    set_recordinfo("user_id",user_id,0);
    $("#record").modal("show");
});

$('.activitylib').live('click', function(){
    var activity_id = $(this).data('activity_id');
    set_recordinfo("activity_id",activity_id,0);
    $("#record").modal("show");
});

$('.prizelib').live('click', function(){
    var prize_id = $(this).data('prize_id');
    set_recordinfo("prize_id",prize_id,0);
    $("#record").modal("show");
});

function checksel()
{
    var nickname = $("#nickname").val();

    if(nickname!=""){
        window.location.href = "/website/lottery/index/"+encodeURIComponent(nickname);
    }else{
        window.location.href = "/website/lottery/index";
    }
}
function clearquery()
{
    $("#nickname").val("");
}
  