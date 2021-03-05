$(function () {
    //$(".c_select").chosen();
    $('.btn-primary').on('click', function () {
        var _this = $(this);
        var _id = _this.data('edit_id');
    });
    $("#save").click(function () {
        $.post("/website/config/edit_save",
            {
                "key": $("#key").val(),
                "desc": $("#desc").val(),
                "value": $("#value").val()
            },
            function (data) {
                console.log(data);
                if (data.errorCode == '0') {
                    op_tip({ title: '操作提醒', content: '操作成功!' }, function () {
                        window.close();
                        window.opener.location.reload();
                    });

                }
                else {
                    op_tip({ title: '操作提醒', content: '操作异常，原因：' + data.error_title }, function () {
                    });
                }
            }, 'json');

    });

    $('.btn-danger').on('click', function () {
        var _this = $(this);
        var _id = _this.data('delete_id');
        op_confirm({ title: '提示', content: '确认删除该配置吗？' }, function () {
            var _del_url = '/website/config/delete/' + _id;
            var _callback = function () {
                op_tip({ title: '提醒', content: '操作成功' }, function () {
                    window.location.reload();
                });
            }
            $.post(_del_url, '', function (result) {
                if (result.errorCode == '0') {
                    _callback();
                }
                else {
                    op_tip({ title: '操作提醒', content: '操作异常，原因：' + data.error_title }, function () {
                    });
                }
                //
            }, "json");
        });
    });

    $('.query').on('click', function () {
        var selkey = $("#selkey").val();
        if(selkey!=""){
            window.location.href = "/website/config/index/"+selkey;
        }else{
            window.location.href = "/website/config/index";
        }

    });

});