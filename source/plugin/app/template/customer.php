<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>下载</title>
    <meta http-equiv="keywords" content="">
    <meta http-equiv="description" content="">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <script type="text/javascript">
        var browser={
            versions:function(){
                var u = navigator.userAgent, app = navigator.appVersion;
                return {         //移动终端浏览器版本信息
                    trident: u.indexOf('Trident') > -1, //IE内核
                    presto: u.indexOf('Presto') > -1, //opera内核
                    webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                    gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                    mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
                    ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                                   android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
                                   iPhone: u.indexOf('iPhone') > -1 , //是否为iPhone或者QQHD浏览器
                                   iPad: u.indexOf('iPad') > -1, //是否iPad
                                   webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
                                   };
                                   }(),
                                   language:(navigator.browserLanguage || navigator.language).toLowerCase()
                                   }
                                   //document.writeln("语言版本: "+browser.language);
                                   //document.writeln(" 是否为移动终端: "+browser.versions.mobile);
                                   //document.writeln(" ios终端: "+browser.versions.ios);
                                   //document.writeln(" android终端: "+browser.versions.android);
                                   //document.writeln(" 是否为iPhone: "+browser.versions.iPhone);
                                   //document.writeln(" 是否iPad: "+browser.versions.iPad);
                                   //document.writeln(navigator.userAgent);
                                   	var ua = window.navigator.userAgent.toLowerCase();
									if(ua.match(/MicroMessenger/i) == 'micromessenger'){
										document.writeln("");
									}else{
										if(browser.versions.android){
											window.location.href="https://www.pgyer.com/dCy5";
									   }else if(browser.versions.iPhone){
											window.location.href="http://fir.im/zc5e";
									   }else{
											alert("请在移动端打开");
									   }
									}
                                   </script>
<style>
body{
	text-align: center;
	margin: 0px;
	padding: 0px;
}
</style>    
</head>
<body>
<img src="/pic/tan.png" width="100% height="auto">
</body>
</html>