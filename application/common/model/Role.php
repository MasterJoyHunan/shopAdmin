<?php
namespace app\common\model;

class Role extends Common
{
    // 获取角色的权限节点
    public function getRuleById($id)
    {
        $res = $this->field('rule')->where('id', $id)->find();
        return $res['rule'];
    }

    /**
     * 获取角色信息
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getRoleInfo()
    {
        if($this->rule == "*"){
            $res = Node::field('control_name, action_name')->select();
        }else{
            $res = Node::where('id', 'in', $this->rule)->field('control_name, action_name')->select();
        }
        if(empty($res)){
            return [];
        }
        foreach($res as $key=>$vo){
            if('#' != $vo['action_name']){
                $result[] = $vo['control_name'] . '/' . $vo['action_name'];
            }
        }
        return $result;
    }

}