<?php
namespace app\common\model;

class ProductSku extends Common
{
    public function sku1(){
        return $this->hasOne('sku', 'id', 'sku_id_1');
    }

    public function sku2(){
        return $this->hasOne('sku', 'id', 'sku_id_2');
    }
}