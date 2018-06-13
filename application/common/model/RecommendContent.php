<?php

namespace app\common\model;


class RecommendContent extends Common
{
    public function pinfo()
    {
        return $this->hasOne('RecommendList', 'id', 'pid');
    }
}