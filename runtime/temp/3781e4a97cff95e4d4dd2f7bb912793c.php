<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"F:\www\lisan\public/../application/admin\view\goods\edit.html";i:1525182246;s:62:"F:\www\lisan\public/../application/admin\view\public\head.html";i:1525182246;s:68:"F:\www\lisan\public/../application/admin\view\public\javascript.html";i:1525182246;}*/ ?>
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
    <style type="text/css">
    #sku .html table.skuTable{font-size:14px;color:#333;border-width:1px;border-color:#ddd;border-collapse:collapse}
    #sku .html table.skuTable th{border-width:1px;padding:5px 10px;border-style:solid;border-color:#ddd;color:#666;background-color:#ededed}
    #sku .html table.skuTable td{border-width:1px;padding:5px 10px;border-style:solid;border-color:#ddd;background-color:#fff;color:#666;widows:auto;text-align:center}
    .SKU_LIST{display: inline;}.SKU_LIST span{margin-left: 10px}
    </style>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('admin/goods/edit'); ?>">
                                    <input name="goods_id" type="hidden" value="<?php echo $row['goods_id']; ?>" />
                                    <div class="form-group">
                                        <label for="c-pid" class="control-label col-xs-12 col-sm-2">所属分类:</label>
                                        <div class="col-xs-12 col-sm-8">

                                            <select  id="c-flag" data-rule="required" class="form-control selectpicker" name="row[category_id]">
                                                <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                                <option value="<?php echo $v['category_id']; ?>" <?php if($row['category_id']==$v['category_id']): ?>selected<?php endif; ?>><?php echo $v['category_name']; ?></option>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-goods_name" class="control-label col-xs-12 col-sm-2">商品名称:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input data-rule="required" class="form-control" name="row[goods_name]" type="text" value="<?php echo $row['goods_name']; ?>" data-rule="required">
                                        </div>
                                    </div>

<!--                                     <div class="form-group">
                                        <label for="c-price" class="control-label col-xs-12 col-sm-2">价格:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-price" class="form-control" name="row[price]" type="text" value="<?php echo $row['price']; ?>">
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <label for="c-picture" class="control-label col-xs-12 col-sm-2">商品主图:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <div class="form-inline">
                                                <input id="c-picture" class="form-control" size="50" name="row[picture]" type="text" value="<?php echo $row['picture']; ?>">

                                                <span><button type="button" id="plupload-picture" class="btn btn-danger plupload" data-multiple="false" data-input-id="c-picture" data-preview-id="p-picture"><i class="fa fa-upload"></i> 上传</button></span>

<!--                                                 <span><button type="button" id="fachoose-image" class="btn btn-primary fachoose" data-multiple="false" data-input-id="c-image"><i class="fa fa-list-ul"></i> 选择</button></span> -->
                                                
                                                <ul class="row list-inline plupload-preview" id="p-picture"></ul>
                                            </div>
                                        </div>
                                    </div>                                     

                                    <div class="form-group">
                                        <label for="c-image" class="control-label col-xs-12 col-sm-2">商品图片:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <div class="form-inline">
                                                <input id="c-image" class="form-control" size="50" name="row[images]" type="text" value="<?php echo implode(',',$row['images']); ?>">

                                                <span><button type="button" id="plupload-image" class="btn btn-danger plupload" data-multiple="true" data-input-id="c-image" data-preview-id="p-image"><i class="fa fa-upload"></i> 上传</button></span>

<!--                                                 <span><button type="button" id="fachoose-image" class="btn btn-primary fachoose" data-multiple="false" data-input-id="c-image"><i class="fa fa-list-ul"></i> 选择</button></span> -->
                                                
                                                <ul class="row list-inline plupload-preview" id="p-image"></ul>
                                            </div>
                                        </div>
                                    </div> 

                                    <?php if($attr): ?>
                                    <div class="form-group">
                                        <label for="attribute_id" class="control-label col-xs-12 col-sm-2">商品类型:</label>
                                        <div class="col-xs-12 col-sm-8">

                                            <select  id="attribute_id" data-rule="required" class="form-control selectpicker" name="row[attr_id]">
                                                <option value="0">请选择商品类型</option>
                                                <?php if(is_array($attr) || $attr instanceof \think\Collection || $attr instanceof \think\Paginator): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                                <option value="<?php echo $v['attr_id']; ?>" <?php if($row['attr_id']==$v['attr_id']): ?>selected<?php endif; ?>><?php echo $v['attr_name']; ?></option>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>

                                        </div>
                                    </div> 

                                    <div id="spec" style="display: none;">
                                        <div class="form-group">
                                            <label for="attribute_id" class="control-label col-xs-12 col-sm-2">商品规格:</label>
                                            <div class="col-xs-12 col-sm-8 html">

                                            </div>
                                        </div>
                                    </div>

                                    <div id="sku" style="display: none;">
                                        <div class="form-group">
                                            <label for="attribute_id" class="control-label col-xs-12 col-sm-2">商品库存:</label>
                                            <div class="col-xs-12 col-sm-8 html">

                                            </div>
                                        </div>
                                    </div>                                                      

                                    <?php endif; ?>     

                                    <div class="form-group">
                                        <label for="c-unit" class="control-label col-xs-12 col-sm-2">单位:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-unit" data-rule="required" class="form-control" name="row[unit]" type="text" value="<?php echo $row['unit']; ?>">
                                        </div>
                                    </div>                                                                                                           

<!--                                     <div class="form-group">
                                        <label for="c-freight" class="control-label col-xs-12 col-sm-2">运费:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-freight" data-rule="required" class="form-control" name="row[freight]" type="text" value="<?php echo $row['freight']; ?>">
                                        </div>
                                    </div> -->

<!--                                     <div class="form-group">
                                        <label for="c-stock" class="control-label col-xs-12 col-sm-2">库存:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-stock" data-rule="required" class="form-control" name="row[stock]" type="text" value="<?php echo $row['stock']; ?>">
                                        </div>
                                    </div>  --> 

                                    <div class="form-group">
                                        <label for="c-volume" class="control-label col-xs-12 col-sm-2">销量:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-volume" data-rule="required" class="form-control" name="row[volume]" type="text"  value="<?php echo $row['volume']; ?>">
                                        </div>
                                    </div>                                                                       

                                    <div class="form-group">
                                        <label for="c-keywords" class="control-label col-xs-12 col-sm-2">关键字:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-keywords" class="form-control" name="row[keywords]" type="text" value="<?php echo $row['keywords']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-introduction" class="control-label col-xs-12 col-sm-2">推荐位:</label>
                                        <div class="col-xs-12 col-sm-8">
                                        <div class="col-xs-12 col-sm-8">
                                            <label><input <?php if(in_array(1,$row['recommend'])): ?>checked="checked"<?php endif; ?> name="row[recommend][]" type="checkbox" value="1"> 特价</label> 
                                            <label><input <?php if(in_array(2,$row['recommend'])): ?>checked="checked"<?php endif; ?> name="row[recommend][]" type="checkbox" value="2"> 热销</label>
                                            <label><input <?php if(in_array(3,$row['recommend'])): ?>checked="checked"<?php endif; ?> name="row[recommend][]" type="checkbox" value="3"> 推荐</label>
                                        </div>
                                        </div>
                                    </div>                                     

                                    <div class="form-group">
                                        <label for="c-introduction" class="control-label col-xs-12 col-sm-2">促销简介:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-introduction" class="form-control" name="row[introduction]" value="<?php echo $row['introduction']; ?>" type="text">
                                        </div>
                                    </div>                                    

                                    <div class="form-group">
                                        <label for="c-description" class="control-label col-xs-12 col-sm-2">描述:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <textarea id="c-description" class="form-control summernote" name="row[description]"><?php echo $row['description']; ?></textarea>
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
                                            <label for="row[status]-normal"><input id="row[status]-normal" <?php if($row['status']=='normal'): ?>checked="checked"<?php endif; ?> name="row[status]" type="radio" value="normal"> 立即上架</label> 
                                            <label for="row[status]-hidden"><input id="row[status]-hidden" <?php if($row['status']=='hidden'): ?>checked="checked"<?php endif; ?> name="row[status]" type="radio" value="hidden"> 放入仓库</label>
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
        var attribute_url="<?php echo url('admin/goods/attributeInfo'); ?>";
        var spec=JSON.parse('<?php echo json_encode($row['spec']); ?>');
        var sku=JSON.parse('<?php echo json_encode($sku); ?>');
        </script>        
        <script type="text/javascript">
    var debug="<?php echo $app_debug; ?>";
    var version="<?php echo VERSION; ?>";
    var root="__STATIC__";
    var jsname="backend/goods/index";
    var controllername="index"
    var actionname="add";
</script>        
<script src="__STATIC__/assets/js/config.js?v=<?php echo VERSION; ?>"></script>
<script src="__STATIC__/assets/js/require.min.js?v=<?php echo VERSION; ?>" data-main="__STATIC__/assets/js/require-backend.min.js?v=<?php echo VERSION; ?>"></script>
    </body>
</html>