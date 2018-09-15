<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"F:\www\lisan\public/../application/admin\view\goods\categoryedit.html";i:1525182246;s:62:"F:\www\lisan\public/../application/admin\view\public\head.html";i:1525182246;s:68:"F:\www\lisan\public/../application/admin\view\public\javascript.html";i:1525182246;}*/ ?>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('admin/goods/categoryEdit'); ?>">

                                    <input type="hidden" name="category_id" value="<?php echo $row['category_id']; ?>" >

                                    <div class="form-group">
                                        <label for="c-pid" class="control-label col-xs-12 col-sm-2">上级栏目:</label>
                                        <div class="col-xs-12 col-sm-8">

                                            <select  id="c-flag" data-rule="required" class="form-control selectpicker" name="row[pid]">
                                                <option value="0">做为顶级栏目</option>
                                                <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                                <option value="<?php echo $v['category_id']; ?>" <?php if($row['pid']==$v['category_id']): ?>selected<?php endif; ?>>|—<?php echo str_repeat('—',$v['level']); ?><?php echo $v['category_name']; ?></option>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-name" class="control-label col-xs-12 col-sm-2">栏目名称:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-name" data-rule="required" class="form-control" name="row[category_name]" value="<?php echo $row['category_name']; ?>" type="text" value="测试2">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-image" class="control-label col-xs-12 col-sm-2">栏目图片:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <div class="form-inline">
                                                <input id="c-image" class="form-control" size="50" name="row[image]" type="text"  value="<?php echo $row['image']; ?>">
                                                <span><button type="button" id="plupload-image" class="btn btn-danger plupload" data-input-id="c-image" data-mimetype="image/*" data-multiple="false" data-preview-id="p-image"><i class="fa fa-upload"></i> 上传</button></span>
                                                <ul class="row list-inline plupload-preview" id="p-image">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-keywords" class="control-label col-xs-12 col-sm-2">关键字:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-keywords" class="form-control" name="row[keywords]" type="text"   value="<?php echo $row['keywords']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-description" class="control-label col-xs-12 col-sm-2">描述:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <textarea id="c-description" class="form-control" name="row[description]"><?php echo $row['description']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-weigh" class="control-label col-xs-12 col-sm-2">权重:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-weigh" class="form-control" name="row[weigh]" type="number" value="<?php echo $row['weigh']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-status" class="control-label col-xs-12 col-sm-2">状态:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <label for="row[status]-normal"><input id="row[status]-normal" <?php if($row['status']=='normal'): ?>checked="checked"<?php endif; ?> name="row[status]" type="radio" value="normal"> 正常</label> 
                                            <label for="row[status]-hidden"><input id="row[status]-hidden" <?php if($row['status']=='hidden'): ?>checked="checked"<?php endif; ?> name="row[status]" type="radio" value="hidden"> 隐藏</label>        
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