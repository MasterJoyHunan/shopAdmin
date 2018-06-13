<?php
namespace app\common\model;

class AdminUser extends Common
{
    protected function setPasswordAttr($value)
    {
        return newMd5($value);
    }
    /**
     * 关联ROLE表
     * @return \think\model\relation\HasOne
     */
    public function role()
    {
        return $this->hasOne('Role', 'id', 'role_id');
    }
}