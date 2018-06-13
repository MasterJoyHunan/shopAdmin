<?php
namespace app\vueapi\controller;

class common extends Base
{
    /**
     * 通用图片上传
     * 只支持单文件上传
     */
    public function uploadImg()
    {
        $file = $this->request->file('file');
        if(!$file){
            return josn(msg(0, '', '没有文件'));
        }
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        return $info ? json(msg(1, $info->getSaveName())) : json(msg(0, '', '上传图片错误'));
    }
}