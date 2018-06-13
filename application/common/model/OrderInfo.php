<?php
namespace app\common\model;

class OrderInfo extends Common
{
    public function user()
    {
        return $this->hasOne('User', 'id', 'uid');
    }

    public function info()
    {
        return $this->hasMany('OrderInfo', 'pid', 'id');
    }
}