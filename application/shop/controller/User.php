<?php

namespace app\shop\controller;

// use app\common\model\{Role, AdminUser, Node};

class User extends Base
{
    /**
     * 个人资料
     */
    public function index()
    {
        $arr['user'] = $this->user;
        unset($arr->password);
        unset($arr->server_password);
        return json(msg(1, $arr));
    }
}
