webpackJsonp([14],{iTZD:function(t,s){},wc2j:function(t,s,e){"use strict";Object.defineProperty(s,"__esModule",{value:!0});var i=e("HulU"),n={name:"login",data:function(){return{info:{tel:"",password:""}}},methods:{doLogin:function(){var t=this;Object(i.a)({url:"/shop/login/index",method:"post",data:this.info}).then(function(s){t.$router.push("/index")}).catch(function(t){console.log(t)})},reg:function(){this.$router.push("/reg")}}},o={render:function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{attrs:{id:"login"}},[t._m(0),t._v(" "),e("div",{staticClass:"container"},[e("div",{staticClass:"login-input username"},[e("svg-icon",{attrs:{"icon-class":"username",size:"24"}}),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.info.tel,expression:"info.tel"}],attrs:{placeholder:"请输入手机号",type:"text"},domProps:{value:t.info.tel},on:{input:function(s){s.target.composing||t.$set(t.info,"tel",s.target.value)}}})],1),t._v(" "),e("div",{staticClass:"login-input password"},[e("svg-icon",{attrs:{"icon-class":"password",size:"24"}}),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.info.password,expression:"info.password"}],attrs:{placeholder:"请输入密码",type:"password"},domProps:{value:t.info.password},on:{input:function(s){s.target.composing||t.$set(t.info,"password",s.target.value)}}})],1),t._v(" "),e("button",{staticClass:"submit",on:{click:t.doLogin}},[t._v("登录")]),t._v(" "),e("a",{staticClass:"reg",on:{click:t.reg}},[t._v("没有账号? 注册一个")])])])},staticRenderFns:[function(){var t=this.$createElement,s=this._self._c||t;return s("div",{staticClass:"container"},[s("div",{staticClass:"logo"}),this._v(" "),s("h1",{staticClass:"title-1"},[this._v("MasterJoy")]),this._v(" "),s("h1",{staticClass:"title-2"},[this._v("SHOP")])])}]};var a=e("VU/8")(n,o,!1,function(t){e("iTZD")},null,null);s.default=a.exports}});