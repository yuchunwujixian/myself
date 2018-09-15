<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"F:\www\lisan\public/../application/admin\view\order\post.html";i:1525182246;s:62:"F:\www\lisan\public/../application/admin\view\public\head.html";i:1525182246;s:68:"F:\www\lisan\public/../application/admin\view\public\javascript.html";i:1525182246;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
        <head>
        <meta charset="utf-8">
        <title>商品分类添加</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="renderer" content="webkit">
        <!-- Loading Bootstrap -->
        <link href="__STATIC__/assets/css/backend.min.css" rel="stylesheet">
        <link href="__STATIC__/assets/css/app.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
          <script src="assets/js/html5shiv.js"></script>
          <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="inside-header inside-aside is-dialog">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    控制台                                    <small>Control panel</small>
                                </h1>
                            </section>
                            <div class="content">
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('admin/order/post'); ?>">

                                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                    <div class="form-group">
                                        <label for="c-goods_name" class="control-label col-xs-12 col-sm-2">订单编号:</label>
                                        <div class="col-xs-12 col-sm-8" style="padding-top:7px;">
                                            <span><?php echo $row['order_no']; ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-goods_name" class="control-label col-xs-12 col-sm-2">下单时间:</label>
                                        <div class="col-xs-12 col-sm-8" style="padding-top:7px;">
                                            <span><?php echo $row['create_time']; ?></span>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label for="c-goods_name" class="control-label col-xs-12 col-sm-2">订购商品:</label>
                                        <div class="col-xs-12 col-sm-8" style="padding-top:7px;">
                                            <?php if(is_array($row['goods']) || $row['goods'] instanceof \think\Collection || $row['goods'] instanceof \think\Paginator): $i = 0; $__LIST__ = $row['goods'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                            <span><?php echo $vo['goods_name']; ?>*<?php echo $vo['num']; ?></span><br>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </div>                                                                       

                                    <div class="form-group">
                                        <label for="c-goods_name" class="control-label col-xs-12 col-sm-2">订单金额:</label>
                                        <div class="col-xs-12 col-sm-8" style="padding-top:7px;">
                                            <span><?php echo $row['price']; ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-goods_name" class="control-label col-xs-12 col-sm-2">联系人:</label>
                                        <div class="col-xs-12 col-sm-8" style="padding-top:7px;">
                                            <span><?php echo $row['link_name']; ?></span>
                                        </div>
                                    </div>                                    

                                    <div class="form-group">
                                        <label for="c-goods_name" class="control-label col-xs-12 col-sm-2">联系电话:</label>
                                        <div class="col-xs-12 col-sm-8" style="padding-top:7px;">
                                            <span><?php echo $row['mobile']; ?></span>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label for="c-goods_name" class="control-label col-xs-12 col-sm-2">配送地址:</label>
                                        <div class="col-xs-12 col-sm-8" style="padding-top:7px;">
                                            <span><?php echo $row['address']; ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-goods_name" class="control-label col-xs-12 col-sm-2">备注信息:</label>
                                        <div class="col-xs-12 col-sm-8" style="padding-top:7px;">
                                            <span><?php echo $row['remark']; ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-post_type" class="control-label col-xs-12 col-sm-2">发货方式:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-post_type" class="form-control" name="row[post_type]" type="text" value="" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-post_id" class="control-label col-xs-12 col-sm-2">发货单号:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-post_id" class="form-control" name="row[post_id]" type="text" value="" placeholder="">
                                        </div>
                                    </div>                                    


                                    <div class="form-group layer-footer">
                                        <label class="control-label col-xs-12 col-sm-2"></label>
                                        <div class="col-xs-12 col-sm-8">
                                            <button type="submit" class="btn btn-success btn-embossed disabled">确定</button>
                                            <button type="reset" class="btn btn-default btn-embossed">重置</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
    var debug="<?php echo $app_debug; ?>";
    var version="<?php echo VERSION; ?>";
    var root="__STATIC__";
    var jsname="backend/goods/category";
    var controllername="category"
    var actionname="add";
</script>        
<script src="__STATIC__/assets/js/config.js?v=<?php echo VERSION; ?>"></script>
<script src="__STATIC__/assets/js/require.min.js?v=<?php echo VERSION; ?>" data-main="__STATIC__/assets/js/require-backend.min.js?v=<?php echo VERSION; ?>"></script>
    </body>
</html>