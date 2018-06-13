<?php

namespace app\shop\controller;
use app\common\model\{Area, Address as AddressModel};

class Address extends Base
{
    public function index()
    {
        $res = AddressModel::where('uid', $this->user->id)->select();
        return json(msg(1, $res));
    }

    /**
     * 为自己添加地址信息
     * @return \think\response\Json
     */
    public function addAddress()
    {
        $rule = [
            ['tel', 'require|number|length:11', '请输入电话号码'],
            ['name', 'require', '请输入收货人信息'],
            ['province', 'require|number|min:6', '请输入省份'],
            ['city', 'require|number|min:6', '请输入市区'],
            ['area', 'require|number|min:6', '请输入地区'],
            ['address', 'require', '请输入收货地址明细'],
        ];
        $data = $this->checkParam($rule);
        //修改操作
        if(!empty($data['address_id'])){
            $my_address = $this->user->address()->where('id', $data['address_id'])->find();
            if(!$my_address){
                return json(msg(0, '', '收货地址不存在'));
            }
            $data['province_id'] = $data['province'];
            $data['province'] = Area::getArea($data['province']);
            $data['city_id'] = $data['city'];
            $data['city'] = Area::getArea($data['city']);
            $data['area_id'] = $data['area'];
            $data['area'] = Area::getArea($data['area']);
            unset($data['id']);
            $flag = $my_address->allowField(['id', 'tel', 'name', 'province', 'city', 'area', 'province_id', 'city_id', 'area_id', 'address'])->save($data);
            $msg = "地址修改";
        }else{ //新增操作
            $my_address = new AddressModel();
            $my_address->uid = $this->user->id;
            $my_address->tel = $data['tel'];
            $my_address->name = $data['name'];
            $my_address->province = Area::getArea($data['province']);
            $my_address->province_id = $data['province'];
            $my_address->city = Area::getArea($data['city']);
            $my_address->city_id = $data['city'];
            $my_address->area = Area::getArea($data['area']);
            $my_address->area_id = $data['area'];
            $my_address->address = $data['address'];
            $flag = $my_address->save();
            $this->setDefault($my_address->id);
            $msg = "地址添加";
        }
        return $flag ? json(msg(1, $my_address, $msg.'成功')) : json(msg(0, $my_address, $msg.'失败'));
    }


    /**
     * 获取详细地址
     * @return \think\response\Json
     */
    public function getAddressDetail()
    {
        $rule = [
            ['address_id', 'require|number|gt:0', '非法参数'],
        ];
        $data = $this->checkParam($rule);
        $res = $this->user->address()->where('id', $data['address_id'])->find();
        if($res){
            return json(msg(1, $res));
        }
        return json(msg(0, '', '没有该收货地址'));
    }


    /**
     * 设置默认地址信息
     * @return \think\response\Json
     */
    public function setDefault($addr_id = null)
    {
        $address_id = $addr_id ?? $this->request->param('address_id') ;
        $address_model = $this->user->address()->where('id', $address_id)->find();
        if(empty($address_model)){
            return json(['status'=>0, 'msg'=>'收货地址不存在']);
        }elseif($address_model->is_default == 1){
            return json(['status'=>0, 'msg'=>'已经是默认地址']);
        }else{
            $this->user->address()->update(['is_default' => 0]);
            $address_model->is_default = 1;
            if($address_model->save()){
                return json(['status'=>1, 'data'=>'修改成功']);
            }else{
                return json(['status'=>0, 'msg'=>'修改失败']);
            }
        }
    }

    /**
     * 删除一条地址记录
     * @return \think\response\Json
     */
    public function deleteAddress()
    {
        $rule = [
            ['address_id', 'require|number|gt:0', '非法参数'],
        ];
        $data = $this->checkParam($rule);
        $res = $this->user->address()->where('id', $data['address_id'])->delete();
        if($res){
            return json(msg(1, '', '删除成功'));
        }
        return json(msg(0, '', '没有该收货地址'));
    }
}