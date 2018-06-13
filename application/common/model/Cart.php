<?php
namespace app\common\model;

class Cart extends Common
{
    public function pro()
    {
        return $this->hasOne('Product', 'id', 'pro_id');
    }

    public function proSku()
    {
        return $this->hasOne('ProductSku', 'id', 'pro_sku_id');
    }
}