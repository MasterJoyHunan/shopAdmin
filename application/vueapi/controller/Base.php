<?php

namespace app\vueapi\controller;
use app\common\model\AdminUser;
use think\Controller;

class Base extends Controller
{
    public $admin_user;

    public function _initialize()
    {
        // 更新权限缓存
        if(empty(cache('auth'))){
            updateAuthCache();
        }

        if(empty(session('id'))){
            header('Content-type: application/json');
            echo json_encode([
                'status' => 404,
                'msg' => '请先登录'
            ]);
            exit;
        }else{
            $this->admin_user = AdminUser::get(session('id'));
        }
        // 检测权限
        $control = strtolower(request()->controller());
        $action = strtolower(request()->action());
        if(!authCheck($control . '/' . $action)){
            header('Content-type: application/json');
            echo json_encode([
                'status' => 403,
                'msg' => '没有权限'
            ]);
            exit;
        }

    }

    /**
     * 检验参数
     * @param $rule
     * @return mixed
     */
    public function checkParam($rule)
    {
        $data = $this->request->param();
        $res = $this->validate($data, $rule);
        if($res !== true){
            echo json_encode([
                'status' => 0,
                'msg' => $res
            ]);
            exit;
        }
        return $data;
    }

}