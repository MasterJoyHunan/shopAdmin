<?php

namespace app\shop\controller;

use app\common\model\{
    Cate, Product, RecommendContent
};
use think\Controller;

class Shop extends Controller
{
    /**
     * 所有热卖商品信息
     */
    public function index()
    {
        $arr['product'] = Product::where(['status' => 1, 'is_hot' => 1])->select();
        $arr['ad'] = RecommendContent::where('pid', 2)->select();
        return json(msg(1, $arr));
    }

    /**
     * 商品详情
     */
    public function getProductDetail()
    {
        $data = $this->request->param('id');
        if (intval($data) == 0) {
            return json(msg(0, '', '非法数据'));
        }
        $where['id'] = $data;
        $where['status'] = 1;
        $res = Product::where($where)->with(['sku' => ['sku1', 'sku2']])->find();
        return $res ? json(msg(1, $res)) : json(msg(0, '', '商品不存在或者被下架'));
    }


    /**
     * 所有分类下的商品
     * @return \think\response\Json
     */
    public function getAllProduct()
    {
        $where['status'] = 1;
        $data = intval($this->request->param('cate_id'));
        if (!empty($data)) {
            $where['cate_id'] = $data;
        }
        $pro = Product::where($where)->order('sort desc')->paginate(10);
        return json(msg(1, $pro));
    }


    /**
     * 获取所有分类
     * @return \think\response\Json
     */
    public function getAllCate()
    {
        $where['status'] = 1;
        $cate = Cate::where($where)->order('sort desc')->select();
        return json(msg(1, $cate));
    }

}