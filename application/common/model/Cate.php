<?php
namespace app\common\model;

class Cate extends Common
{
    public function sku()
    {
        return $this->hasMany('sku', 'pid', 'id');
    }
}