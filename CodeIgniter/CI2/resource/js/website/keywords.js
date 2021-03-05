$(function () {
    //$(".c_select").chosen();
    $('.btn-primary').on('click', function () {
        var _this = $(this);
        var _id = _this.data('edit_id');
    });
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $("#save").click(function () {
        var relation = [];
        var flag = true;
        $("[type='checkbox']:checked").each(function () {
            var tmp = [];
            tmp.push($(this).data("allow_id"));
            var _sort = $(this).parent().nextAll().find(".sort");
            var sort_num = _sort.val();

            if (sort_num.trim() == "") {
                flag = false;
                obj =$(this);
                return false;

            }
            tmp.push($(this).parent().nextAll().find(".sort").val());
            relation.push(tmp);
        });
        if (!flag) {
            op_tip({ title: '操作提醒', content: '请输入排序数字!' }, function () {
            });
        }
        $.post("/website/platform/keywords/edit_save",
            {
                "id": $("#id").val(),
                "key": $("#key").val(),
                "type": $("#type").val(),
                "value": $("#value").val(),
                "relation": relation
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
        var _title = _this.data('delete_title');
        op_confirm({ title: '提示', content: '确认删除关键词"' + _title + '"吗？' }, function () {
            var _del_url = '/website/platform/keywords/delete/' + _id;
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

});
function changetype(type) {
    $("#type").val(type);
}
