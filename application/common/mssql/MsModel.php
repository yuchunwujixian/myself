<?php
namespace app\common\mssql;

use app\common\model\OrderGoods;
use app\common\service\Goods;
use app\common\service\GoodsCategory;
use app\common\service\Order;
use app\common\service\User;
use think\Db;
use app\common\mssql;

class MsModel
{
//	public function __construct($table){
//        $GoodsCategoryModel= new Base($table);
//		$this->model=$GoodsCategoryModel->model;
//	}

    /*
    * 同步分类
    */
    public function categorySync($table){
        $res = array('code' => 0, 'msg' => '操作失败');
        $GoodsCategory = new GoodsCategory();//本地
        $model = new Base($table);
        $data = $model->model->select();
        $su = 0;
        $err = 0;
        foreach ($data as $v){
            $map = array(
                'foreign_key' => $v['id']
            );
            $info = $GoodsCategory->find($map);
            $addmap = array();
            $where = array();
            if ($info){
                if ($info['uptime'] != $v['modifytime']){//更新
                    $addmap = array(
                        'category_name' => $v['name'],
                        'pid' => $v['parentgoodsclassid']?:0,
                        'description' => $v['remark'],
//                        'image' => $this->getDefaultImg(),//默认图片
                        'status' => 'hidden',
                        'uptime' => $v['modifytime'],
                    );
                    if ($v['isavailable'] == 1){
                        $addmap['status'] = 'normal';
                    }
                    $where['category_id'] = $info['category_id'];
                }
            }else{//添加
                $addmap = array(
                    'category_name' => $v['name'],
                    'pid' => $v['parentgoodsclassid']?:0,
                    'description' => $v['remark'],
                    'image' => $this->getDefaultImg(),//默认图片
                    'status' => 'hidden',
                    'foreign_key' => $v['id'],
                    'uptime' => $v['modifytime'],
                );
                if ($v['isavailable'] == 1){
                    $addmap['status'] = 'normal';
                }
            }
            if ($addmap){
                $re = $GoodsCategory->save($where, $addmap);
                if ($re){
                    $su ++;
                    continue;
                }else{
                    $err ++;
                }
            }
        }
        $res['code'] = 1;
        $res['msg'] = '成功操作：'.$su.'条数据，失败操作：'.$err.'条数据';
        return $res;
    }

  /*
    * 同步商品
    */
    public function goodsSync($table){
        $res = array('code' => 0, 'msg' => '操作失败');
        $Goods = new Goods();//本地
        $GoodsCategory = new GoodsCategory();//本地
        $model = new Base($table);
        $data = $model->model->select();
        $price = new Base('sz_goodsprice');
        $su = 0;
        $err = 0;
        foreach ($data as $v){
//            if ($v['id']+0 != 8){
//                continue;
//            }
            $map = array(
                'foreign_key' => $v['id']
            );
            $info = $Goods->find($map);
            $pinfo = $price->model->where(array('goodsid' => $v['id'], 'pricesystemid' => '01'))->find();
            $addmap = array();
            $cinfo = $GoodsCategory->find(array('foreign_key'=>$v['goodsclassid']));//本地类别对应信息
            if ($info){
                if ($info['uptime'] != $v['modifytime']){//更新
                    $addmap = array(
                        'goods_name' => $v['name'],
                        'category_id' => $cinfo?$cinfo['category_id']:0,
                        'price' => $pinfo&&$pinfo['price']?$pinfo['price']:0,
                        'stock' => 99999999,//库存 默认最大
                        'description' => $v['remark'],
//                        'image' => $this->getDefaultImg(),//默认图片
                        'status' => 'hidden',
                        'uptime' => $v['modifytime'],
                        'update_time' => strtotime($v['modifytime']),
                        'taxrate' => $v['taxrate'],
                        'foreign_key' => $v['id'],
                        'isdiscount' => $v['isdiscount'],
                        'goods_id' => $info['goods_id'],
                    );
                    if ($v['isavailable'] == 1){
                        $addmap['status'] = 'normal';
                    }
                }
            }else{//添加
                $addmap = array(
                    'goods_name' => $v['name'],
                    'category_id' => $cinfo?$cinfo['category_id']:0,
                    'price' => $pinfo&&$pinfo['price']?$pinfo['price']:0,
                    'stock' => 99999999,//库存 默认最大
                    'description' => $v['remark'],
                    'picture' => $this->getDefaultImg(),//默认图片
                    'images' => $this->getDefaultImg(),//默认图片
                    'status' => 'hidden',
                    'uptime' => $v['modifytime'],
                    'update_time' => strtotime($v['modifytime']),
                    'create_time' => strtotime($v['buildtime']),
                    'taxrate' => $v['taxrate'],
                    'foreign_key' => $v['id'],
                    'isdiscount' => $v['isdiscount'],
                );
                if ($v['isavailable'] == 1){
                    $addmap['status'] = 'normal';
                }
            }
            if ($addmap){
                $re = $Goods->model->saveAll([$addmap]);
                if ($re){
                    $su ++;
                    continue;
                }else{
                    $err ++;
                }
            }
        }
        $res['code'] = 1;
        $res['msg'] = '成功操作：'.$su.'条数据，失败操作：'.$err.'条数据';
        return $res;
    }

    /*
    * 同步用户
    */
    public function userSync($table){
        $res = array('code' => 0, 'msg' => '操作失败');
        $User = new User();//本地
        $model = new Base($table);
        $data = $model->model->select();
        $su = 0;
        $err = 0;
        foreach ($data as $v){
//            if ($v['id']+0 != 8){
//                continue;
//            }
            $map = array(
                'foreign_key' => $v['id']
            );
            $info = $User->find($map);
            $addmap = array();
            if ($info){
                if ($info['uptime'] != $v['modifytime']){//更新
                    $addmap = array(
                        'user_name' => $v['name'],
                        'mobile' => $v['contactmoblie'],
                        'register_time' => strtotime($v['buildtime']),
                        'status' => 'hidden',
                        'uptime' => $v['modifytime'],
                        'foreign_key' => $v['id'],
                        'isusecustomerprice' => $v['isusecustomerprice'],
                        'pricesystemid' => $v['pricesystemid'],
                        'id' => $info['id'],
                    );
                    if ($v['isavailable'] == 1){
                        $addmap['status'] = 'normal';
                    }
                }
            }else{//添加
                $addmap = array(
                    'user_name' => $v['name'],
                    'mobile' => $v['contactmoblie'],
                    'password' => md5('zm_'.md5(123456)),//默认密码123456
                    'avatar' => $this->getDefaultImg(),//默认图片
                    'register_time' => strtotime($v['buildtime']),
                    'status' => 'hidden',
                    'uptime' => $v['modifytime'],
                    'foreign_key' => $v['id'],
                    'isusecustomerprice' => $v['isusecustomerprice'],
                    'pricesystemid' => $v['pricesystemid'],
                );
                if ($v['isavailable'] == 1){
                    $addmap['status'] = 'normal';
                }
            }
            if ($addmap){
                $re = $User->model->saveAll([$addmap]);
                if ($re){
                    $su ++;
                    continue;
                }else{
                    $err ++;
                }
            }
        }
        $res['code'] = 1;
        $res['msg'] = '成功操作：'.$su.'条数据，失败操作：'.$err.'条数据';
        return $res;
    }

    /*
    * 同步订单
    */
    public function orderSync($table){
        $res = array('code' => 0, 'msg' => '操作失败');
        $Order = new Order();//本地
        $user = new User();//本地
        $Goods = new Goods();//本地
        $ordergoods = new OrderGoods();//本地
        $msorderinfomodel = new Base('kf_outorderitem');
        $model = new Base($table);
        $data = $model->model->select();
        $su = 0;
        $err = 0;
        foreach ($data as $v){
//            if ($v['id']+0 != 2){
//                continue;
//            }
            $map = array(
                'foreign_key' => $v['id']
            );
            $info = $Order->find($map);
            $addmap = array();
            $where = array();
            if ($info){
                if ($info['uptime'] != $v['rversion']){//更新
                    //主表内容
                    $addmap = array(
                        'status' => 1,
                        'post_time' => $v['deliverytime']?strtotime($v['deliverytime']):null,
                        'uptime' => $v['rversion'],
                        'order_id' => $info['order_id'],
                    );
                    if ($v['isavailable'] == 0){
                        $addmap['status'] = -1;
                    }elseif($v['isposted'] == 1 && $v['iscompleted'] == 0){
                        $addmap['status'] = 2;
                    }elseif($v['isposted'] == 1 && $v['iscompleted'] == 1){
                        $addmap['status'] = 99;
                    }
                    $where['order_id'] = $info['order_id'];
                }
            }else{//添加
                //主表内容
                $addmap = array(
                    'order_no' => $v['showid'],
                    'price' => $msorderinfomodel->model->where('outorderdocid', $v['id'])->sum('discountsubtotal')?:0,//商品详情价格和
                    'uid' => $user->value(array('foreign_key' => $v['customerid']), 'id'),
                    'link_name' => $user->value(array('foreign_key' => $v['customerid']), 'user_name'),
                    'mobile' => $user->value(array('foreign_key' => $v['customerid']), 'mobile'),
                    'create_time' => strtotime($v['buildtime']),
                    'update_time' => strtotime($v['buildtime']),
                    'status' => 1,
                    'post_time' => $v['deliverytime']?strtotime($v['deliverytime']):null,
                    'remark' => $v['remark'],
                    'uptime' => $v['rversion'],
                    'foreign_key' => $v['id'],
                );
                if ($v['isavailable'] == 0){
                    $addmap['status'] = -1;
                }elseif($v['isposted'] == 1 && $v['iscompleted'] == 0){
                    $addmap['status'] = 2;
                }elseif($v['isposted'] == 1 && $v['iscompleted'] == 1){
                    $addmap['status'] = 99;
                }
            }
            if ($addmap){
                if ($where){
                    $re = $Order->model->save($addmap, $where);
                }else{
                    $re = db('order')->insertGetId($addmap);
                }
                if ($re){
                    if (empty($where)){
                        //从表内容
                        $cinfo = $msorderinfomodel->model->where('outorderdocid', $v['id'])->select();
                        if ($cinfo){
                            $infomap = [];
                            foreach ($cinfo as $s){
                                $infomap[] = array(
                                    'order_id' => $re,
                                    'goods_id' => $Goods->value(array('foreign_key' => $s['goodsid']), 'goods_id'),
                                    'goods_name' => $Goods->value(array('foreign_key' => $s['goodsid']), 'goods_name'),
                                    'price' => $s['price'],
                                    'discountratio' => $s['discountratio'],
                                    'num' => $s['num'],
                                    'foreign_key' => $s['serialid'],
                                    'picture' => $this->getDefaultImg(),//默认图片
                                );
                            }
                            $ordergoods->saveAll($infomap);
                        }
                    }
                    $su ++;
                    continue;
                }else{
                    $err ++;
                }
            }
        }
        $res['code'] = 1;
        $res['msg'] = '成功操作：'.$su.'条数据，失败操作：'.$err.'条数据';
        return $res;
    }


    /*
    * 获取默认图片
    */
    public function getDefaultImg(){
        return '/uploads/default.png';
    }
}