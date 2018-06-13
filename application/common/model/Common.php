<?php

namespace app\common\model;

use think\Model;

class Common extends Model
{
    /**
     * 普通取出数据
     * @param $where
     * @param $limit
     * @param string $order
     * @return mixed
     * @throws \think\exception\DbException
     */
    public static function getListByWhere($where, $limit, $field="*", $order="id desc")
    {
        return self::where($where)->order($order)->field($field)->paginate($limit);
    }

    /**
     * @param $where
         * @param $limit
     * @param $with
     * @param string $order
     * @return mixed
     * @throws \think\exception\DbException
     */
    public static function getMapListByWhere($where, $limit, $with, $field="*", $order="id desc")
    {
        return self::where($where)->with($with)->field($field)->order($order)->paginate($limit);
    }

}