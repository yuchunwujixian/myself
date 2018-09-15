<?php if (!defined('THINK_PATH')) exit(); /*a:8:{s:63:"F:\www\lisan\public/../application/admin\view\config\index.html";i:1525182246;s:62:"F:\www\lisan\public/../application/admin\view\public\head.html";i:1525182246;s:63:"F:\www\lisan\public/../application/admin\view\config\basic.html";i:1525182246;s:62:"F:\www\lisan\public/../application/admin\view\config\shop.html";i:1525182246;s:61:"F:\www\lisan\public/../application/admin\view\config\sms.html";i:1525182246;s:61:"F:\www\lisan\public/../application/admin\view\config\app.html";i:1525182246;s:64:"F:\www\lisan\public/../application/admin\view\config\alipay.html";i:1525182246;s:68:"F:\www\lisan\public/../application/admin\view\public\javascript.html";i:1525182246;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
        <head>
        <meta charset="utf-8">
        <title>系统设置</title>
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
                                    <li><a href="javascript:;" data-url="general">常规管理</a></li>
                                    <li><a href="javascript:;" data-url="general/config">系统配置</a></li>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <div class="content">
                                <style type="text/css">
                                    @media (max-width: 375px) {
                                        .edit-form tr td input{width:100%;}
                                        .edit-form tr th:first-child,.edit-form tr td:first-child{
                                            width:20%;
                                        }
                                        .edit-form tr th:last-child,.edit-form tr td:last-child{
                                            display: none;
                                        }
                                    }
                                </style>
                                <div class="panel panel-default panel-intro">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">

<!--                                             <li><a href="#basic" data-toggle="tab">基础配置</a></li>

                                            <li class=""><a href="#shop" data-toggle="tab">商城配置</a></li> -->

                                            <li class="active"><a href="#sms" data-toggle="tab">短信配置</a></li>

                                            <li class=""><a href="#app" data-toggle="tab">APP配置</a></li>
<!-- 
                                            <li class=""><a href="#wxpay" data-toggle="tab">微信支付</a></li>

                                            <li class=""><a href="#alipay" data-toggle="tab">支付宝支付</a></li> -->

                                        </ul>
                                    </div>

                                    <div class="panel-body">
                                        <div id="myTabContent" class="tab-content">
                                        
                                        <div class="tab-pane fade" id="basic">
    <div class="widget-body no-padding">
        <form id="basic-form" class="edit-form form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('admin/config/index'); ?>">
            <input type="hidden" name="key" value="base"/>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="15%">
                            变量标题
                        </th>
                        <th width="70%">
                            变量值
                        </th>
                        <th width="15%">
                            调用方法
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            站点名称
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[title]" value="<?php echo $config['base']['title']; ?>" class="form-control" data-rule="required" data-tip="请填写站点名称"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.base.title}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            关键词
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[keywords]" value="<?php echo $config['base']['keywords']; ?>" class="form-control" data-rule="required" data-tip="请填写站点关键词"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.base.keywords}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            站点描述
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[description]"  value="<?php echo $config['base']['description']; ?>" class="form-control" data-rule="required" data-tip="请填写站点描述"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.base.description}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success btn-embossed">
                                确定
                            </button>
                            <button type="reset" class="btn btn-default btn-embossed">
                                重置
                            </button>
                        </td>
                        <td>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>


                                        <div class="tab-pane fade " id="shop">
    <div class="widget-body no-padding">
        <form id="shop-form" class="edit-form form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('admin/config/index'); ?>">
            <input type="hidden" name="key" value="shop"/>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="15%">
                            变量标题
                        </th>
                        <th width="70%">
                            变量值
                        </th>
                        <th width="15%">
                            调用方法
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            一级返还比例
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[return1]" value="<?php echo $config['shop']['return1']; ?>" class="form-control" data-rule="" data-tip="填写一级推广员获得返还比例（%）"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.shop.return1}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            二级返还比例
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[return2]" value="<?php echo $config['shop']['return2']; ?>" class="form-control" data-rule="" data-tip="填写二级推广员获得返还比例（%）"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.shop.return2}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            三级返还比例
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[return3]" value="<?php echo $config['shop']['return3']; ?>" class="form-control" data-rule="" data-tip="填写三级推广员获得返还比例（%）"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.shop.return3}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            配送方式
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <dl class="fieldlist" rel="4" data-name="row[postType]">
                                        <dd>
                                            <ins>
                                                键名
                                            </ins>
                                            <ins>
                                                键值
                                            </ins>
                                        </dd>
                                        <?php if($config['shop']['postType']): if(is_array($config['shop']['postType']['field']) || $config['shop']['postType']['field'] instanceof \think\Collection || $config['shop']['postType']['field'] instanceof \think\Paginator): $i = 0; $__LIST__ = $config['shop']['postType']['field'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                        <dd class="form-inline">
                                            <input type="text" name="row[postType][field][]" class="form-control" value="<?php echo $val; ?>" size="10"/>
                                            <input type="text" name="row[postType][value][]" class="form-control" value="<?php echo $config['shop']['postType']['value'][$key]; ?>" size="40"/>
                                            <span class="btn btn-sm btn-danger btn-remove">
                                                <i class="fa fa-times">
                                                </i>
                                            </span>
                                            <span class="btn btn-sm btn-primary btn-dragsort">
                                                <i class="fa fa-arrows">
                                                </i>
                                            </span>
                                        </dd>
                                        <?php endforeach; endif; else: echo "" ;endif; else: ?>
                                        <dd class="form-inline">
                                            <input type="text" name="row[postType][field][]" class="form-control" value="" size="10"/>
                                            <input type="text" name="row[postType][value][]" class="form-control" value="" size="40"/>
                                            <span class="btn btn-sm btn-danger btn-remove">
                                                <i class="fa fa-times">
                                                </i>
                                            </span>
                                            <span class="btn btn-sm btn-primary btn-dragsort">
                                                <i class="fa fa-arrows">
                                                </i>
                                            </span>
                                        </dd>
                                        <?php endif; ?>
                                        <dd>
                                            <a href="javascript:;" class="append btn btn-sm btn-success">
                                                <i class="fa fa-plus">
                                                </i>
                                                追加
                                            </a>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.shop.postType}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success btn-embossed">
                                确定
                            </button>
                            <button type="reset" class="btn btn-default btn-embossed">
                                重置
                            </button>
                        </td>
                        <td>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>


                                        <div class="tab-pane fade  active in" id="sms">
    <div class="widget-body no-padding">
        <form id="sms-form" class="edit-form form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('admin/config/index'); ?>">
            <input type="hidden" name="key" value="sms"/>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="15%">
                            变量标题
                        </th>
                        <th width="70%">
                            变量值
                        </th>
                        <th width="15%">
                            变量名
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Access Key ID
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="password" name="row[access_key_id]" value="<?php echo $config['sms']['access_key_id']; ?>" class="form-control" data-rule="" data-tip="请填写阿里云Access Key ID"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.sms.access_key_id}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Access Key Secret
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="password" name="row[access_key_secret]" value="<?php echo $config['sms']['access_key_secret']; ?>" class="form-control" data-tip="请填写阿里云Access Key Secret"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.sms.access_key_secret}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            注册验证码模板CODE
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[register_code]" value="<?php echo $config['sms']['register_code']; ?>" class="form-control" data-tip="请填写阿里云短信注册验证码模板CODE" placeholder="模板变量${code}"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.sms.register_code}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            找回密码验证码模板CODE
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[find_code]" value="<?php echo $config['sms']['find_code']; ?>" class="form-control" data-tip="请填写阿里云短信找回密码验证码模板CODE" placeholder="模板变量${code}"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.sms.find_code}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            短信测试模板CODE
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[test_code]" value="<?php echo $config['sms']['test_code']; ?>" class="form-control" data-tip="请填写阿里云短信注册验证码模板CODE" placeholder="模板变量${customer}"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.sms.test_code}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            短信签名
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[sign]" value="<?php echo $config['sms']['sign']; ?>" class="form-control" data-tip="请填写阿里云短信审核通过的签名"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.sms.sign}
                        </td>
                    </tr>                    

                    <tr>
                        <td>
                            管理员手机号
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[admin_mobile]" value="<?php echo $config['sms']['admin_mobile']; ?>" class="form-control" data-rule="" data-tip=""  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.sms.admin_mobile}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success btn-embossed">
                                确定
                            </button>
                            <button type="reset" class="btn btn-default btn-embossed">
                                重置
                            </button>
                        </td>
                        <td>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>


                                        <div class="tab-pane fade " id="app">
    <div class="widget-body no-padding">
        <form id="basic-form" class="edit-form form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('admin/config/index'); ?>">
            <input type="hidden" name="key" value="app"/>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="15%">
                            变量标题
                        </th>
                        <th width="70%">
                            变量值
                        </th>
                        <th width="15%">
                            调用方法
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            最新版本
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[version]" value="<?php echo $config['app']['version']; ?>" class="form-control" data-rule="required" data-tip="请填写app最新版本号"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.app.version}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            下载地址
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[download]" value="<?php echo $config['app']['download']; ?>" class="form-control" data-rule="required" data-tip="请填写app下载地址"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.app.download}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success btn-embossed">
                                确定
                            </button>
                            <button type="reset" class="btn btn-default btn-embossed">
                                重置
                            </button>
                        </td>
                        <td>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>


                                        <div class="tab-pane fade " id="alipay">
    <div class="widget-body no-padding">
        <form id="basic-form" class="edit-form form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('admin/config/index'); ?>">
            <input type="hidden" name="key" value="alipay"/>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="15%">
                            变量标题
                        </th>
                        <th width="70%">
                            变量值
                        </th>
                        <th width="15%">
                            调用方法
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            支付宝账号
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[user]" value="<?php echo $config['alipay']['user']; ?>" class="form-control" data-tip="请填写支付宝账号，通常为邮箱地址"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.alipay.email}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            合作者身份ID
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" name="row[appid]" value="<?php echo $config['alipay']['appid']; ?>" class="form-control" data-tip="应用APPID"  />
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.alipay.appid}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            私钥内容
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <textarea name="row[privatekey]" class="form-control" data-rule="" rows="5" data-tip="生成密钥时获取的私钥字符串，直接使用pem文件的完整字符串" ><?php echo $config['alipay']['privatekey']; ?></textarea>
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </td>
                        <td>
                            {$config.alipay.privatekey}
                        </td>
                    </tr>                    
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success btn-embossed">
                                确定
                            </button>
                            <button type="reset" class="btn btn-default btn-embossed">
                                重置
                            </button>
                        </td>
                        <td>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
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
    var debug="<?php echo $app_debug; ?>";
    var version="<?php echo VERSION; ?>";
    var root="__STATIC__";
    var jsname="backend/config/index";
    var controllername="config"
    var actionname="index";
</script>        
<script src="__STATIC__/assets/js/config.js?v=<?php echo VERSION; ?>"></script>
<script src="__STATIC__/assets/js/require.min.js?v=<?php echo VERSION; ?>" data-main="__STATIC__/assets/js/require-backend.min.js?v=<?php echo VERSION; ?>"></script>
    </body>
</html>