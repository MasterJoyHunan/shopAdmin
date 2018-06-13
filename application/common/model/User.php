<?php
namespace app\common\model;

class User extends Common
{
    protected function setPasswordAttr($value)
    {
        return newMd5($value);
    }

    public function cart()
    {
        return $this->hasMany('Cart', 'uid', 'id');
    }

    public function address()
    {
        return $this->hasMany('Address', 'uid', 'id');
    }

    public function orderList()
    {
        return $this->hasMany('Order', 'uid', 'id');
    }
}