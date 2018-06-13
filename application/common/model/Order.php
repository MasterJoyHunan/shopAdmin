<?php
namespace app\common\model;

class Order extends Common
{
    public function user()
    {
        return $this->hasOne('User', 'id', 'uid');
    }

    public function info()
    {
        return $this->hasMany('Order_info', 'pid', 'id');
    }
}