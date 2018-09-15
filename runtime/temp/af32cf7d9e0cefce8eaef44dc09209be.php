<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"F:\www\lisan\public/../application/admin\view\goods\specedit.html";i:1525182246;s:62:"F:\www\lisan\public/../application/admin\view\public\head.html";i:1525182246;s:68:"F:\www\lisan\public/../application/admin\view\public\javascript.html";i:1525182246;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
        <head>
        <meta charset="utf-8">
        <title>商品规格编辑</title>
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
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('admin/goods/specEdit'); ?>">
                                    <input type="hidden" name="spec_id" value="<?php echo $row['spec_id']; ?>">

                                    <div class="form-group">
                                        <label for="c-name" class="control-label col-xs-12 col-sm-2">规格名称:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-name" data-rule="required" class="form-control" name="row[spec_name]" value="<?php echo $row['spec_name']; ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-desc" class="control-label col-xs-12 col-sm-2">规格描述:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-desc" data-rule="required" class="form-control" name="row[spec_desc]" value="<?php echo $row['spec_desc']; ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-weigh" class="control-label col-xs-12 col-sm-2">权重:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-weigh" class="form-control" name="row[weigh]" type="number"  value="<?php echo $row['weigh']; ?>">
                                        </div>
                                    </div>
                                    
                                    <div id="rows">
                                        <?php if($row['values']): if(is_array($row['values']) || $row['values'] instanceof \think\Collection || $row['values'] instanceof \think\Paginator): $i = 0; $__LIST__ = $row['values'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                            <div class="form-group">
                                                <label for="c-value" class="control-label col-xs-12 col-sm-2"><?php if($key==0): ?>属性:<?php endif; ?></label>
                                                <div class="col-xs-10 col-sm-7">
                                                    <input data-edit class="form-control" data-id="<?php echo $vo['spec_value_id']; ?>" name="value[<?php echo $vo['spec_value_id']; ?>]" type="text" value="<?php echo $vo['spec_value_name']; ?>"  data-rule="required">
                                                </div>
                                                <div class="col-xs-2 col-sm-1">
                                                    <?php if($key>0): ?>
                                                        <button type="button" data-id="<?php echo $vo['spec_value_id']; ?>" class="btn btn-danger btn-del btn-xs"><i class="fa fa-remove"></i></button>
                                                    <?php endif; ?>
                                                </div>                                        
                                            </div>
                                        <?php endforeach; endif; else: echo "" ;endif; else: ?>
                                        <div class="form-group">
                                            <label for="c-value" class="control-label col-xs-12 col-sm-2">属性:</label>
                                            <div class="col-xs-10 col-sm-7">
                                                <input class="form-control" name="value[]" type="text"  data-rule="required">
                                            </div>
                                            <div class="col-xs-2 col-sm-1">
                                                
                                            </div>                                        
                                        </div>
                                        <?php endif; ?>
                                        <script type="text/html" id="tpl">
                                            <div class="form-group">
                                                <label for="c-value" class="control-label col-xs-12 col-sm-2"></label>
                                                <div class="col-xs-10 col-sm-7">
                                                    <input class="form-control"  data-add data-id="<?php echo $row['spec_id']; ?>" name="value[]" type="text">
                                                </div>
                                                <div class="col-xs-2 col-sm-1">
                                                    <button type="button" class="btn btn-danger btn-del btn-xs"><i class="fa fa-remove"></i></button>
                                                </div>                                        
                                            </div>  
                                        </script> 
                                    </div>                                   

                                   <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-2"></label>
                                        <div class="col-xs-12 col-sm-8">
                                        <a href="javascript:" id="add"><i class="fa fa-plus"></i>添加属性</a>
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
        var delete_url="<?php echo url('admin/goods/specValueDelete'); ?>";
        var update_url="<?php echo url('admin/goods/specValueEdit'); ?>";
        </script>
        <script type="text/javascript">
    var debug="<?php echo $app_debug; ?>";
    var version="<?php echo VERSION; ?>";
    var root="__STATIC__";
    var jsname="backend/goods/spec";
    var controllername="index"
    var actionname="edit";
</script>        
<script src="__STATIC__/assets/js/config.js?v=<?php echo VERSION; ?>"></script>
<script src="__STATIC__/assets/js/require.min.js?v=<?php echo VERSION; ?>" data-main="__STATIC__/assets/js/require-backend.min.js?v=<?php echo VERSION; ?>"></script>
    </body>
</html>