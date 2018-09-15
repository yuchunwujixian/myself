<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:62:"F:\www\lisan\public/../application/admin\view\index\index.html";i:1525182246;s:62:"F:\www\lisan\public/../application/admin\view\public\head.html";i:1525182246;s:64:"F:\www\lisan\public/../application/admin\view\public\header.html";i:1525182246;s:63:"F:\www\lisan\public/../application/admin\view\public\sider.html";i:1536933584;s:65:"F:\www\lisan\public/../application/admin\view\public\control.html";i:1525182246;s:68:"F:\www\lisan\public/../application/admin\view\public\javascript.html";i:1525182246;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
        <head>
        <meta charset="utf-8">
        <title>后台管理</title>
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

    <body class="hold-transition skin-green sidebar-mini fixed" id="tabs">
        <div class="wrapper">
            
                        <header id="header" class="main-header">
                <!-- Logo -->
                <a href="./" class="logo">
                    <!-- 迷你模式下Logo的大小为50X50 -->
                    <span class="logo-mini">后台</span>
                    <!-- 普通模式下Logo -->
                    <span class="logo-lg"><b>管理</b>后台</span>
                </a>
                <!-- 顶部通栏样式 -->
                <nav class="navbar navbar-static-top">
                    <!-- 边栏切换按钮-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div id="nav" class="pull-left">
                        <!--如果不想在顶部显示角标,则给ul加上disable-top-badge类即可-->
                        <ul class="nav nav-tabs nav-addtabs disable-top-badge" role="tablist">
                        </ul>
                    </div>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

<!--                             <li>
                                <a href="index/index/index" target="_blank"><i class="fa fa-home" style="font-size:14px;"></i></a>
                            </li> -->

<!--                             <li>
                                <a href="javascript:;" data-toggle="wipecache" title="清空缓存">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </li> -->

<!--                             <li class="hidden-xs">
                                <a href="#" data-toggle="fullscreen"><i class="fa fa-arrows-alt"></i></a>
                            </li> -->

                            <!-- 账号信息下拉框 -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="__STATIC__/assets/img/avatar.png" class="user-image" alt="Admin">
                                    <span class="hidden-xs"><?php echo session('admin_name'); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="__STATIC__/assets/img/avatar.png" class="img-circle" alt="">

                                        <p>
                                            <?php echo session('admin_name'); ?>                            
                                            <small><?php echo date('Y-m-d H:i:s',time()); ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo url('admin/admin/info'); ?>" class="btn btn-default btn-flat addtabsit">个人资料</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo url('admin/login/out'); ?>" class="btn btn-default btn-flat">注销</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- 控制栏切换按钮 -->
<!--                             <li>
                                <a href="javascript:;" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li> -->
                        </ul>
                    </div>
                </nav>
            </header>

            <!--侧边导航-->
                        <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel hidden-xs">
                        <div class="pull-left image">
                            <a href="profile" class="addtabsit"><img src="__STATIC__/assets/img/avatar.png" class="img-circle" /></a>
                        </div>
                        <div class="pull-left info">
                            <p><?php echo session('admin_name'); ?></p>
                            <i class="fa fa-circle text-success"></i> 在线        </div>
                    </div>

                    <!-- search form -->
<!--                     <form action="" method="get" class="sidebar-form" onsubmit="return false;">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="搜索菜单">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                            <div class="menuresult list-group sidebar-form hide">
                            </div>
                        </div>
                    </form> -->
                    <!-- /.search form -->

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <!--如果想始终显示子菜单,则给ul加上show-submenu类即可-->
                    <ul class="sidebar-menu">
                        <li class="header">站内导航</li>
                        <li class=" active"><a href="<?php echo url('admin/index/dashboard'); ?>" addtabs="11180" url="<?php echo url('admin/index/dashboard'); ?>" py="kzt" pinyin="kongzhitai"><i class="fa fa-dashboard"></i> <span>控制台</span> <span class="pull-right-container"> <small class="label pull-right bg-blue">hot</small></span></a> </li>
                        
                        <?php if(session('group_id')==1): ?>
                        <li class="treeview"><a href="javascript:;" addtabs="11256" url="javascript:;" py="cggl" pinyin="changguiguanli"><i class="fa fa-list"></i> <span>订单管理</span> <span class="pull-right-container"> <small class="label pull-right bg-purple"><?php echo $OrderPost; ?></small></span></a> 
                            <ul class="treeview-menu">
                                <li class=""><a href="<?php echo url('admin/order/index'); ?>" addtabs="11264" url="<?php echo url('admin/order/index'); ?>" py="qbdd" pinyin="quanbudingdan"><i class="fa fa-list"></i> <span>全部订单</span> <span class="pull-right-container"> </span></a> </li>

                                <li class=""><a href="<?php echo url('admin/order/index',['status'=>1]); ?>" addtabs="11266" url="<?php echo url('admin/order/index',['status'=>1]); ?>" py="dfh" pinyin="daifahuo"><i class="fa fa-list"></i> <span>待发货</span> <span class="pull-right-container"> </span></a> </li>

                                <li class=""><a href="<?php echo url('admin/order/index',['status'=>2]); ?>" addtabs="11267" url="<?php echo url('admin/order/index',['status'=>2]); ?>" py="dsh" pinyin="daishouhuo"><i class="fa fa-list"></i> <span>待收货</span> <span class="pull-right-container"> </span></a> </li>

                                <li class=""><a href="<?php echo url('admin/order/index',['status'=>99]); ?>" addtabs="11268" url="<?php echo url('admin/order/index',['status'=>99]); ?>" py="ywc" pinyin="yiwancheng"><i class="fa fa-list"></i> <span>已完成</span> <span class="pull-right-container"> </span></a> </li>
                            </ul>
                        </li>                       

                        <li class=" treeview"><a href="javascript:;" addtabs="11218" url="javascript:;" py="spgl" pinyin="shangpinguanli"><i class="fa fa-shopping-cart"></i> <span>商品管理</span> <span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a> 
                            <ul class="treeview-menu">
                                <li class=""><a href="<?php echo url('admin/goods/category'); ?>" addtabs="11219" url="<?php echo url('admin/goods/category'); ?>" py="spfl" pinyin="shangpinfenlei"><i class="fa fa-briefcase"></i> <span>商品分类</span> <span class="pull-right-container"> </span></a> </li>

                                <li class=""><a href="<?php echo url('admin/goods/index'); ?>" addtabs="11226" url="<?php echo url('admin/goods/index'); ?>" py="splb" pinyin="shangpinliebiao"><i class="fa fa-list"></i> <span>商品列表</span> <span class="pull-right-container"> </span></a> </li>

                                <!--<li class=""><a href="<?php echo url('admin/goods/spec'); ?>" addtabs="11227" url="<?php echo url('admin/goods/spec'); ?>" py="spgg" pinyin="shangpinguige"><i class="fa fa-cubes"></i> <span>商品规格</span> <span class="pull-right-container"> </span></a> </li>-->

                                <!--<li class=""><a href="<?php echo url('admin/goods/attribute'); ?>" addtabs="11228" url="<?php echo url('admin/goods/attribute'); ?>" py="splx" pinyin="shangpinleixing"><i class="fa fa-film"></i> <span>商品类型</span> <span class="pull-right-container"> </span></a> </li>                                -->
                                
                            </ul>
                        </li>

                        <li class="treeview"><a href="javascript:;" addtabs="11280" url="javascript:;" py="dygl" pinyin="dayinguanli"><i class="fa fa-print"></i> <span>打印管理</span><span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a>

                            <ul class="treeview-menu">
                                <li class=""><a href="<?php echo url('admin/task/goods'); ?>" addtabs="11264" url="<?php echo url('admin/task/goods'); ?>" py="tjdy" pinyin="tianjiadayin"><i class="fa fa-plus"></i> <span>添加打印</span> <span class="pull-right-container"> </span></a> </li>
                                <li class=""><a href="<?php echo url('admin/task/index'); ?>" addtabs="11265" url="<?php echo url('admin/task/index'); ?>" py="dyjl" pinyin="dayinjilu"><i class="fa fa-list"></i> <span>打印记录</span> <span class="pull-right-container"> </span></a> </li>                                
                            </ul>                         
                        </li>                        

                        <li class=" treeview"><a href="javascript:;" addtabs="1" url="javascript:;" py="nrgl" pinyin="neirongguanli"><i class="fa fa-pencil-square-o"></i> <span>内容管理</span> <span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a> 
                            <ul class="treeview-menu">
                                <li class=""><a href="<?php echo url('admin/content/category'); ?>" addtabs="2" url="<?php echo url('admin/content/category'); ?>" py="nrfl" pinyin="neirongfenlei"><i class="fa fa-briefcase"></i> <span>内容分类</span> <span class="pull-right-container"> </span></a> </li>

                                <li class=""><a href="<?php echo url('admin/content/index'); ?>" addtabs="3" url="<?php echo url('admin/content/index'); ?>" py="nrlb" pinyin="neirongliebiao"><i class="fa fa-list"></i> <span>内容列表</span> <span class="pull-right-container"> </span></a> </li>
                                
                            </ul>
                        </li>                        

                        <li class=" treeview"><a href="javascript:;" addtabs="11192" url="javascript:;" py="hygl" pinyin="huiyuanguanli"><i class="fa fa-user"></i> <span>会员管理</span> <span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a> 
                            <ul class="treeview-menu">
                                <li class=""><a href="<?php echo url('admin/user/index'); ?>" addtabs="11193" url="<?php echo url('admin/user/index'); ?>" py="hylb" pinyin="huiyuanliebiao"><i class="fa fa-list"></i> <span>会员列表</span> <span class="pull-right-container"> </span></a> </li>

                            </ul>
                        </li>

                        <li class="treeview"><a href="javascript:;" addtabs="4" url="javascript:;" py="glygl" pinyin="guanliyuanguanli"><i class="fa fa-user"></i> <span>管理员管理</span><span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a> 
                            <ul class="treeview-menu">
                                <li class=""><a href="<?php echo url('admin/admin/index'); ?>" addtabs="5" url="<?php echo url('admin/admin/index'); ?>" py="glylb" pinyin="yonghuliebiao"><i class="fa fa-list"></i> <span>管理员列表</span> <span class="pull-right-container"> </span></a> </li>
                                <li class=""><a href="<?php echo url('admin/group/index'); ?>" addtabs="6" url="<?php echo url('admin/group/index'); ?>" py="glyfz" pinyin="yonghuzu"><i class="fa fa-group"></i> <span>管理员分组</span> <span class="pull-right-container"> </span></a> </li>
                            </ul>
                        </li>

                        <li class=" treeview"><a href="javascript:;" addtabs="11325" url="javascript:;" py="gnsz" pinyin="gongnengshezhi"><i class="fa fa-wrench"></i> <span>功能设置</span> <span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a> 
                            <ul class="treeview-menu">

                                <li class=""><a href="<?php echo url('admin/config/index'); ?>" addtabs="11326" url="<?php echo url('admin/config/index'); ?>" py="xtsz" pinyin="xitongshezhi"><i class="fa fa-cog"></i> <span>系统设置</span> <span class="pull-right-container"> </span></a></li>

                                <li class=""><a href="<?php echo url('admin/position/index'); ?>" addtabs="11327" url="<?php echo url('admin/position/index'); ?>" py="xtsz" pinyin="xitongshezhi"><i class="fa fa-cog"></i> <span>广告位设置</span> <span class="pull-right-container"> </span></a></li>
                                
                            </ul>
                        </li>
                        <?php endif; if(session('group_id')==2): ?>
                        <li class="treeview"><a href="javascript:;" addtabs="11280" url="javascript:;" py="dygl" pinyin="dayinguanli"><i class="fa fa-print"></i> <span>打印管理</span><span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a>

                            <ul class="treeview-menu">
                                <li class=""><a href="<?php echo url('admin/task/goods'); ?>" addtabs="11264" url="<?php echo url('admin/task/goods'); ?>" py="tjdy" pinyin="tianjiadayin"><i class="fa fa-plus"></i> <span>添加打印</span> <span class="pull-right-container"> </span></a> </li>
                                <li class=""><a href="<?php echo url('admin/task/index'); ?>" addtabs="11265" url="<?php echo url('admin/task/index'); ?>" py="dyjl" pinyin="dayinjilu"><i class="fa fa-list"></i> <span>打印记录</span> <span class="pull-right-container"> </span></a> </li>                                
                            </ul>                         
                        </li>                          
                        <?php endif; ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!--侧边导航结束-->
            
            <!--内容容器-->
            <div class="content-wrapper tab-content tab-addtabs"></div>
            <!--内容容器结束-->
            
            <!--侧边控制菜单-->
                        <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
            <style>
                .skin-list li{
                    float:left; width: 33.33333%; padding: 5px;
                }
                .skin-list li a{
                    display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4);
                }
            </style>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane active" id="control-sidebar-setting-tab">
                        <h4 class="control-sidebar-heading">布局设定</h4>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-layout="fixed" class="pull-right"> 固定布局</label><p>盒子模型和固定布局不能同时启作用</p></div>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-layout="layout-boxed" class="pull-right"> 盒子布局</label><p>盒子布局最大宽度将被限定为1250px</p></div>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-layout="sidebar-collapse" class="pull-right"> 切换菜单栏</label><p>切换菜单栏的展示或收起</p></div>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-enable="expandOnHover" class="pull-right"> 菜单栏自动展开</label><p>鼠标移到菜单栏自动展开</p></div>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-menu="show-submenu" class="pull-right"> 显示菜单栏子菜单</label><p>菜单栏子菜单将始终显示</p></div>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-menu="disable-top-badge" class="pull-right"> 禁用顶部彩色小角标</label><p>左边菜单栏的彩色小角标不受影响</p></div>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-controlsidebar="control-sidebar-open" class="pull-right"> 切换右侧操作栏</label><p>切换右侧操作栏覆盖或独占</p></div>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-sidebarskin="toggle" class="pull-right"> 切换右侧操作栏背景</label><p>将右侧操作栏背景亮色或深色切换</p></div>
                        <h4 class="control-sidebar-heading">皮肤</h4>
                        <ul class="list-unstyled clearfix skin-list">
                            <li><a href="javascript:;" data-skin="skin-blue" style="" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9;"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div></a><p class="text-center no-margin">Blue</p></li>
                            <li><a href="javascript:;" data-skin="skin-black" class="clearfix full-opacity-hover"><div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe;"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div></a><p class="text-center no-margin">Black</p></li>
                            <li><a href="javascript:;" data-skin="skin-purple" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div></a><p class="text-center no-margin">Purple</p></li>
                            <li><a href="javascript:;" data-skin="skin-green" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div></a><p class="text-center no-margin">Green</p></li>
                            <li><a href="javascript:;" data-skin="skin-red" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div></a><p class="text-center no-margin">Red</p></li>
                            <li><a href="javascript:;" data-skin="skin-yellow" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div></a><p class="text-center no-margin">Yellow</p></li>
                            <li><a href="javascript:;" data-skin="skin-blue-light" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9;"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Blue Light</p></li>
                            <li><a href="javascript:;" data-skin="skin-black-light" class="clearfix full-opacity-hover"><div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe;"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Black Light</p></li>
                            <li><a href="javascript:;" data-skin="skin-purple-light" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Purple Light</p></li>
                            <li><a href="javascript:;" data-skin="skin-green-light" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Green Light</p></li>
                            <li><a href="javascript:;" data-skin="skin-red-light" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Red Light</p></li>
                            <li><a href="javascript:;" data-skin="skin-yellow-light" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div></a><p class="text-center no-margin" style="font-size: 12px;">Yellow Light</p></li>
                        </ul>
                    </div>
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!--侧边控制结束-->

        </div>

    <script type="text/javascript">
    var debug="<?php echo $app_debug; ?>";
    var version="<?php echo VERSION; ?>";
    var root="__STATIC__";
    var jsname="backend/index";
    var controllername="index"
    var actionname="index";
</script>        
<script src="__STATIC__/assets/js/config.js?v=<?php echo VERSION; ?>"></script>
<script src="__STATIC__/assets/js/require.min.js?v=<?php echo VERSION; ?>" data-main="__STATIC__/assets/js/require-backend.min.js?v=<?php echo VERSION; ?>"></script>
    </body>
</html>