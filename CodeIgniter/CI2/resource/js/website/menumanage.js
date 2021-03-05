$(function () {
    var text = $("#article-content").val();
    var json_text = eval("(" + text + ")");
    $("#article-content").val(JsonUti.convertToString(json_text));
    $("#edit").on('click', function () {
        $(this).attr("class", "btn").attr("disabled", "disabled");
        $("#article-content").attr("disabled", false);
        $("#save").attr("disabled", false).attr("class", "btn  btn-primary");
        $("#cancel").attr("disabled", false).attr("class", "btn  btn-primary");
    });

    $("#save").on('click', function () {
        var _this = $(this);
        url_content = $("#article-content").val();
        //menu_content = url_content.replace(/\n|\t/,"");
        $.post("/website/platform/menu/edit",  $('form').serialize(), function (data) {
            console.log(data);
            if (data.errorCode == '0') {
                op_tip({ title: '操作提醒', content: '操作成功!' }, function () {
                    _this.attr("class", "btn").attr("disabled", "disabled");
                    $("#cancel").attr("class", "btn").attr("disabled", "disabled");
                    $("#article-content").attr("disabled", "disabled");
                    $("#edit").attr("disabled", false).attr("class", "btn  btn-primary");
                });

            } else if (data.errorCode == '1') {
                op_tip({ title: '操作提醒', content: '数据不能为空!' }, function () {
                });
            } else {
                op_tip({ title: '操作提醒', content: '操作异常，原因：' + data.error_title }, function () {
                });
            }
        }, 'json');

    });

    $("#cancel").on('click', function () {
        $(this).attr("class", "btn").attr("disabled", "disabled");
        $("#save").attr("class", "btn").attr("disabled", "disabled");
        $("#article-content").attr("disabled", "disabled");
        $("#edit").attr("disabled", false).attr("class", "btn  btn-primary");
    });
});

