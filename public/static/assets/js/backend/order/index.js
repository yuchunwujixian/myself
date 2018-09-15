define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: index_url,
                    add_url: add_url,
                    edit_url: edit_url,
                    del_url: del_url,
                    multi_url: multi_url
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                escape: false,
                pk: 'order_id',
                sortName: 'weigh',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'order_no', title: "订单编号"},
                        {field: 'goods', title: __('Goods Name'), align: 'left',formatter:function(items){
                            var html='';
                            for (var i in items) {
                                html+='<div class="media"><div class="media-left"><a href="#"><img class="media-object" src="'+items[i].picture+'"></a></div><div class="media-body"><h4 class="media-heading">'+items[i].goods_name+'*'+items[i].num+'</h4></div></div>';
                            }
                            return html;
                        }},
                        {field: 'price', title:__('Order Price'), align: 'left'},
                        {field: 'link_name', title: __('link name')},
                        {field: 'mobile', title: __('mobile')},
                        {field: 'create_time', title: __('Createtime')},
                        {field: 'status_name', title: __('status')},
                        {field: 'operate', title: __('Operate'), events: Controller.api.events.operate, formatter: function(value, row, index){
                            var detail="";
                            if(row.status==0){
                                //待付款
                                detail+='<a class="btn btn-xs btn-danger btn-close">关闭</a> ';
                            }
                            if(row.status==1){
                                //待发货
                                detail+='<a class="btn btn-xs btn-success btn-edit" data-id="'+row.order_id+'">发货</a> ';                                
                            }
                            return detail;                            
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
            },
            formatter: {//渲染的方法
                operate: function (value, row, index) {
                    //返回字符串加上Table.api.formatter.operate的结果
                    //默认需要按需显示排序/编辑/删除按钮,则需要在Table.api.formatter.operate将table传入
                    //传入了table以后如果edit_url为空则不显示编辑按钮,如果del_url为空则不显显删除按钮
                    return '<a class="btn btn-info btn-xs btn-detail"><i class="fa fa-list"></i> ' + __('Detail') + '</a> '
                            + Table.api.formatter.operate(value, row, index, $("#table"));
                },
            },  
            events: {//绑定事件的方法
                operate: $.extend({
                    'click .btn-detail': function (e, value, row, index) {
                        e.stopPropagation();
                        Backend.api.open('example/bootstraptable/detail/ids/' + row['id'], __('Detail'));
                    },
                    'click .btn-close':function(e, value, row, index){
                        e.stopPropagation();
                        var that = this;
                        var index = Layer.confirm(
                                __('确定要关闭该订单吗?'),
                                {icon: 3, title: __('Warning'), shadeClose: true},
                                function () {
                                    Table.api.multi("del", row['order_id'], $("#table"), that);
                                    Layer.close(index);
                                }
                        );
                    }
                }, Table.api.events.operate)
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