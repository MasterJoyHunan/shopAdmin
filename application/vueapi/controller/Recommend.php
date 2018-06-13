<?php

namespace app\vueapi\controller;
use app\common\model\{RecommendList, RecommendContent};
class Recommend extends  Base
{
    /**
     * 推荐位管理列表
     */
    public function index()
    {
        $res = RecommendList::all();
        return json(msg(1, $res));
    }

    /**
     * 推荐位内容管理列表
     */
    public function content()
    {
        $data = $this->request->param('pid');
        $where = [];
        if(!empty($data)){
            $where['pid'] = $data;
        }
        $data = $this->request->param();
        $page = $data['pageSize'] ?? 10;
        $field = "id, pid, name, memo, img, link, sort";
        $res = RecommendContent::getMapListByWhere($where, $page, 'pinfo', $field, 'sort desc, id desc');
        return json(msg(1, $res));
    }


    /**
     * 添加推荐位
     */
    public function addRecommendList()
    {
        $rule = [
            ['name', 'require', '请填写推荐名'],
        ];
        $data = $this->checkParam($rule);
        $recom = new RecommendList($data);
        $flag = $recom->allowField('name')->save();
        return returnRes($flag, '添加推荐位');
    }


    /**
     * 修改推荐位
     */
    public function editRecommendList()
    {
        $rule = [
            ['name', 'require', '请填写推荐名'],
            ['id', 'require', '请输入要修改的ID号']
        ];
        $data = $this->checkParam($rule);
        $res = RecommendList::where('id', $data['id'])->find();
        if(empty($res)){
            return json(msg(0, '', '没有该推荐位的信息'));
        }
        if($res->name == $data['name']){
            return json(msg(0, '', '相同名字不需要修改'));
        }
        $res->name = $data['name'];
        $flag = $res->save();
        return returnRes($flag, '修改推荐位');
    }

    /**
     * 删除推荐位
     */
    public function delRecommendList()
    {
        $rule = [
            ['id', 'require', '请输入要修改的ID号']
        ];
        $data = $this->checkParam($rule);
        $res = RecommendList::where('id', $data['id'])->find();
        if(empty($res)){
            return json(msg(0, '', '没有该推荐位的信息'));
        }
        // 查看下面有没有内容
        $child = RecommendContent::where('pid', $res->id)->find();
        if(!empty($child)){
            return json(msg(0, '', '该推荐位下面还有内容,暂时无法删除'));
        }
        $flag = $res->delete();
        return returnRes($flag, '删除推荐位');
    }


    /**
     * 添加推荐位内容
     */
    public function addRecommendContent()
    {
        $rule = [
            ['name', 'min:1', '请填写推荐信息'],
            ['memo', 'min:1', '请填写推荐摘要'],
            ['link', 'min:1', '请填写推荐名链接'],
            ['img', 'min:1', '请填写推荐图片'],
            ['sort', 'min:1', '请填写推荐排序'],
            ['pid', 'require|regex:/^[1-9]\d*$/', '请填写所属推荐位|请填写合法所属推荐位'],
        ];
        $data = $this->checkParam($rule);
        $recom = RecommendList::where('id', $data['pid'])->find();
        if(empty($recom)){
            return json(msg(0, '', '该推荐位不存在'));
        }
        $rec_model = new RecommendContent($data);
        $flag = $rec_model->allowField(['name', 'memo', 'link', 'img', 'sort', 'pid'])->save();
        return returnRes($flag, '添加推荐内容');
    }


    /**
     * 修改推荐位内容
     */
    public function editRecommendContent()
    {
        $rule = [
            ['name', 'min:1', '请填写推荐信息'],
            ['memo', 'min:1', '请填写推荐摘要'],
            ['link', 'min:1', '请填写推荐名链接'],
            ['img', 'min:1', '请填写推荐图片'],
            ['sort', 'min:1', '请填写推荐排序'],
            ['pid', 'require|regex:/^[1-9]\d*$/', '请填写所属推荐位|请填写合法所属推荐位'],
            ['id', 'require|regex:/^[1-9]\d*$/', '请填写所属推荐内容ID|请填写合法推荐内容ID'],
        ];
        $data = $this->checkParam($rule);
        $recom = RecommendList::where('id', $data['pid'])->find();
        if(empty($recom)){
            return json(msg(0, '', '该推荐位不存在'));
        }
        $rec_model = RecommendContent::where('id', $data['id'])->find();
        if(empty($rec_model)){
            return json(msg(0, '', '该推荐内容不存在'));
        }
        $flag = $rec_model->allowField(['name', 'memo', 'link', 'img', 'sort', 'pid'])->save($data);
        return returnRes($flag, '修改推荐内容');
    }
    


    /**
     * 删除推荐位内容
     */
    public function delRecommendContent()
    {
        $rule = [
            ['id', 'require|regex:/^[1-9]\d*$/', '请填写所属推荐内容ID|请填写合法推荐内容ID'],
        ];
        $data = $this->checkParam($rule);
        $rec_model = RecommendContent::where('id', $data['id'])->find();
        if(empty($rec_model)){
            return json(msg(0, '', '该推荐内容不存在'));
        }
        $flag = $rec_model->delete();
        return returnRes($flag, '删除推荐内容');
    }
}