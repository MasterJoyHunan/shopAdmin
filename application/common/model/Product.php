<?php
namespace app\common\model;

class Product extends Common
{
    public function sku()
    {
        return $this->hasMany('ProductSku', 'pro_id', 'id');
    }

    public function cate()
    {
        return $this->hasOne('cate', 'id', 'cate_id');
    }
}