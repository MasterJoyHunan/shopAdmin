webpackJsonp([12],{"62NT":function(t,e){},LBb0:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a=n("vLgD");var i={name:"database",created:function(){this._getData()},data:function(){return{table_loading:!0,list:[]}},methods:{backSql:function(){var t=this;this.$confirm("是否备份数据库","警告",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){Object(a.a)({url:"data/backup"}).then(function(e){t.$message({message:e.msg,type:"success"}),t._getData()})})},initSql:function(){var t=this;this.$confirm("系统将恢复初始状态,不可恢复","警告",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){Object(a.a)({url:"data/initData"}).then(function(e){t.$message({message:e.msg,type:"success"})})})},download:function(t){location.href="http://localhost/web/public/vueapi/data/download?filename="+t.title},restore:function(t){var e=this;this.$confirm("系统将继续还原操作,不可恢复","警告",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){var n;(n=t,Object(a.a)({url:"data/restore",params:n})).then(function(t){e.$message({message:t.msg,type:"success"})})})},deleteSql:function(t,e){var n=this;this.$confirm("该数据库将进行删除,不可恢复","警告",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){var i;(i=e,Object(a.a)({url:"data/del",params:i})).then(function(e){n.$message({message:e.msg,type:"success"}),n.list.splice(t,1)})})},_getData:function(){var t=this;Object(a.a)({url:"data/index"}).then(function(e){t.list=e.data,t.table_loading=!1}).catch(function(e){t.table_loading=!0})}}},l={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"app-container"},[n("p",{staticClass:"page-title"},[t._v("数据库列表")]),t._v(" "),n("div",{staticClass:"filter-container"},[n("el-button",{staticClass:"filter-item",attrs:{type:"primary",plain:""},on:{click:function(e){t.backSql()}}},[t._v("备份数据库")]),t._v(" "),n("el-button",{staticClass:"filter-item",attrs:{type:"danger",plain:""},on:{click:function(e){t.initSql()}}},[t._v("系统初始化")])],1),t._v(" "),n("el-table",{directives:[{name:"loading",rawName:"v-loading",value:t.table_loading,expression:"table_loading"}],attrs:{"element-loading-text":"加载中...",border:"",fit:"","highlight-current-row":"",data:t.list}},[n("el-table-column",{attrs:{align:"center",label:"数据库",prop:"title"}}),t._v(" "),n("el-table-column",{attrs:{align:"center",label:"数据库大小",prop:"size"}}),t._v(" "),n("el-table-column",{attrs:{align:"center",label:"创建时间",prop:"addtime"}}),t._v(" "),n("el-table-column",{attrs:{align:"center",label:"操作"},scopedSlots:t._u([{key:"default",fn:function(e){return[n("el-button",{attrs:{size:"mini",type:"primary"},on:{click:function(n){t.download(e.row)}}},[t._v("下载")]),t._v(" "),n("el-button",{attrs:{size:"mini",type:"warning"},on:{click:function(n){t.restore(e.row)}}},[t._v("还原")]),t._v(" "),n("el-button",{attrs:{size:"mini",type:"danger"},on:{click:function(n){t.deleteSql(e.$index,e.row)}}},[t._v("删除")])]}}])})],1)],1)},staticRenderFns:[]};var c=n("VU/8")(i,l,!1,function(t){n("62NT")},"data-v-6f4562ea",null);e.default=c.exports}});