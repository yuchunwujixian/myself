<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"F:\www\lisan\public/../application/admin\view\goods\specadd.html";i:1525182246;s:62:"F:\www\lisan\public/../application/admin\view\public\head.html";i:1525182246;s:68:"F:\www\lisan\public/../application/admin\view\public\javascript.html";i:1525182246;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
        <head>
        <meta charset="utf-8">
        <title>商品规格添加</title>
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
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('admin/goods/specAdd'); ?>">

                                    <div class="form-group">
                                        <label for="c-name" class="control-label col-xs-12 col-sm-2">规格名称:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-name" data-rule="required" class="form-control" name="row[spec_name]" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-desc" class="control-label col-xs-12 col-sm-2">规格描述:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-desc" data-rule="required" class="form-control" name="row[spec_desc]" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-weigh" class="control-label col-xs-12 col-sm-2">权重:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-weigh" class="form-control" name="row[weigh]" type="number" value="0">
                                        </div>
                                    </div>
                                    
                                    <div id="rows">
                                        <div class="form-group">
                                            <label for="c-value" class="control-label col-xs-12 col-sm-2">属性:</label>
                                            <div class="col-xs-10 col-sm-7">
                                                <input class="form-control" name="value[]" type="text"  data-rule="required">
                                            </div>
                                            <div class="col-xs-2 col-sm-1">
                                                
                                            </div>                                        
                                        </div>
                                        
                                        <script type="text/html" id="tpl">
                                            <div class="form-group">
                                                <label for="c-value" class="control-label col-xs-12 col-sm-2"></label>
                                                <div class="col-xs-10 col-sm-7">
                                                    <input class="form-control" name="value[]" type="text">
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