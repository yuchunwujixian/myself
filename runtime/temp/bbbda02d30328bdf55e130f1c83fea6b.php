<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"F:\www\lisan\public/../application/admin\view\goods\spec.html";i:1525182246;s:62:"F:\www\lisan\public/../application/admin\view\public\head.html";i:1525182246;s:68:"F:\www\lisan\public/../application/admin\view\public\javascript.html";i:1525182246;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
        <head>
        <meta charset="utf-8">
        <title>商品规格</title>
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

    <body class="inside-header inside-aside ">
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
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> 控制台</a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="javascript:;" data-url="category">商品规格</a></li>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <div class="content">
                                <div class="panel panel-default panel-intro">

                                    <div class="panel-body">
                                        <div id="myTabContent" class="tab-content">
                                            <div class="tab-pane fade active in" id="one">
                                                <div class="widget-body no-padding">
                                                    <div id="toolbar" class="toolbar">
                                                        <a href="javascript:;" class="btn btn-primary btn-refresh"><i class="fa fa-refresh"></i> </a> 
                                                        <a href="javascript:;" class="btn btn-success btn-add"><i class="fa fa-plus"></i> 添加</a>
                                                        <a href="javascript:;" class="btn btn-danger btn-del btn-disabled disabled" ><i class="fa fa-trash"></i> 删除</a>
                                                    </div>
                                                    <table id="table" class="table table-striped table-bordered table-hover" width="100%">
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        var index_url="<?php echo url('admin/goods/spec'); ?>";
        var add_url="<?php echo url('admin/goods/specAdd'); ?>";
        var edit_url="<?php echo url('admin/goods/specEdit'); ?>";
        var del_url="<?php echo url('admin/goods/specDelete'); ?>";
        </script>
       <script type="text/javascript">
    var debug="<?php echo $app_debug; ?>";
    var version="<?php echo VERSION; ?>";
    var root="__STATIC__";
    var jsname="backend/goods/spec";
    var controllername="index"
    var actionname="index";
</script>        
<script src="__STATIC__/assets/js/config.js?v=<?php echo VERSION; ?>"></script>
<script src="__STATIC__/assets/js/require.min.js?v=<?php echo VERSION; ?>" data-main="__STATIC__/assets/js/require-backend.min.js?v=<?php echo VERSION; ?>"></script>
    </body>
</html>