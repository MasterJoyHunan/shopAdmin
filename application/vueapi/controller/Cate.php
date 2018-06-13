<?php
namespace app\vueapi\controller;
use app\common\model\{Cate as CateModel, Sku, ProductSku};

class Cate extends Base
{

    /**
     * 所有分类
     */
    public function index()
    {
        $data = $this->request->param();
        $page = $data['pageSize'] ?? 10;
        $where['status'] = 1;
        if(!empty($data['name'])){
            $where['name'] = ['like', "%{$data['name']}%"];
        }
        $field = 'id, name, status, add_time, sort';
        $res = CateModel::getMapListByWhere($where, $page, 'sku',$field, 'add_time desc');
        return json(msg(1, $res));
    }


    /**
     * 添加分类
     */
    public function addCate()
    {
        $rule = [
            ['name', 'require', '分类名必填'],
            ['sort', 'require|number|egt:0', '请选择输入排序']
        ];
        $data = $this->checkParam($rule);
        $cateModel = new CateModel($data);
        $res = $cateModel->allowField(['name', 'sort'])->save();
        return returnRes($res, '分类添加');
    }

    /**
     * 修改分类
     */
    public function editCate()
    {
        $rule = [
            ['id', 'require|number|gt:0', '分类ID必填'],
            ['name', 'require', '分类名必填'],
            ['sort', 'require|number|egt:0', '请选择输入排序']
        ];
        $data = $this->checkParam($rule);
        $cate = CateModel::where('id', $data['id'])->find();
        if(empty($cate) || $cate->status != 1){
            return json(msg(0, '', '不存在该分类'));
        }
        $res = $cate->allowField(['name', 'sort'])->save($data);
        return returnRes($res, '分类修改');
    }

    /**
     * 删除分类
     */
    public function delCate()
    {
        $rule = [
            ['id', 'require|number|egt:0', '分类id必填'],
        ];
        $data = $this->checkParam($rule);
        $cate = CateModel::where('id', $data['id'])->find();
        if(empty($cate) || $cate->status != 1){
            return json(msg(0, '', '不存在该分类'));
        }
        $cate->status = -1;
        $res = $cate->save();
        return returnRes($res, '分类删除');
    }

    /**
     * 添加属性
     * @return \think\response\Json
     */
    public function addCateSku()
    {
        $rule = [
            ['level', 'require|in:1,2', '请选择属性的层级|请选择属性的层级'],
            ['pid', 'require|number|gt:0', '请输入选择的分类'],
            ['name', 'require', '请输入属性名']
        ];
        $data = $this->checkParam($rule);
        //不允许有相同的属性
        $cate_model = new CateModel();
        $where['name'] = $data['name'];
        $where['level'] = $data['level'];
        $cate = $cate_model->where('id', $data['pid'])->where('status', 1)->find();
        if(empty($cate)){
            return json(msg(0, '', '该分类不存在'));
        }
        $have_sku = $cate->sku()->where($where)->find();
        if($have_sku){
            return json(msg(0, '', '该属性已存在,请不要重复添加'));
        }
        $where['pid'] = $cate->id;
        $res = Sku::create($where);
        return $res ? json(msg(1, $res)) : json(msg(0, '', '添加属性失败'));
    }

    /**
     * 删除属性
     * @return \think\response\Json
     */
    public function delCateSku()
    {
        $rule = [
            ['id', 'require|number|gt:0', '请输入属性ID'],
        ];
        $data = $this->checkParam($rule);
        //不允许有相同的属性
        $sku = Sku::where('id', $data['id'])->find();
        if(empty($sku)){
            return json(msg(0, '', '该属性不存在'));
        }
        $have_sku = ProductSku::where('sku_id_1|sku_id_2', $data['id'])->find();
        if($have_sku){
            return json(msg(0, '', '该属性已被使用, 无法进行删除'));
        }
        $res = $sku->delete();
        return returnRes($res, '删除属性');
    }
}