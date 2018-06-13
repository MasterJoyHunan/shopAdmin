<?php

namespace app\vueapi\controller;

use app\common\model\{
    Cate, Product as ProductModel
};
use think\Db;

class Product extends Base
{
    /**
     * 所有记录
     * @return \think\response\Json
     */
    public function index()
    {
        $data = $this->request->param();
        $page = $data['pageSize'] ?? 10;
        $where = [];
        if (!empty($data['title'])) {
            $where['title'] = ['like', "%{$data['title']}%"];
        }
        if (!empty($data['cate_id'])) {
            $where['cate_id'] = $data['cate_id'];
        }
        $cate = Cate::where('status', 1)->field('id, name')->column('id, name');
        $field = 'id, title, cate_id, market_price, imgs, price, sales_volume, stock, img, is_hot, status, sort, desc';
        $res = ProductModel::getMapListByWhere($where, $page, 'sku', $field, 'sort desc, id desc');
        $arr['cate'] = $cate;
        $arr['pro'] = $res;
        return json(msg(1, $arr));
    }


    public function getProdetail()
    {
        $id = intval($this->request->param('id'));
        if($id <= 0){
            return json(msg(0, '', '非法数据'));
        }
        $res = ProductModel::where('id', $id)->with('sku')->find();
        return $res ? json(msg(1, $res)) : json(msg(0));
    }

    /**
     * 添加商品
     * @return \think\response\Json
     */
    public function addPro()
    {
        if ($this->request->isGet()) {
            $cate = Cate::where('status', 1)->field('id, name')->with('sku')->select();
            return json(msg(1, $cate));
        } else {
            if (!empty($this->request->param('sku/a'))) {
                $rule = [
                    ['title', 'require|length:4,25', '请输入商品名|商品名长度在4-100个字符'],
                    ['desc', 'require|min:1', '请输入详细的描述|请输入详细的描述'],
                    ['cate_id', 'require|number|gt:0', '请选择分类|请选择分类|请选择分类'],
                    ['imgs', 'require|array|length:1,5', '请上传至少一张图片|请上传至少一张图片|只能上传1-5张图片'],
                    ['is_hot', 'require|number|in:0,1', '请选择是否热卖|请选择是否热卖|请选择是否热卖'],
                    ['status', 'require|number|in:0,1', '请选择是否上架|请选择是否上架|请选择是否上架'],
                    ['sort', 'require|number|between:0,255', '请输入排序|请输入市场价|请输入市场价'],
                ];
            } else {
                $rule = [
                    ['title', 'require|length:4,25', '请输入商品名|商品名长度在4-100个字符'],
                    ['desc', 'require|min:1', '请输入详细的描述|请输入详细的描述'],
                    ['cate_id', 'require|number|gt:0', '请选择分类|请选择分类|请选择分类'],
                    ['market_price', 'require|number|gt:0', '请输入市场价|请输入市场价|请输入市场价'],
                    ['price', 'require|number|gt:0', '请输入售价|请输入售价|请输入售价'],
                    ['stock', 'require|number|gt:0', '请输入库存|请输入库存|请输入库存'],
                    ['sales_volume', 'require|number|egt:0', '请输入出售个数|请输入出售个数|请输入出售个数'],
                    ['imgs', 'require|array|length:1,5', '请上传至少一张图片|请上传至少一张图片|只能上传1-5张图片'],
                    ['is_hot', 'require|number|in:0,1', '请输入市场价|请输入市场价|请输入市场价'],
                    ['status', 'require|number|in:0,1', '请输入市场价|请输入市场价|请输入市场价'],
                    ['sort', 'require|number|between:0,255', '请输入排序|请输入市场价|请输入市场价'],
                ];
            }

            $data = $this->checkParam($rule);
            $pro_model = new ProductModel();
            $data['img'] = $data['imgs'][0];
            $data['imgs'] = implode('|', $data['imgs']);
            // 详情描述字段不过滤html
            $data['desc'] = $this->request->param('desc', '', null);
            Db::startTrans();
            $flag = $pro_model->allowField(['title', 'desc', 'cate_id', 'market_price', 'price',
                'stock', 'sales_volume', 'img', 'imgs', 'is_hot', 'status', 'sort'])->save($data);
            $flag2 = true;
            $flag3 = true;
            if ($data['sku']) {
                foreach ($data['sku'] as $v) {
                    $res = $this->validate($v, [
                        ['name', 'require', '请填写商品的名字'],
                        ['stock', 'require|number|gt:0', '请输入子属性库存|请输入子属性库存|请输入子属性库存'],
                        ['market_price', 'require|number|gt:0', '请输入子属性市场价|请输入子属性市场价|请输入子属性市场价'],
                        ['price', 'require|number|gt:0', '请输入子属性售价|请输入子属性售价|请输入子属性售价'],
                        ['sales_volume', 'require|number|egt:0', '请输入子属性出售个数|请输入子属性出售个数|请输入子属性出售个数'],
                        ['img', 'require', '请上传子属性图片'],
                    ]);
                    if ($res !== true) {
                        return json(msg(0, '', $res));
                    }
                    if (!empty($v['sku_id_1']) && intval($v['sku_id_1']) == 0) {
                        return json(msg(0, '', '请选择SKU'));
                    }
                    if (!empty($v['sku_id_2']) && intval($v['sku_id_2']) == 0) {
                        return json(msg(0, '', '请选择SKU'));
                    }
                }
                $pro_model->market_price = min(array_column($data['sku'], 'market_price'));
                $pro_model->price = min(array_column($data['sku'], 'price'));
                $pro_model->stock = array_sum(array_column($data['sku'], 'stock'));
                $pro_model->sales_volume = array_sum(array_column($data['sku'], 'sales_volume'));
                $flag3 = $pro_model->save();
                $flag2 = $pro_model->sku()->saveAll($data['sku']);
            }
            if ($flag && $flag2 && $flag3) {
                Db::commit();
                return json(msg(1, '', '添加商品成功'));
            }
            Db::rollback();
            return json(msg(0, '', '添加商品失败'));
        }
    }

    /**
     * 修改商品
     * @return \think\response\Json
     */
    public function editPro()
    {
        if (!empty($this->request->param('sku/a'))) {
            $rule = [
                ['id', 'require|number|egt:1', '请输入商品ID|请输入商品ID|请输入商品ID'],
                ['title', 'require|length:4,25', '请输入商品名|商品名长度在4-100个字符'],
                ['desc', 'require|min:1', '请输入详细的描述|请输入详细的描述'],
                ['cate_id', 'require|number|gt:0', '请选择分类|请选择分类|请选择分类'],
                ['imgs', 'require|array|length:1,5', '请上传至少一张图片|请上传至少一张图片|只能上传1-5张图片'],
                ['is_hot', 'require|number|in:0,1', '请选择是否热卖|请选择是否热卖|请选择是否热卖'],
                ['status', 'require|number|in:0,1', '请选择是否上架|请选择是否上架|请选择是否上架'],
                ['sort', 'require|number|between:0,255', '请输入排序|请输入市场价|请输入市场价'],
            ];
        } else {
            $rule = [
                ['id', 'require|number|egt:1', '请输入商品ID|请输入商品ID|请输入商品ID'],
                ['title', 'require|length:4,25', '请输入商品名|商品名长度在4-100个字符'],
                ['desc', 'require|min:1', '请输入详细的描述|请输入详细的描述'],
                ['cate_id', 'require|number|gt:0', '请选择分类|请选择分类|请选择分类'],
                ['market_price', 'require|number|gt:0', '请输入市场价|请输入市场价|请输入市场价'],
                ['price', 'require|number|gt:0', '请输入售价|请输入售价|请输入售价'],
                ['stock', 'require|number|gt:0', '请输入库存|请输入库存|请输入库存'],
                ['sales_volume', 'require|number|egt:0', '请输入出售个数|请输入出售个数|请输入出售个数'],
                ['imgs', 'require|array|length:1,5', '请上传至少一张图片|请上传至少一张图片|只能上传1-5张图片'],
                ['is_hot', 'require|number|in:0,1', '请输入市场价|请输入市场价|请输入市场价'],
                ['status', 'require|number|in:0,1', '请输入市场价|请输入市场价|请输入市场价'],
                ['sort', 'require|number|between:0,255', '请输入排序|请输入市场价|请输入市场价'],
            ];
        }

        $data = $this->checkParam($rule);
        $pro_model = ProductModel::where('id', $data['id'])->find();
        $data['img'] = $data['imgs'][0];
        $data['imgs'] = implode('|', $data['imgs']);
        // 详情描述字段不过滤html
        $data['desc'] = $this->request->param('desc', '', null);
        Db::startTrans();
        $flag = $pro_model->allowField(['title', 'desc', 'cate_id', 'market_price', 'price',
            'stock', 'sales_volume', 'img', 'imgs', 'is_hot', 'status', 'sort'])->save($data);
        if ($data['sku']) {
            foreach ($data['sku'] as $v) {
                $res = $this->validate($v, [
                    ['id', 'number|egt:1', '请输入商品属性ID|请输入商品属性ID|请输入商品属性ID'],
                    ['name', 'require', '请填写商品的名字'],
                    ['stock', 'require|number|gt:0', '请输入子属性库存|请输入子属性库存|请输入子属性库存'],
                    ['market_price', 'require|number|gt:0', '请输入子属性市场价|请输入子属性市场价|请输入子属性市场价'],
                    ['price', 'require|number|gt:0', '请输入子属性售价|请输入子属性售价|请输入子属性售价'],
                    ['sales_volume', 'require|number|egt:0', '请输入子属性出售个数|请输入子属性出售个数|请输入子属性出售个数'],
                    ['img', 'require', '请上传子属性图片'],
                ]);
                if ($res !== true) {
                    return json(msg(0, '', $res));
                }
                if (!empty($v['sku_id_1']) && intval($v['sku_id_1']) == 0) {
                    return json(msg(0, '', '请选择SKU'));
                }
                if (!empty($v['sku_id_2']) && intval($v['sku_id_2']) == 0) {
                    return json(msg(0, '', '请选择SKU'));
                }
                if(!empty($v['id'])){
                    $pro_model->sku()->where('id', $v['id'])->update($v);
                }else{
                    $pro_model->sku()->save($v);
                }
            }
            $pro_model->market_price = min(array_column($data['sku'], 'market_price'));
            $pro_model->price = min(array_column($data['sku'], 'price'));
            $pro_model->stock = array_sum(array_column($data['sku'], 'stock'));
            $pro_model->sales_volume = array_sum(array_column($data['sku'], 'sales_volume'));
            $pro_model->save();
        }
        Db::commit();
        return json(msg(1, '', '修改商品成功'));
    }


    /**
     * 删除商品
     * @return \think\response\Json
     */
    public function delPro()
    {
        $rule = [
            ['id', 'require|number|gt:0', '请输入商品的ID|请输入商品的ID|请输入商品的ID'],
            ['type', 'require|in:1,2', '请选择删除商品的类型|请选择删除商品的类型']
        ];
        $data = $this->checkParam($rule);
        if($data['type'] == 1){
            // 主商品
            //TODO 各种条件判断,并没做, 暂时不能删除商品吧
            if(true){
                return json(msg(0, '', '暂时无法删除商品'));
            }
        }else{
            // 商品的属性
            //TODO 各种条件判断,并没做, 暂时不能删除商品吧
            return json(msg(0, '', '暂时无法删除商品'));
        }
    }
}