/**
 * Created by Administrator on 13-10-10.
 */
$(document).ready(function() {
    var event = arguments.callee.caller.arguments[0]||window.event;
    $('body').keydown(function(e){
        if(e.keyCode == 13){
            form_submit();
        }
    });
    $("#loginBtn").click(function() {
        form_submit();
    });
    var form_submit = function(){
        tempEmail = $("#Jemail").val();
        tempPwd = $("#Jpassword").val();
        tempCheckCode = $("#JcheckCode").val();
        if (tempEmail == "" || isEmail(tempEmail) == false) {
            $("#errorTip").html("邮箱格式不正确！").show(200);
            return false;
        }
        if (tempPwd == "") {
            $("#errorTip").html("请输入正确密码！").show(200);
            return false;
        }
        if (!tempCheckCode) {
            $("#errorTip").html("请输入正确验证码！").show(200);
            return false;
        }
        $.ajax({
            url: "/login/ajaxLogin",
            type: "POST",
            datatype: "json",
            data: "email=" + tempEmail + "&password=" + tempPwd+"&authCode="+tempCheckCode,
            beforeSend: function() {
                $("#loginBtn").hide();
                $("#loading").show();
            },
            success: function(data) {
                var dataObj = eval("(" + data + ")");
                if (dataObj.errorCode > 0) {
                    $("#errorTip").html(dataObj.msg).show(200);
                    $("#loginBtn").show();
                    $("#loading").hide();
                    $("#authCode").attr("src", "/captcha?random=" + Math.ceil(Math.random() * (38 - 8) + 8));
                }
                else {
                    $("#loginBox").hide();
                    $("#mobileBox").show();
                    window.location = "/main"
                }
            },
            error: function() {
                $("#lemaildiv").html("系统错误，请稍后再试！").show(200);
                $("#loginBtn").show();
                $("#loading").hide();
            }
        });
    }
    

    $("#refreshBtn").click(function() {
        $("#authCode").attr("src", "/captcha?random=" + Math.ceil(Math.random() * (38 - 8) + 8));
    })
})

function isEmail(strEmail) {
    if (strEmail == null || strEmail == "") {
        return false;
    }
    if (strEmail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1) {
        return true;
    } else {
        return false;
    }
}


function resendCheckCode(userEmail) {
    $.ajax({
        url: "/index.php/login/resendCheckCode",
        type: "POST",
        datatype: "json",
        data: "",
        success: function(data) {
            var dataObj = eval("(" + data + ")");
            if (dataObj.errorCode > 0) {
                $("#lcheckCodediv").html("验证码发送失败，请稍后再试！").show(200);
            }
            else {
                restartCount();
                $("#resend").attr("onclick", "#");
            }
        },
        error: function() {
            $("#lcheckCodediv").html("系统错误，请稍后再试！").show(200);
        }
    });
}
//计时相关
var timer;
var maxTime = 2;
function startCount() {
    timer = setInterval("countDown()", 1000);
}
function countDown() {
    if (maxTime >= 0) {
        $("#countB").html(maxTime);
        --maxTime;
    } else {
        $("#resend").attr("onclick", "resendCheckCode();");
        clearInterval(timer);
    }
}
function restartCount() {
    maxTime = 3;
    startCount();
}