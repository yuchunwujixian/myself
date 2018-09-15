define(['jquery', 'bootstrap', 'backend', 'table', 'form', 'layer'], function ($, undefined, Backend, Table, Form, Layer) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: index_url,
                    add_url: add_url,
                    edit_url: edit_url,
                    del_url: del_url,
                    dragsort_url:"",
                    multi_url: 'data/multi.json',
                    table: 'category',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                escape: false,
                pk: 'category_id',
                sortName: 'weigh',
                commonSearch:false,
                pageSize:1000,
                pageList:[],
                columns: [
                    [
                        {checkbox: true},
                        {field: 'category_id', title: __('Id')},
                        {field: 'category_name', title: __('Name'), align: 'left'},
                        {field: 'image', title: __('Image'), operate: false, formatter: Table.api.formatter.image},
                        {field: 'weigh', title: __('Weigh'), operate: false},
                        {field: 'status', title: __('Status'), operate: false, formatter: Table.api.formatter.status},
                        {field: 'operate', title: __('Operate'), events: Table.api.events.operate, formatter:function(){
                            var html = [];
                            html.push('<a href="javascript:;" data-width="1000px" class="btn btn-success btn-editone btn-xs"><i class="fa fa-pencil"></i></a>');
                            html.push('<a href="javascript:;" class="btn btn-danger btn-delone btn-xs"><i class="fa fa-trash"></i></a>');
                            return html.join(' ');
                        }}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
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