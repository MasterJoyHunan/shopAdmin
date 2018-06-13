<?php

namespace app\vueapi\controller;
use app\common\model\Node as NodeModel;

class Node extends Base
{
    /**
     * 节点列表
     * @return mixed|\think\response\Json
     */
    public function index()
    {
        $node = new NodeModel();
        $nodes = $node->getNodeList();
        return json(msg(1, $nodes));
    }

    /**
     * 添加节点
     * @return \think\response\Json
     */
    public function nodeAdd()
    {
        $data = $this->request->param();
        $data['control_name'] = strtolower($data['control_name']);
        $data['action_name'] = strtolower($data['action_name']);
        $data['component_name'] = strtolower($data['component_name']);
        $node = new NodeModel($data);
        $flag = $node->allowField(['type_id', 'node_name', 'control_name', 'action_name', 'is_menu', 'component_name'])->save();
        return returnRes($flag, '添加');
    }

    /**
     * 编辑节点
     * @return \think\response\Json
     */
    public function nodeEdit()
    {
        $data = $this->request->param();
        $save_data['control_name'] = strtolower($data['control_name']);
        $save_data['action_name'] = strtolower($data['action_name']);
        $save_data['component_name'] = strtolower($data['component_name']);
        $save_data['node_name'] = $data['node_name'];
        $save_data['is_menu'] = $data['is_menu'];
        $flag = NodeModel::where('id', $data['id'])->update($save_data);
        return returnRes($flag, '编辑');
    }

    /**
     * 删除节点
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function nodeDel()
    {
        $data = $this->request->param();
        $have_child = NodeModel::where('type_id', $data['id'])->find();
        if($have_child){
            return json(msg(0, '', '该节点下面有子元素,不可删除'));
        }
        $flag = NodeModel::destroy($data['id']);
        return returnRes($flag, '删除');
    }


    /**
     * 每次操作都要更新缓存
     */
    public function __destruct()
    {
        updateAuthCache();
    }
}