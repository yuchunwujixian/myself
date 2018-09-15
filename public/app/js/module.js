var module = {};

/*
 * 首页
 */
module.index = function() {
	var vm=$.vue("#content",{
		data:{
			info:{}
		}
	},{
		mounted:function(){
			this.get();
		},
		methods:{
			get:function(){
				var self=this;
				$.get('/app',function(res){
					$.log(res);
					self.info=res.data;
					if(window.RefreshType=='down'){
						mui('#refreshContainer').pullRefresh().endPulldown();
					}
				});
			},
			open:function(e,data){
				var url=$(e.currentTarget).attr('href');
				$.open(url,data);
			}
		},
		updated:function(){
			$.slider();
		}
	});
	$("#search").on("keypress",function(e){
		var keycode = e.keyCode;
		var keyword=$(this).val();
		$.log(keyword);
		if(keycode==13){
			$.open('goods.html',{keyword:keyword});
		}
	})
	//下拉刷新
	window.addEventListener('RefreshDown',function(event){
		vm.get();
	});	
	//沉浸式导航栏
	if(mui.os.plus&&plus.navigator.isImmersedStatusbar()){
		var t=document.getElementById('search_box');
		var h=plus.navigator.getStatusbarHeight();
		t.style.marginTop=h+'px';
	}
}

/*
* 分类页面 
*/
module.category=function(){
	var args=$.args();
	if(!args.category_id||args.category_id=='undefined'||args.category_id=='null'){
		args.category_id=0;
	}
	var vm = $.vue("#content", {
		data:{
			info:{},
			contentTops:[],
			goods:{},
			disabled:true,
			spec:[],
			sku_id:0,
			cart_num:0,
			check:{},
			sku_number:1
		}
	},{
		mounted:function(){
			this.get();
		},
		updated:function(){
			this.scroll();
		},
		methods:{
			get:function(){
				var self=this;
				$.get('/goods/category',{category_id:args.category_id},function(res){
					self.info=res.data;
				})
			},
			open:function(e,data){
				var url=$(e.currentTarget).attr('href');
				$.open(url,data);
			},
			open_cart:function(){
				$.open('cart.html');
			},
			setCategory:function(category_id){
				args.category_id=category_id;
				this.get();
			},
			addcart:function(goods){
				if($.data('cart')){
					var cart=JSON.parse($.data('cart'));
					this.cart_num=cart.length;
					console.log(cart)
				}
				var self = this;
				$.get('/goods/detail', {
					goods_id: goods.goods_id
				}, function(res) {
					//初始化
					self.disabled=true;
					self.spec=[];
					self.check={};
					console.log(self.spec)
					$.log(res);
					self.goods= res.data.info;
					//检测是否存在规格列表
					if(self.goods.sku.length<1){
						$.msg("该商品暂时无法预订");
						return false;
					}
					$("#cart-popover").popover();
				})
			},
			close:function(){
				$("#cart-popover").popover();
			},
			setSpec:function(key,value){
				this.spec[key]=value;
				console.log(this.spec)
				var arr = [];
				for(var i in this.spec){
					arr.push(this.spec[i]);
				}
				//检测是否选中完毕
				if(arr.length==this.goods.spec_array.length){
					this.disabled=false;
				}
				//获取价格信息
				var spec=[];
				var spec_value="";
				for(var i in this.spec){
					spec.push(this.spec[i]);
				}
				spec_value=spec.join(';');
				if(this.goods.sku_data[spec_value]){
					var sku=this.goods.sku_data[spec_value];
					if(sku.image){
						this.goods.picture=sku.image;
					}
					if(parseFloat(sku.price)<=0||parseFloat(sku.stock)<=0){
						this.disabled=true;
						return false;
					}
					this.goods.price=sku.price;
					this.sku_id=sku.sku_id;
				}				
			},
			confirm:function(){
				if(!this.sku_id){
					$.msg('商品规格不存在');
					return false;
				}
				// 写入购物车
				var cart = [];
				if($.data('cart')) {
					cart = JSON.parse($.data('cart'));
				}
				cart.push(this.sku_id);
				$.data('cart', this.unique(cart));
				// 写入数量
				var sku_num={};
				if($.data('sku_num')) {
					sku_num = JSON.parse($.data('sku_num'));
				}
				sku_num[this.sku_id]=this.sku_number;
				$.data('sku_num', sku_num);

				$.msg('添加成功');
				$("#cart-popover").popover();
			},
			unique:function(array){
				var n = []; 
				for(var i = 0; i < array.length; i++){ 
					if (n.indexOf(array[i]) == -1) n.push(array[i]); 
				} 
				return n; 				
			},
			plus:function(){
				this.sku_number++;
			},
			min:function(){
				if(this.sku_number>1){
					this.sku_number--;
				}
			},
			scrollTo:function(index){
				var contentsElem = document.getElementById("segmentedControlContents");
				contentsElem.scrollTop = this.contentTops[index];
			},
			scroll:function(){
				var controlsElem = document.getElementById("segmentedControls");
				var contentsElem = document.getElementById("segmentedControlContents");
				var controlListElem = controlsElem.querySelectorAll('.mui-control-item');
				var contentListElem = contentsElem.querySelectorAll('.mui-control-content');
				var controlWrapperElem = controlsElem.parentNode;
				var controlWrapperHeight = controlWrapperElem.offsetHeight;
				var controlMaxScroll = controlWrapperElem.scrollHeight - controlWrapperHeight;//左侧类别最大可滚动高度
				var maxScroll = contentsElem.scrollHeight - contentsElem.offsetHeight;//右侧内容最大可滚动高度
				var controlHeight = controlListElem[0].offsetHeight;//左侧类别每一项的高度
				var controlTops = []; //存储control的scrollTop值
				var contentTops = [0]; //存储content的scrollTop值
				var length = contentListElem.length;
				for (var i = 0; i < length; i++) {
					controlTops.push(controlListElem[i].offsetTop + controlHeight);
				}
				for (var i = 1; i < length; i++) {
					var offsetTop = contentListElem[i].offsetTop;
					if (offsetTop + 100 >= maxScroll) {
						var height = Math.max(offsetTop + 100 - maxScroll, 100);
						var totalHeight = 0;
						var heights = [];
						for (var j = i; j < length; j++) {
							var offsetHeight = contentListElem[j].offsetHeight;
							totalHeight += offsetHeight;
							heights.push(totalHeight);
						}
						for (var m = 0, len = heights.length; m < len; m++) {
							contentTops.push(parseInt(maxScroll - (height - heights[m] / totalHeight * height)));
						}
						break;
					} else {
						contentTops.push(parseInt(offsetTop));
					}
				}
				this.contentTops=contentTops;
				var lastIndex = 0;
				//监听content滚动
				var onScroll = function(index) {
					if (lastIndex !== index) {
						lastIndex = index;
						var lastActiveElem = controlsElem.querySelector('.mui-active');
						lastActiveElem && (lastActiveElem.classList.remove('mui-active'));
						var currentElem = controlsElem.querySelector('.mui-control-item:nth-child(' + (index + 1) + ')');
						currentElem.classList.add('mui-active');
						//简单处理左侧分类滚动，要么滚动到底，要么滚动到顶
						var controlScrollTop = controlWrapperElem.scrollTop;
						if (controlScrollTop + controlWrapperHeight < controlTops[index]) {
							controlWrapperElem.scrollTop = controlMaxScroll;
						} else if (controlScrollTop > controlTops[index] - controlHeight) {
							controlWrapperElem.scrollTop = 0;
						}
					}
				};
				contentsElem.addEventListener('scroll', function() {
					var scrollTop = contentsElem.scrollTop;
					for (var i = 0; i < length; i++) {
						var offsetTop = contentTops[i];
						var offset = Math.abs(offsetTop - scrollTop);
						//console.log("i:"+i+",scrollTop:"+scrollTop+",offsetTop:"+offsetTop+",offset:"+offset);
						if (scrollTop < offsetTop) {
							if (scrollTop >= maxScroll) {
								onScroll(length - 1);
							} else {
								onScroll(i - 1);
							}
							break;
						} else if (offset < 20) {
							onScroll(i);
							break;
						}else if(scrollTop >= maxScroll){
							onScroll(length - 1);
							break;
						}
					}
				});	
			}
		}
	});
	$("#search").on("keypress",function(e){
		var keycode = e.keyCode;
		var keyword=$(this).val();
		$.log(keyword);
		if(keycode==13){
			$.open('goods.html',{keyword:keyword});
		}
	})
	//沉浸式导航栏
	if(mui.os.plus&&plus.navigator.isImmersedStatusbar()){
		var t=document.getElementById('fullscreen');
		var h=plus.navigator.getStatusbarHeight()+85;
		t.style.marginTop=h+'px';
	}
}

/* 
* 单页面
*/
module.page=function(){
	var args=$.args();
	$.get('/content/info',{content_id:args.content_id},function(res){
		$.log(res);
		if(res.status!=1){
			$.msg('内容不存在');
			$.back();
		}else{
			$("#title").html(res.data.title);
			$("#content").html(res.data.content);
		}
	});
}

/*
* 设置
*/
module.setting=function(){
	//获取用户资料
	$.get('/member', function(res) {
		$.log(res);
		var vm = $.vue("#content", res);
		vm.login_out=function(){
			$.data('token',"");
			$.open('index.html');
		}
	})	
}


/*
* 购物车 
*/
module.cart=function(){
	var vm=$.vue("#content",{
		data:{
			info:{},
			ids:"",
			checked:false,
			checkbox:[],
			sku_num:{}
		}
	},{
		mounted:function(){
			if($.data('cart')){
				var cart=JSON.parse($.data('cart'));
				this.ids=cart.join(',');	
			}
			if($.data('sku_num')){
				this.sku_num=JSON.parse($.data('sku_num'));
			}
			this.get();
		},
		computed:{
			//计算总价格
			totalPrice:function(){
				var price=0;
				var _this=this;
				//未加载数据前或数据为空处理
				if(!_this.info.data||_this.info.data.length<1){
					return price;
				}
				_this.info.data.forEach(function(item) {
					if($.inArray(item.sku_id,_this.checkbox)){
						price+=parseFloat(item.price)*item.num;
					}
				});
				return price.toFixed(2);
			}
		},
		methods:{
			get:function(){
				var self=this;
				$.get('/goods/cart',{ids:this.ids},function(res){
					for(var i in res.data.data) {
						var sku_id=res.data.data[i].sku_id;
						res.data.data[i].num = self.sku_num[sku_id]?self.sku_num[sku_id]:1;
					}
					self.info=res.data;
				});
			},
			open: function(e, data) {
				var url = pc(e.currentTarget).attr('href');
				$.open(url, data);
			},
			//全选
			checkedAll:function(){
				var _this = this;
				if (this.checked) {//实现反选
				  _this.checkbox = [];
				}else{//实现全选
				  _this.checkbox = [];
				  _this.info.data.forEach(function(item) {
					_this.checkbox.push(item.sku_id);
				  });
				}				
			},
			//结算
			settle:function(){
				//检测是否选中
				if(this.checkbox.length<1){
					$.msg('尚未选中任何商品');
					return false;
				}
				//检测是否登录
				if($.data('token')){
					$.open('order.html',{ids:this.checkbox.join(',')});
				}else{
					$.msg('请登录');
					$.open('login.html');
				}
			},
			//删除
			remove:function(event,sku_id){
				var li = event.target.parentNode.parentNode;
				mui.swipeoutClose(li);
				var data={
					total:0,
					data:[]
				};
				//总数减一
				data.total=this.info.total-1;
				//从列表中移除该列
				for(var i in this.info.data){
					if(this.info.data[i].sku_id!=sku_id){
						data.data.push(this.info.data[i]);
					}
				}
				//更新数据
				this.info=data;
				//删除本地购物车缓存
				var cart=JSON.parse($.data('cart'));
				for(var i=0; i<cart.length; i++) {
				    if(cart[i] == sku_id) {
				      cart.splice(i, 1);
				      break;
				    }
				}
				$.data("cart",cart);
			},
			//清空购物车
			clear:function(){
				var self=this;
				if(this.info.total<1){
					$.alert("购物车为空");
				}
				$.confirm("确定要清空购物车吗？","提示",['确定','取消'],function(res){
					if(res.index==0){
						var data={
							total:0,
							data:[]
						};	
						//更新数据
						self.info=data;
						$.data("cart","");	
						$.msg("清空成功")
					}
				});
			}
		},
		watch:{
			//判断是否宣布选中
			'checkbox':{
				handler: function (val, oldVal) { 
					if (this.checkbox.length === this.info.data.length) {
					  this.checked=true;
					}else{
					  this.checked=false;
					}
				  },
				  deep: true				
			}
		}
	})
}
/*
 * 商品页面
 */
module.goods = function() {
	var args=$.args();
	if(args.keyword){
		$("#search").val(args.keyword);
	}
	var vm = $.vue("#content", {
		data: {
			goods: {},
			map:{
				p:1,
				order:'default',
				keyword:args.keyword?args.keyword:""
			}			
		}
	}, {
		mounted: function() {
			this.get();
		},
		methods: {
			get: function() {
				var self = this;
				$.get("/goods",self.map, function(res) {
					$.log(res);
					self.goods = res.data;
				})
			},
			open: function(e, data) {
				var url = pc(e.currentTarget).attr('href');
				$.open(url, data);
			},
			setOrder:function(order){
				this.map.order=order;
				this.get();
			}
		}
	});
	$("#search").on("keypress",function(e){
		var keycode = e.keyCode;
		var keyword=$(this).val();
		$.log(keyword);
		vm.map.keyword=keyword;
		vm.get();
	});	
}

/*
 * 商品详情
 */
module.detail = function() {
	var args = $.args();
	var vm = $.vue("#content", {
		data: {
			goods: {},
			spec:{},
			disabled:true,
			total:"",
			sku_id:0,
			cart:false,
			cart_num:0,
			check:{},
			CannotBuy:{},
			select_sku_name:"",
			sku_number:1
		}
	}, {
		mounted: function() {
			if($.data('cart')){
				var cart=JSON.parse($.data('cart'));
				this.cart_num=cart.length;
			}
			this.get();
		},
		updated:function(){
			$.slider(0,false);
			mui.previewImage();
		},
		methods: {
			get: function() {
				var self = this;
				$.get('/goods/detail', {
					goods_id: args.goods_id
				}, function(res) {
					$.log(res);
					self.goods = res.data.info;
					//检测是否存在规格列表
					self.cart=self.goods.sku.length<1;
				})
			},
			close:function(){
				$("#cart-popover").popover();
			},
			setSpec:function(key,value){
				this.spec[key]=value;
				console.log(this.goods.sku_data)
				var arr = [];
				for(var i in this.spec){
					arr.push(this.spec[i]);
				}
				console.log(arr)
				//检测是否选中完毕
				if(arr.length==this.goods.spec_array.length){
					this.disabled=false;
				}
				//获取价格信息
				var spec=[];
				var spec_value="";
				for(var i in this.spec){
					spec.push(this.spec[i]);
				}
				spec_value=spec.join(';');
				if(this.goods.sku_data[spec_value]){
					var sku=this.goods.sku_data[spec_value];
					if(sku.image){
						this.goods.picture=sku.image;
					}
					if(parseFloat(sku.price)<=0||parseFloat(sku.stock)<=0){
						this.disabled=true;
						return false;
					}
					this.goods.price=sku.price;
					this.sku_id=sku.sku_id;
					this.select_sku_name=sku.sku_name
				}				
			},
			confirm:function(){
				if(!this.sku_id){
					$.msg('商品规格不存在');
					return false;
				}
				//写入id
				var cart = [];
				if($.data('cart')) {
					cart = JSON.parse($.data('cart'));
				}
				cart.push(this.sku_id);
				cart=this.unique(cart);
				$.data('cart', cart);
				this.cart_num=cart.length;
				//写入数量
				var sku_num={};
				if($.data('sku_num')) {
					sku_num = JSON.parse($.data('sku_num'));
				}
				sku_num[this.sku_id]=this.sku_number;
				$.data('sku_num', sku_num);
				$.msg('添加成功');
				$("#cart-popover").popover();
			},
			addCart: function() {
				if(this.cart){
					return false;
				}
				this.spec=[];
				this.check={};
				this.disabled=true;
				$("#cart-popover").popover();
			},
			buy: function() {
				$.open('order.html', {
					ids: this.info.goods_id
				});
			},
			unique:function(array){
				var n = []; 
				for(var i = 0; i < array.length; i++){ 
					if (n.indexOf(array[i]) == -1) n.push(array[i]); 
				} 
				return n; 				
			},
			open_cart:function(){
				$.open('cart.html');
			},
			set_cart_num:function(){
				var cart = [];
				if($.data('cart')) {
					cart = JSON.parse($.data('cart'));
				}
				this.cart_num=cart.length;
			},
			plus:function(){
				this.sku_number++;
			},
			min:function(){
				if(this.sku_number>1){
					this.sku_number--;
				}
			}
		}
	})
}

/*
 * 提交订单
 */
module.order = function() {
	var args = $.args();
	var vm = $.vue("#content", {
		data: {
			info: {
				list: []
			},
			payType: "alipay",
			postType: '',
			mobile: "",
			address: "",
			linkname: "",
			sku_num:{}
		}
	}, {
		computed: {
			total: function() {
				var total = 0;
				for(var i in this.info.list) {
					total += this.info.list[i].num * this.info.list[i].price;
				}
				return total.toFixed(2);
			}
		},
		mounted: function() {
			if($.data('sku_num')){
				this.sku_num=JSON.parse($.data('sku_num'));
			}
			this.get();
		},
		methods: {
			get: function() {
				var self = this;
				$.get('/order/buy', {
					ids: args.ids
				}, function(res) {
					$.log(res);
					for(var i in res.data.list) {
						var sku_id=res.data.list[i].sku_id;
						res.data.list[i].num = self.sku_num[sku_id]?self.sku_num[sku_id]:1;
					}
					self.info.list = res.data.list;
				});
			},
			plus: function(v) {
				v.num++;
			},
			min: function(v) {
				if(v.num > 1) {
					v.num--;
				}
			},
			openInputAddress: function() {
				$("#popover").popover();
			},
			setAddress: function() {
				var address = $.val("#address", "收货地址不能为空");
				var linkname = $.val("#linkname", "联系人不能为空");
				var mobile = $.val("#mobile", "手机号码不能为空");
				if(mobile.length != 11) {
					$.msg('手机号码格式错误');
					return false;
				}
				this.linkname = linkname;
				this.address = address;
				this.mobile = mobile;
				$("#popover").popover();
			},
			post: function() {
				//商品信息
				var info = [];
				for(var i in this.info.list) {
					info.push({
						sku_id: this.info.list[i].sku_id,
						num: this.info.list[i].num
					});
				}
				if(!this.address || !this.mobile) {
					$.msg("请填写收货地址");
					return false;
				}
				var data = {
					goods: info,
					address: this.address,
					mobile: this.mobile,
					linkname: this.linkname
				}
				$.post('/order/create', data, function(res) {
					$.log(res);
					$.msg(res.msg);
					if(res.status>0){
						//清除购物车
						$.data("cart","");
						//跳转到我的订单页面
						$.open("my_order.html");
					}
				})
			}
		}
	})
}

/*
 * 注册用户
 */
module.register = function() {
	var vm = $.vue("#content", {
		data: {
			info: {},
			is_get:false
		}
	}, {
		methods: {
			register: function() {
				var info = this.info;
				if(!info.mobile) {
					$.msg('请输入手机号');
					return false;
				}
				if(!info.code) {
					$.msg('请输入验证码');
					return false;
				}
				if(!info.password) {
					$.msg('请输入密码');
					return false;
				}
				$.post('/user/register', info, function(res) {
					$.log(res);
					if(res.status == 1) {
						$.msg('注册成功，请登录')
						$.open('login.html');
					} else {
						$.msg(res.msg);
					}
				});
			},
			getCode: function(e) {
				var self=this;
				var info = this.info;
				var timer;
				var time = 60;
				if(!info.mobile) {
					$.msg('请输入手机号');
					return false;
				}
				if(self.is_get){
					return false;
				}
				console.log(self.is_get);
				self.is_get=true;
				$.get('/user/getRegisterCode?mobile=' + info.mobile, function(res) {
					$.log(res);
					if(res.status == 1) {
						$.msg('获取成功');
						//注册定时器
						timer = setInterval(function() {
							time--;
							$(e.target).html(time + '秒后重新获取');
							if(time <= 0) {
								self.is_get=false;
								time = 60;
								clearInterval(timer);
								$(e.target).html('获取验证码');
							}
						}, 1000);
					} else {
						self.is_get=false;
						$.msg(res.msg);
					}
				});
				return false;
			}
		}
	});
}

/*
 * 找回密码
 */
module.find = function() {
	var vm = $.vue("#content", {
		data: {
			info: {},
			is_get:false
		}
	}, {
		methods: {
			register: function() {
				var info = this.info;
				if(!info.mobile) {
					$.msg('请输入手机号');
					return false;
				}
				if(!info.code) {
					$.msg('请输入验证码');
					return false;
				}
				if(!info.password) {
					$.msg('请输入密码');
					return false;
				}
				$.post('/user/find', info, function(res) {
					$.log(res);
					if(res.status == 1) {
						$.msg('设置成功，请使用新密码登录')
						$.open('login.html');
					} else {
						$.msg(res.msg);
					}
				});
			},
			getCode: function(e) {
				var self=this;
				var info = this.info;
				var timer;
				var time = 60;
				if(!info.mobile) {
					$.msg('请输入手机号');
					return false;
				}
				if(self.is_get){
					return false;
				}
				console.log(self.is_get);
				self.is_get=true;
				$.get('/user/getFindCode?mobile=' + info.mobile, function(res) {
					$.log(res);
					if(res.status == 1) {
						$.msg('获取成功');
						//注册定时器
						timer = setInterval(function() {
							time--;
							$(e.target).html(time + '秒后重新获取');
							if(time <= 0) {
								self.is_get=false;
								time = 60;
								clearInterval(timer);
								$(e.target).html('获取验证码');
							}
						}, 1000);
					} else {
						self.is_get=false;
						$.msg(res.msg);
					}
				});
				return false;
			}
		}
	});
}

/*
 * 登录
 */
module.login = function() {
	var vm = $.vue("#content", {
		data: {
			info: {}
		}
	}, {
		methods: {
			login: function() {
				var info = this.info;
				if(!info.mobile) {
					$.msg('请输入手机号');
					return false;
				}
				if(!info.password) {
					$.msg('请输入密码');
					return false;
				}
				$.post('/user/login', info, function(res) {
					$.log(res);
					if(res.status == 1) {
						$.msg('登录成功')
						$.data('token', res.data.token);
						$.open('member.html');
					} else {
						$.msg(res.msg);
					}
				});
			}
		}
	});
}
/*
 * 会员中心 
 */
module.member = function() {
	//获取用户资料
	var vm=$.vue("#content",{
		data:{
			userinfo:{},
			version: "1.0"
		}
	},{
		mounted: function() {
			//获取当前版本号
			if(mui.os.plus) {
				this.version = plus.runtime.version;
			}
			this.get();
		},		
		methods: {
			get:function(){
				var self = this;
				$.get('/member', function(res) {
					self.userinfo=res.data.userinfo;
				})
			},
			login_out:function(){
				$.data('token',"");
				$.open('index.html');
			}
		},
		computed:{
			username:function(){
				if(this.userinfo.nickname){
					return this.userinfo.nickname;
				}else{
					return this.userinfo.user_name?this.userinfo.user_name:'未设置';
				}
			}
		}		
	})
}

/*
 * 我的订单
 */
module.my_order = function() {
	var vm = $.vue("#content", {
		data: {
			info: {},
			map: {
				page: 0,
				status: 'all'
			}
		}
	}, {
		mounted: function() {
			//this.get();
		},
		methods: {
			get: function() {
				var self = this;
				$.get('/order', this.map, function(res) {
					$.log(res);
					if(self.map.page==1){
						self.info = res.data;	
					}else{
						for(var i in res.data.data){
							self.info.data.push(res.data.data[i]);
						}
					}
					// 判断是否结束加载
					var is_end=(res.data.current_page>=res.data.last_page);
					if(!is_end){
						//重置上拉加载
						mui('#refreshContainer').pullRefresh().refresh(!is_end);						
					}
					if(window.RefreshType=='down'){
						mui('#refreshContainer').pullRefresh().endPulldown();
						//重置上拉加载
						mui('#refreshContainer').pullRefresh().refresh(!is_end);
					}
					if(RefreshType=='up'){
						mui('#refreshContainer').pullRefresh().endPullup(is_end);
					}
				});
			},
			setStatus: function(status) {
				this.map.status = status;
				this.map.page=1;
				this.get();
			},
			confirm: function(order_id) {
				$.confirm("确定已经收到货物了吗？", "提示", ['确定', '取消'], function(data) {
					if(data.index == 0) {
						$.get('/order/confirm', {
							order_id: order_id
						}, function(res) {
							$.msg(res.msg);
							if(res.status == 1) {
								$.reload();
							}
						})
					}
				})
			},
			close: function(order_id) {
				$.confirm("确定要取消该订单吗？", "提示", ['确定', '取消'], function(data) {
					if(data.index == 0) {
						$.get('/order/close', {
							order_id: order_id
						}, function(res) {
							$.msg(res.msg);
							if(res.status == 1) {
								$.reload();
							}
						})
					}
				})
			},
			pay:function(order_id){
				$.confirm("请选择支付方式",'选择',["支付宝","微信"],function(data){
					var type=data.index==1?'wxpay':'alipay';
					$.pay('/'+type+'?order_id='+order_id,function(res){
						$.log(res);
					},type);					
				})				
			}
		}
	})
	//下拉刷新
	window.addEventListener('RefreshDown',function(event){
		vm.map.page=1;
		vm.get();
	});
	//上拉加载
	window.addEventListener('RefreshUp',function(event){
		vm.map.page++;
		vm.get();
	});	
}
/*
 * 个人资料 
 */
module.member_info = function() {
	var vm;
	$.get('/member', function(res) {
		$.log(res);
		res.data.password = "";
		res.data.password1 = "";
		vm = $.vue("#content", res);
		vm.post = function() {
			var data = vm.user_info;
			$.log(data);
			$.post('/member/update', data, function(res) {
				$.log(res);
			})
		}
		vm.change_passwd = function() {
			if(!this.password) {
				$.msg('请输入密码');
				return false;
			}
			if(this.password.length < 6) {
				$.msg('密码长度最低为6位');
				return false;
			}
			if(this.password != this.password1) {
				$.msg('两次输入密码不一致');
				return false;
			}
			$.post('/member/password', {
				password: this.password
			}, function(res) {
				$.log(res);
				$.msg(res.data);
				if(res.status) {
					$.back();
				}
			})
		}
		//修改头像
		vm.change_headimg = function() {
			var _this = this;
			$.gallery(function(img) {
				$.log(img);
				$.post('/upload', {
					base64: img
				}, function(rs) {
					$.log(rs);
					_this.member.user_info.user_headimg = rs.data;
					console.log(_this.config.url + '/..' + rs.data)
					//设置头像
					$.post('/member/headimg', {
						src: rs.data
					}, function(res) {
						$.msg(res.data);
					})
				});
			})
		}
	});
	$("#save").on("tap",function(){
		vm.post();
	});
}

/*
* 修改密码
*/
module.change_password=function(){
	var vm = $.vue("#content", {
		data:{
			userinfo:{}
		}
	},{
		methods:{
			save:function(){
				if(!this.userinfo.password_old){
					$.msg('请输入旧密码');
					return false;
				}
				if(!this.userinfo.password){
					$.msg('请输入新密码');
					return false;					
				}
				if(!this.userinfo.password_confirm){
					$.msg('请输入确认密码');
					return false;					
				}
				if(this.userinfo.password!=this.userinfo.password_confirm){
					$.msg('确认密码不正确');
					return false;					
				}
				$.post('/member/changePassword',this.userinfo,function(res){
					$.log(res);
					$.msg(res.msg);
					if(res.status>0){
						$.back();
					}
				});
			}
		}
	});
}

/*
 * 关于我们
 */
module.about = function() {
	var vm = $.vue("#content", {
		data: {
			info: {},
			version: "1.0"
		}
	}, {
		mounted: function() {
			//获取当前版本号
			if(mui.os.plus) {
				this.version = plus.runtime.version;
			}
			//获取服务器最新版本号
			this.get();
		},
		methods: {
			get: function() {
				var self = this;
				$.get('/app/version', function(res) {
					$.log(res);
					self.info = res.data;
				});
			},
			update: function() {
				var self = this;
				if(this.version >= this.info.version) {
					$.msg('暂无最新版本');
				} else {
					$.confirm('发现新版本' + info.data.version + '，是否打开浏览器下载更新？', '更新确认', ['是', '否'], function(e) {
						if(e.index == 0) {
							var url = self.info.download;
							plus.runtime.openURL(url);
						} else {
							mui.toast('取消更新');
						}
					});
				}
			}
		}
	});
}