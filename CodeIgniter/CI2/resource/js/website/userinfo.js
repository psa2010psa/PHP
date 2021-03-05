 $('#myTab a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
	 $('#myTab a:first').tab('show');

	 
 	$('#save').live('click',function(e) {
	    var email = $("[name='email']").val();
		if(trim(email)!=""&&!email_check(email)){
			op_tip({ title: '操作提醒', content: '邮箱输入有误，请正确输入' }, function () {
                    });
					return false;
		}
		var mobile = $("[name='mobile']").val();
		if(trim(mobile)!=""&&!mobile_check(mobile)){
			op_tip({ title: '操作提醒', content: '移动电话输入有误，请正确输入' }, function () {
                    });
					return false;
		}
		op_confirm({ title : '提示', content : '确认修改该用户信息吗？' },function(){ 
	   		 var user_id = $("#user_id").val();
        	$.post("/website/user/edit",  $('form').serialize(), function (data) {
            	if (data.errorCode == '0') {
                	op_tip({ title: '操作提醒', content: '操作成功!' }, function () {
                    });

            	}else {
                	op_tip({ title: '操作提醒', content: '操作异常，原因：' + data.title }, function () {
                	});
           		 }
        	}, 'json');
		});
    });
    $('#ban').live('click',function(e) {
	var _this =$(this);
	op_confirm({ title : '提示', content : '确认禁止该用户发言吗？' },function(){ 
	    var user_id = $("#user_id").val();
        $.post('/website/user/user_stop', {"user_id":user_id}, function(data){
		    if(data.errorCode=='0'){
			   op_tip({ title : '操作提醒', content : '操作成功!' }, function(){
			   _this.remove();
					$(".modal-footer").append("<button id='unban' class='btn btn-primary'>取消禁言</button>");
                });
			}else{
			    op_tip({ title : '操作提醒', content : '操作失败，请重试!' }, function(){
                });
			}
		},'json');
		});
    });
	
	 $('#unban').live('click',function(e) {
	 var _this =$(this);
	op_confirm({ title : '提示', content : '确认允许该用户发言吗？' },function(){ 
	    var user_id = $("#user_id").val();
        $.post('/website/user/user_unstop', {"user_id":user_id}, function(data){
		    if(data.errorCode=='0'){
			   op_tip({ title : '操作提醒', content : '操作成功!' }, function(){
			   _this.remove();
					$(".modal-footer").append('<button id="ban" class="btn btn-primary">禁言</button>');
                });
			}else{
			    op_tip({ title : '操作提醒', content : '操作失败，请重试!' }, function(){
                });
			}
		},'json');
		});
    });
$('.delcomment').live('click', function(){
		var _this = $(this);
		var _id = _this.data('del_id');
		op_confirm({ title : '提示', content : '确认删除该条评论吗？' },function(){ 
		    var _del_url = '/website/comment/delete_online/' + _id;
            var _callback = function(){ op_tip({ title : '提醒', content : '操作成功' },function(){_this.parent().parent().remove(); }); }
		    $.post(_del_url, '', function(result){
              if(result.errorCode == '0'){
				_callback();
            }
            else{
               op_tip({ title: '操作提醒', content: '操作异常，原因：' + result.title }, function () {
                	});
            }
            },'json');
		 });
	});
	$('.btn-danger.time').on('click', function(){
		var _this = $(this);
		var _id = _this.data('user_id');
		op_confirm({ title : '提示', content : '确认清除签到时间吗？' },function(){ 
		    var _del_url = '/website/user/remark/' + _id;
        	$.post(_del_url, {}, function(result){
            	console.log(result);
            	if(result.errorCode == '0'){
                	op_tip({ title : '操作提醒', content : '操作成功!' }, function(){
					//window.location.reload();
                	});
            	}
            	else{
            	    op_tip({ title: '操作提醒', content: '操作异常，原因：' + result.title }, function () {
                	});
            	}
        	}, 'json');
		 });
	});
	 
	 function set_creditinfo(user_id,offset){  ///积分日志列表异步加载
	     var html = "";
	     if(user_id==""){
		     html = '<tr> <td height="90" colspan="6">无积分日志</td></tr>';
		 }else{
		    $.post('/website/user/credit_list', {"user_id":user_id,"offset":offset}, function(data){

							if(data.errorCode == 0){
								var creditInfo = data.info.credit_log;
								var pages = data.info.pages;
								pages = pages.replace(/href/g, "data-offset")
								var nowpage = data.info.now;
								var total = data.info.total;
								$("#DataTables_Table_1_info_credit").html("显示："+nowpage+"  总共："+total);
								$("#DataTables_Table_1_paginate_credit").html(pages);
								if(pages!=""){
								    $("#DataTables_Table_1_paginate_credit .paginate_button").on("click",function(){
									    var uerid = $("#user_id").val();
										var offset = $(this).data('offset').substr(1);
									    set_creditinfo(uerid,offset);
									});
								}
								if(creditInfo.length>0){
								  creditInfo.forEach(function(credit_tmp){
								    html+='<tr style="text-align: center;" height="35px">';
									
									html+='<td></td>';
									html+='<td>'+credit_tmp.operate_type+'</td>';
								html+='<td>'+credit_tmp.source_type+'</td>';
									html+='<td>'+credit_tmp.credit+'</td>';
									html+='<td>'+credit_tmp.operate_time+'</td>';
									html+='<td></td>';
									html+='</tr>';
									
								  });
							   }else{
								   html = '<tr> <td height="90" colspan="6">无积分日志</td></tr>';
							   }
							}
							 $("#credits table tbody").html(html);
				  }, 'json');
	   } 
	 }
	 
	  function set_markinfo(user_id,offset){  ///积分日志列表异步加载
	     var html = "";
	     if(user_id==""){
		     html = '<tr> <td height="90" colspan="4">无签到记录</td></tr>';
		 }else{
		    $.post('/website/user/mark_record_list', {"user_id":user_id,"offset":offset}, function(data){

							if(data.errorCode == 0){
								
								var markInfo = data.info.mark_log;
								var pages = data.info.pages;
								pages = pages.replace(/href/g, "data-offset")
								var nowpage = data.info.now;
								var total = data.info.total;
								$("#DataTables_Table_1_info_mark").html("显示："+nowpage+"  总共："+total);
								$("#DataTables_Table_1_paginate_mark").html(pages);
								if(pages!=""){
								    $("#DataTables_Table_1_paginate_mark .paginate_button").on("click",function(){
									    var uerid = $("#user_id").val();
										var offset = $(this).data('offset').substr(1);
									    set_markinfo(uerid,offset);
									});
								}
								$(".marknum").html(total);
								if(markInfo.length>0){
								  markInfo.forEach(function(mark_tmp){
								    html+='<tr style="text-align: center;" height="35px">';
									
									html+='<td></td>';
									html+='<td>'+$("[name='nickname']").val();+'</td>';
								html+='<td>'+mark_tmp.create_time+'</td>';
									html+='<td></td>';
									html+='</tr>';
									
								  });
							   }else{
								   html = '<tr> <td height="90" colspan="4">无签到记录</td></tr>';
							   }
							}
							 $("#mark table tbody").html(html);
				  }, 'json');
	   } 
	 }
	 
	 function set_commentinfo(user_id,offset){  ///评论列表异步加载
	     var html = "";
	     if(user_id==""){
		     html = '<tr>   <td height="90" colspan="7">无评论内容</td>   </tr>';
		 }else{
		    $.post('/website/user/comment_list', {"user_id":user_id,"offset":offset}, function(data){

							if(data.errorCode == 0){
								var commentInfo = data.info.comment;
								var pages = data.info.pages;
								pages = pages.replace(/href/g, "data-offset")
								var nowpage = data.info.now;
								var total = data.info.total;
								$("#DataTables_Table_1_info").html("显示："+nowpage+"  总共："+total);
								$("#DataTables_Table_1_paginate").html(pages);
								if(pages!=""){
								    $("#DataTables_Table_1_paginate .paginate_button").on("click",function(){
									    var uerid = $("#user_id").val();
										var offset = $(this).data('offset').substr(1);
									    set_commentinfo(uerid,offset);
									});
								}
								if(commentInfo.length>0){
								  commentInfo.forEach(function(comment_tmp){
								    html+='<tr style="text-align: center;" height="35px">';
									
									html+='<td></td>';
									html+='<td>'+comment_tmp.article_title+'</td>';
									html+='<td>'+comment_tmp.article_column+'</td>';
									html+='<td>'+comment_tmp.content+'</td>';
									html+='<td>'+comment_tmp.create_time+'</td>';
									html+='<td>';
									html+='<button class="btn btn-danger delcomment" type="button" data-del_id="'+comment_tmp.comment_id+'">删除</button>';
									html+='</td>';
									html+='<td></td>';
									html+='</tr>';
									
								  });
							   }else{
								   html = '<tr>   <td height="90" colspan="7">无评论内容</td>   </tr>';
							   }
							}
							 $("#comment table tbody").html(html);
				  }, 'json');
	   } 
	 }
	 function set_locationinfo(open_id,offset){  ///位置列表异步加载
	     var html = "";
	     if(open_id==""){
		     html = '<tr>   <td height="90" colspan="7">无位置信息</td>   </tr>';
		 }else{
		    $.post('/website/user/location_list', {"open_id":open_id,"offset":offset}, function(data){
							if(data.errorCode == 0){
								var commentInfo = data.info.location;
								var pages = data.info.pages;
								pages = pages.replace(/href/g, "data-offset")
								var nowpage = data.info.now;
								var total = data.info.total;
								$("#DataTables_Table_1_location").html("显示："+nowpage+"  总共："+total);
								$("#DataTables_Table_1_paginate_location").html(pages);
								if(pages!=""){
								    $("#DataTables_Table_1_paginate_location .paginate_button").on("click",function(){
									    var open_id = $("#open_id").val();
										var offset = $(this).data('offset').substr(1);
									    set_locationinfo(uerid,offset);
									});
								}
								if(commentInfo.length>0){
								  commentInfo.forEach(function(comment_tmp){
								    html+='<tr style="text-align: center;" height="35px">';
									
									html+='<td></td>';
									html+='<td>'+comment_tmp.create_time+'</td>';
									html+='<td>'+comment_tmp.latitude+'</td>';
									html+='<td>'+comment_tmp.longitude+'</td>';
									html+='<td>'+comment_tmp.precision+'</td>';
									html+='<td></td>';
									html+='</tr>';
									
								  });
							   }else{
								   html = '<tr>   <td height="90" colspan="7">无位置信息</td>   </tr>';
							   }
							}
							 $("#location table tbody").html(html);
				  }, 'json');
	   } 
	 }