webpackJsonp([3],{"+mJe":function(e,t,l){"use strict";var i={name:"md-input",props:{icon:String,name:String,type:{type:String,default:"text"},value:[String,Number],placeholder:String,readonly:Boolean,disabled:Boolean,min:String,max:String,step:String,minlength:Number,maxlength:Number,required:{type:Boolean,default:!0},autoComplete:{type:String,default:"off"},validateEvent:{type:Boolean,default:!0}},computed:{computedClasses:function(){return{"material--active":this.focus,"material--disabled":this.disabled,"material--raised":Boolean(this.focus||this.currentValue)}}},watch:{value:function(e){this.currentValue=e}},data:function(){return{currentValue:this.value,focus:!1,fillPlaceHolder:null}},methods:{handleModelInput:function(e){var t=e.target.value;this.$emit("input",t),"ElFormItem"===this.$parent.$options.componentName&&this.validateEvent&&this.$parent.$emit("el.form.change",[t]),this.$emit("change",t)},handleMdFocus:function(e){this.focus=!0,this.$emit("focus",e),this.placeholder&&""!==this.placeholder&&(this.fillPlaceHolder=this.placeholder)},handleMdBlur:function(e){this.focus=!1,this.$emit("blur",e),this.fillPlaceHolder=null,"ElFormItem"===this.$parent.$options.componentName&&this.validateEvent&&this.$parent.$emit("el.form.blur",[this.currentValue])}}},s={render:function(){var e=this,t=e.$createElement,l=e._self._c||t;return l("div",{staticClass:"material-input__component",class:e.computedClasses},[l("div",{class:{iconClass:e.icon}},[e.icon?l("i",{staticClass:"el-input__icon material-input__icon",class:["el-icon-"+e.icon]}):e._e(),e._v(" "),"email"===e.type?l("input",{directives:[{name:"model",rawName:"v-model",value:e.currentValue,expression:"currentValue"}],staticClass:"material-input",attrs:{type:"email",name:e.name,placeholder:e.fillPlaceHolder,readonly:e.readonly,disabled:e.disabled,autoComplete:e.autoComplete,required:e.required},domProps:{value:e.currentValue},on:{focus:e.handleMdFocus,blur:e.handleMdBlur,input:[function(t){t.target.composing||(e.currentValue=t.target.value)},e.handleModelInput]}}):e._e(),e._v(" "),"url"===e.type?l("input",{directives:[{name:"model",rawName:"v-model",value:e.currentValue,expression:"currentValue"}],staticClass:"material-input",attrs:{type:"url",name:e.name,placeholder:e.fillPlaceHolder,readonly:e.readonly,disabled:e.disabled,autoComplete:e.autoComplete,required:e.required},domProps:{value:e.currentValue},on:{focus:e.handleMdFocus,blur:e.handleMdBlur,input:[function(t){t.target.composing||(e.currentValue=t.target.value)},e.handleModelInput]}}):e._e(),e._v(" "),"number"===e.type?l("input",{directives:[{name:"model",rawName:"v-model",value:e.currentValue,expression:"currentValue"}],staticClass:"material-input",attrs:{type:"number",name:e.name,placeholder:e.fillPlaceHolder,step:e.step,readonly:e.readonly,disabled:e.disabled,autoComplete:e.autoComplete,max:e.max,min:e.min,minlength:e.minlength,maxlength:e.maxlength,required:e.required},domProps:{value:e.currentValue},on:{focus:e.handleMdFocus,blur:e.handleMdBlur,input:[function(t){t.target.composing||(e.currentValue=t.target.value)},e.handleModelInput]}}):e._e(),e._v(" "),"password"===e.type?l("input",{directives:[{name:"model",rawName:"v-model",value:e.currentValue,expression:"currentValue"}],staticClass:"material-input",attrs:{type:"password",name:e.name,placeholder:e.fillPlaceHolder,readonly:e.readonly,disabled:e.disabled,autoComplete:e.autoComplete,max:e.max,min:e.min,required:e.required},domProps:{value:e.currentValue},on:{focus:e.handleMdFocus,blur:e.handleMdBlur,input:[function(t){t.target.composing||(e.currentValue=t.target.value)},e.handleModelInput]}}):e._e(),e._v(" "),"tel"===e.type?l("input",{directives:[{name:"model",rawName:"v-model",value:e.currentValue,expression:"currentValue"}],staticClass:"material-input",attrs:{type:"tel",name:e.name,placeholder:e.fillPlaceHolder,readonly:e.readonly,disabled:e.disabled,autoComplete:e.autoComplete,required:e.required},domProps:{value:e.currentValue},on:{focus:e.handleMdFocus,blur:e.handleMdBlur,input:[function(t){t.target.composing||(e.currentValue=t.target.value)},e.handleModelInput]}}):e._e(),e._v(" "),"text"===e.type?l("input",{directives:[{name:"model",rawName:"v-model",value:e.currentValue,expression:"currentValue"}],staticClass:"material-input",attrs:{type:"text",name:e.name,placeholder:e.fillPlaceHolder,readonly:e.readonly,disabled:e.disabled,autoComplete:e.autoComplete,minlength:e.minlength,maxlength:e.maxlength,required:e.required},domProps:{value:e.currentValue},on:{focus:e.handleMdFocus,blur:e.handleMdBlur,input:[function(t){t.target.composing||(e.currentValue=t.target.value)},e.handleModelInput]}}):e._e(),e._v(" "),l("span",{staticClass:"material-input-bar"}),e._v(" "),l("label",{staticClass:"material-label"},[e._t("default")],2)])])},staticRenderFns:[]};var a=l("VU/8")(i,s,!1,function(e){l("PJk0")},"data-v-50ce04ff",null);t.a=a.exports},"5aCZ":function(e,t,l){"use strict";var i=l("//Fk"),s=l.n(i),a=l("fZjL"),o=l.n(a),r={name:"editorSlideUpload",props:{color:{type:String,default:"#20a0ff"}},data:function(){return{dialogVisible:!1,listObj:{},fileList:[],imgPostUrl:"/vueapi//common/uploadImg"}},methods:{checkAllSuccess:function(){var e=this;return o()(this.listObj).every(function(t){return e.listObj[t].hasSuccess})},handleSubmit:function(){var e=this,t=o()(this.listObj).map(function(t){return e.listObj[t]});this.checkAllSuccess()?(console.log(t),this.$emit("successCBK",t),this.listObj={},this.fileList=[],this.dialogVisible=!1):this.$message("请等待所有图片上传成功 或 出现了网络问题，请刷新页面重新上传！")},handleSuccess:function(e,t){for(var l=t.uid,i=o()(this.listObj),s=0,a=i.length;s<a;s++)if(this.listObj[i[s]].uid===l)return this.listObj[i[s]].url="/uploads/"+e.data,void(this.listObj[i[s]].hasSuccess=!0)},handleRemove:function(e){for(var t=e.uid,l=o()(this.listObj),i=0,s=l.length;i<s;i++)if(this.listObj[l[i]].uid===t)return void delete this.listObj[l[i]]},beforeUpload:function(e){var t=this,l=this,i=window.URL||window.webkitURL,a=e.uid;return this.listObj[a]={},new s.a(function(s,o){var r=new Image;r.src=i.createObjectURL(e),r.onload=function(){l.listObj[a]={hasSuccess:!1,uid:e.uid,width:t.width,height:t.height}},s(!0)})}}},n={render:function(){var e=this,t=e.$createElement,l=e._self._c||t;return l("div",{staticClass:"upload-container"},[l("el-button",{style:{background:e.color,borderColor:e.color},attrs:{icon:"upload",type:"primary"},on:{click:function(t){e.dialogVisible=!0}}},[e._v("上传图片\n    ")]),e._v(" "),l("el-dialog",{attrs:{visible:e.dialogVisible,title:"上传图片"},on:{"update:visible":function(t){e.dialogVisible=t}}},[l("el-upload",{staticClass:"editor-slide-upload",attrs:{action:e.imgPostUrl,multiple:!0,"file-list":e.fileList,"show-file-list":!0,"list-type":"picture-card","on-remove":e.handleRemove,"on-success":e.handleSuccess,"before-upload":e.beforeUpload}},[l("el-button",{attrs:{size:"small",type:"primary"}},[e._v("点击上传")])],1),e._v(" "),l("el-button",{on:{click:function(t){e.dialogVisible=!1}}},[e._v("取 消")]),e._v(" "),l("el-button",{attrs:{type:"primary"},on:{click:e.handleSubmit}},[e._v("确 定")])],1)],1)},staticRenderFns:[]};var u={name:"tinymce",components:{editorImage:l("VU/8")(r,n,!1,function(e){l("vyK3")},"data-v-39eed342",null).exports},props:{value:{type:String,default:""},toolbar:{type:Array,required:!1,default:function(){return["removeformat undo redo |  bullist numlist | outdent indent | forecolor | fullscreen code","bold italic blockquote | h2 p  media link | alignleft aligncenter alignright  "]}},menubar:{default:""},height:{type:Number,required:!1,default:360}},data:function(){return{hasChange:!1,hasInit:!1}},watch:{value:function(e){!this.hasChange&&this.hasInit&&this.$nextTick(function(){return window.tinymce.get("tinymceId").setContent(e)})}},mounted:function(){this.initTinymce()},activated:function(){this.initTinymce()},deactivated:function(){this.destroyTinymce()},methods:{initTinymce:function(){var e=this,t=this;window.tinymce.init({selector:"#tinymceId",height:this.height,body_class:"panel-body ",object_resizing:!1,toolbar:this.toolbar,menubar:this.menubar,plugins:"advlist,autolink,code,paste,textcolor, colorpicker,fullscreen,link,lists,media,wordcount, imagetools ",forced_root_block:"",end_container_on_empty_block:!0,powerpaste_word_import:"clean",code_dialog_height:450,code_dialog_width:1e3,advlist_bullet_styles:"square",advlist_number_styles:"default",imagetools_cors_hosts:["wpimg.wallstcn.com","wallstreetcn.com"],imagetools_toolbar:"watermark",default_link_target:"_blank",link_title:!1,init_instance_callback:function(l){t.value&&l.setContent(t.value),t.hasInit=!0,l.on("NodeChange Change KeyUp",function(){e.hasChange=!0,e.$emit("input",l.getContent({format:"raw"}))})}})},destroyTinymce:function(){window.tinymce.get("tinymceId")&&window.tinymce.get("tinymceId").destroy()},setContent:function(e){window.tinymce.get("tinymceId").setContent(e)},getContent:function(){window.tinymce.get("tinymceId").getContent()},imageSuccessCBK:function(e){e.forEach(function(e){window.tinymce.get("tinymceId").insertContent('<img class="wscnph" src="'+e.url+'" >')})}},destroyed:function(){this.destroyTinymce()}},c={render:function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"tinymce-container editor-container"},[t("textarea",{staticClass:"tinymce-textarea",attrs:{id:"tinymceId"}}),this._v(" "),t("div",{staticClass:"editor-custom-btn-container"},[t("editorImage",{staticClass:"editor-upload-btn",attrs:{color:"#20a0ff"},on:{successCBK:this.imageSuccessCBK}})],1)])},staticRenderFns:[]};var d=l("VU/8")(u,c,!1,function(e){l("UDGN")},"data-v-656f7ebd",null);t.a=d.exports},F9X0:function(e,t){},PJk0:function(e,t){},UDGN:function(e,t){},cVqd:function(e,t,l){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var i=l("+mJe"),s=l("0xDb"),a=l("5aCZ"),o=l("UgCr"),r={name:"addPro",data:function(){return{cdn:"/uploads/",formValue:{title:"",cate_id:"",market_price:0,price:0,stock:0,sales_volume:0,sort:0,imgs:[],is_hot:0,status:1,desc:"",sku:[]},formRules:{title:[{required:!0,message:"必填项",trigger:"blur"},{min:4,max:25,message:"请输入4-25个字",trigger:"blur"}],cate_id:[{required:!0,message:"请选择分类",trigger:"blur",type:"number"}],market_price:[{required:!0,min:.01,message:"市场价不得低于0.01元",trigger:"blur",type:"number"}],price:[{required:!0,min:.01,message:"售价不得低于0.01元",trigger:"blur",type:"number"}],stock:[{required:!0,min:1,message:"库存不能低于1个",trigger:"blur",type:"number"}],sales_volume:[{required:!0,min:0,message:"销售个数不能为负数",trigger:"blur",type:"number"}],sort:[{required:!0,min:0,max:255,message:"排序0-255之间",trigger:"blur",type:"number"}],is_hot:[{required:!0,enum:[0,1],message:"非法数据",trigger:"blur",type:"number"}],status:[{required:!0,enum:[0,1],message:"非法数据",trigger:"blur",type:"number"}]},skuAttr:{name:"",market_price:"",price:"",sales_volume:"",stock:"",img:""},cate:[],skuLabel:[],sku1List:[],sku2List:[],chooseSku1:[],chooseSku2:[],tempIdenx:0,imgPostUrl:"/vueapi//common/uploadImg",dialogImageUrl:"",dialogVisible:!1,haveSku:!1}},created:function(){var e=this;Object(o.d)().then(function(t){e.cate=t.data})},methods:{chooseCate:function(e){var t=this;this.skuLabel=[],this.chooseSku1=[],this.chooseSku2=[],this.cate.forEach(function(l,i){l.id==e&&(l.sku.length>0?(t.haveSku=!0,t.skuLabel=l.sku,t.setSku(l.sku)):t.haveSku=!1)})},setSku:function(e){var t=[],l=[];e.forEach(function(e,i){1==e.level?t.push(e):l.push(e)}),this.sku1List=t.length>0?t:[],this.sku2List=l.length>0?l:[]},handlePictureCardPreview:function(e){console.log("handlePictureCardPreview",e),this.dialogVisible=!0,this.dialogImageUrl=e.url},handleRemove:function(e,t){this.formValue.imgs.splice(Object(s.a)(this.formValue.imgs,e.response.data),1),console.log("handleRemove",e,t)},uploadSuccess:function(e,t,l){this.formValue.imgs.unshift(e.data),console.log("uploadSuccess",e,t,l)},beforeRemove:function(e,t){return console.log("beforeRemove",e,t),this.$confirm("确定移除？")},deleteSku:function(e,t){this.formValue.sku.splice(e,1)},skuImgUpload:function(e){this.tempIdenx=e},skuImgUploadSuccess:function(e){1==e.status&&(this.formValue.sku[this.tempIdenx].img=e.data)},onSubmit:function(){var e=this;this.$refs.fromInput.validate(function(t){return t?e.choose1Error||e.choose2Error?(e.$message({message:"SKU选择出现错误!请仔细检查",type:"error"}),!1):void Object(o.a)(e.formValue).then(function(t){e.$message({message:t.msg,type:"success"}),e.$router.push("/product/goods")}):(e.$message({message:"信息填写错误,请仔细检查",type:"error"}),!1)})},buildChild:function(){var e=this;this.formValue.sku=[],this.chooseSku1.length>0&&0==this.chooseSku2.length?this.chooseSku1.forEach(function(t,l){e.formValue.sku.push({name:t.name,sku_id_1:t.id,sku_id_2:0,stock:0,market_price:0,price:0,sales_volume:0,img:""})}):this.chooseSku1.length>0&&this.chooseSku2.length>0?this.chooseSku1.forEach(function(t,l){e.chooseSku2.forEach(function(l,i){e.formValue.sku.push({name:t.name+l.name,sku_id_1:t.id,sku_id_2:l.id,stock:0,market_price:0,price:0,sales_volume:0,img:""})})}):0==this.chooseSku1.length&&this.chooseSku2.length>0&&this.chooseSku2.forEach(function(t,l){e.formValue.sku.push({name:t.name,sku_id_1:0,sku_id_2:t.id,stock:0,market_price:0,price:0,sales_volume:0,img:""})})},overwrite:function(e,t){var l=this,i=t.column;t.$index;return e("el-popover",{attrs:{placement:"top-start",trigger:"click"}},[e("el-row",[e("el-col",{attrs:{span:15}},[e("el-input",{attrs:{size:"mini",placeholder:"全部修改"},on:{change:function(e){l.skuAttr[i.property]=e}}})]),e("el-col",{attrs:{span:9}},[e("el-button",{attrs:{size:"mini",type:"success"},style:"float: right",on:{click:function(){return l.setAll(i.property)}}},["确定"])])]),e("span",{slot:"reference",style:"display: flex; justify-content:center"},[i.label,e("i",{class:"el-icon-edit"})])])},overwriteImg:function(e,t){var l=this,i=t.column;t.$index;return this.skuAttr.img?e("el-popover",{attrs:{placement:"top-start",trigger:"click"}},[e("el-row",[e("el-col",{attrs:{span:15},style:"display: flex; justify-content:center"},[e("el-upload",{props:{action:this.imgPostUrl,showFileList:!1,onSuccess:this.setAllImg}},[e("img",{attrs:{src:this.cdn+this.skuAttr.img},style:"height: 28px; width: 28px;"})])]),e("el-col",{attrs:{span:9}},[e("el-button",{attrs:{size:"mini",type:"success"},style:"float: right",on:{click:function(){return l.setAll("img")}}},["确定"])])]),e("span",{slot:"reference",style:"display: flex; justify-content:center"},[i.label,e("i",{class:"el-icon-edit"})])]):e("el-popover",{props:{placement:"top-start",trigger:"click"}},[e("el-upload",{props:{action:this.imgPostUrl,showFileList:!1,onSuccess:this.setAllImg}},[e("el-button",{slot:"trigger",attrs:{size:"mini",type:"primary"}},["选取文件"])]),e("span",{slot:"reference",style:"display: flex; justify-content:center"},[i.label,e("i",{class:"el-icon-edit"})])])},setAll:function(e){var t=this;this.formValue.sku.forEach(function(l){t.$set(l,e,t.skuAttr[e])})},setAllImg:function(e){1==e.status&&(this.skuAttr.img=e.data)}},computed:{choose1Error:function(){return!(this.sku1List.length>0&&0==this.sku2List.length)&&(this.sku1List.length>0&&this.sku2List.length>0?this.chooseSku1.length>0&&0==this.chooseSku2.length:void 0)},choose2Error:function(){return!(0==this.sku1List.length&&this.sku2List.length>0)&&(this.sku1List.length>0&&this.sku2List.length>0?0==this.chooseSku1.length&&this.chooseSku2.length>0:void 0)}},watch:{chooseSku1:function(e,t){this.buildChild()},chooseSku2:function(e,t){this.buildChild()}},components:{MDinput:i.a,tinymce:a.a}},n={render:function(){var e=this,t=e.$createElement,l=e._self._c||t;return l("div",{staticClass:"app-container",attrs:{id:"add-pro"}},[l("el-form",{ref:"fromInput",staticClass:"form-container",attrs:{inline:!0,"status-icon":"",rules:e.formRules,model:e.formValue,"label-width":"80px","label-position":"left"},nativeOn:{submit:function(e){e.preventDefault()}}},[l("el-row",[l("el-col",{staticStyle:{"margin-bottom":"22px"},attrs:{span:24}},[l("el-form-item",{attrs:{prop:"title",id:"title-item"}},[l("MDinput",{attrs:{maxlength:25},model:{value:e.formValue.title,callback:function(t){e.$set(e.formValue,"title",t)},expression:"formValue.title"}},[e._v("输入标题")])],1)],1)],1),e._v(" "),l("el-row",[l("el-col",{attrs:{span:8}},[l("el-form-item",{attrs:{label:"分类",prop:"cate_id"}},[l("el-select",{staticStyle:{width:"200px"},on:{change:e.chooseCate},model:{value:e.formValue.cate_id,callback:function(t){e.$set(e.formValue,"cate_id",t)},expression:"formValue.cate_id"}},e._l(e.cate,function(e,t){return l("el-option",{key:t,attrs:{label:e.name,value:e.id}})}))],1)],1),e._v(" "),e.haveSku?e._e():l("el-col",{attrs:{span:8}},[l("el-form-item",{attrs:{label:"库存",prop:"stock"}},[l("el-input",{staticStyle:{width:"200px"},attrs:{type:"number"},model:{value:e.formValue.stock,callback:function(t){e.$set(e.formValue,"stock",e._n(t))},expression:"formValue.stock"}})],1)],1),e._v(" "),l("el-col",{attrs:{span:8}},[l("el-form-item",{attrs:{label:"排序",prop:"sort"}},[l("el-input",{staticStyle:{width:"200px"},attrs:{type:"number"},model:{value:e.formValue.sort,callback:function(t){e.$set(e.formValue,"sort",e._n(t))},expression:"formValue.sort"}})],1)],1)],1),e._v(" "),l("el-row",[e.haveSku?e._e():l("el-col",{attrs:{span:8}},[l("el-form-item",{attrs:{label:"市场价",prop:"market_price"}},[l("el-input",{staticStyle:{width:"200px"},attrs:{type:"number"},model:{value:e.formValue.market_price,callback:function(t){e.$set(e.formValue,"market_price",e._n(t))},expression:"formValue.market_price"}})],1)],1),e._v(" "),e.haveSku?e._e():l("el-col",{attrs:{span:8}},[l("el-form-item",{attrs:{label:"售价",prop:"price"}},[l("el-input",{staticStyle:{width:"200px"},attrs:{type:"number"},model:{value:e.formValue.price,callback:function(t){e.$set(e.formValue,"price",e._n(t))},expression:"formValue.price"}})],1)],1),e._v(" "),e.haveSku?e._e():l("el-col",{attrs:{span:8}},[l("el-form-item",{attrs:{label:"售出",prop:"sales_volume"}},[l("el-input",{staticStyle:{width:"200px"},attrs:{type:"number"},model:{value:e.formValue.sales_volume,callback:function(t){e.$set(e.formValue,"sales_volume",e._n(t))},expression:"formValue.sales_volume"}})],1)],1)],1),e._v(" "),e.skuLabel.length>0?l("el-row",[e.sku1List.length>0?l("el-col",{staticStyle:{"padding-bottom":"22px"},attrs:{span:24}},[l("span",{staticClass:"diver"},[e._v("选择商品属性1\n                    "),e.choose1Error?l("div",{staticClass:"el-form-item__error"},[e._v("请继续选择属性2")]):e._e()]),e._v(" "),e._l(e.sku1List,function(t,i){return l("el-checkbox",{key:i,attrs:{label:t,border:""},model:{value:e.chooseSku1,callback:function(t){e.chooseSku1=t},expression:"chooseSku1"}},[e._v(e._s(t.name))])})],2):e._e(),e._v(" "),e.sku2List.length>0?l("el-col",{staticStyle:{"padding-bottom":"22px"},attrs:{span:24}},[l("span",{staticClass:"diver"},[e._v("选择商品属性2\n                    "),e.choose2Error?l("div",{staticClass:"el-form-item__error"},[e._v("请继续选择属性1")]):e._e()]),e._v(" "),e._l(e.sku2List,function(t,i){return l("el-checkbox",{key:i,attrs:{label:t,border:""},model:{value:e.chooseSku2,callback:function(t){e.chooseSku2=t},expression:"chooseSku2"}},[e._v(e._s(t.name))])})],2):e._e()],1):e._e(),e._v(" "),l("span",{staticClass:"diver"},[e._v("图片上传(第一张将作为默认显示)")]),e._v(" "),l("el-upload",{staticStyle:{"padding-bottom":"22px"},attrs:{action:e.imgPostUrl,multiple:!1,"list-type":"picture-card","on-preview":e.handlePictureCardPreview,"on-success":e.uploadSuccess,"on-remove":e.handleRemove,"before-remove":e.beforeRemove,limit:5}},[l("i",{staticClass:"el-icon-plus"})]),e._v(" "),l("el-row",[l("el-col",{attrs:{span:12}},[l("el-form-item",{attrs:{label:"是否上架",prop:"is_hot"}},[l("el-radio",{attrs:{label:1,border:""},model:{value:e.formValue.is_hot,callback:function(t){e.$set(e.formValue,"is_hot",e._n(t))},expression:"formValue.is_hot"}},[e._v("上架")]),e._v(" "),l("el-radio",{attrs:{label:0,border:""},model:{value:e.formValue.is_hot,callback:function(t){e.$set(e.formValue,"is_hot",e._n(t))},expression:"formValue.is_hot"}},[e._v("下架")])],1)],1),e._v(" "),l("el-col",{attrs:{span:12}},[l("el-form-item",{attrs:{label:"是否热卖",prop:"status"}},[l("el-radio",{attrs:{label:1,border:""},model:{value:e.formValue.status,callback:function(t){e.$set(e.formValue,"status",e._n(t))},expression:"formValue.status"}},[e._v("是")]),e._v(" "),l("el-radio",{attrs:{label:0,border:""},model:{value:e.formValue.status,callback:function(t){e.$set(e.formValue,"status",e._n(t))},expression:"formValue.status"}},[e._v("否")])],1)],1)],1),e._v(" "),e.formValue.sku.length>0?l("el-row",[l("span",{staticClass:"diver"},[e._v("添加商品的子属性")]),e._v(" "),l("el-col",{attrs:{span:24}},[l("el-table",{staticClass:"table-sku",attrs:{data:e.formValue.sku,border:"",fit:"","highlight-current-row":""}},[l("el-table-column",{attrs:{prop:"name",align:"center","render-header":e.overwrite,label:"属性名"},scopedSlots:e._u([{key:"default",fn:function(t){return[l("el-input",{attrs:{size:"mini"},model:{value:t.row.name,callback:function(l){e.$set(t.row,"name",l)},expression:"scope.row.name"}})]}}])}),e._v(" "),l("el-table-column",{attrs:{prop:"market_price",align:"center","render-header":e.overwrite,label:"市场价"},scopedSlots:e._u([{key:"default",fn:function(t){return[l("el-input",{attrs:{type:"number",size:"mini"},model:{value:t.row.market_price,callback:function(l){e.$set(t.row,"market_price",e._n(l))},expression:"scope.row.market_price"}})]}}])}),e._v(" "),l("el-table-column",{attrs:{prop:"price",align:"center","render-header":e.overwrite,label:"售价"},scopedSlots:e._u([{key:"default",fn:function(t){return[l("el-input",{attrs:{type:"number",size:"mini"},model:{value:t.row.price,callback:function(l){e.$set(t.row,"price",e._n(l))},expression:"scope.row.price"}})]}}])}),e._v(" "),l("el-table-column",{attrs:{prop:"stock",align:"center","render-header":e.overwrite,label:"库存"},scopedSlots:e._u([{key:"default",fn:function(t){return[l("el-input",{attrs:{type:"number",size:"mini"},model:{value:t.row.stock,callback:function(l){e.$set(t.row,"stock",e._n(l))},expression:"scope.row.stock"}})]}}])}),e._v(" "),l("el-table-column",{attrs:{prop:"sales_volume",align:"center","render-header":e.overwrite,label:"销量"},scopedSlots:e._u([{key:"default",fn:function(t){return[l("el-input",{attrs:{type:"number",size:"mini"},model:{value:t.row.sales_volume,callback:function(l){e.$set(t.row,"sales_volume",e._n(l))},expression:"scope.row.sales_volume"}})]}}])}),e._v(" "),l("el-table-column",{attrs:{prop:"img","render-header":e.overwriteImg,align:"center",label:"上传图片"},scopedSlots:e._u([{key:"default",fn:function(t){return[l("el-upload",{staticClass:"upload-img-col",attrs:{"on-success":e.skuImgUploadSuccess,"show-file-list":!1,action:e.imgPostUrl}},[t.row.img?l("img",{staticClass:"upload-img",attrs:{slot:"trigger",src:e.cdn+t.row.img,alt:""},slot:"trigger"}):l("el-button",{attrs:{slot:"trigger",size:"mini",type:"primary"},on:{click:function(l){e.skuImgUpload(t.$index)}},slot:"trigger"},[e._v("选取文件")])],1)]}}])}),e._v(" "),l("el-table-column",{attrs:{prop:"sales_volume",align:"center",label:"操作"},scopedSlots:e._u([{key:"default",fn:function(t){return[l("el-button",{attrs:{type:"warning",icon:"el-icon-close",size:"mini"},on:{click:function(l){e.deleteSku(t.$index,t.row)}}},[e._v("删除")])]}}])})],1)],1)],1):e._e(),e._v(" "),l("el-row",[l("el-col",[l("span",{staticClass:"diver"},[e._v("详细内容")]),e._v(" "),l("div",{staticClass:"editor-container"},[l("tinymce",{ref:"editor",attrs:{height:400},model:{value:e.formValue.desc,callback:function(t){e.$set(e.formValue,"desc",t)},expression:"formValue.desc"}})],1)])],1),e._v(" "),l("el-row",[l("el-col",[l("el-button",{staticStyle:{float:"right"},attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v("提交")])],1)],1)],1),e._v(" "),l("el-dialog",{attrs:{visible:e.dialogVisible},on:{"update:visible":function(t){e.dialogVisible=t}}},[l("img",{attrs:{width:"100%",src:e.dialogImageUrl,alt:""}})])],1)},staticRenderFns:[]};var u=l("VU/8")(r,n,!1,function(e){l("F9X0")},null,null);t.default=u.exports},vyK3:function(e,t){}});