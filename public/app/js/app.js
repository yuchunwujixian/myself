! function() {
	/**
	 * @constructor
	 * @description 入口方法
	 * @example
	 * $("#id")||$(fun)
	 */	
	var pc = function() {
			var p = arguments;
			if (typeof p[0] == 'function') {
				var callback = p[0];
				//加载
				window.onload = function() {
					mui.init({
						gestureConfig: {
							tap: true, //默认为true
							doubletap: false, //默认为false
							longtap: false, //默认为false
							swipe: true, //默认为true
							drag: true, //默认为true
							hold: false, //默认为false，不监听
							release: false //默认为false，不监听
						},
						pullRefresh : {
						  	container:"#refreshContainer",//待刷新区域标识，querySelector能定位的css选择器均可，比如：id、.class等
							down: {
								style:'circle',
								callback: function(){
									window.RefreshType='down';
									if(mui.os.plus){
										var _webview=plus.webview.currentWebview();
										mui.fire(_webview,"RefreshDown");										
									}else{
										// 创建
										var evt = document.createEvent("HTMLEvents");
										// 初始化
										evt.initEvent("RefreshDown", false, false);
										// 触发, 即弹出文字
										setTimeout(function(){
											window.dispatchEvent(evt);
										},0);									
									}
								}
							},
							up: {
								auto:true,
								contentrefresh: '正在加载...',
								callback: function(){
									window.RefreshType='up';
									if(mui.os.plus){
							      		var _webview=plus.webview.currentWebview();
							      		mui.fire(_webview,"RefreshUp");											
									}else{
										// 创建
										var evt = document.createEvent("HTMLEvents");
										evt.initEvent("RefreshUp", false, false);
										//注册异步事件
										setTimeout(function(){
											window.dispatchEvent(evt);
										},0);
									}
								}
							}
						 },						
						//后退刷新
						beforeback: function(){
							if(mui.os.plus){
								//获得列表界面的webview
								var list = plus.webview.all();
								if(!list[list.length-2]){
									return false;
								}
								var _webview=plus.webview.getWebviewById(list[list.length-2].id);
								//触发列表界面的自定义事件（refresh）,从而进行数据刷新
								mui.fire(_webview,'refresh');
								//返回true，继续页面关闭逻辑								
							}
							return true;
						}						
					});
					if(mui.os.plus){
						mui.plusReady(function(){
							pc.ready();
							//沉浸式导航
							if(plus.navigator.isImmersedStatusbar()){
								var t=mui('.mui-bar-nav')[0];
								if(t){
									var h=plus.navigator.getStatusbarHeight();
									t.style.paddingTop=h+'px';
									t.style.height=44+h+'px';
									var c=mui('.mui-content')[0];
									c.style.paddingTop=44+h+'px';
								}
							}
							callback();								
						})
					}else{
						pc.ready();
						callback();						
					}
				}
			} else if (typeof p[0] == 'string') {
				//返回选择器对象
				var obj = new pc();
				obj.__proto__.__select = p[0];
				obj.__proto__.__mui = mui(p[0]);
				//mui对象
				obj.mui = mui(p[0]);
				//document对象
				obj.document = obj.mui[0];
				return obj;
			} else if (typeof p[0] == 'object') {
				//返回选择器对象
				var obj = new pc();
				obj.__proto__.__select = '鬼知道是什么';
				obj.__proto__.__mui = mui(p[0]);
				//mui对象
				obj.mui = mui(p[0]);
				//document对象
				obj.document = obj.mui[0];
				return obj;
			}
		}
		//配置
	pc.config={debug:false};		//调试模式
	pc.config.url=(function(){
		return pc.config.debug?'http://192.168.2.247/zhuangshi/public/api':'http://demo1.atmomo.cn/api';
	})();
	/*****************************方法***************************/
	//加载事件
	pc.ready = function() {
		//滑动关闭
//		mui("body").on('swiperight','.mui-content',function(event){
//			mui.back();
//			event.stopPropagation();
//		})
		//a标签处理
		mui('body').on('click', 'a', function(event) {
			event.preventDefault();
		});
		//tap事件
		mui('body').on('tap', 'a', function() {
			var jump = this.getAttribute('data-jump'); //打开页面
			var url = this.getAttribute('href'); //链接
			var fun = this.getAttribute('data-fun'); //调用函数
			if (jump) {
				var data = this.getAttribute('data-obj') ? this.getAttribute('data-obj') : {};
				if(typeof data=="string"){
					data=JSON.parse(data);
				}
				var login = this.getAttribute('data-login');
				if (login && !pc.data('token')) {
					//打开登录页面
					mui.toast("请登录");
					pc.open(login, data);
					return false;
				}
				//如果是底部导航栏打开，则不使用动画
				if(this.classList.contains('mui-tab-item')){
					pc.open(url, data,true,false);
					return false;
				}else{
					pc.open(url, data);	
					return false;
				}
			}
			if (fun) {
				var data = this.getAttribute('data-obj') ? this.getAttribute('data-obj') : {};
				eval('pc.' + fun + '(' + data + ')');
			}
			//如果是底部导航栏打开，则阻止继续执行
			if(this.classList.contains('mui-tab-item')){
				return false;	
			}
		});

	};
	/*
	* @constructor
	* @description get请求
	* @example
	* $(url,{},fn)
	*/
	pc.get = function() {
		if(mui.os.plus){
			//加载动画
			plus.nativeUI.showWaiting("正在加载...", {
				padlock: false
			});			
		}
		//处理请求参数
		if (typeof arguments[1] == 'object') {
			var data = arguments[1];
			var callback = arguments[2];
		} else {
			if (typeof arguments[1] == "function") {
				var data = {};
				var callback = arguments[1];
			} else {
				var data = arguments[1] ? arguments[1] : {};
				var callback = arguments[2];
			}
		}
		//token处理
		data.token = pc.data('token');
		var url = pc.config.url + arguments[0];
		//打印地址和参数
		pc.log("url:" + url + ":" + JSON.stringify(data));
		mui.ajax(url, {
			data: data,
			dataType: 'json',
			timeout: 10000,
			type: 'get',
			success: function(data) {
				if(mui.os.plus){
					//结束加载动画
					plus.nativeUI.closeWaiting();
				}
				//处理登录失效信息
				if(data.status==-1){
					$.msg('登录信息已失效，请重新登录');
					$.data('token',"");
					if(mui.os.plus){
						plus.webview.close();
					}
					pc.open('login.html');
				}
				//回调
				callback(data);
			},
			error: function(xhr, type, errorThrown) {
				//结束加载动画
				if(mui.os.plus){
					plus.nativeUI.closeWaiting();	
				}
				$.log(xhr);
				pc.log('异常类型:'+type+";异常码:"+errorThrown+";返回内容:"+xhr);
				mui.toast("系统异常");
			}
		});
	};
	//post
	pc.post = function() {
		//加载动画
//		plus.nativeUI.showWaiting("请求中...", {
//			padlock: false
//		});
		var callback = arguments[2];
		var url = pc.config.url + arguments[0];
		var data = arguments[1];
		data.token = pc.data('token');
		pc.log("url:" + url + ":" + JSON.stringify(data));
		mui.ajax(url, {
			data: data,
			dataType: 'json',
			timeout: 10000,
			type: 'post',
			success: function(data) {
				//结束加载动画
//				plus.nativeUI.closeWaiting();
				//处理登录失效信息
				if(data.status==-1){
					$.msg('登录信息已失效，请重新登录');
					$.data('token',"");
					if(mui.os.plus){
						plus.webview.close();
					}					
					pc.open('login.html');
				}	
				//回调
				callback(data);
			},
			error: function(xhr, type, errorThrown) {
				//结束加载动画
				if(mui.os.plus){
					plus.nativeUI.closeWaiting();	
				}			
				pc.log('异常类型:'+type+";异常码:"+errorThrown+";返回内容:"+JSON.stringify(xhr));
				mui.toast("系统异常");
			}
		});
	};
	//log
	pc.log = function() {
		if (pc.config.debug) {
			if (typeof arguments[0] == "object") {
				console.log(JSON.stringify(arguments[0]));
			} else {
				console.log(arguments[0]);
			}
		}
	};
	//打开页面
	pc.open = function() {
		if (typeof arguments[1] == "string") {
			arguments[1] = JSON.parse(arguments[1]);
		}
		var createNew=arguments[2]===false?false:true;
		var aniShow=arguments[3]===false?false:'slide-in-right';
		// 处理id
		var id=arguments[0];
		if(arguments[0].indexOf('/')>-1){
			var urls=arguments[0].split("/");
			var id=urls[urls.length-1];
		}
		//不是手机环境则记录参数
		if(!mui.os.plus){
			pc.data('_args',arguments[1]);
		}		
		mui.openWindow({
			id:id,
			url: arguments[0],
			extras: arguments[1],
			createNew: createNew,
			show:{
				aniShow:aniShow
			},
			waiting: {
				autoShow: false,
				title: '正在加载...', //等待对话框上显示的提示内容
			}
		});
		return false;
	};
	//渲染模版[使用arttemplate渲染]
	pc.tpl = function() {
		var data = arguments[0].data;
		var tpl_id = arguments[1];
		var id = arguments[2];
		var status = arguments[3] ? arguments[3] : 0;
		var p = arguments[4];
		var html = (p > 1) ? document.getElementById(id).innerHTML + template(tpl_id, data) : template(tpl_id, data);
		document.getElementById(id).innerHTML = html;
		if (!status) {
			//pc.ready(1);
		}
		if (!p) {
			mui('.mui-scroll-wrapper').scroll();
		}
	};
	//渲染模版[使用vue渲染],return:vue对象
	pc.vue=function(){
		var tpl = arguments[0];
		
		var data = arguments[1]?arguments[1].data:{};
		//注入数据
		if(data){
			data.config=pc.config
		}
		var option={
			el: tpl,
			data:data,
			methods:{
				open:function(e,data){
					var url=pc(e.currentTarget).attr('href');
					var login=pc(e.currentTarget).data('login');
					var back=pc(e.currentTarget).data('back');
					if (login && !pc.data('token')) {
						if(back){
							$.data('back',{
								url:back,
								data:data
							});
						}
						mui.toast("请登录");
						url = login;
					}
					pc.open(url,data);
					return false;
				}
			},
			filters:{
				date:function(value,fmt){
					return $.date(fmt,new Date(value.replace(/-/g, "/")));
				}
			}
		}
		//是否有附加数据
		if(arguments[2]){
			option=mui.extend(option,arguments[2]);
		}
		return new Vue(option);
	}
	pc.scroll=function(){
		mui('.mui-scroll-wrapper').scroll();
	}
	pc.PopPicker=function(map){
		return new mui.PopPicker(map);
	}
	//on绑定批量事件
	pc.on = function() {
		var callback = arguments[3];
		mui(arguments[0]).on(arguments[2], arguments[1], function() {
			callback.call(this);
		});
	};
	//off取消绑定事件
	pc.off = function() {
			mui(arguments[0]).off(arguments[2], arguments[1]);
		}
		//获取值
	pc.val = function() {
		var val = mui(arguments[0])[0].value;
		var length = arguments.length;
		if (length == 4) {
			if (!val) {
				mui.toast(arguments[1]);
				throw arguments[1];
			}
			if (!new RegExp(arguments[2]).test(val)) {
				pc.msg(val);
				//				mui.toast(arguments[3]);
				throw arguments[3];
			}
		} else if (length == 2 && !val) {
			mui.toast(arguments[1]);
			throw arguments[1];
		}
		return val;
	};
	//获取上页传递数据
	pc.args = function() {
		if(mui.os.plus){
			return plus.webview.currentWebview();	
		}else{
			var args=pc.data('_args');
			return JSON.parse(args);
		}
	};
	//上拉刷新，下拉加载
	pc.refresh = function(elem, fn) {
		mui(elem).pullRefresh({
			up: {
				callback: function() {
					setTimeout(function() {
						fn(mui(elem).pullRefresh(), "up");
					}, 1000);
				}
			},
			down: {
				callback: function() {
					setTimeout(function() {
						fn(mui(elem).pullRefresh(), "down");
					}, 1000);
				}
			}
		});
		return mui(elem).pullRefresh();
	};
	//storage本地数据保存
	pc.data = function(key, value) {
		if(!key){
			return false;
		}
		if(mui.os.plus){
			if (!value && arguments.length == 1) {
				return plus.storage.getItem(key);
			} else if (!value && arguments.length == 2) {
				plus.storage.removeItem(key);
			} else {
				if (typeof value == 'number') value = new String(value);
				if(typeof value =='object') value=JSON.stringify(value);
				plus.storage.setItem(key, value);
			}
		}else{
			if (!value && arguments.length == 1) {
				return window.localStorage[key];
			} else if (!value && arguments.length == 2) {
				window.localStorage[key]="";
			}else{
				if (typeof value == 'number') value = new String(value);
				if(typeof value =='object') value=JSON.stringify(value);
				window.localStorage[key]=value;
			}
		}
	};
	//弹出框
	pc.alert=function(){
		mui.alert(arguments[0]);
	}
	//提示框
	pc.msg = function() {
		mui.toast(arguments[0]);
	};
	//刷新页面
	pc.reload = function() {
		if(mui.os.plus){
			//刷新指定页面
			if(arguments[0]){
				if(plus.webview.getWebviewById(arguments[0])){
					plus.webview.getWebviewById(arguments[0]).reload();	
				}
			}else{
				plus.webview.currentWebview().reload(); //5+api刷新	
			}
		}else{
			window.location.reload();
		}
	};
	pc.call = function(number) {
		if (plus.os.name == "Android") {
			var Intent = plus.android.importClass("android.content.Intent");
			var Uri = plus.android.importClass("android.net.Uri");
			var main = plus.android.runtimeMainActivity();
			var uri = Uri.parse("tel:" + number);
			var call = new Intent("android.intent.action.CALL", uri);
			main.startActivity(call);
		} else {
			var UIAPP = plus.ios.importClass("UIApplication");
			var NSURL = plus.ios.importClass("NSURL");
			var app = UIAPP.sharedApplication();
			app.openURL(NSURL.URLWithString("tel://" + number));
		}
	};
	//图片轮播
	pc.slider = function() {
		var items = mui(".mui-slider .mui-slider-group .mui-slider-item");
		if (items.length > 0) {
			var is_loop=arguments[1]===false ? false : true;
			if(is_loop){
				pc(".mui-slider .mui-slider-group").append('<div class="mui-slider-item mui-slider-item-duplicate">' + items[0].innerHTML + '</div>');
				pc(".mui-slider .mui-slider-group").prepend('<div class="mui-slider-item mui-slider-item-duplicate">' + items[items.length - 1].innerHTML + '</div>');			
			}
			var time = arguments[0] ? arguments[0] : 3000;
			if(arguments[0]===0){
				time=0;
			}
			var gallery = mui('.mui-slider');
			gallery.slider({
				interval: time //自动轮播周期，若为0则不自动播放，默认为0；
			});
		}
	};
	//获取地理位置
	pc.getLocation = function(fn) {
		try {
			//提示框
			plus.nativeUI.showWaiting("正在获取地理位置...", {
				padlock: false
			});
			//获取地理坐标信息
			var localstreet = plus.storage.getItem("localstreet"); //取出信息
			plus.geolocation.getCurrentPosition(function(position) {
				var codns = position.coords;
				var geoc = new BMap.Geocoder();
				var pt = new BMap.Point(codns.longitude, codns.latitude);
				//获取城市信息
				geoc.getLocation(pt, function(rs) {
					var addComp = rs.addressComponents;
					var lo = addComp.city + "," + addComp.district + "," + addComp.street + "," + addComp.streetNumber;
					var data = {};
					if (addComp.street != localstreet) {
						mui.confirm('发现地址变化，当前为：' + lo + '\r\n是否切换？', '位置变更', ['是', '否'], function(e) {
							if (e.index == 0) {
								//写入本地存储
								plus.storage.setItem("lng", codns.longitude.toString()); //html5+的storage不支持保存数字，需要转为字符串
								plus.storage.setItem("lat", codns.latitude.toString());
								plus.storage.setItem("localstreet", addComp.street);
								plus.storage.setItem("localdistrict", addComp.district);
								plus.storage.setItem("localcity", addComp.city);
								plus.storage.setItem("localall", lo);
								data.lng = codns.longitude.toString();
								data.lat = codns.latitude.toString();
								data.localdistrict = addComp.district;
								data.localcity = addComp.city;
								data.localstreet=addComp.street;
								data.localall = lo;
							} else {
								data.lng = plus.storage.getItem("lng");
								data.lat = plus.storage.getItem("lat");
								data.localdistrict = plus.storage.getItem("localdistrict");
								data.localcity = plus.storage.getItem("localcity");
								data.localall = plus.storage.getItem("localall");
								data.localstreet = plus.storage.getItem("localstreet");
							}
							fn(data);
						})
					} else {
						data.lng = plus.storage.getItem("lng");
						data.lat = plus.storage.getItem("lat");
						data.localdistrict = plus.storage.getItem("localdistrict");
						data.localcity = plus.storage.getItem("localcity");
						data.localall = plus.storage.getItem("localall");
						data.localstreet = plus.storage.getItem("localstreet");
						fn(data);
					}
					plus.nativeUI.closeWaiting();
				});
			}, function(e) {
				alert("获取定位位置信息失败：" + e.message);
				plus.nativeUI.closeWaiting();
			}, {
				provider: 'baidu'
			});
		} catch (e) {
			alert(e.message);
			plus.nativeUI.closeWaiting(); //处理异常并关闭等待动画
		}
	};
	pc.gallery = function(fn) {
		var f1 = null;
		plus.gallery.pick(function(path) {
			//处理图片
			var img = new Image();
			img.src = path; // 传过来的图片
			GetBase64Code(path,fn);
			function GetBase64Code(path,fn){
			        var bitmap = new plus.nativeObj.Bitmap("test"); //test标识谁便取
			        var pics=[];
			        // 从本地加载Bitmap图片
			        bitmap.load(path,function(){
			            var base4=bitmap.toBase64Data();
			            var datastr=base4.split(',',3)
			            if(datastr.length>1)
			            {
			               pics.push(datastr[1]);
			            }else
			            {
			               pics.push(datastr[0]);
			            }
			            fn(base4);
			        },function(e){
			            console.log('加载图片失败：'+JSON.stringify(e));
			        });
			}	
//			
//			//图片处理
//			img.onload = function() {
//				var that = this;
//				//生成比例 
//				w = obj.width || 200;
//				h = obj.height || 200;
//				//生成canvas
//				var canvas = document.createElement('canvas');
//				var ctx = canvas.getContext('2d');
//				$(canvas).attr({
//					width: w,
//					height: h
//				});
//				ctx.drawImage(that, 0, 0, w, h);
//				f1 = canvas.toDataURL('image/jpeg', 1 || 0.8);
//				//回调
//				fn(f1);
//			}
		});
	};
	pc.update = function(url, src) {
			var src = src ? src : "../manifest.json";
			//获取本地版本号
			mui.getJSON(src, function(data) {
				var v = data.version.name;
				//获取网络版本号
				pc.get(url, function(info) {
					plus.storage.setItem('update_date', 'update_date:' + new Date().getDate());
					if (info.data.version != v) {
						mui.confirm('发现新版本' + info.data.version + '，是否打开浏览器下载更新？', '更新确认', ['是', '否'], function(e) {
							if (e.index == 0) {
								var url = mui.os.android ? info.data.apk : info.data.ios;
								plus.runtime.openURL(url);
							} else {
								mui.toast('取消更新');
							}
						});
					} else {
						mui.toast('已经是最新版本了');
					}
				});
			});
		}
		//获取推送使用的APP信息
	pc.getClientInfo = function() {
			var info = plus.push.getClientInfo();
			if (arguments.length == 1) {
				return info[arguments[0]];
			} else {
				return info;
			}
		}
	pc.confirm=function(){
		mui.confirm(arguments[0],arguments[1],arguments[2],arguments[3]);
	}
	pc.back=function(){
		mui.back();
	}
		//创建悬浮窗口
	pc.floatWebview=function (url){
		var floatw=null;
		// 避免快速多次点击创建多个窗口
		if(floatw){
			return;
		}
		//创建悬浮窗口
		floatw=plus.webview.create(url,"webview_float.html",{margin:"auto",scrollIndicator:'none',scalable:false,popGesture:'none'});
		//淡入效果
		floatw.addEventListener("loaded",function(){
			floatw.show('fade-in',300);
			floatw=null;
		},false);
		//监听maskClick
		floatw.addEventListener("maskClick",function(){
		    plus.webview.close(plus.webview.getWebviewById('webview_float.html'));
		},false);
	}	
	pc.inArray=function(needle, haystack) {
	    var length = haystack.length;
	    for(var i = 0; i < length; i++) {
	        if(haystack[i] == needle) return true;
	    }
	    return false;
	}
	pc.date=function(fmt,date){
	    var o = { 
	    	"Y+" : date.getFullYear(),				  //年份
	        "M+" : date.getMonth()+1,                 //月份 
	        "d+" : date.getDate(),                    //日 
	        "h+" : date.getHours(),                   //小时 
	        "m+" : date.getMinutes(),                 //分 
	        "s+" : date.getSeconds(),                 //秒 
	        "q+" : Math.floor((date.getMonth()+3)/3), //季度 
	        "S"  : date.getMilliseconds()             //毫秒 
	    }; 
	    if(/(y+)/.test(fmt)) {
	            fmt=fmt.replace(RegExp.$1, (date.getFullYear()+"").substr(4 - RegExp.$1.length)); 
	    }
	     for(var k in o) {
	        if(new RegExp("("+ k +")").test(fmt)){
	             fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
	         }
	     }
	    return fmt;
	}
	//支付
	pc.pay = function(url,fn,type) {
		//支付地址
		var channel = null;
		var channels = null;		
		// 获取支付通道
		plus.payment.getChannels(function(channels) {
			//检测支付通道
			pc.log(channels);
			var is_pay=false;
			for( var i in channels){
				if(channels[i].id==type&&!channels[i].serviceReady){
					$.msg('系统未安装“'+channels[i].description+'”服务，无法完成支付')
					return false;
				}
				if(type==channels[i].id){
					is_pay=true;
					break;
				}
			}
			if(!is_pay){
				pc.msg('手机暂不支持该支付方式');
				return false;
			}
			channel=channels[i];
			//从服务器请求支付
			var xhr = new XMLHttpRequest();
			url=pc.config.url+url;
			//发送请求
			pc.log('支付请求地址'+url);
			xhr.onreadystatechange = function() {
				switch (xhr.readyState) {
					case 4:
						if (xhr.status == 200) {
							pc.log(xhr.responseText);
							plus.payment.request(channel, xhr.responseText, function(result) {
								var data = {
									status: 1,
									msg: "支付成功"
								};
								fn(data);
							}, function(error) {
								//pc.log(error);
								var data = {
									status: error.code,
									msg: "支付失败"
								};
								fn(data);
							});
						} else {
							var data = {
								status: 0,
								msg: "获取订单信息失败"
							};
							fn(data);
						}
						break;
				}
			}
			xhr.open('GET', url);
			xhr.send();			
		}, function(e) {
			pc.msg("获取支付通道失败：" + e.message);
		});
	}	
		/*****************************原型***************************/
		//绑定
	pc.prototype.on = function(action, callback) {
		mui(document).on(action, pc.prototype.__select, callback);
	};
	//取消绑定
	pc.prototype.off = function(action) {
			mui(document).off(action, pc.prototype.__select);
		}
		//检测是否含有类名
	pc.prototype.hasClass = function() {
		return pc.prototype.__mui[0].classList.contains(arguments[0]);
	};
	//添加css类
	pc.prototype.addClass = function() {
		pc.prototype.__mui[0].classList.add(arguments[0]);
	};
	//移除css类
	pc.prototype.removeClass = function() {
		pc.prototype.__mui[0].classList.remove(arguments[0]);
	};
	//value操作
	pc.prototype.val = function() {
		if (arguments.length == 0) {
			if(!pc.prototype.__mui[0])return false;
			return pc.prototype.__mui[0].value;
		} else if (arguments.length == 1) {
			pc.prototype.__mui[0].value = arguments[0];
		}
	};
	//在被选元素前插入html
	pc.prototype.prepend = function() {
			pc.prototype.__mui[0].innerHTML = arguments[0] + pc.prototype.__mui[0].innerHTML;
		}
		//html操作
	pc.prototype.html = function() {
		if (arguments.length == 0) {
			return pc.prototype.__mui[0].innerHTML;
		} else if (arguments.length == 1) {
			pc.prototype.__mui[0].innerHTML = arguments[0];
		}
	};
	//在被选元素后插入html
	pc.prototype.append = function() {
			pc.prototype.__mui[0].innerHTML = pc.prototype.__mui[0].innerHTML + arguments[0];
		}
		//attr操作
	pc.prototype.attr = function() {
		if (arguments.length == 1) {
			return pc.prototype.__mui[0].getAttribute(arguments[0]);
		} else if (arguments.length == 2) {
			pc.prototype.__mui[0].setAttribute(arguments[0], arguments[1]);
		}
	};
	//removeAttr
	pc.prototype.removeAttr=function(){
		pc.prototype.__mui[0].removeAttribute(arguments[0]);
	}
	pc.prototype.hide = function() {
		pc.prototype.__mui[0].style.display = "none";
	}
	pc.prototype.show = function() {
			pc.prototype.__mui[0].style.display = "inline";
		}
		//height操作
	pc.prototype.height = function() {
		if (arguments.length == 0) {
			return pc.prototype.__mui[0].offsetHeight;
		} else if (arguments.length == 1) {
			pc.prototype.__mui[0].style.height = arguments[0] + "px";
		}
	};
	//width
	pc.prototype.width = function() {
		if (arguments.length == 0) {
			return pc.prototype.__mui[0].offsetWidth;
		} else if (arguments.length == 1) {
			pc.prototype.__mui[0].style.width = arguments[0] + "px";
		}
	};
	//css
	pc.prototype.css = function() {
		var property = arguments[0];
		if (arguments.length == 1) {
			return document.defaultView.getComputedStyle(pc.prototype.__mui[0])[property];
		} else if (arguments.length == 2) {
			var value = arguments[1];
			pc.prototype.__mui.each(function() {
				this.style[property] = value;
			});
		}
	};
	//data
	pc.prototype.data = function() {
		var p = arguments;
		switch (p.length) {
			case 1:
				var d = pc.prototype.__mui[0].getAttribute('data-' + p[0]);
				return (parseInt(d) == d && d.length == String(parseInt(d)).length) ? parseInt(pc.prototype.__mui[0].getAttribute('data-' + p[0])) : pc.prototype.__mui[0].getAttribute('data-' + p[0]);
				break;
			case 2:
				pc.prototype.__mui[0].setAttribute('data-' + p[0], p[1]);
				break;
			default:
				throw 'Invalid arguments of Function data';
				break;
		}
	};
	pc.prototype.each = function() {
			pc.prototype.__mui.each(arguments[0]);
		}
		//
	pc.prototype.popover = function() {
		pc.prototype.__mui.popover('toggle');
	}
	pc.prototype.scroll=function(option){
		return mui(pc.prototype.__select).scroll(option);
	}
	window.pc = pc;
	window.$ = pc;
}();