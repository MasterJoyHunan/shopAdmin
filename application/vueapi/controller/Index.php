<?php

namespace app\vueapi\controller;

use app\common\model\{
    User, Order, Product, AdminUser, Node
};

class Index extends Base
{
    // 登录
    public function user()
    {
        $user = AdminUser::where('id', session('id'))->with('role')->field('user_name, real_name as true_name, role_id')->find();
        $node_model = new Node();
        $user->node = $node_model->getMenu($user->role->rule);
        return json(msg(1, $user));
    }

    public function member()
    {
        $arr['data'] = [
            User::whereTime('add_time', 'between', [date("Y-m-d",strtotime("-6 day")).'00:00:00', date("Y-m-d",strtotime("-6 day")).'23:59:59'])->count('id'),
            User::whereTime('add_time', 'between', [date("Y-m-d",strtotime("-5 day")).'00:00:00', date("Y-m-d",strtotime("-5 day")).'23:59:59'])->count('id'),
            User::whereTime('add_time', 'between', [date("Y-m-d",strtotime("-4 day")).'00:00:00', date("Y-m-d",strtotime("-4 day")).'23:59:59'])->count('id'),
            User::whereTime('add_time', 'between', [date("Y-m-d",strtotime("-3 day")).'00:00:00', date("Y-m-d",strtotime("-3 day")).'23:59:59'])->count('id'),
            User::whereTime('add_time', 'between', [date("Y-m-d",strtotime("-2 day")).'00:00:00', date("Y-m-d",strtotime("-2 day")).'23:59:59'])->count('id'),
            User::whereTime('add_time', 'between', [date("Y-m-d",strtotime("-1 day")).'00:00:00', date("Y-m-d",strtotime("-1 day")).'23:59:59'])->count('id'),
            User::whereTime('add_time', 'd')->count('id'),
        ];
        $arr['active'] = [
            User::whereTime('last_login_time', 'between', [date("Y-m-d",strtotime("-6 day")).'00:00:00', date("Y-m-d",strtotime("-6 day")).'23:59:59'])->count('id'),
            User::whereTime('last_login_time', 'between', [date("Y-m-d",strtotime("-5 day")).'00:00:00', date("Y-m-d",strtotime("-5 day")).'23:59:59'])->count('id'),
            User::whereTime('last_login_time', 'between', [date("Y-m-d",strtotime("-4 day")).'00:00:00', date("Y-m-d",strtotime("-4 day")).'23:59:59'])->count('id'),
            User::whereTime('last_login_time', 'between', [date("Y-m-d",strtotime("-3 day")).'00:00:00', date("Y-m-d",strtotime("-3 day")).'23:59:59'])->count('id'),
            User::whereTime('last_login_time', 'between', [date("Y-m-d",strtotime("-2 day")).'00:00:00', date("Y-m-d",strtotime("-2 day")).'23:59:59'])->count('id'),
            User::whereTime('last_login_time', 'between', [date("Y-m-d",strtotime("-1 day")).'00:00:00', date("Y-m-d",strtotime("-1 day")).'23:59:59'])->count('id'),
            User::whereTime('last_login_time', 'd')->count('id'),
        ];
        $arr['time'] = [
            date('m-d', strtotime("-6 day")),
            date('m-d', strtotime("-5 day")),
            date('m-d', strtotime("-4 day")),
            date('m-d', strtotime("-3 day")),
            date('m-d', strtotime("-2 day")),
            date('m-d', strtotime("-1 day")),
            date('m-d'),
        ];
        return json(msg(1, $arr));
    }


    public function sales()
    {
        $arr['data'] = [
            Order::where('status', 'gt', 0)->whereTime('pay_date', 'between', [date("Y-m-d",strtotime("-6 day")).'00:00:00', date("Y-m-d",strtotime("-6 day")).'23:59:59'])->sum('amount'),
            Order::where('status', 'gt', 0)->whereTime('pay_date', 'between', [date("Y-m-d",strtotime("-5 day")).'00:00:00', date("Y-m-d",strtotime("-5 day")).'23:59:59'])->sum('amount'),
            Order::where('status', 'gt', 0)->whereTime('pay_date', 'between', [date("Y-m-d",strtotime("-4 day")).'00:00:00', date("Y-m-d",strtotime("-4 day")).'23:59:59'])->sum('amount'),
            Order::where('status', 'gt', 0)->whereTime('pay_date', 'between', [date("Y-m-d",strtotime("-3 day")).'00:00:00', date("Y-m-d",strtotime("-3 day")).'23:59:59'])->sum('amount'),
            Order::where('status', 'gt', 0)->whereTime('pay_date', 'between', [date("Y-m-d",strtotime("-2 day")).'00:00:00', date("Y-m-d",strtotime("-2 day")).'23:59:59'])->sum('amount'),
            Order::where('status', 'gt', 0)->whereTime('pay_date', 'between', [date("Y-m-d",strtotime("-1 day")).'00:00:00', date("Y-m-d",strtotime("-1 day")).'23:59:59'])->sum('amount'),
            Order::where('status', 'gt', 0)->whereTime('pay_date', 'd')->count('id'),
        ];
        $arr['time'] = [
            date('m-d', strtotime("-6 day")),
            date('m-d', strtotime("-5 day")),
            date('m-d', strtotime("-4 day")),
            date('m-d', strtotime("-3 day")),
            date('m-d', strtotime("-2 day")),
            date('m-d', strtotime("-1 day")),
            date('m-d'),
        ];
        return json(msg(1, $arr));
    }


    public function systemCount()
    {
        $sys = new Data();
        $res = $sys->showSqlList();
        $arr = [
            'user' => User::count('id'),
            'order' => Order::count('id'),
            'product' => Product::count('id'),
            'system' => $res ? $res[0]['addtime'] : '没有备份'
        ];
        return json(msg(1, $arr));
    }


    public function orderInfo()
    {
        $arr['cancel'] = [
            Order::where('status', -1)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-6 day")).'00:00:00', date("Y-m-d",strtotime("-6 day")).'23:59:59'])->count('id'),
            Order::where('status', -1)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-5 day")).'00:00:00', date("Y-m-d",strtotime("-5 day")).'23:59:59'])->count('id'),
            Order::where('status', -1)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-4 day")).'00:00:00', date("Y-m-d",strtotime("-4 day")).'23:59:59'])->count('id'),
            Order::where('status', -1)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-3 day")).'00:00:00', date("Y-m-d",strtotime("-3 day")).'23:59:59'])->count('id'),
            Order::where('status', -1)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-2 day")).'00:00:00', date("Y-m-d",strtotime("-2 day")).'23:59:59'])->count('id'),
            Order::where('status', -1)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-1 day")).'00:00:00', date("Y-m-d",strtotime("-1 day")).'23:59:59'])->count('id'),
            Order::where('status', -1)->whereTime('add_date', 'd')->count('id'),
        ];
        $arr['wait'] = [
            Order::where('status', 0)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-6 day")).'00:00:00', date("Y-m-d",strtotime("-6 day")).'23:59:59'])->count('id'),
            Order::where('status', 0)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-5 day")).'00:00:00', date("Y-m-d",strtotime("-5 day")).'23:59:59'])->count('id'),
            Order::where('status', 0)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-4 day")).'00:00:00', date("Y-m-d",strtotime("-4 day")).'23:59:59'])->count('id'),
            Order::where('status', 0)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-3 day")).'00:00:00', date("Y-m-d",strtotime("-3 day")).'23:59:59'])->count('id'),
            Order::where('status', 0)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-2 day")).'00:00:00', date("Y-m-d",strtotime("-2 day")).'23:59:59'])->count('id'),
            Order::where('status', 0)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-1 day")).'00:00:00', date("Y-m-d",strtotime("-1 day")).'23:59:59'])->count('id'),
            Order::where('status', 0)->whereTime('add_date', 'd')->count('id'),
        ];
        $arr['pay'] = [
            Order::where('status', 1)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-6 day")).'00:00:00', date("Y-m-d",strtotime("-6 day")).'23:59:59'])->count('id'),
            Order::where('status', 1)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-5 day")).'00:00:00', date("Y-m-d",strtotime("-5 day")).'23:59:59'])->count('id'),
            Order::where('status', 1)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-4 day")).'00:00:00', date("Y-m-d",strtotime("-4 day")).'23:59:59'])->count('id'),
            Order::where('status', 1)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-3 day")).'00:00:00', date("Y-m-d",strtotime("-3 day")).'23:59:59'])->count('id'),
            Order::where('status', 1)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-2 day")).'00:00:00', date("Y-m-d",strtotime("-2 day")).'23:59:59'])->count('id'),
            Order::where('status', 1)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-1 day")).'00:00:00', date("Y-m-d",strtotime("-1 day")).'23:59:59'])->count('id'),
            Order::where('status', 1)->whereTime('add_date', 'd')->count('id'),
        ];
        $arr['wait_get'] = [
            Order::where('status', 2)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-6 day")).'00:00:00', date("Y-m-d",strtotime("-6 day")).'23:59:59'])->count('id'),
            Order::where('status', 2)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-5 day")).'00:00:00', date("Y-m-d",strtotime("-5 day")).'23:59:59'])->count('id'),
            Order::where('status', 2)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-4 day")).'00:00:00', date("Y-m-d",strtotime("-4 day")).'23:59:59'])->count('id'),
            Order::where('status', 2)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-3 day")).'00:00:00', date("Y-m-d",strtotime("-3 day")).'23:59:59'])->count('id'),
            Order::where('status', 2)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-2 day")).'00:00:00', date("Y-m-d",strtotime("-2 day")).'23:59:59'])->count('id'),
            Order::where('status', 2)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-1 day")).'00:00:00', date("Y-m-d",strtotime("-1 day")).'23:59:59'])->count('id'),
            Order::where('status', 2)->whereTime('add_date', 'd')->count('id'),
        ];
        $arr['get'] = [
            Order::where('status', 3)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-6 day")).'00:00:00', date("Y-m-d",strtotime("-6 day")).'23:59:59'])->count('id'),
            Order::where('status', 3)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-5 day")).'00:00:00', date("Y-m-d",strtotime("-5 day")).'23:59:59'])->count('id'),
            Order::where('status', 3)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-4 day")).'00:00:00', date("Y-m-d",strtotime("-4 day")).'23:59:59'])->count('id'),
            Order::where('status', 3)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-3 day")).'00:00:00', date("Y-m-d",strtotime("-3 day")).'23:59:59'])->count('id'),
            Order::where('status', 3)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-2 day")).'00:00:00', date("Y-m-d",strtotime("-2 day")).'23:59:59'])->count('id'),
            Order::where('status', 3)->whereTime('add_date', 'between', [date("Y-m-d",strtotime("-1 day")).'00:00:00', date("Y-m-d",strtotime("-1 day")).'23:59:59'])->count('id'),
            Order::where('status', 3)->whereTime('add_date', 'd')->count('id'),
        ];
        $arr['time'] = [
            date('m-d', strtotime("-6 day")),
            date('m-d', strtotime("-5 day")),
            date('m-d', strtotime("-4 day")),
            date('m-d', strtotime("-3 day")),
            date('m-d', strtotime("-2 day")),
            date('m-d', strtotime("-1 day")),
            date('m-d'),
        ];

        return json(msg(1, $arr));
    }

}
