function delectNotice(id, url) {
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

function editNotice(id,url) {
    if (!id) {
        $("#boxTitle").html("添加公告");
        $("#notice-id").val("");
        $("#notice-title").val("");
        $("#notice-title-color").val("");
        $("#editNotice").modal("show");        
        $("#notice-title").css("color", "");
        editor.setContent('');//编辑器赋值
    } else {
        
        $.ajax({
            url:url,
            type:"POST",
            dataType:"json",
            data:{
                id:id
            },
            success: function(data){

                if(data.errorCode == 0){
                    var noticeInfo = data.info;
                    if(noticeInfo.title_color)
                    {
                        $("#notice-title").css("color", noticeInfo.title_color);
                    }else{
                        $("#notice-title").css("color", "");
                    }
                    $("#boxTitle").html("编辑公告");
                    $("#notice-id").val(noticeInfo.id);
                    $("#notice-title").val(noticeInfo.title);
                    $("#notice-title-color").val(noticeInfo.title_color);
                    $("#editNotice").modal("show");
                    editor.setContent(noticeInfo.content);
                }			  
            }
        });
       
    }
}

function saveNotice(url) {
    var id = $("#notice-id").val();
    var title = $("#notice-title").val();
    var content = editor.getContent();//获取编辑器值
    var color = $("#notice-title-color").val();
    if(trim(title) == "")
    {
        alert("标题不能为空！");
        return false;
    }
    if(trim(content) == "")
    {
        alert("公告内容不能为空！");
        return false;
    }
    $.ajax({
        url: url,
        type:"POST",
        data: {
            "id": id, 
            "title": title, 
            "content": content, 
            "color": color
        },
        dataType: "json",
        success: function (data) {
            if (data.errorCode > 0) {
                alert("输入错误，请刷新后重试！");
            } else {
                $(".modal").modal('hide');
                window.location.reload();
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
//删除字符串左右两端的空格
function trim(str){ 
    return str.replace(/(^\s*)|(\s*$)/g, "");
}
//搜索关键字高亮（颜色为#FFBB00）
function searchHighLight(string,search)
{
        if (search == "" || search == null)
        {
            return string;
        }
        else
        {
            string = string.replace(eval("/" + search + "/g"), "<font color='#FFBB00'>" + search + "</font>");    
        }

        return string;
}