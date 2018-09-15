define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: url,
                    add_url: add_url,
                    edit_url: edit_url,
                    del_url: del_url,
                    multi_url: 'data/multi.json',
                }
            });
            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                columns: [
                    [
                        {field: 'state', checkbox: true, },
                        {field: 'id', title: 'ID'},
                        {field: 'avatar', title: __('Avatar'), operate: false, formatter: Table.api.formatter.image},
                        {field: 'user_name', title: __('Username'),operate: 'LIKE %...%', placeholder: '用户名，模糊搜索'},
                        {field: 'mobile', title: __('Mobile')},
                        {field: 'nickname', title: __('Nickname')},
                        {field: 'email', title: __('Email')},                    
                        {field: 'status', title: __("Status"),operate:false,formatter: Table.api.formatter.status},
                        {field: 'operate', title: __('Operate'), events: Table.api.events.operate, formatter: function (value, row, index) {
                                return Table.api.formatter.operate.call(this, value, row, index, table);
                            }}
                    ]
                ],
                commonSearch:false
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Form.api.bindevent($("form[role=form]"));
        },
        edit: function () {
            Form.api.bindevent($("form[role=form]"));
        }
    };
    //同步数据
    $(document).on('click', '.btn-sync', function(){
        var _this = $(this);
        _this.attr('disabled', true);
        $.ajax({
            url:sync_url,
            type:'post',
            data:{},
            dataTyoe:'json',
            success:function(data){
                Layer.msg(data.msg);
                if(data.code == 1){
                    setInterval(function () {
                        window.location.reload();
                    }, 3000);
                }else{
                    _this.removeAttr('disabled');
                }
            }
        });
    });
    return Controller;
});