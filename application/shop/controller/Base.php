<?php

namespace app\shop\controller;
use app\common\model\User;
use think\Controller;
class Base extends Controller
{
    public $user;

    public function _initialize()
    {
        if(empty(session('user_id'))){
            header('Content-type: application/json');
            echo json_encode([
                'status' => 404,
                'msg' => '请先登录'
            ]);
            exit;
        }else{
            $this->user = User::get(session('user_id'));
            if($this->user->status !== 1){
                echo json_encode([
                    'status' => 404,
                    'msg' => '账号已被封停,无法继续操作'
                ]);
                exit;
            }
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