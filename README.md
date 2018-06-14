# 前言
* 本项目仅供交流和学习使用
* 项目出现的任何BUG和需要优化的地方请 PR 或 ISSUES, 作者不保证会第一时间会修改,只有在业余时间才会进行修改
* 如果觉得不错,请帮忙点个star ,举手之劳
* 作者一直都是把github当U盘用, 所以请不要在意master分支提交那么多次

# 项目地址
* [商城前台-Mobil版 演示地址](http://www.masterjoy.top)
* [商城前台-Mobil版 github](https://github.com/MasterJoyHunan/app)
* [商城后台-PC版 演示地址](http://www.masterjoy.top/root)
* [商城后台-PC版 github](https://github.com/MasterJoyHunan/adminForVue)
* [商城后台 php源码 github](https://github.com/MasterJoyHunan/shopAdmin)

# 项目介绍
#### 商城前台-Mobil版
___
> 使用VUE作为主框架编写的一套简单的商城系统, 使用vux作为css框架(作者css太弱了,其实里面的css有能力的完全可以自己重写).麻雀虽小,五脏俱全. 能实现完整的购物流程, 该项目没有使用各种复杂的代码
> > 定位: 适合初学者想学习VUE,又没有几个合适的项目练手的朋友.学习和使用VUE的各种特性和语法.
> 本项目没有文档和测试,不保证安全和性能,仅仅用来学习交流

该项目的功能含有:

* 登录
* 首页
* 分类
* 购物车
* 个人中心
* 商品详情
* 商品SKU选择
* 立即购买
* 加入购物车
* 订单列表
* 订单详情
* ....

有些功能由于能力,精力限制,暂时还不完善,请不要纠结
图片展示:
![登录](http://www.masterjoy.top/uploads/app/login.png)
![首页](http://www.masterjoy.top/uploads/app/index.png)
![分类](http://www.masterjoy.top/uploads/app/cate.png)
![个人中心](http://www.masterjoy.top/uploads/app/member.png)
![商品](http://www.masterjoy.top/uploads/app/detail2.png)
![商品](http://www.masterjoy.top/uploads/app/detail.png)
![订单](http://www.masterjoy.top/uploads/app/order.png)
#### 商城后台-PC版
___
> 使用VUE作为主框架编写的一套简单的商城后台系统, 使用element-ui为css框架(作者css太弱了,其实里面的css有能力的完全可以自己重写).麻雀虽小,五脏俱全. 能实现完整的购物流程, 该项目没有使用各种复杂的代码
> > 定位: 适合初学者想学习VUE,又没有几个合适的项目练手的朋友.学习和使用VUE的各种特性和语法.
> 本项目没有文档和测试,不保证安全和性能,仅仅用来学习交流

* 权限管理
* 列表
* 分页
* 对应前台的功能
* ....

有些功能由于能力,精力限制,暂时还不完善,请不要纠结
图片展示:
![登录](http://www.masterjoy.top/uploads/root/login.png)
![首页](http://www.masterjoy.top/uploads/root/index.png)
![分类](http://www.masterjoy.top/uploads/root/cate.png)
![权限管理](http://www.masterjoy.top/uploads/root/node.png)

# 作者简介
作者是半路出家自学的PHP的程序员,fu南人, 主要从事后端PHP开发, 从业3年,PHP也不是很熟, 前端也不是很强, 就这样吧, 如有对项目有疑问或需要联系作者, 请 PR 或者 issuse 或者发邮箱 386442876@qq.com
# 基于
本项目或多或少用到了别人的代码,确实做了很多次伸手党(注: 在MIT协议情况下),在此谢谢在GitHub上的大神
感谢他们开源精神,以下
* [vue-element-admin](https://github.com/PanJiaChen/vue-element-admin/blob/master/README.zh-CN.md)
	* vue-element-admin 是一个后台集成解决方案，它基于 Vue.js 和 element。它使用了最新的前端技术栈，内置了i18国际化解决方案，动态路由，权限验证等很多功能特性，相信不管你的需求是什么，本项目都能帮助到你。
# 多说两句
前端的变化速度日新月异, 以前很火的Jquery我们公司已经不怎么用了,而新的MVVM的框架将成为主流,而VUE又是其中佼佼者, 由国人大神尤雨溪主导开发,中文文档非常友好,社区非常繁荣.
现在学习前端可以构建单页面应用,可以打包成APP IOS, 甚至可以打包成桌面应用,让我这个学PHP的也心动不已.前端实在是太棒了!希望大家能早日精通前端, 升职加薪,赢取白富美
# 技术栈
* 商城前台-Mobil版
	* vue
	* vue-cli
	* less
	* vue-router
	* vuex 
	* vux 
	* axios
	* es-lint
	* better-scroll
* 商城后台-PC版
	* vue
	* vue-cli
	* scss
	* vue-router
	* vuex 
	* element-ui
	* axios
	* es-lint
	* echarts
	* es6-promise
* 商城后台
	* think-php 5.0

# 搭建本地服务
> 1. 克隆https://github.com/MasterJoyHunan/shopAdmin到本地,并把项目根目录的里的/data/xxx.sql的数据库文件给导入

 注意:
* 先创建shop_template数据库 
* 再运行进行导入
* github上上传的时候,我忽略了database.php文件,请自己创建
* database.php下
 * database = '你的数据库',
 * prefix = 'mj_' ,
 * mysql_path' => '备份文件所在的目录'

以上运行,如果没报错,可以进行下一步了
> 2.克隆https://github.com/MasterJoyHunan/shopAdmin到本地, npm install && npm run dev
    
 注意:
    * 由于shopAdmin是单独项目, js请求会跨域, 导致请求不成功, 所幸vue-cli提供了一个代理的功能. 进入shopAdmin/config/index.js, 修改以下内容

	proxyTable: {
        "/shop": {
            target: "http://localhost/web/public/shop",   //修改为你需要调用api入口
            changeOrigin: true,
            pathRewrite: {
                "^/shop": "/"
            }
        }
    },
    // 该代码是指, 所有调用/shop的地方都换装换成http://localhost/web/public/shop
	       
接下来,运行下面的操作

# 运行VUE项目
``` bash
# 安装依赖
npm install

# 运行项目
npm run dev

# 打包
npm run build

# build for production and view the bundle analyzer report
npm run build --report
```

# 协议
> license MIT 