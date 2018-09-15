<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"F:\www\lisan\public/../application/admin\view\goods\attributeadd.html";i:1525182246;s:62:"F:\www\lisan\public/../application/admin\view\public\head.html";i:1525182246;s:68:"F:\www\lisan\public/../application/admin\view\public\javascript.html";i:1525182246;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
        <head>
        <meta charset="utf-8">
        <title>商品类型添加</title>
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
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('admin/goods/attributeAdd'); ?>">

                                    <div class="form-group">
                                        <label for="c-attr_name" class="control-label col-xs-12 col-sm-2">类型名称:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-attr_name" data-rule="required" class="form-control" name="row[attr_name]" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-weigh" class="control-label col-xs-12 col-sm-2">权重:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-weigh" class="form-control" name="row[weigh]" type="number" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-weigh" class="control-label col-xs-12 col-sm-2">关联规格:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <?php if(is_array($spec) || $spec instanceof \think\Collection || $spec instanceof \think\Paginator): $i = 0; $__LIST__ = $spec;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                <input name="row[spec_id_array][]" type="checkbox" value="<?php echo $vo['spec_id']; ?>"> <?php echo $vo['spec_name']; if($vo['spec_desc']): ?>[<?php echo $vo['spec_desc']; ?>]<?php endif; endforeach; endif; else: echo "" ;endif; ?>
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
    var jsname="backend/goods/spec";
    var controllername="index"
    var actionname="add";
</script>        
<script src="__STATIC__/assets/js/config.js?v=<?php echo VERSION; ?>"></script>
<script src="__STATIC__/assets/js/require.min.js?v=<?php echo VERSION; ?>" data-main="__STATIC__/assets/js/require-backend.min.js?v=<?php echo VERSION; ?>"></script>
    </body>
</html>