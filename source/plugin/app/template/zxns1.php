<!--{subtemplate _header}-->
<style>

a{text-decoration: none;}
*, body{ padding:0; margin:0 auto; font-family:"微软雅黑";}
ul li{ list-style:none;}
h3,h2,h1 { font-weight:normal;}
.clear{ clear:both;}
.all{height:auto; overflow:hidden; margin:0 auto;}
em{ font-style:normal;}

.top{background-image:url(images/top_01.png); height:92px}
.top_nr{ width:1000px; overflow:hidden}
.top_l{ float:left}
.top_r{ float:right; width:640px}
.top_t{ width:312px; float:right}
.top_t img{ float:left; display:block; margin-top:16px; margin-right:5px; }
.top_t span a{ font-size:12px; color:#444;line-height:54px; margin:0 10px}
.top_t em{ font-size:12px; color:#444;line-height:54px}
.top_d{ width:640px; display:inline-block}
.top_d ul{ overflow:hidden}
.top_d ul li{ float:left; width:88px; text-align:center; font-size:12px;}
.top_d ul li a{ color:#444; line-height:36px}
.top_d ul li a:hover{ color:#01017a; line-height:36px}
.top_d ul li a.xuanz{ color:#01017a; line-height:36px}
.sy_banner{ width:1000px; height:313px}
.sy_main{ background:url(images/nysx_02.png) repeat-x;height:auto;padding-top:24px; margin-top:1px}
.main{ width:1000px; overflow:hidden}
.left{ float:left; background-image:url(images/zbj_07.png); width:247px; height:270px}
.left2{ float:left; background-image:url(images/jjbj_03.png); width:247px; height:150px}
.bt{ font-size:16px; color:#444; line-height:34px; border-bottom:1px solid #fff}
.bt img{ display:block; float:left; margin:10px}
.bt1{ font-size:16px; color:#444; margin-top:10px}
.bt1 img{ display:block; float:left; margin-left:20px; margin-top:4px;margin-right:6px}
.leftul{ width:216px; padding:0;}
.leftul li{  line-height:26px; font-size:14px;  padding-left:20px; color:#666;}
.leftul li a{ color:#666; display:block; background:url(images/hd_03.png) no-repeat 0px 10px;padding-left: 10px;}
.leftul li a:hover{ color:#01017a; background:url(images/tt_11.png) no-repeat 0px 10px;padding-left: 10px;}
.leftul li a.selet{ color:#01017a; background:url(images/tt_11.png) no-repeat 0px 10px;padding-left: 10px;}
.right{ background-image:url(images/rbj_03.png); float:right; width:743px; height:839px}
.right2{ background-image:url(images/cpxq_03.png); float:right; width:743px; height:auto}
.tm{width:945px;overflow:hidden; border-bottom:1px solid #fff}
.bt2{ float:right;font-size:12px;  line-height:34px; margin-right:10px}
.bt2 img{ display:block; float:left; margin-top:8px}
.bt2 a{color:#888;}
.bt3{ float:left;font-size:18px; font-weight:bold; color:#444; line-height:34px;}
.bt3 img{ display:block; float:left; margin:10px}
.fw_main{ width:743px; overflow:hidden; margin:30px 0}
.fw_by{ margin-left:40px; float:left; margin-top:10px}
.fw_by h2 span{ font-size:18px; color:#01017a; font-weight:bold; line-height:46px; margin-right:20px}
.fw_by h2 em{ font-size:14px; color:#444; line-height:50px; margin-top:4px}
.fw_by1{ margin-left:40px; float:left; margin-top:10px}
.fw_by1 h2 span{ font-size:18px; color:#01017a; font-weight:bold; line-height:30px; margin-right:20px}
.fw_by1 h2 em{ font-size:14px; color:#444; line-height:50px; margin-top:4px}

.fanhui{width:70px;height:20px; background:#42a5cc; border-radius:10px; text-align:center; line-height:20px; color:#FFF;}

.fw_main img{ float:right; margin-right:40px}
.xw_list{ display:block; width:1000px}
.hangye_box{ width:960px; padding-top:10px; padding-bottom:10px; height:auto; overflow:hidden; border-bottom:dashed 1px #999;}
.h4{ width:815px; font-size:12px;}
.xw_list li a{ color:#666; display:block; font-size:12px; padding-left: 10px;}
.xw_list li a:hover{ color:#01017a; font-size:12px;padding-left: 10px;}
.xw_list li a.xz{ color:#01017a; font-size:12px;padding-left: 10px;}
.time1{ font-size: 12px; color: rgb( 153, 153, 153 ); display:inline-block;}
.left1{ float:left;}
.right1{ float:right;}
.page1{ width:320px; height:30px; float:right; margin-top:20px; margin-bottom:20px}
.page1 ul li{ float:left; margin-right:5px; line-height:28px; font-size:12px; text-align:center;width:30px; height:28px;}
.page1 ul li a{  display:block; border-radius:3px; background-color:#fff; border:solid 1px #dcdbdb; color:#003b79;}
.page1 ul li a:hover{ background-color:#003b79; border:solid 1px #003b79; color:#fff;}
.page1 ul li a.selet{ background-color:#003b79; border:solid 1px #003b79; color:#fff;}


.xw_main{background:
url(images/cbj_03.png) repeat-x;height:auto;width:1000px; margin-top:1px; overflow:hidden}
.w2{width:1000px; height:1px; background-color:#555; margin-top:50px; border:none}
.foot{ width:1000px; overflow:hidden;}
.foot_l{ float:left}
.foot_l span a{ font-size:12px; color:#8e9194;line-height:44px; margin:0 10px}
.foot_r{ float:right;font-size:12px; color:#8e9194;line-height:44px;}

.dt_detail{ width:960px; height:auto; overflow:hidden;}
.dt_detail img{ float:left; margin-top:20px; margin-bottom:20px; margin-right:45px;}
.dt_detail p{ margin-bottom:5px; font-size: 11px; color: rgb( 102, 102, 102 ); line-height:24px; text-indent: 2em; width:960px; height:auto; margin-top:10px;} 
.txtlink{ width:960px; background-color:#ececec; height:auto; overflow:hidden; margin-top:30px; margin-bottom:20px}
.txtlink ul{ width:960px;}
.txtlink ul li{ float:left; width:425px; line-height:40px; color:#333333; text-indent:2em; font-size:11px;}
.txtlink ul li a{ color:#333;}


.RR{ overflow:hidden; width:700px; margin:0 auto}
.RR .CP li{ width:207px; height:228px; float:left; background-image:url(images/cpbj_03.png); margin-right:39px; margin-bottom:20px}
.bei{ display:block;margin:0 auto; margin-top:6px; margin-left:5px}
.RR .CP li a{ font-size:12px; color:#666; text-align:center; display:block; line-height:50px }
.RR .CP li a:hover{ font-size:12px; text-align:center; display:block; line-height:50px; color:#01017a}
.RR .CP li a.xuan{ font-size:12px; text-align:center; display:block; line-height:50px; color:#01017a }
.cpzs{ width:700px; overflow:hidden; margin-top:10px}
.cpt{ border:1px solid #e0e0e0; float:left; width:562px}
.xt{ float:left; margin:0 28px}
.xt li{ margin-top:10px; height:58px; border:1px solid #e0e0e0;}
.xt li:hover{margin-top:10px; height:58px;  border:1px solid #01017a;}
.xt li.dian{margin-top:10px; height:58px;  border:1px solid #01017a;}
.bt4{ font-size:14px; color:#666; line-height:34px; margin-left:20px; margin-top:10px; margin-bottom:10px}
.bt4 img{ display:block; float:left; margin-top:13px; margin-right:6px}
.fl{ height:30px; width:721px; font-size:14px; color:#fff; line-height:30px; padding-left:20px; background-color:#01017a}
.xbt{ font-size:14px; color:#666; font-weight:bold; line-height:30px; margin-left:20px}
.cpxq{ font-size:12px; color:#666; margin-left:20px; line-height:24px; margin-bottom:35px}
.xm_main{ background-image:url(images/albj_03.png); width:1000px; height:auto}
.al{ overflow:hidden; width:960px; margin-top:30px;}
.al li{ background-image:url(images/bj_05.png); width:305px; height:320px; float:left; margin-right:22px}
.al li:hover{ background-image:url(images/bj_03.png); width:305px; height:320px; float:left; margin-right:22px; color:#01017a;margin-top: 0px;}
.al li:hover>.alfl{ color:#01017a;}
.al li:hover>.sl{  color:#01017a;}
.al li:hover>.p1{ color:#666;}
.al li.xuanz{ background-image:url(images/bj_03.png); width:305px; height:320px; float:left; margin-right:22px; color:#01017a;margin-top: 0px;}
.al li.xuanz>.alfl{ color:#01017a;}
.al li.xuanz>.sl{  color:#01017a;}
.al li.xuanz>.p1{ color:#666;}
.alfl{ font-size:22px; text-align:center; color:#666; font-weight:bold; margin-top:10px;}
.sl{ font-size:20px; color:#666;text-align:center;font-weight:bold; margin-top:16px;}
.p1{ font-size:12px; color:#666; line-height:20px; margin-top:36px; width:285px}
.tuzs{ width:960px; margin-bottom:40px}
.tp{ margin-left:135px; margin-top:10px; margin-bottom:10px}
.tuzs ul{ overflow:hidden}
.tuzs ul li{ float:left; margin-right:20px;}
.zh{ width:960px;}
.zhbt{font-size:22px; color:#01017a;font-weight:bold;}
.zhjs{ font-size:12px; color:#666; text-indent:2em; margin:10px 0}
.fl_main{ background-image:url(images/flbj_03.png); width:1000px; height:auto}
.flsm{ font-size:12px; color:#000; line-height:24px; width:960px; margin-top:20px; padding-bottom:83px;}
.E_main{ background-image:url(images/Ebj_03.png); width:1000px; height:auto}
.qy_detail{ width:700px; height:auto; overflow:hidden;}
.qy_detail img{ float:left; margin-top:20px; margin-bottom:10px; margin-right:30px;}
.qy_detail p{ font-size: 11px; color: rgb( 102, 102, 102 ); line-height:24px; text-indent: 2em; width:700px; height:auto;} 
.jj{ margin-bottom:5px; font-size: 11px; color: rgb( 102, 102, 102 ); line-height:24px; text-indent: 2em; width:700px; height:auto; margin-top:10px;}
.qy_nav{ width:700px; margin-top:20px}
.qy_nav ul{overflow:hidden;width:695px; border:1px #ddd solid; background:url(images/tr_03.png) repeat-x; height:30px }
.qy_nav ul li{ float:left; width:173px; height:30px; text-align:center; line-height:30px; border-right:1px solid #ddd; position:relative}
.qy_nav ul li a{ color:#666; font-size:14px;}
.qy_nav ul li a:hover{ display:block;color:#fff; font-size:14px; background-color:#01017a; }
.qy_nav ul li a.dj{ display:block;color:#fff; font-size:14px; background-color:#01017a}

.right3{ background-image:url(images/jjbj_05.png); float:right; width:743px; height:auto}
.right4{ background-image:url(images/zsbj_03.png); float:right; width:743px; height:auto}
.right5{ background-image:url(images/zlbj_03.png); float:right; width:743px; height:auto}


.zx_main{ background-image:url(images/zxbj_03.png); width:1000px; height:auto; background:#FFF;margin-bottom:40px; border:1px #ddd solid; border-radius:10px;}
.zx{ margin-top:10px; padding-bottom:34px}
.zx h2{ font-size:20px; color:#5cbac0; text-align:center; font-weight:bold; line-height:50px}
.zx p{ font-size:12px; color:#666; text-align:center; line-height:24px}
.zx h3{ font-size:18px; color:#5cbac0; text-align:center;font-weight:bold; line-height:40px}

.zx h1{ font-size:26px; color:#01017a; text-align:center;font-weight:bold; line-height:40px}
.zx h1 span{ font-size:26px; color:#F00; text-align:center;font-weight:bold; line-height:40px}


.al1{ overflow:hidden; width:960px; margin:30px auto 10px auto;}
.al1 li{ background-image:url(../images/img/zpbj_05.png); width:305px; height:444px; float:left; margin-right:22px}
.al1 li:hover{ background-image:url(../images/img/zpbj_03.png); width:305px; height:444px; float:left; margin-right:22px; color:#01017a;margin-top: 0px;}
.al1 li:hover>.alfl1{ color:#5cbac0;}
.al1 li:hover>.alfl1 a{ color:#5cbac0;}
.al1 li:hover>.sl1{  color:#5cbac0;}
.al1 li:hover>.p11{ color:#666;}
.al1 li.xuanz1{ background-image:url(../images/img/zpbj_03.png); width:305px; height:444px; float:left; margin-right:22px; color:#01017a;margin-top: 0px;}
.al1 li.xuanz1>.alfl1 a{ color:#5cbac0;}
.al1 li.xuanz1>.alfl1{ color:#5cbac0;}
.al1 li.xuanz1>.sl1{  color:#5cbac0;}
.al1 li.xuanz1>.p11{ color:#666;}
.alfl1{ font-size:22px; text-align:center; color:#5cbac0; font-weight:bold; margin-top:10px;margin-bottom:38px;padding-top:8px}
.alfl1 a{ color:#5cbac0}
.sl1{ font-size:20px; color:#5cbac0;text-align:center;font-weight:bold; margin-top:16px;}
.p11{ font-size:12px; color:#666; line-height:22px; margin-top:36px; width:285px;margin:30px auto 0 auto;}
.lx{ margin-top:140px; padding-bottom:172px}
.lx ul{ overflow:hidden; width:960px}
.lx ul li{ float:left; margin-right:55px}
.lx ul li img{ float:left}
.lx ul li h3{ font-size:18px; color:#000}
.lxnr{ float:left; margin-left:10px;}
.lxnr span{ font-size:12px; color:#39424b; margin-top:10px; display:block}
.lxnr span em{ color:#01017a}
.lxnr h2{ font-size:12px; color:#818a93; margin-top:10px; display:block}

.lx_main{ background-image:url(images/lxbj_03.png); width:1000px; height:auto}
.ns_main{ background-image:url(images/Ebj_03.png); width:1000px; height:auto;background:#fff; margin-bottom:30px; border-radius:10px; border:1px solid #ddd;}
.js_main{ background-image:url(images/jsbj_03.png); width:1000px; height:auto}


.cultmain{ width:1000px; height:auto; overflow:hidden;}
.zdbox1{ width:943px; height:auto; overflow:hidden; border-bottom:solid 1px #e0e0e0; padding-bottom:15px; padding-top:30px;}
.zdbox1 span{ display:block; font-size:14px}
.sp15{float: left;line-height: 20px; margin-right:8px;height: 23px;overflow: hidden;}
.sp16{float: left;color:#014898;font-size: 20px;line-height: 20px;}
.sp17{float: right;line-height: 20px;height: 19px;overflow: hidden; position:relative; width:70px;}
.sp17 a{ position:absolute; top:-19px; left:0px;}
.sp17 a:hover{ position:absolute; top:0px; left:0px;}
.img5{width:80px;height:25px; text-align:center; line-height:25px; border-radius:12px; color:#FFF; background:#5cbac0;float: left;margin-right: 10px;}
.txt{line-height: 22px; float:left; }
.zdbox1 ul li{ float: left;margin-right: 20px;width: 230px;margin-bottom: 30px;}
.zdbox2{ width:943px; height:auto; overflow:hidden; padding-top:24px; padding-bottom:45px; line-height:24px;}
.zdbox2 dl{ line-height:30px; }
.zdbox2 dt{ color:#003b79; text-indent:1em;}
.zdbox2 dd{ font-size:11px; text-indent:2em;}
.spsq{ width:111px; height:23px; overflow:hidden; float:left; position:relative;}
.spsq a{width: 111px;height: 23px;display: block; position:absolute; top:-24px; left:0px;}

.ys{ width:860px; height:170px; background-color:#eee; overflow:hidden; margin-bottom:10px}
.wz{float:left; width:360px; margin-left:20px; margin-top:34px;}
.wz h2{ font-size:18px; color:#888}
.wz p{ font-size:12px; color:#888; margin-top:20px; line-height:24px}
.t{ float:right; border:1px solid #ccc; margin-top:14px; margin-right:20px}
.ys1{ width:860px; height:170px; background-color:#eee; overflow:hidden; margin-bottom:10px}
.wz1{ float:right; width:360px; margin-left:20px; margin-top:34px;}
.wz1 h2{ font-size:18px; color:#888}
.wz1 p{ font-size:12px; color:#888; margin-top:20px; line-height:24px}
.t1{ float:left; border:1px solid #ccc; margin-top:14px; margin-left:20px}

.js{ line-height:24px; font-size:12px; color:#666; text-indent:2em; width:880px; padding:20px 0; }
.js span{ font-size:14px; color:#01017a; font-weight:bold}
.zs{ margin-top:20px; padding-bottom:5px}
.zs ul{ overflow:hidden; width:700px}
.zs ul li{ float:left; width:220px; margin-right:20px;}
.zs ul li span{ display:block; text-align:center; line-height:34px; font-size:14px;}

a{text-decoration: none;}
*, body{ padding:0; margin:0 auto; font-family:"微软雅黑";}
ul li{ list-style:none;}
h3,h2,h1 { font-weight:normal;}
.clear{ clear:both;}
.all{height:auto; overflow:hidden; margin:0 auto;}
em{ font-style:normal;}

.top{background-image:url(images/top_01.png); height:92px}
.top_nr{ width:1000px; overflow:hidden}
.top_l{ float:left}
.top_r{ float:right; width:640px}
.top_t{ width:312px; float:right}
.top_t img{ float:left; display:block; margin-top:16px; margin-right:5px; }
.top_t span a{ font-size:12px; color:#444;line-height:54px; margin:0 10px}
.top_t em{ font-size:12px; color:#444;line-height:54px}
.top_d{ width:640px; display:inline-block}
.top_d ul{ overflow:hidden}
.top_d ul li{ float:left; width:88px; text-align:center; font-size:12px;}
.top_d ul li a{ color:#444; line-height:36px}
.top_d ul li a:hover{ color:#01017a; line-height:36px}
.top_d ul li a.xuanz{ color:#01017a; line-height:36px}
.sy_banner{ width:1000px; height:560px}
.sy_main{ background:url(images/sydb_bj_06.png) repeat-x;height:auto;padding-top:24px}
.main_t{ background-image:url(images/sybj_05.png); width:998px; height:179px;}
.main_l{ float:left; margin-left:20px; overflow:hidden; width:544px}
.ml{ float:left;}
.ml h2{ font-size:12px; color:#444; line-height:43px}
.ml h2 a{font-size:12px; color:#444; line-height:43px}
.mr{ float:left; margin-left:20px; margin-right:20px; margin-top:38px; width:322px;}
.mr p{ font-size:12px; color:#444; line-height:20px; padding-bottom:6px;border-bottom:dashed 1px #ddd; margin-bottom:6px}
.mr h2{ font-size:12px; color:#444; line-height:20px;}
.sx{ float:right}
.main_r{ float:right; width:424px}
.ml1{ float:left;}
.ml1 h2{ font-size:12px; color:#444; line-height:43px}
.mr1{ float:left; margin-left:10px; margin-top:38px; width:234px;}
.mr1 p{ font-size:12px; color:#444; line-height:20px;padding-bottom:6px; margin-bottom:6px}
.main_d{ border:1px solid #ddd; width:998px; height:118px; margin-top:20px}
.main_d ul{ overflow:hidden}
.main_d ul li{ float:left; width:223px; margin:0 13px}
.main_d ul li h2{font-size:12px; color:#444; line-height:36px;}
.flbj p{font-size:12px; color:#444; width:132px; float:right; display:block; margin-right:8px; line-height:18px; margin-top:6px}
.flbj{ background-image:url(images/tb_03.png); height:74px; overflow:hidden}
.flbj1{ float:left; display:block}
.flbj span{ display:block; float:right; width:140px; margin-top:8px}
.flbj span em{font-size:12px; color:#444; width:118px}
.flbj span img{ float:right; display:block; margin-right:10px; margin-top:4px}
.flbj2{background-image:url(images/tb_03.png); height:74px; overflow:hidden}
.flbj3{ float:right; display:block}
.flbj2 p{font-size:12px; color:#444; width:130px; float:left; display:block; margin-left:10px; line-height:18px; margin-top:6px}
.w1{ width:1000px; height:1px; background-color:#555; margin-top:30px; border:none}
.foot{ width:1000px; overflow:hidden;}
.foot_l{ float:left}
.foot_l span a{ font-size:12px; color:#8e9194;line-height:44px; margin:0 10px}
.foot_r{ float:right;font-size:12px; color:#8e9194;line-height:44px;}

</style>
<div class="sy_main">
        	<div class="zx_main">
            	<div class="tm">
                    	<h2 class="bt3">招贤纳士</h2>
                        <div class="bt2">
                        	
                        </div></div>
                       <div class="zx">
                       		<h2>给自己一个机会，也给我们一个机会！
 </h2>
                            <p>上海炫漫科技有限公司坚持可持续发展的人才战略，并将“尊重个人”作为企业核心价值之一，作为你职业发展的一部分，我们承诺支持你提高技能和拓展专业知识<br>我们通过各种现场培训以及在职学习提供丰富的在教育，培训和发展机会，这对于你的获得技能知识和认证以更好的应对工作需要非常重要。</p>
                            <h3>加入我们，你 —— 准备好了吗？</h3>
                       </div>
                        <ul class="al1">
                        	<li class="xuanz1">
                            	<h2 class="alfl1"><a href="/app/zxns3">我要<br>应聘</a></h2>
                                <h3 class="sl1">UI设计师</h3>
                                <p class="p11">
                              月薪范围：8k-10k&nbsp;&nbsp;&nbsp;&nbsp;工作地点：上海<br>
工作经验：2-3年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学历要求：本科<br>
年龄：23岁以上&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别：不限<br>
<br>
职位描述 ：<br>
	&nbsp;手绘精通，一定要有代表作哦；<br>
	&nbsp;手绘能力出色，构图及色彩能力扎实；<br>
	&nbsp;熟练使用PS，AI等图像处理软件；<br>
	&nbsp;对APP设计有强烈兴趣；<br>
    &nbsp;处女作极佳，尽情钻牛角吧。投递简历时请附带个人作品和主页链接；
                                                            </p>
                            </li>
                            <li>
                            
                            
                            	<h2 class="alfl1"><a href="/app/zxns3">我要<br>
应聘</a></h2>
                                <h3 class="sl1">UI设计师</h3>
                                <p class="p11">
                              月薪范围：8k-10k&nbsp;&nbsp;&nbsp;&nbsp;工作地点：上海<br>
工作经验：2-3年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学历要求：本科<br>
年龄：23岁以上&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别：不限<br>
<br>
职位描述 ：<br>
	&nbsp;手绘精通，一定要有代表作哦；<br>
	&nbsp;手绘能力出色，构图及色彩能力扎实；<br>
	&nbsp;熟练使用PS，AI等图像处理软件；<br>
	&nbsp;对APP设计有强烈兴趣；<br>
    &nbsp;处女作极佳，尽情钻牛角吧。投递简历时请附带个人作品和主页链接；
                                                            </p>
                            </li>
                            <li style="margin-right:0">
                            	<h2 class="alfl1"><a href="/app/zxns3">我要<br>
应聘</a></h2>
                                <h3 class="sl1">设计师</h3>
                               <p class="p11">
                              月薪范围：8k-10k&nbsp;&nbsp;&nbsp;&nbsp;工作地点：上海<br>
工作经验：2-3年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学历要求：本科<br>
年龄：23岁以上&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别：不限<br>
<br>
职位描述 ：<br>
	&nbsp;手绘精通，一定要有代表作哦；<br>
	&nbsp;手绘能力出色，构图及色彩能力扎实；<br>
	&nbsp;熟练使用PS，AI等图像处理软件；<br>
	&nbsp;对APP设计有强烈兴趣；<br>
    &nbsp;处女作极佳，尽情钻牛角吧。投递简历时请附带个人作品和主页链接；
                                                            </p>
                            </li>
                        </ul>
                         <ul class="al1" style="padding-bottom:20px">
                        	<li>
                            	<h2 class="alfl1"><a href="/app/zxns3">我要<br>应聘</a></h2>
                                <h3 class="sl1">产品经理</h3>
                               <p class="p11">
                              月薪范围：8k-10k&nbsp;&nbsp;&nbsp;&nbsp;工作地点：上海<br>
工作经验：2-3年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学历要求：本科<br>
年龄：23岁以上&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别：不限<br>
<br>
职位描述 ：<br>
	&nbsp;手绘精通，一定要有代表作哦；<br>
	&nbsp;手绘能力出色，构图及色彩能力扎实；<br>
	&nbsp;熟练使用PS，AI等图像处理软件；<br>
	&nbsp;对APP设计有强烈兴趣；<br>
    &nbsp;处女作极佳，尽情钻牛角吧。投递简历时请附带个人作品和主页链接；
                                                            </p>
                            </li>
                            <li>
                            	<h2 class="alfl1"><a href="/app/zxns3">我要<br>
应聘</a></h2>
                                <h3 class="sl1">销售代表</h3>
                                <p class="p11">
                              月薪范围：8k-10k&nbsp;&nbsp;&nbsp;&nbsp;工作地点：上海<br>
工作经验：2-3年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学历要求：本科<br>
年龄：23岁以上&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别：不限<br>
<br>
职位描述 ：<br>
	&nbsp;手绘精通，一定要有代表作哦；<br>
	&nbsp;手绘能力出色，构图及色彩能力扎实；<br>
	&nbsp;熟练使用PS，AI等图像处理软件；<br>
	&nbsp;对APP设计有强烈兴趣；<br>
    &nbsp;处女作极佳，尽情钻牛角吧。投递简历时请附带个人作品和主页链接；
                                                            </p>
                            </li>
                            <li style="margin-right:0">
                            	<h2 class="alfl1"><a href="/app/zxns3">我要<br>
应聘</a></h2>
                                <h3 class="sl1">销售代表</h3>
                                <p class="p11">
                              月薪范围：8k-10k&nbsp;&nbsp;&nbsp;&nbsp;工作地点：上海<br>
工作经验：2-3年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学历要求：本科<br>
年龄：23岁以上&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别：不限<br>
<br>
职位描述 ：<br>
	&nbsp;手绘精通，一定要有代表作哦；<br>
	&nbsp;手绘能力出色，构图及色彩能力扎实；<br>
	&nbsp;熟练使用PS，AI等图像处理软件；<br>
	&nbsp;对APP设计有强烈兴趣；<br>
    &nbsp;处女作极佳，尽情钻牛角吧。投递简历时请附带个人作品和主页链接；
                                                            </p>
                            </li>
                        </ul>
			</div>
            </div>
            <!--{subtemplate _footer}-->