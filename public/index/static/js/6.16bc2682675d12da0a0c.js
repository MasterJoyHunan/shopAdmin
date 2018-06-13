webpackJsonp([6],{"34+M":function(t,e){},P2O8:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n("Dd8w"),r=n.n(i),a=n("piuB"),s=(a.b,Number,String,String,String,String,Boolean,Function,String,Boolean,Number,String,{name:"tab",mixins:[a.b],mounted:function(){var t=this;this.$nextTick(function(){setTimeout(function(){t.hasReady=!0},0)})},props:{lineWidth:{type:Number,default:3},activeColor:String,barActiveColor:String,defaultColor:String,disabledColor:String,animate:{type:Boolean,default:!0},customBarWidth:[Function,String],preventDefault:Boolean,scrollThreshold:{type:Number,default:4},barPosition:{type:String,default:"bottom",validator:function(t){return-1!==["bottom","top"].indexOf(t)}}},computed:{barLeft:function(){if(this.hasReady){var t=this.scrollable?window.innerWidth/this.$children[this.currentIndex||0].$el.getBoundingClientRect().width:this.number;return this.currentIndex*(100/t)+"%"}},barRight:function(){if(this.hasReady){var t=this.scrollable?window.innerWidth/this.$children[this.currentIndex||0].$el.getBoundingClientRect().width:this.number;return(t-this.currentIndex-1)*(100/t)+"%"}},innerBarStyle:function(){return{width:"function"==typeof this.customBarWidth?this.customBarWidth(this.currentIndex):this.customBarWidth,backgroundColor:this.barActiveColor||this.activeColor}},barStyle:function(){var t={left:this.barLeft,right:this.barRight,display:"block",height:this.lineWidth+"px",transition:this.hasReady?null:"none"};return this.customBarWidth?t.backgroundColor="transparent":t.backgroundColor=this.barActiveColor||this.activeColor,t},barClass:function(){return{"vux-tab-ink-bar-transition-forward":"forward"===this.direction,"vux-tab-ink-bar-transition-backward":"backward"===this.direction}},scrollable:function(){return this.number>this.scrollThreshold}},watch:{currentIndex:function(t,e){this.direction=t>e?"forward":"backward",this.$emit("on-index-change",t,e),this.hasReady&&this.scrollToActiveTab()}},data:function(){return{direction:"forward",right:"100%",hasReady:!1}},methods:{scrollToActiveTab:function(){var t=this;if(this.scrollable&&this.$children&&this.$children.length){var e=this.$children[this.currentIndex].$el,n=0;window.requestAnimationFrame(function i(){var r=t.$refs.nav;r.scrollLeft+=(e.offsetLeft-(r.offsetWidth-e.offsetWidth)/2-r.scrollLeft)/15,++n<15&&window.requestAnimationFrame(i)})}}}}),o={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"vux-tab-wrap",class:"top"===t.barPosition?"vux-tab-bar-top":""},[n("div",{staticClass:"vux-tab-container"},[n("div",{ref:"nav",staticClass:"vux-tab",class:[{"vux-tab-no-animate":!t.animate},{scrollable:t.scrollable}]},[t._t("default"),t._v(" "),t.animate?n("div",{staticClass:"vux-tab-ink-bar",class:t.barClass,style:t.barStyle},[t.customBarWidth?n("span",{staticClass:"vux-tab-bar-inner",style:t.innerBarStyle}):t._e()]):t._e()],2)])])},staticRenderFns:[]};var c=n("VU/8")(s,o,!1,function(t){n("34+M")},null,null).exports,l=(a.a,String,Boolean,String,String,String,{name:"tab-item",mixins:[a.a],props:{activeClass:String,disabled:Boolean,badgeBackground:{type:String,default:"#f74c31"},badgeColor:{type:String,default:"#fff"},badgeLabel:String},computed:{style:function(){return{borderWidth:this.$parent.lineWidth+"px",borderColor:this.$parent.activeColor,color:this.currentSelected?this.$parent.activeColor:this.disabled?this.$parent.disabledColor:this.$parent.defaultColor,border:this.$parent.animate?"none":"auto"}}}}),d={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"vux-tab-item",class:[t.currentSelected?t.activeClass:"",{"vux-tab-selected":t.currentSelected,"vux-tab-disabled":t.disabled}],style:t.style,on:{click:t.onItemClick}},[t._t("default"),t._v(" "),void 0!==t.badgeLabel&&""!==t.badgeLabel?n("span",{staticClass:"vux-tab-item-badge",style:{background:t.badgeBackground,color:t.badgeColor}},[t._v("\n  "+t._s(t.badgeLabel))]):t._e()],2)},staticRenderFns:[]},u=n("VU/8")(l,d,!1,null,null,null).exports,h=n("jOlP"),f=n("/kga"),m=n("etVR"),v=n("jCps"),p=n("HulU"),b=n("NYxO"),x=(v.b,r()({itemChange:function(t){var e=this;-1!=t?(this.showList=[],this.total.map(function(n){n.status==t&&e.showList.push(n)})):this.showList=this.total},label:function(t){return{"-1":"取消订单",0:"待付款",1:"待发货",2:"待收货",3:"已完成"}[t]},handelCancel:function(t,e){var n=this;this.$vux.confirm.show({title:"警告",content:"确认取消订单",onConfirm:function(){Object(p.a)({url:"/shop/order/cancelOrder",method:"post",data:{id:t}}).then(function(t){n.total.splice(e,1)}).catch(function(t){console.log(t)})}})},handelGetOrder:function(t,e){var n=this;this.$vux.confirm.show({title:"确认收货",content:"是否确认收到货物",onConfirm:function(){Object(p.a)({url:"/shop/order/getOrder",method:"post",data:{id:t}}).then(function(t){var i=n.total[e];i.status=3,n.$set(n.total,e,i)}).catch(function(t){console.log(t)})}})},handelGetdetail:function(t){this.$router.push("/orderDetail?id="+t)},handelBeforePay:function(t,e){this.payFlag=!0,this.tempItem=t,this.tempIndex=e},handelPay:function(){var t=this;this.payFlag=!1,0!=this.checklist.length&&(2!=this.checklist[0]&&3!=this.checklist[0]?Object(p.a)({url:"/shop/order/payOrder",method:"post",data:{id:this.tempItem.id,pay_way:this.checklist[0]}}).then(function(e){t.tempItem.status=1,t.$set(t.total,t.tempIndex,t.tempItem)}).catch(function(t){console.log(t)}):this.$vux.toast.text("线上支付正在开发中"))},_getData:function(){var t=this;Object(p.a)({url:"/shop/order/index"}).then(function(e){t.showLoading=!1,e.data.length>0&&e.data.map(function(t,e){t.index=e}),t.total=e.data,t.itemChange(t.order_current_index)}).catch(function(t){console.log(t)})}},Object(b.d)({setIndex:"SET_ORDER_CURRENT_INDEX"})),r()({},Object(b.c)(["order_current_index"])),h.a,f.a,m.a,{name:"order",mixins:[v.b],data:function(){return{showLoading:!0,total:[],showList:[],cdn:"http://www.masterjoy.top/uploads/",currendIndex:-1,tempItem:{},tempIndex:0}},created:function(){this._getData()},methods:r()({itemChange:function(t){var e=this;-1!=t?(this.showList=[],this.total.map(function(n){n.status==t&&e.showList.push(n)})):this.showList=this.total},label:function(t){return{"-1":"取消订单",0:"待付款",1:"待发货",2:"待收货",3:"已完成"}[t]},handelCancel:function(t,e){var n=this;this.$vux.confirm.show({title:"警告",content:"确认取消订单",onConfirm:function(){Object(p.a)({url:"/shop/order/cancelOrder",method:"post",data:{id:t}}).then(function(t){n.total.splice(e,1)}).catch(function(t){console.log(t)})}})},handelGetOrder:function(t,e){var n=this;this.$vux.confirm.show({title:"确认收货",content:"是否确认收到货物",onConfirm:function(){Object(p.a)({url:"/shop/order/getOrder",method:"post",data:{id:t}}).then(function(t){var i=n.total[e];i.status=3,n.$set(n.total,e,i)}).catch(function(t){console.log(t)})}})},handelGetdetail:function(t){this.$router.push("/orderDetail?id="+t)},handelBeforePay:function(t,e){this.payFlag=!0,this.tempItem=t,this.tempIndex=e},handelPay:function(){var t=this;this.payFlag=!1,0!=this.checklist.length&&(2!=this.checklist[0]&&3!=this.checklist[0]?Object(p.a)({url:"/shop/order/payOrder",method:"post",data:{id:this.tempItem.id,pay_way:this.checklist[0]}}).then(function(e){t.tempItem.status=1,t.$set(t.total,t.tempIndex,t.tempItem)}).catch(function(t){console.log(t)}):this.$vux.toast.text("线上支付正在开发中"))},_getData:function(){var t=this;Object(p.a)({url:"/shop/order/index"}).then(function(e){t.showLoading=!1,e.data.length>0&&e.data.map(function(t,e){t.index=e}),t.total=e.data,t.itemChange(t.order_current_index)}).catch(function(t){console.log(t)})}},Object(b.d)({setIndex:"SET_ORDER_CURRENT_INDEX"})),computed:r()({},Object(b.c)(["order_current_index"])),watch:{total:{handler:function(t){this.itemChange(this.order_current_index)},deep:!0},order_current_index:function(t){this.itemChange(t)}},components:{Tab:c,TabItem:u,Spinner:h.a,XDialog:f.a,Checklist:m.a}}),g={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("transition",{attrs:{name:"order"}},[n("div",{attrs:{id:"order"}},[n("tab",[n("tab-item",{attrs:{selected:-1==t.order_current_index},on:{"on-item-click":function(e){t.setIndex(-1)}}},[t._v("全部")]),t._v(" "),n("tab-item",{attrs:{selected:0==t.order_current_index},on:{"on-item-click":function(e){t.setIndex(0)}}},[t._v("待付款")]),t._v(" "),n("tab-item",{attrs:{selected:1==t.order_current_index},on:{"on-item-click":function(e){t.setIndex(1)}}},[t._v("待发货")]),t._v(" "),n("tab-item",{attrs:{selected:2==t.order_current_index},on:{"on-item-click":function(e){t.setIndex(2)}}},[t._v("发货中")]),t._v(" "),n("tab-item",{attrs:{selected:3==t.order_current_index},on:{"on-item-click":function(e){t.setIndex(3)}}},[t._v("完成")])],1),t._v(" "),t.showLoading?n("div",{staticClass:"order-list loading"},[n("div",{staticClass:"loading"},[n("spinner",{attrs:{type:"bubbles",size:"40px"}}),t._v(" "),n("div",{staticClass:"text"},[t._v("加载中...")])],1)]):n("div",{staticClass:"order-list"},t._l(t.showList,function(e,i){return n("div",{key:i,staticClass:"order-item"},[n("div",{staticClass:"header"},[n("div",{staticClass:"no"},[t._v("订单编号: "+t._s(e.no))]),t._v(" "),n("div",{staticClass:"label"},[t._v(t._s(t.label(e.status)))])]),t._v(" "),t._l(e.info,function(e,i){return n("div",{key:i,staticClass:"content"},[n("div",{staticClass:"img"},[n("img",{attrs:{src:t.cdn+e.img}})]),t._v(" "),n("div",{staticClass:"text"},[n("div",{staticClass:"title"},[t._v(t._s(e.name))]),t._v(" "),e.name_ext?n("div",{staticClass:"sku"},[t._v("属性 : "+t._s(e.name_ext))]):n("div",{staticClass:"sku"},[t._v(" ")])]),t._v(" "),n("div",{staticClass:"info"},[n("div",{staticClass:"price"},[t._v(t._s(e.price))]),t._v(" "),n("div",{staticClass:"num"},[t._v("x "+t._s(e.num))])])])}),t._v(" "),n("div",{staticClass:"footer"},[t._v("\n                    共 "+t._s(e.info.length)+" 件商品      合计: ¥"+t._s(e.amount)+"\n                ")]),t._v(" "),n("div",{staticClass:"action"},[n("div",{staticClass:"btn",on:{click:function(n){t.handelGetdetail(e.id)}}},[t._v("查看订单")]),t._v(" "),0==e.status?n("div",{staticClass:"btn",on:{click:function(n){t.handelCancel(e.id,e.index)}}},[t._v("删除订单")]):t._e(),t._v(" "),0==e.status?n("div",{staticClass:"btn",on:{click:function(n){t.handelBeforePay(e,e.index)}}},[t._v("立即付款")]):t._e(),t._v(" "),2==e.status?n("div",{staticClass:"btn",on:{click:function(n){t.handelGetOrder(e.id,e.index)}}},[t._v("确认收货")]):t._e()])],2)})),t._v(" "),n("x-dialog",{attrs:{"hide-on-blur":""},model:{value:t.payFlag,callback:function(e){t.payFlag=e},expression:"payFlag"}},[n("div",{staticClass:"pay"},[n("checklist",{attrs:{"label-position":"right",required:"",options:t.options,max:1},model:{value:t.checklist,callback:function(e){t.checklist=e},expression:"checklist"}}),t._v(" "),n("div",{staticClass:"btn",on:{click:function(e){t.handelPay()}}},[t._v("确定")])],1)])],1)])},staticRenderFns:[]};var _=n("VU/8")(x,g,!1,function(t){n("hzq4")},null,null);e.default=_.exports},QJs2:function(t,e){},Vchb:function(t,e){for(var n=0,i=["webkit","moz"],r=0;r<i.length&&!window.requestAnimationFrame;++r)window.requestAnimationFrame=window[i[r]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[i[r]+"CancelAnimationFrame"]||window[i[r]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(t,e){var i=(new Date).getTime(),r=Math.max(0,16-(i-n)),a=window.setTimeout(function(){t(i+r)},r);return n=i+r,a}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(t){clearTimeout(t)})},hzq4:function(t,e){},jOlP:function(t,e,n){"use strict";n("Vchb");var i={a:"animate",an:"attributeName",at:"animateTransform",c:"circle",da:"stroke-dasharray",os:"stroke-dashoffset",f:"fill",lc:"stroke-linecap",rc:"repeatCount",sw:"stroke-width",t:"transform",v:"values"},r={v:"0,32,32;360,32,32",an:"transform",type:"rotate",rc:"indefinite",dur:"750ms"};function a(t,e,n){t.setAttribute(i[e]||e,n)}function s(t,e){var n=t.split(";"),i=n.slice(e),r=n.slice(0,n.length-i.length);return(n=i.concat(r).reverse()).join(";")+";"+n[0]}var o={sw:4,lc:"round",line:[{fn:function(t,e){return{y1:"ios"===e?17:12,y2:"ios"===e?29:20,t:"translate(32,32) rotate("+(30*t+(t<6?180:-180))+")",a:[{fn:function(){return{an:"stroke-opacity",dur:"750ms",v:s("0;.1;.15;.25;.35;.45;.55;.65;.7;.85;1",t),rc:"indefinite"}},t:1}]}},t:12}]},c={android:{c:[{sw:6,da:128,os:82,r:26,cx:32,cy:32,f:"none"}]},ios:o,"ios-small":o,bubbles:{sw:0,c:[{fn:function(t){return{cx:24*Math.cos(2*Math.PI*t/8),cy:24*Math.sin(2*Math.PI*t/8),t:"translate(32,32)",a:[{fn:function(){return{an:"r",dur:"750ms",v:s("1;2;3;4;5;6;7;8",t),rc:"indefinite"}},t:1}]}},t:8}]},circles:{c:[{fn:function(t){return{r:5,cx:24*Math.cos(2*Math.PI*t/8),cy:24*Math.sin(2*Math.PI*t/8),t:"translate(32,32)",sw:0,a:[{fn:function(){return{an:"fill-opacity",dur:"750ms",v:s(".3;.3;.3;.4;.7;.85;.9;1",t),rc:"indefinite"}},t:1}]}},t:8}]},crescent:{c:[{sw:4,da:128,os:82,r:26,cx:32,cy:32,f:"none",at:[r]}]},dots:{c:[{fn:function(t){return{cx:16+16*t,cy:32,sw:0,a:[{fn:function(){return{an:"fill-opacity",dur:"750ms",v:s(".5;.6;.8;1;.8;.6;.5",t),rc:"indefinite"}},t:1},{fn:function(){return{an:"r",dur:"750ms",v:s("4;5;6;5;4;3;3",t),rc:"indefinite"}},t:1}]}},t:3}]},lines:{sw:7,lc:"round",line:[{fn:function(t){return{x1:10+14*t,x2:10+14*t,a:[{fn:function(){return{an:"y1",dur:"750ms",v:s("16;18;28;18;16",t),rc:"indefinite"}},t:1},{fn:function(){return{an:"y2",dur:"750ms",v:s("48;44;36;46;48",t),rc:"indefinite"}},t:1},{fn:function(){return{an:"stroke-opacity",dur:"750ms",v:s("1;.8;.5;.4;1",t),rc:"indefinite"}},t:1}]}},t:4}]},ripple:{f:"none","fill-rule":"evenodd",sw:3,circle:[{fn:function(t){return{cx:32,cy:32,a:[{fn:function(){return{an:"r",begin:-1*t+"s",dur:"2s",v:"0;24",keyTimes:"0;1",keySplines:"0.1,0.2,0.3,1",calcMode:"spline",rc:"indefinite"}},t:1},{fn:function(){return{an:"stroke-opacity",begin:-1*t+"s",dur:"2s",v:".2;1;.2;0",rc:"indefinite"}},t:1}]}},t:2}]},spiral:{defs:[{linearGradient:[{id:"sGD",gradientUnits:"userSpaceOnUse",x1:55,y1:46,x2:2,y2:46,stop:[{offset:.1,class:"stop1"},{offset:1,class:"stop2"}]}]}],g:[{sw:4,lc:"round",f:"none",path:[{stroke:"url(#sGD)",d:"M4,32 c0,15,12,28,28,28c8,0,16-4,21-9"},{d:"M60,32 C60,16,47.464,4,32,4S4,16,4,32"}],at:[r]}]}},l={android:function(t){var e=this;this.stop=!1;var n,i=0,r=0,s=t.querySelector("g"),o=t.querySelector("circle");function c(){if(!e.stop){var t,l=(t=Date.now()-n,(t/=650/2)<1?.5*t*t*t:.5*((t-=2)*t*t+2)),d=1,u=0,h=188-58*l,f=182-182*l;i%2&&(d=-1,u=-64,h=128- -58*l,f=182*l);var m=[0,-101,-90,-11,-180,79,-270,-191][i];a(o,"da",Math.max(Math.min(h,188),128)),a(o,"os",Math.max(Math.min(f,182),0)),a(o,"t","scale("+d+",1) translate("+u+",0) rotate("+m+",32,32)"),(r+=4.1)>359&&(r=0),a(s,"t","rotate("+r+",32,32)"),l>=1&&(++i>7&&(i=0),n=Date.now()),window.requestAnimationFrame(c)}}return function(){return n=Date.now(),c(),e}}};var d=function(t,e,n){var r;r=e;var s=document.createElement("div");return function t(e,n,r,s,o){var c,l,d,u=document.createElement(i[e]||e);for(c in n)if("[object Array]"===Object.prototype.toString.call(n[c]))for(l=0;l<n[c].length;l++)if(n[c][l].fn)for(d=0;d<n[c][l].t;d++)t(c,n[c][l].fn(d,s),u,s);else t(c,n[c][l],u,s);else a(u,c,n[c]);o&&"28px"!==o&&a(u,"style","width: "+o+"; height: "+o),r.appendChild(u)}("svg",{viewBox:"0 0 64 64",g:[c[r]]},s,r,n),t.innerHTML=s.innerHTML,l[r]&&l[r](t)(),t},u=(String,String,["android","ios","ios-small","bubbles","circles","crescent","dots","lines","ripple","spiral"]),h={name:"spinner",mounted:function(){var t=this;this.$nextTick(function(){d(t.$el,t.type,t.size)})},props:{type:{type:String,default:"ios"},size:String},computed:{styles:function(){if(void 0!==this.size&&"28px"!==this.size)return{width:this.size,height:this.size}},className:function(){for(var t={},e=0;e<u.length;e++)t["vux-spinner-"+u[e]]=this.type===u[e];return t}}},f={render:function(){var t=this.$createElement;return(this._self._c||t)("span",{staticClass:"vux-spinner",class:this.className,style:this.styles})},staticRenderFns:[]};var m=n("VU/8")(h,f,!1,function(t){n("QJs2")},null,null);e.a=m.exports},piuB:function(t,e,n){"use strict";n.d(e,"b",function(){return r}),n.d(e,"a",function(){return a});var i=n("0FxO"),r={mounted:function(){this.value>=0&&(this.currentIndex=this.value),this.updateIndex()},methods:{updateIndex:function(){if(this.$children&&this.$children.length){this.number=this.$children.length;for(var t=this.$children,e=0;e<t.length;e++)t[e].currentIndex=e,t[e].currentSelected&&(this.index=e)}}},props:{value:Number},watch:{currentIndex:function(t,e){e>-1&&this.$children[e]&&(this.$children[e].currentSelected=!1),t>-1&&this.$children[t]&&(this.$children[t].currentSelected=!0),this.$emit("input",t),this.$emit("on-index-change",t,e)},index:function(t){this.currentIndex=t},value:function(t){this.index=t}},data:function(){return{index:-1,currentIndex:this.index,number:this.$children.length}}},a={props:{selected:{type:Boolean,default:!1}},mounted:function(){this.$parent.updateIndex()},beforeDestroy:function(){var t=this.$parent;this.$nextTick(function(){t.updateIndex()})},methods:{onItemClick:function(t){var e=this;this.$parent.preventDefault?this.$parent.$emit("on-before-index-change",this.currentIndex):(void 0!==this.disabled&&!1!==this.disabled||(this.currentSelected=!0,this.$parent.currentIndex=this.currentIndex,this.$nextTick(function(){e.$emit("on-item-click",e.currentIndex)})),!0===t&&Object(i.a)(this.link,this.$router))}},watch:{currentSelected:function(t){t&&(this.$parent.index=this.currentIndex)},selected:function(t){this.currentSelected=t}},data:function(){return{currentIndex:-1,currentSelected:this.selected}}}}});