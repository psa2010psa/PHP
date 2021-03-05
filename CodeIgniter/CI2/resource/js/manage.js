function delectUser(id, url) {
  
    $.ajax({
        "url": url,
        "data": "id=" + id,
        success: function (data) {
            if (data.errorCode > 0) {
                alert("删除错误，请刷新后重试");
            } else {
                $(".modal").modal('hide');
                window.location.reload();
            }
        },
        error: function (xhr, error, thrown) {
        }
    })
}

function lockUser(id, is_lock,url) {
 
 
    $.ajax({
        url: url,
        type:"POST",
        data: {
            "uid": id, 
            "is_lock": is_lock
        },
        dataType: "json",
        success: function (data) {
            // console.log(data);
            if (data.errorCode > 0) {
                alert("数据错误，请刷新后重试！");
            } else {
                $(".modal").modal('hide');
                window.location.reload();
            }
        },
        error: function (xhr, error, thrown) {
        //alert(error);
        }
    })
   
    
}

function editManage(id, email, password, app, game,weixin,real_name,mobile) {
    if (!id) {
        $("#manageboxTitle").html("添加用户");
        $("#manage_email").val("");
        $("#manage_password").val("");
        $("#manage_app").val("");
        $("#manage_game").val("");
        $("#manage_weixin").val("");
        $("#manage_real_name").val("");
        $("#manage_mobile").val("");
        $("#manage_email").removeAttr("readonly");
        $("#manage_userlist_id").val("");
        $("#editManage").modal("show");                
              
        //app部分，缺少初始化--空选择
       
		dataArray = new Array();
        $(".app_select>option").each(function(index, element) {
			$(this).attr("selected",false);
        });
		 $(".app_select").chosen();
		 $(".app_select").trigger("liszt:updated");
		 
		 $(".game_select>option").each(function(index, element) {
				$(this).attr("selected",false);
	     });
		$(".game_select").chosen();
		$(".game_select").trigger("liszt:updated");
		
		$(".weixin_select>option").each(function(index, element) {
			$(this).attr("selected",false);
	     });
		$(".weixin_select").chosen();
		$(".weixin_select").trigger("liszt:updated");

    } else {
        $("#manageboxTitle").html("编辑用户");
        $("#manage_email").val(email);
        $("#manage_password").val("******");
       
		$(".app_select>option").each(function(index, element) {
			$(this).attr("selected",false);
        });
        //app部分，缺少先清空在去赋值
        var appList = app.split(",");
        $(".app_select>option").each(function(index, element) {
            var nowVal = $(this).val();
            for(i= 0;i<appList.length;i++){
                if(appList[i]==nowVal)
                {
                    $(this).attr("selected","");
                }
            }
        });
        
        $(".game_select>option").each(function(index, element) {
			$(this).attr("selected",false);
        });
        //app部分，缺少先清空在去赋值
        var gameList = game.split(",");
        $(".game_select>option").each(function(index, element) {
            var nowVal = $(this).val();
            for(i= 0;i<gameList.length;i++){
                if(gameList[i]==nowVal)
                {
                    $(this).attr("selected","");
                }
            }
        });
        
        $(".weixin_select>option").each(function(index, element) {
			$(this).attr("selected",false);
        });
        //app部分，缺少先清空在去赋值
        var weixinList = weixin.split(",");
        $(".weixin_select>option").each(function(index, element) {
            var nowVal = $(this).val();
            for(i= 0;i<weixinList.length;i++){
                if(weixinList[i]==nowVal)
                {
                    $(this).attr("selected","");
                }
            }
        });
  
        $("#manage_real_name").val(real_name);
        $("#manage_mobile").val(mobile);
        $("#manage_userlist_id").val(id);
        
        $("#manage_email").attr("readonly","readonly");
        $(".app_select").chosen();
		$(".app_select").trigger("liszt:updated");
		$(".game_select").chosen();
		$(".game_select").trigger("liszt:updated");
		$(".weixin_select").chosen();
		$(".weixin_select").trigger("liszt:updated");
		
        $("#editManage").modal("show");
        
    }
}

function saveManage(url) {

    var id = $("#manage_userlist_id").val();
    var email = $("#manage_email").val();
    var password = $("#manage_password").val();
    var app = $("#manage_app").val();
    var game = $("#manage_game").val();
    var weixin = $("#manage_weixin").val();
    var real_name =  $("#manage_real_name").val();
    var mobile = $("#manage_mobile").val();
    var app_arr = new Array();
    $("#manage_app").next('div').find("input:checkbox").each(function(index, domEle) { 
        if($(this).attr("checked")=="checked")
        {         
            app_arr.push($(this).val());  
        } 
    });
	if(app_arr.length==0){
		app_arr.push("");	
	}
    var game_arr = new Array();
    $("#manage_game").next('div').find("input:checkbox").each(function(index, domEle) { 
        if($(this).attr("checked")=="checked")
        {         
        	game_arr.push($(this).val());  
        } 
    });
 	if(game_arr.length==0){
		game_arr.push("");	
	}
 	var weixin_arr = new Array();
    $("#manage_weixin").next('div').find("input:checkbox").each(function(index, domEle) { 
        if($(this).attr("checked")=="checked")
        {         
        	weixin_arr.push($(this).val());  
        } 
    });
 	if(weixin_arr.length==0){
		weixin_arr.push("");	
	}
    //邮箱验证
    var isemail=/^\w+([-\.]\w+)*@\w+([\.-]\w+)*\.\w{2,4}$/;
    if (email=="")  {
        alert("请输入用户邮箱!");
        return false;
    }
    if (password=="")  {
        alert("请输入密码!");
        return false;
    }
    if (email.length>50){
        alert("长度太长");
        return false;
    }
    if (!isemail.test(email)){
        alert("您输入的邮箱不正确，请重新输入！");
        return false;
    }
    //手机号验证
    var ismobile = /^1(3|5|8)\d{9}$/;
    if(!ismobile.test(mobile)){
        alert("您输入的手机号不正确，请重新输入！（注：只支持13,15,18开头的11位手机号）");
        return false;
    }
   
    $.ajax({
        url: url,
        type:"POST",
        data: {
            "uid": id, 
            "email": email, 
            "password": password, 
            "app": app?app:app_arr, 
            "game": game?game:game_arr, 
            "weixin": weixin?weixin:weixin_arr, 
            "real_name": real_name, 
            "mobile": mobile
        },
        dataType: "json",
        success: function (data) {
            if (data.errorCode == 0) {
                $(".modal").modal('hide');
                window.location.reload();               
            } else if (data.errorCode == 2) {
                alert("您输入的邮箱已存在，请重新输入！");
            }else {
                alert("输入错误，请刷新后重试！");
            }
        },
        error: function (xhr, error, thrown) {
        }
    })
}
function changeColor(type) {
    var color = null;
    switch (type) {
        case 1:
            color = "#f00";
            break;
        case 2:
            color = "#000";
            break;
        case 3:
            color = "#00f";
            break;
    }
    $("#notice-title").css("color", color);
    $("#notice-title-color").val(color);
}

//编辑用户消息
function editMuserMsg(id,url,type,content) {
    $("input[type='radio']").each(function(n,value) {
            $("input[type='radio']").eq(n).attr("checked", false);
    });
    if (!id) {
        //alert("aa");
        //return;
        $("#editMuserMsgTitle").html("添加消息");
        
        $("#message-content").val("");
        $("#saveMuserMsgBtn").attr('onclick','saveMuserMsg("'+'","'+url+'")');   
        $("#editMuserMsg").modal("show");                
              

    } else {
        $("#editMuserMsgTitle").html("编辑消息");
        if(type==1)
        {
            $("#message-system").attr("checked",true);
        }else if(type==0)
        {
            $("#message-normal").attr("checked",true);
        }    
        $("#message-content").val(content);
        $("#saveMuserMsgBtn").attr('onclick','saveMuserMsg('+id+',"'+url+'")');   
        $("#editMuserMsg").modal("show");
        
    }
}
//保存消息
function saveMuserMsg(id,url)
{
    var content = $("#message-content").val();
    var type=$('input[name="chbox"]:checked').val();
    
    if(!type)
    {
        alert("类型必须选择！");
        return false;
    }
    if(content == "")
    {
        alert("内容不能为空！");
        return false;
    }
    
    $.ajax({
        url: url,
        type:"POST",
        data: {
            "id": id, 
            "content": content, 
            "type": type
        },
        dataType: "json",
        success: function (data) {
            if (data.errorCode == 0) {
                $(".modal").modal('hide');
                window.location.reload();               
            } else {
                alert("输入错误，请刷新后重试！");
            }
        },
        error: function (xhr, error, thrown) {
        }
    })
}
//显示删除消息的提示
function showMuserMsgDelete(id,url){
        $("#tipTitle2").html("是否要删除此条消息");
	$("#tipBtn").attr("onClick","deleteMuserMsg("+id+",'"+url+"')");
	$("#showTip").modal("show");
}
//删除用户消息
function deleteMuserMsg(id,url)
{
    $.ajax({
        url: url,
        type:"POST",
        dataType:"json",
        data: {id:id},
        success: function (data) {
            if (data.errorCode == 0) {
                $(".modal").modal('hide');
                window.location.reload();                
            } 
            else{
                alert("删除错误，请刷新后重试");
            }
        },
        error: function (xhr, error, thrown) {
        }
    });
}
//显示发送消息的提示
function showMuserMsgSend(id,url){
	$("#tipTitle2").html("是否要发送此条消息");
	$("#tipBtn").attr("onClick","sendMuserMsg("+id+",'"+url+"')");
	$("#showTip").modal("show");
}
//确认发送用户消息
function sendMuserMsg(id,url)
{
    $.ajax({
        url: url,
        type:"POST",
        dataType:"json",
        data: {id:id},
        success: function (data) {
            if (data.errorCode == 0) {
                $(".modal").modal('hide');
                window.location.reload();                
            } 
            else{
                alert("系统错误，请刷新后重试");
            }
        },
        error: function (xhr, error, thrown) {
        }
    });
}