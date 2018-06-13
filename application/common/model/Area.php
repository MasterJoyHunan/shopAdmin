<?php

namespace app\common\model;


class Area extends Common
{
    public static function getArea($id)
    {
        $res = self::get($id);
        return $res['name'];
    }
}