new function (){
   var _self = this;
   _self.width = 640;//设置默认最大宽度
   _self.fontSize = 100;//默认字体大小
   _self.widthProportion = function(){var p = (document.body&&document.body.clientWidth||document.getElementsByTagName("html")[0].offsetWidth)/_self.width;return  p<0.5?0.5:p; /*p>1?1:p<0.5?0.5:p*/};
	_self.changePage = function(){
       document.getElementsByTagName("html")[0].setAttribute("style","font-size:"+_self.widthProportion()*_self.fontSize+"px");
   }
   _self.changePage();
   window.addEventListener('resize',function(){_self.changePage();},false);
};
$.ajaxSettings.xhrFields={withCredentials: true};
var config = new Array();
config['timeOut'] = 1500;
config['host'] = "http://121.199.8.244:2000/";
config['imageUrl'] = "http://121.199.8.244:8509/lgsc/upload_all/head/news_img/";

/**
 * 获取url参数
 * @returns {Array}
 */
function get_param(url){
	if (url != '' && url != undefined && url != null){
		var local_url = url;
	} else {
		var local_url = document.location.href;
	}
	var data = local_url.split("?");
	data = data[1];
	var get_data = [];
	if(data != '' && data != undefined){
		data = data.split("&");
		$.each(data, function(i, v){
			var j = v.split("=");
			get_data[j[0]] = decodeURI(j[1]);
		});
	}
	return get_data;
}

var user_info = sessionStorage.getItem("LG_User");
var user_id = null;
var user_token = null;
if(user_info != "" && user_info != null && user_info != undefined){
	user_info = JSON.parse(user_info);
	user_id = user_info.uid;
	user_token = user_info.user_token;
}

/**
 * ajax请求数据
 * @param url
 * @param data
 * @param calBackFunction
 */
function requestData(url, data, calBackFunction, async) {
	var loading_html = '<div class="alert_dialog loading_dialog" style="position:fixed;top:0;left:0;height:100%;width:100%;z-index:999; background:rgba(0,0,0,0.3);"><div class="show_alert" style="background:transparent; padding: 0; border-radius: 0.1rem; overflow: hidden; box-shadow: none;"><img src="images/loading.gif" style="height:0.8rem; width:0.8rem; display:block; margin:0 auto;"/></div></div>';
	url = config.host+url;
	if(async == null || async == undefined){
		async = true;
	}
	$.ajax({
		type: "POST",
		url: url,
		data: data,
		dataType: "JSON",
		async: async,
		beforeSend : function(){
			$("body").append(loading_html);
		},
		success : function(json){
			calBackFunction(json);
			$(".loading_dialog").remove();
		},
		error : function(XMLHttpRequest){
			$(".loading_dialog").remove();
			console.log(XMLHttpRequest);
			show_alert('请检查网络');
		}
	});
}

/**
 *
 * @param msg 提示信息
 * @param qnmlgb 是否刷新
 * @param local_url 跳转地址
 * @param rep
 */
function show_alert(msg, qnmlgb, local_url, rep){
	var html = '<div class="alert_dialog"><div class="show_alert">'+msg+'</div></div>';
	$("body").append(html);
	var i = 0;
	var setI = setTimeout(function(){
		$('.alert_dialog').remove();
		if(qnmlgb == true){
			history.go(0);
		}
		if(local_url != "" && local_url != undefined){
			redirect(local_url, rep);
		}
		if(i >= 1){
			clearTimeout(setI);
		}
		i++;
	}, config.timeOut);
}

/**
 * 提示信息并返回
 * @param msg
 */
function show_alert_back(msg, is_sx) {
	var html = '<div class="alert_dialog"><div class="show_alert">'+msg+'</div></div>';
	$("body").append(html);
	var i = 0;
	var setI = setTimeout(function(){
		$('.alert_dialog').remove();
		if(is_sx == true){
			location.reload();
		}
		history.back();
		if(i >= 1){
			clearTimeout(setI);
		}
		i++;
	}, config.timeOut);
}

/**
 * 验证是否登陆
 * @returns {boolean}
 */
function checkLogin() {
	if(user_id == "" || user_id == undefined || user_id <= 0){
		if(confirm("你还未登陆,是否前去登陆?")){
			window.location.href = "login.html";
		}
		return false;
	}
	return true;
}

/**
 * 跳转链接
 * @param url
 * @param rep
 */
function redirect(url, rep){
	if (rep == true) {
		location.replace(url);
	} else {
		window.location.href = url;
	}
}

/**
 * 去除首尾空格
 * @param string
 * @returns {XML|void|*}
 */
function tirm(string){
	return string.replace(/(^\s*)|(\s*$)/g, "");
}

/**
 * 价格格式化
 * @param price
 * @returns {string}
 */
function formatPrice(price){
	return price.toFixed(2);
}


/**
 *
 * 返回上一页并刷新
 */
function getBackShuaXin(){
	location.reload();
	history.back();
}

/**
 * 拼接图片地址
 * @param string
 * @returns {object}
 */
function getImagesList(string) {
	var arr = string.split(";");
	$.each(arr, function(i, v){
		arr[i] = config.imageUrl + v;
	});
	return arr;
}

/**
 * 时间戳转换
 * @param time
 * @param his
 * @returns {string}
 */
function get_date(time, his){
	time = new Date(time * 1000);
	var year = time.getFullYear();
	var month = parseInt(time.getMonth()) + 1;
	var day = time.getDate();
	month = (month>=10)?month:"0"+month;
	day = (day>=10)?day:"0"+day;
	if(his == true){
		var hours = time.getHours();
		hours = (hours>=10)?hours:"0"+hours;
		var min = time.getMinutes();
		min = (min>=10)?min:"0"+min;
		var sen = time.getSeconds();
		sen = (sen>=10)?sen:"0"+sen;
		return year+'-'+month+'-'+day+' '+hours+':'+min+':'+sen;
	}else{
		return year+'-'+month+'-'+day;
	}
}


