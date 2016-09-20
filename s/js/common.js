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

var config = new Array();
config['timeOut'] = 1500;

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
/**
 * 没啥用
 * @returns {number}
 */
function getScrollTop()
{
    var scrollTop=0;
    if(document.documentElement&&document.documentElement.scrollTop)
    {
        scrollTop=document.documentElement.scrollTop;
    }
    else if(document.body)
    {
        scrollTop=document.body.scrollTop;
    }
    return scrollTop;
}

/**
 *
 * @param msg 提示信息
 * @param qnmlgb 是否刷新
 * @param loca_url 跳转地址
 */
function show_alert(msg, qnmlgb, loca_url){
	var html = '<div class="alert_dialog"><div class="show_alert">'+msg+'</div></div>';
	$("body").append(html);
	var i = 0;
	var setI = setTimeout(function(){
		$('.alert_dialog').remove();
		if(qnmlgb == true){
			history.go(0);
		}
		if(loca_url != "" && loca_url != undefined){
			redirect(loca_url);
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





