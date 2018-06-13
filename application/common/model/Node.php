<?php
namespace app\common\model;
use think\Model;

class Node extends Model
{
    /**
     * 获取节点数据 (vue)
     */
    public function getNodeInfo($id)
    {
        $result = $this->column('id,node_name as label,type_id');
        $result = getTree($result, 'type_id');
        $role = new Role();
        $rule = $role->getRuleById($id);
        if (!empty($rule)) {
            $rule = explode(',', $rule);
        }
        $arr['choseKeys'] = $rule;
        $arr['tree'] = $result;
        return $arr;
    }

    public function getMenu($str)
    {
        if($str === '*'){
            return $this->where('is_menu', 2)->column('component_name');
        }
        $arr = explode(',', $str);
        $res = $this->where('is_menu', 2)->where('id', 'in', $arr)->column('component_name');
        return $res;
    }

    /**
     * 获取节点数据
     * @return array
     */
    public function getNodeList()
    {
        $res = $this->column('id,node_name as label, type_id,is_menu,control_name,action_name, component_name');
        $tree = getTree($res, 'type_id');
        return $tree;
    }




}