<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"F:\www\lisan\public/../application/admin\view\user\add.html";i:1525182246;s:62:"F:\www\lisan\public/../application/admin\view\public\head.html";i:1525182246;s:68:"F:\www\lisan\public/../application/admin\view\public\javascript.html";i:1525182246;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
        <head>
        <meta charset="utf-8">
        <title>添加会员</title>
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
                                <form id="edit-form" class="form-horizontal form-ajax" role="form" data-toggle="validator" method="POST" action="<?php echo url('admin/user/add'); ?>">

                                    <div class="form-group">
                                        <label for="username" class="control-label col-xs-12 col-sm-2">用户名:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="text" class="form-control" id="username" name="row[user_name]" data-rule="required;username" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-avatar" class="control-label col-xs-12 col-sm-2">用户头像:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <div class="form-inline">
                                                <input id="c-avatar" class="form-control" size="50" name="row[avatar]" value="__STATIC__/assets/img/avatar.png" type="text" value="">

                                                <span><button type="button" id="plupload-avatar" class="btn btn-danger plupload" data-multiple="false" data-input-id="c-avatar" data-preview-id="p-avatar"><i class="fa fa-upload"></i> 上传</button></span>

<!--                                                 <span><button type="button" id="fachoose-image" class="btn btn-primary fachoose" data-multiple="false" data-input-id="c-image"><i class="fa fa-list-ul"></i> 选择</button></span> -->
                                                
                                                <ul class="row list-inline plupload-preview" id="p-avatar"></ul>
                                            </div>
                                        </div>
                                    </div>                                    

                                    <div class="form-group">
                                        <label for="mobile" class="control-label col-xs-12 col-sm-2">手机号码:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="text" class="form-control" id="mobile" name="row[mobile]" data-rule="required;mobile" />
                                        </div>
                                    </div>                                    


                                    <div class="form-group">
                                        <label for="nickname" class="control-label col-xs-12 col-sm-2">昵称:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="text" class="form-control" id="nickname" name="row[nickname]" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="sex" class="control-label col-xs-12 col-sm-2">性别:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <label for="row[sex]-normal"><input id="row[sex]-normal" checked="checked" name="row[sex]" type="radio" value="1"> 男</label> 
                                            <label for="row[sex]-hidden"><input id="row[sex]-hidden" name="row[sex]" type="radio" value="2"> 女</label>
                                             <label for="row[sex]-hidden"><input id="row[sex]-hidden" name="row[sex]" type="radio" value="0"> 保密</label>
                                        </div>
                                    </div>                                    

                                    <div class="form-group">
                                        <label for="email" class="control-label col-xs-12 col-sm-2">Email:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="email" class="form-control" id="email" name="row[email]" data-rule="required;email" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="control-label col-xs-12 col-sm-2">密码:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="password" class="form-control" id="password" name="row[password]" value="" data-rule="required;password" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="content" class="control-label col-xs-12 col-sm-2">状态:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <label for="row[status]-normal"><input id="row[status]-normal" checked="checked" name="row[status]" type="radio" value="normal"> 正常</label> 
                                            <label for="row[status]-hidden"><input id="row[status]-hidden" name="row[status]" type="radio" value="normal"> 隐藏</label>        
                                        </div>
                                    </div>

                                    <div class="form-group hidden layer-footer">
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
    var jsname="backend/auth/user";
    var controllername="user"
    var actionname="add";
</script>        
<script src="__STATIC__/assets/js/config.js?v=<?php echo VERSION; ?>"></script>
<script src="__STATIC__/assets/js/require.min.js?v=<?php echo VERSION; ?>" data-main="__STATIC__/assets/js/require-backend.min.js?v=<?php echo VERSION; ?>"></script>
    </body>
</html>