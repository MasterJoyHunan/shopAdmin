<?php

namespace app\common\model;


class RecommendList extends Common
{
    public function child()
    {
        return $this->hasMany('RecommendContent', 'id', 'pid');
    }
}