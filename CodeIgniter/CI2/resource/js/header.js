$(function(){
    setInterval("getUserMsg()", 50000);//用户消息
    setInterval("getSystemMsg()", 50000);//系统消息
    $('#show_message_tip').on('click', function(){
        $('ul.dropdown-menu').load('/userMsg');
    });

});
//显示提示信息
function showMessage()
{
    $("#quitUser").modal("show");

}

//退出跳转
function quitUser(url)
{
    window.location.href = url;
}

//显示用户信息
function showUserInfo(tag,id,email,real_name,mobile)
{
    if(tag == 1)
    {
        $("#headerboxTitle").html("用户资料");
        $("#user_psw").hide();
        $("#usernew_psw").hide();
        $("#usernew_psw2").hide();
        $("#userMobile").show();

        $("#user_email_id").val(id);
        $("#user_email").val(email);
        $("#user_real_name").val(real_name);
        $("#user_mobile").val(mobile);
        $("#userSaveBtn").attr("onClick","saveUserInfo("+1+",'/center/user/saveUserInfo');");
        $("#UserInfo").modal("show");
    }else if(tag == 2)
    {
        $("#headerboxTitle").html("账户设置");
        $("#user_psw").show();
        $("#usernew_psw").show();
        $("#usernew_psw2").show();
        $("#userMobile").hide();

        $("#user_password").val("");
        $("#usernew_password").val("");
        $("#usernew_password2").val("");
        $("#userMobile").val("");
        $("#user_email_id").val(id);
        $("#user_email").val(email);
        $("#user_real_name").val(real_name);
        $("#userSaveBtn").attr("onClick","saveUserInfo("+2+",'/center/user/saveUserInfo');");
        $("#UserInfo").modal("show");
    }
}

//用户信息的修改
function saveUserInfo(tag,url)
{
    var id = $("#user_email_id").val();
    var mobile = $("#user_mobile").val();
    var user_psw = $("#user_password").val();
    var usernew_psw = $("#usernew_password").val();
    var usernew_psw2 = $("#usernew_password2").val();



    if(tag == 1)
    {
        if(mobile == "")
        {
            alert("请输入手机号！");
            return false;
        }
        //手机号验证
        var ismobile = /^1(3|5|8)\d{9}$/;
        if(!ismobile.test(mobile)){
            alert("您输入的手机号不正确，请重新输入！（注：只支持13,15,18开头的11位手机号）");
            return false;
        }


        //用户资料的保存--修改手机号
        $.ajax({
            url: url,
            type:"POST",
            data: {
                "uid": id,
                "mobile": mobile
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
    }else if(tag == 2)
    {
        if(user_psw == "")
        {
            alert("请输入原密码！");
            return false;
        }
        if(usernew_psw == "")
        {
            alert("请输入新密码！");
            return false;
        }
        if(usernew_psw2 == "")
        {
            alert("请输入确认密码！");
            return false;
        }
        if(usernew_psw != usernew_psw2)
        {
            alert("您输入的确认密码与新密码不一致，请重新输入！");
            return false;
        }

        //账号设置的保存--修改密码
        $.ajax({
            url: url,
            type:"POST",
            data: {
                "uid": id,
                "password": user_psw,
                "newpassword": usernew_psw
            },
            dataType: "json",
            success: function (data) {
                if (data.errorCode == 0)
                {
                    $(".modal").modal('hide');
                    window.location.reload();
                }else if(data.errorCode == 2)
                {
                    alert("您输入的原密码不正确，请重新输入！");
                }else
                {
                    alert("输入错误，请刷新后重试！");
                }
            },
            error: function (xhr, error, thrown) {
            }
        })
    }else
    {
        return false;
    }

}
function op_tip(obj, func){
    var _html = '\
    <div class="modal hide fade op_tip">\
      <div class="modal-header">\
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
        <h3>' + obj.title +'</h3>\
      </div>\
      <div class="modal-body">\
        <p> ' + obj.content + '</p>\
      </div>\
      <div class="modal-footer">\
        <a href="#" class="btn btn-primary">OK</a>\
      </div>\
    </div>';
    $('body').append(_html);
    $('.op_tip').modal('show');
    $('div.modal-footer a.btn').on('click', function(){
        if(func) func && func();
        $('.op_tip').modal('hide').remove();
    });
}
function op_custom(obj, func){
    var _html = '\
    <div class="modal hide fade op_tip">\
      <div class="modal-header">\
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
        <h3>' + obj.title +'</h3>\
      </div>\
      <div class="modal-body">\
        ' + obj.content + '\
      </div>\
      <div class="modal-footer">\
        <a href="#" class="btn btn-close">关闭</a>\
      </div>\
    </div>';
    $('body').append(_html);
    $('.op_tip').modal('show');
    $('div.modal-footer a.btn').on('click', function(){
        $('.op_tip').modal('hide').remove();
    });
    setTimeout(function(){ if(func) func && func() }, '1000');
}
function op_confirm(obj, callback){
    //obj{ title: title, content:content };
    var _html = '\
    <div class="modal hide fade op_confirm">\
      <div class="modal-header">\
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
        <h3>' + obj.title +'</h3>\
      </div>\
      <div class="modal-body">\
        <p> ' + obj.content + '</p>\
      </div>\
      <div class="modal-footer">\
        <a href="#" class="btn btn-primary yes">确定</a>\
        <a href="#" class="btn btn-info no">关闭</a>\
      </div>\
    </div>';
    $('body').append(_html);
    $('.op_confirm').modal('show');
    $('div.modal-footer a.yes').on('click', function(){
        $('.op_confirm').modal('hide').remove();
        callback && callback();
    });
    $('div.modal-footer a.no').on('click', function(){
        $('.op_confirm').modal('hide').remove();
    });
}

function checkbox_init(){
    $('input.checkall').on('click', function(){
        $('input.checkdata').prop('checked', $(this).prop("checked") ? true : false);
    });
}
//用户消息
var getUserMsg_lock = false;
function getUserMsg()
{
	if (getUserMsg_lock)
	{
		return false;
	}
	getUserMsg_lock = true;
	
    //console.log("bbbb");
    var url = "/userMsg/getMsgDataInfo";
    $.ajax({
        url: url,
        type:"POST",
        dataType: "json",
        success: function (data) {

        	getUserMsg_lock = false;
            if (data.errorCode == 0)
            {
                if(data.count>0)
                {
                    $('#new_msg_num').html(data.count);
                }else
                {
                    $('#new_msg_num').html("0");
                    $('#new_msg_num').hide();
                }
            }
        },
        error: function (xhr, error, thrown) {
        }
    })
}
//系统消息
var getSystemMsg_lock = false;
function getSystemMsg()
{
	if (getSystemMsg_lock)
	{
		return false;
	}
	getSystemMsg_lock = true;
	
    //console.log("bbbb");
    var url = "/userMsg/getSysMsgDataInfo";
    $.ajax({
        url: url,
        type:"POST",
        dataType: "json",
        success: function (data) {

        	getSystemMsg_lock = false;
            if (data.errorCode == 0)
            {
                var msg_content = data.Info["content"];
                if(msg_content)
                {
                    $.messager.lays(300,160);
                    $.messager.show("系统消息",msg_content,0);
                }

            }
        },
        error: function (xhr, error, thrown) {
        }
    })
}
//标记用户所有未读信息为已读
function readAllUserMsg()
{
    var url = "/userMsg/readAllUesrMsg";
    $.ajax({
        url: url,
        type:"POST",
        dataType: "json",
        success: function (data) {

            $('#new_msg_num').html("0");
            $('#new_msg_num').hide();
        },
        error: function (xhr, error, thrown) {
        }
    })
}

function message_close(){
    $('#message_close').on('click', function(){
            $('#message').hide();
//            var url = "/userMsg/readAllUesrMsg";
//            $.ajax({
//                url: url,
//                type:"POST",
//                dataType: "json",
//                success: function (data) {
//
//                    if (data.errorCode == 0)
//                    {
//
//                    }
//                },
//                error: function (xhr, error, thrown) {
//                }
//            })
    });
}
