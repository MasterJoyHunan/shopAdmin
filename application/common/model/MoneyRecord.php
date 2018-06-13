<?php

namespace app\common\model;


class MoneyRecord extends Common
{
    public static function addRecord($user, $money, $money_type, $type, $memo)
    {
        $money_type_str = moneyStr($money_type);
        $flag = User::where('id', $user->id)->setInc($money_type_str, $money);
//        $new_user = User::where('id', $user->id)->field($money_type_str)->find();
        $data['uid'] = $user->id;
        $data['money'] = $money;
        $data['type'] = $type;
        $data['memo'] = $memo;
        $data['money_type'] = $money_type;
//        $data['left_money'] = $new_user->$money_type_str;
        $flag2 = self::create($data);
        if($flag2 && $flag){
            return true;
        }
        return false;
    }

}