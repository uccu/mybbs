<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{title}</title>
<base href="{baseurl}">
<!--{eval addcss('main')}-->
<script type="text/javascript">
	
function login1(){
	document.getElementById("fugai1").style.display="block";
	document.getElementById("bai").style.display="block";
}
function login2(){
	document.getElementById("fugai1").style.display="none";
	document.getElementById("bai").style.display="none";
}
function wjpwd1(){
	document.getElementById("fugai1").style.display="none";
	document.getElementById("bai").style.display="block";
	document.getElementById("fugai_index_wj_pwd").style.display="block";
}
function wjpwd2(){
	
	document.getElementById("bai").style.display="none";
	document.getElementById("fugai_index_wj_pwd").style.display="none";
}

function zhuce1(){
	
	document.getElementById("bai").style.display="block";
	document.getElementById("fugai_index_zhuce").style.display="block";
}
function zhuce2(){
	
	document.getElementById("bai").style.display="none";
	document.getElementById("fugai_index_zhuce").style.display="none";
}
function zhuce3(){
	document.getElementById("bai").style.display="block";
	document.getElementById("fugai1").style.display="none";
	document.getElementById("fugai_index_zhuce").style.display="block";
}
		
</script>
<style>
img{}
.m1 {
    
    
  -webkit-clip-path: url({href}#svgPath1);
  clip-path: url({href}#svgPath1);
}
.m2 {
   
  -webkit-clip-path: url({href}#svgPath2);
  clip-path: url({href}#svgPath2);
}
.m3 {
   
  -webkit-clip-path: url({href}#svgPath3);
  clip-path: url({href}#svgPath3);
}
.m4 {
    
  -webkit-clip-path: url({href}#svgPath4);
  clip-path: url({href}#svgPath4);
}
image:hover {
  opacity: .5;
}
svg{position:absolute}
</style>
</head>

<body>
<!--{eval echo $_SERVER['EDIRECT_URL']}-->
<div id="bai"></div>
<div id="fugai1">
	<div class="fugai_index_1" onclick="login2()"><img src="images/bc_03.png" class="fugai_index_tu1"/></div>
    <div class="fugai_index_2">登录</div>
    <div class="fugai_index_3"><input type="text" value="请输入您的手机号" onfocus="if ('请输入您的手机号'){value =''}" onblur="if (value ==''){value='请输入您的手机号'}" class="fugai_index_3_text1"/></div>
    <div class="fugai_index_3"><input type="text" value="6-16位密码，区分大小写" onfocus="if (value =='6-16位密码，区分大小写'){value =''}" onblur="if (value ==''){value='6-16位密码，区分大小写'}" class="fugai_index_3_text1"/></div>
    <div class="fugai_index_4" onclick="wjpwd1()">忘记密码</div>
    <div class="fugai_index_5">登录</div>
    <div class="fugai_index_6">
    	<div class="fugai_index_6_1">
        	<div class="fugai_index_che"><input type="checkbox" /></div>
            <div class="fugai_index_pwd">记住密码</div>
        </div>
        <div class="fugai_index_6_2" onclick="zhuce3()">去注册</div>
    </div>
</div>

<div id="fugai_index_wj_pwd">
	<div class="fugai_index_1" onclick="wjpwd2()"><img src="images/bc_03.png" class="fugai_index_tu1"/></div>
    <div class="fugai_index_2">忘记密码</div>
    <div class="fugai_index_3">
    	<input type="text" value="请输入您的手机号" onfocus="if (value =='请输入您的手机号'){value =''}" onblur="if (value ==''){value='请输入您的手机号'}" class="fugai_index_3_text2"/>
    	<div class="fugai_huoqu">获取验证码</div>
    </div>
    <div class="fugai_index_3"><input type="text" value="请输入验证码" onfocus="if (value =='请输入验证码'){value =''}" onblur="if (value ==''){value='请输入验证码'}" class="fugai_index_3_text1"/></div>
    <div class="fugai_index_3"><input type="text" value="请输入新密码" onfocus="if (value =='请输入新密码'){value =''}" onblur="if (value ==''){value='请输入新密码'}" class="fugai_index_3_text1"/></div>
    <div class="fugai_index_3"><input type="text" value="请确认新密码" onfocus="if (value =='请确认新密码'){value =''}" onblur="if (value ==''){value='请确认新密码'}" class="fugai_index_3_text1"/></div>
    <div class="fugai_index_7">确定</div>
</div>

<div id="fugai_index_zhuce">
	<div class="fugai_index_1" onclick="zhuce2()"><img src="images/bc_03.png" class="fugai_index_tu1"/></div>
    <div class="fugai_index_2">注册</div>
    <div class="fugai_index_3"><input type="text" value="请输入您的手机号" onfocus="if (value =='请输入您的手机号'){value =''}" onblur="if (value ==''){value='请输入您的手机号'}" class="fugai_index_3_text1"/></div>
    <div class="fugai_index_3"><input type="text" value="6-16位密码，区分大小写" onfocus="if (value =='6-16位密码，区分大小写'){value =''}" onblur="if (value ==''){value='6-16位密码，区分大小写'}" class="fugai_index_3_text1"/></div>
    <div class="fugai_index_3"><input type="text" value="请确认新密码" onfocus="if (value =='请确认新密码'){value =''}" onblur="if (value ==''){value='请确认新密码'}" class="fugai_index_3_text1"/></div>
    <div class="fugai_index_7">注册</div>
</div>
<div class="banner">
<!-- banner -->
	<img src="pic/{banner.0.pic}.jpg" class="banner_tu1"/>
    <div class="nav">
        <div class="nav_z">
            <div class="nav_z_left">
                <div class="nav_z_left_1"><img src="images/xq_06.png" class="nav_tu1"/></div>
                <a href="index.html"><div class="nav_z_left_2">主页</div></a>
                <a href="twostar.html"><div class="nav_z_left_3">二次元明星</div></a>
                <a href="#"><div class="nav_z_left_3">漫吧</div></a>
                <a href="#"><div class="nav_z_left_3">漫展&周边</div></a>
                <a href="center.html"><div class="nav_z_left_3">个人中心</div></a>
            </div>
            <div class="nav_z_right">
                <div class="nav_z_right_1">
                <input type="text" class="nav_text_1" value="搜索用户/标签" onfocus="if (value =='搜索用户/标签'){value =''}" onblur="if (value ==''){value='搜索用户/标签'}"  /></div>
                <div class="nav_z_right_2" onclick="zhuce1()">注册</div>
                <div class="nav_z_right_3" onclick="login1()">登录</div>
            </div>
        </div>
    </div>
	<div class="jiaru">
    	<div class="jr_z">
        	<div class="jr_1"><img src="images/sy_04.png" /></div>
            <div class="jr_2">
            	<div class="jr_2_1">{banner.0.title}</div>
                <div class="jr_2_2">{banner.0.content}</div>
                <a href="{banner.0.href}"><div class="jr_2_3">{banner.0.button}</div></a>
            </div>
            <div class="jr_3"><img src="images/sy_06.png" /></div>
        </div>
    </div>
</div>
<div class="guanfang">
	<div class="guanfang_1">
    	<div class="guanfang_1_1">官方IP授权COS</div>
        <a href="cosrole.html"><div class="guanfang_1_2">MORE</div></a>
    </div>
</div>
<div class="ip_tu">
	<div class="ip_tu_zs">
        <!--{loop $character $k=>$c}-->
        <!--{if !$k}-->
    	<div class="ip_tu_1">
        	<a href="rolelist.html"><div class="ip_tu_1_1"><img src="pic/{c.thumb}.medium.jpg" class="ip_tu1"/></div></a>
            <div class="ip_tu_1_2">
                <div class="ip_wenzi_left">{c.name}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2" /></div>
                <div class="ip_1_2_4">{c.fans}</div>
            </div>
            <div class="ip_weizi_bot">出自：{c.pname}</div>
        </div>
        <!--{else}-->
        <div class="ip_tu_2">
        	<a href="rolelist.html"><div class="ip_tu_1_1"><img src="pic/{c.thumb}.medium.jpg" class="ip_tu1"/></div></a>
            <div class="ip_tu_1_2">
                <div class="ip_wenzi_left">{c.name}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2" /></div>
                <div class="ip_1_2_4">{c.fans}</div>
            </div>
            <div class="ip_weizi_bot">出自：{c.pname}</div>
        </div>
        {/if}
        <!--{/loop}-->
    </div>
</div>
<div class="guanfang">
 	<div class="guanfang_1">
    	<div class="guanfang_1_1">推荐明星</div>
        <a href="starlist.html"><div class="guanfang_1_2">MORE</div></a>
    </div>
</div>
<div class="mingxing">
    <div style="width: 1000px;height: 420px;margin: 0 auto;position: relative;">
		<svg height="420" width="1000">
          <defs>
            <clipPath id="svgPath1">
              <path  d="M0 0 L277 0 L139 420 L0 420 L0 0 Z"></path>
             </clipPath>
             <clipPath id="svgPath2">
              <path  d="M287 0 L564 0 L426 420 L149 420 L287 0 Z"></path>
             </clipPath>
             <clipPath id="svgPath3">
              <path  d="M574 0 L851 0 L713 420 L436 420 L574 0 Z"></path>
             </clipPath>
             <clipPath id="svgPath4">
              <path  d="M861 0 L1000 0 L1000 420 L723 420 L861 0 Z"></path>
             </clipPath>
          </defs>
          <g>
            <a xlink:href="stardetails.html">
            <image class="m1" xlink:href="pic/{star.0.pic}.jpg" x="000" y="0" height="420px" width="277px" /></a>
            <a xlink:href="stardetails.html">
            <image class="m2" xlink:href="pic/{star.1.pic}.jpg" x="149" y="0" height="420px" width="415px" /></a>
            <a xlink:href="stardetails.html">
            <image class="m3" xlink:href="pic/{star.2.pic}.jpg" x="436" y="0" height="420px" width="415px" /></a>
            <a xlink:href="stardetails.html">
            <image class="m4" xlink:href="pic/{star.3.pic}.jpg" x="723" y="0" height="420px" width="277px" /></a>
          </g>
        </svg>
       <div class="con_fg_1">
       		<a href="stardetails.html"><div class="con_fg_1_1">
            	<div class="con_fg_1_top">
                	<div class="con_fg_1_top_1">{star.0.nickname}</div>
                    <div class="con_fg_1_top_2"><img src="images/sy_11.png" class="con_fg_1_top_2_tu1"></div>
                    <div class="con_fg_1_top_3">{star.0.fans}</div>
                </div>
                <div class="con_fg_1_bot">
                    {if $star[0]['sign']}签约coser{/if}
                </div>
            </div></a>
            <a href="stardetails.html"><div class="con_fg_1_2">
            	<div class="con_fg_1_top">
                	<div class="con_fg_1_top_1">{star.1.nickname}</div>
                    <div class="con_fg_1_top_2"><img src="images/sy_11.png" class="con_fg_1_top_2_tu1"></div>
                    <div class="con_fg_1_top_3">{star.1.fans}</div>
                </div>
                <div class="con_fg_1_bot">
                    {if $star[1]['sign']}签约coser{/if}
                </div>
            </div></a>
            <a href="stardetails.html"><div class="con_fg_1_3">
            	<div class="con_fg_1_top">
                	<div class="con_fg_1_top_1">{star.2.nickname}</div>
                    <div class="con_fg_1_top_2"><img src="images/sy_11.png" class="con_fg_1_top_2_tu1"></div>
                    <div class="con_fg_1_top_3">{star.2.fans}</div>
                </div>
                <div class="con_fg_1_bot">
                    {if $star[2]['sign']}签约coser{/if}
                </div>
            </div></a>
            <a href="stardetails.html"><div class="con_fg_1_4">
            	<div class="con_fg_1_top">
                	<div class="con_fg_1_top_1">{star.3.nickname}</div>
                    <div class="con_fg_1_top_2"><img src="images/sy_11.png" class="con_fg_1_top_2_tu1"></div>
                    <div class="con_fg_1_top_3">{star.3.fans}</div>
                </div>
                <div class="con_fg_1_bot">
                    {if $star[3]['sign']}签约coser{/if}
                </div>
            </div></a>
       </div>
    </div>
</div>
<div class="tj_z">	
    <div class="sp_z">
    	<div class="sp_z_1">视频展示</div>
        <div class="sp_z_2">
        	<div class="sp_z_2_1">赛事视频</div>
            <!--{loop $contestVideo $v}-->
            <div class="sp_z_2_2">
            	<a href="video.html"><img src="pic/{v.thumb}.medium.jpg" class="sp_tu1"/>
            	<div class="sp_z_2_2_1">
                	<div class="sp_z_2_2_1_text">{v.title}</div>
                    <div class="sp_z_2_2_1_tu1"><img src="images/xq_71.png" /></div>
                </div></a>
            </div>
            <!--{/loop}-->
        </div>
        <div class="sp_z_2">
        	<div class="sp_z_2_1">明星视频</div>
            <!--{loop $video $v}-->
            <div class="sp_z_2_2">
            	<a href="video.html"><img src="pic/{v.thumb}.medium.jpg" class="sp_tu1"/>
            	<div class="sp_z_2_2_1">
                	<div class="sp_z_2_2_1_text">{v.title}</div>
                    <div class="sp_z_2_2_1_tu1"><img src="images/xq_71.png" /></div>
                </div></a>
            </div>
            <!--{/loop}-->
        </div>
    </div>
</div>
<div class="guanfang">
    <div class="guanfang_1">
        <div class="guanfang_1_1">个人排行榜</div>
        <div class="guanfang_1_2"></div>
    </div>
</div>
   
<div class="tj_z1">
    <div class="ip_tu_zong">
    	<div class="ip_tu_1s">
        	<div class="ip_tu_1_1">
            	<a href="stardetails.html"><img src="pic/{cosers.0.thumb}.medium.jpg" class="ip_tu1"/></a>
            	<div class="ip_tu_1_1_dw"><img src="images/123_03.png" /></div>
            </div>
            <div class="ip_tu_1_2">
            	<div class="ip_1_2_1"><img src="pic/{cosers.0.avatar}.avatar.jpg" class="ip_tu3"/></div>
                <div class="ip_1_2_2">{cosers.0.nickname}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                <div class="ip_1_2_4">{cosers.0.fans}</div>
            </div>
            
        </div>
        <div class="ip_tu_2s">
        	<div class="ip_tu_1_1">
            	<a href="stardetails.html"><img src="pic/{cosers.1.thumb}.medium.jpg" class="ip_tu1"/></a>
            	<div class="ip_tu_1_1_dw"><img src="images/123_06.png" /></div>
            </div>
            <div class="ip_tu_1_2">
            	<div class="ip_1_2_1"><img src="pic/{cosers.1.avatar}.avatar.jpg" class="ip_tu3"/></div>
                <div class="ip_1_2_2">{cosers.1.nickname}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                <div class="ip_1_2_4">{cosers.1.fans}</div>
            </div>
           
        </div>
        <div class="ip_tu_2s">
        	<div class="ip_tu_1_1">
            	<a href="stardetails.html"><img src="pic/{cosers.2.thumb}.medium.jpg" class="ip_tu1"/></a>
            	<div class="ip_tu_1_1_dw"><img src="images/123_08.png" /></div>
            </div>
            <div class="ip_tu_1_2">
            	<div class="ip_1_2_1"><img src="pic/{cosers.2.avatar}.avatar.jpg" class="ip_tu3"/></div>
                <div class="ip_1_2_2">{cosers.2.nickname}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                <div class="ip_1_2_4">{cosers.2.fans}</div>
            </div>
            
        </div>
        <div class="ip_tu_2s_1">
        
        	<div class="geren_left">4</div>
            <div class="geren_right">
            	<a href="stardetails.html"><div class="geren_r_1"><img src="pic/{cosers.3.avatar}.avatar.jpg" /></div></a>
                <div class="geren_r_2">
                    <div class="geren_r_2_1">{cosers.3.nickname}</div>
                    <div class="geren_r_2_2">
                    	<div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                        <div class="geren_r_2_2_1">{cosers.3.fans}</div>
                    </div>
                </div>
            </div>
            <div class="geren_left">5</div>
            <div class="geren_rights">
            	<a href="stardetails.html"><div class="geren_r_1"><img src="pic/{cosers.4.avatar}.avatar.jpg" /></div></a>
                <div class="geren_r_2">
                    <div class="geren_r_2_1">{cosers.4.nickname}</div>
                    <div class="geren_r_2_2">
                    	<div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                        <div class="geren_r_2_2_1">{cosers.4.fans}</div>
                    </div>
                </div>
            </div>
            <div class="geren_left">6</div>
            <div class="geren_rights">
            	<a href="stardetails.html"><div class="geren_r_1"><img src="pic/{cosers.5.avatar}.avatar.jpg" /></div></a>
                <div class="geren_r_2">
                    <div class="geren_r_2_1">{cosers.5.nickname}</div>
                    <div class="geren_r_2_2">
                    	<div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                        <div class="geren_r_2_2_1">{cosers.5.fans}</div>
                    </div>
                </div>
            </div>
            <div class="geren_left">7</div>
            <div class="geren_rights">
            	<a href="stardetails.html"><div class="geren_r_1"><img src="pic/{cosers.6.avatar}.avatar.jpg" /></div></a>
                <div class="geren_r_2">
                    <div class="geren_r_2_1">{cosers.6.nickname}</div>
                    <div class="geren_r_2_2">
                    	<div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                        <div class="geren_r_2_2_1">{cosers.6.fans}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="guanfang">
    <div class="guanfang_1">
        <div class="guanfang_1_1">团体排行榜</div>
        <div class="guanfang_1_2"></div>
    </div>
</div>
<div class="tuanti">
	<div class="tuanti_1">
    	<div class="tuanti_1_1">
        	<a href="teamdetails.html"><img src="pic/{team.0.pic}.medium.jpg" class="tuanti_1_1_tu1"/>
        	<div class="tuanti_1_1_dw">
            	<div class="tuanti_1_1_dw_1"><img src="images/qz_11.png" /><div class="tuanti_1_fg_1">1</div></div>
                <div class="tuanti_1_1_dw_2">
                	<font size="+1">{team.0.name}</font>&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/sy_11.png" class="tuanti_1_1_dw_2_tu1"/>&nbsp;
                    {team.0.fans}
                </div>
            </div></a>
        </div>
        <div class="tuanti_1_2">
            <a href="teamdetails.html"><img src="pic/{team.1.pic}.medium.jpg" class="tuanti_1_1_tu1"/>
            <div class="tuanti_1_1_dw">
            	<div class="tuanti_1_1_dw_1"><img src="images/qz_14.png" /><div class="tuanti_1_fg_1">2</div></div>
                <div class="tuanti_1_1_dw_2">
                	<font size="+1">{team.1.name}</font>&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/sy_11.png" class="tuanti_1_1_dw_2_tu1"/>&nbsp;
                    {team.1.fans}
                </div>
            </div></a>
        </div>
        <div class="tuanti_1_2">
            <a href="teamdetails.html"><img src="pic/{team.2.pic}.medium.jpg" class="tuanti_1_1_tu1"/>
            <div class="tuanti_1_1_dw">
            	<div class="tuanti_1_1_dw_1"><img src="images/qz_14.png" /><div class="tuanti_1_fg_1">3</div></div>
                <div class="tuanti_1_1_dw_2">
                	<font size="+1">{team.2.name}</font>&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/sy_11.png" class="tuanti_1_1_dw_2_tu1"/>&nbsp;
                    {team.2.fans}
                </div>
            </div></a>
        </div>
    </div>
    <div class="tuanti_2">
    	<div class="tuanti_2_1">
        	<a href="teamdetails.html"><img src="pic/{team.3.pic}.medium.jpg" class="tuanti_1_1_tu2"/>
        	<div class="tuanti_1_1_dws">
            	<div class="tuanti_1_1_dw_1s"><img src="images/qz_19.png" /><div class="tuanti_1_fg_2">4</div></div>
                <div class="tuanti_1_1_dw_2s">
                	<font size="+1">{team.3.name}</font>&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/sy_11.png" class="tuanti_1_1_dw_2_tu1"/>&nbsp;
                    {team.3.fans}
                </div>
            </div></a>
        </div>
        <!--{loop $team $k=>$t}-->
        {if $k>3}
        <div class="tuanti_2_2">
        	<a href="teamdetails.html"><img src="pic/{t.thumb}.medium.jpg" class="tuanti_1_1_tu2"/>
        	<div class="tuanti_1_1_dws">
            	<div class="tuanti_1_1_dw_1s"><img src="images/qz_19.png" /><div class="tuanti_1_fg_2">5</div></div>
                <div class="tuanti_1_1_dw_2s">
                	<font size="+1">{t.name}</font>&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/sy_11.png" class="tuanti_1_1_dw_2_tu1"/>&nbsp;
                    {t.fans}
                </div>
            </div></a>
        </div>
       	{/if}
        <!--{/loop}-->
    </div>
    
</div>
<div class="guanfang">
    <div class="guanfang_1">
        <div class="guanfang_1_1">大赛实况</div>
        <a href=""><div class="guanfang_1_2">MORE</div></a>
    </div>
</div>
    
<div class="dasai">
	<div class="dasai_1">
    	<a href="actually.html">
        	<div class="dasai_1_1"><img src="images/sy_60.png" />
        
        	<div class="dasai_1_fg"><img src="images/sj_03.png"></div>
        </div></a>
        <div class="dasai_1_2">
        	<div class="dasai_1_2_1">炫漫线下cosplay大赛</div>
            <div class="dasai_1_2_2">首届炫漫线下全民角色国际cosplay锦标赛打造原汁原味的顶级cosplay赛事，范围覆盖亚洲。</div>
            <a href="actually.html"><div class="dasai_1_2_3">查看全文</div></a>
        </div>
        <a href="actually.html"><div class="dasai_1_1"><img src="images/sy_63.png" /><div class="dasai_1_fg"><img src="images/sj_03.png"></div></div>
        	
        </a>
        <div class="dasai_1_2">
        	<div class="dasai_1_2_1">炫漫线下cosplay大赛</div>
            <div class="dasai_1_2_2">首届炫漫线下全民角色国际cosplay锦标赛打造原汁原味的顶级cosplay赛事，范围覆盖亚洲。</div>
            <a href="actually.html"><div class="dasai_1_2_3">查看全文</div></a>
        </div>
    </div>
   <div class="dasai_2">
        <div class="dasai_1_2">
        	<div class="dasai_1_2_1">炫漫线下cosplay大赛</div>
            <div class="dasai_1_2_2">首届炫漫线下全民角色国际cosplay锦标赛打造原汁原味的顶级cosplay赛事，范围覆盖亚洲。</div>
            <a href="actually.html"><div class="dasai_1_2_3">查看全文</div></a>
        </div>
        <a href="actually.html"><div class="dasai_1_1"><img src="images/sy_66.png" />
        	<div class="dasai_2_fg"><img src="images/sj_06.png"></div>
        </div></a>
        <div class="dasai_1_2">
        	<div class="dasai_1_2_1">炫漫线下cosplay大赛</div>
            <div class="dasai_1_2_2">首届炫漫线下全民角色国际cosplay锦标赛打造原汁原味的顶级cosplay赛事，范围覆盖亚洲。</div>
            <a href="actually.html"><div class="dasai_1_2_3">查看全文</div></a>
        </div>
        <a href="actually.html"><div class="dasai_1_1"><img src="images/sy_68.png" />
        	<div class="dasai_2_fg"><img src="images/sj_06.png"></div>
        </div></a>
    </div>
</div>    
<div class="guanfang">
    <div class="guanfang_1">
        <div class="guanfang_1_1">赛事烽火</div>
        <div class="guanfang_1_2"></div>
    </div>
</div>    
<div class="fenghuo">
	<div class="fh_z"><img src="images/sy_71.png" /></div>
</div>

<div class="fooder">
	<div class="fooder_content">
    	<div class="fooder_content_top">
        	<div class="f_c_t_1">
            	<div class="f_c_t_top">友情链接</div>
                <a href="#"><div class="f_c_t_con">哗哩哗哩动画</div></a>
                <a href="#"><div class="f_c_t_con">半次元社区</div></a>
                <a href="#"><div class="f_c_t_con">chinacoser</div></a>
            </div>
            <div class="f_c_t_2">
            	<div class="f_c_t_top">站点地图</div>
                <div class="f_c_t_con">
                	<a href="index.html">主&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;页</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                	<a href="twostar.html">二次元明星</a>
                </div>
                <div class="f_c_t_con">
                	<a href="#">漫&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;吧</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#">漫展&周边</a>
                </div>
                <div class="f_c_t_con">
                	<a href="center.html">个人中心</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="zxns1.html">加入我们</a>
                </div>
          </div>
            <div class="f_c_t_3">
            	<div class="f_c_t_top">关注我们</div>
                <div class="f_tu">
                	<a href="#"><img src="images/xq_118.png"  class="f_tu1"/></a>
                    <a href="#"><img src="images/xq_120.png" class="f_tu1"/></a>
                    <a href="#"><img src="images/xq_122.png" class="f_tu1"/></a>
                    <a href="#"><img src="images/xq_124.png" class="f_tu1"/></a>
                    <a href="#"><img src="images/xq_126.png" class="f_tu1"/></a>
                    <a href="#"><img src="images/xq_128.png" class="f_tu1"/></a>
                </div>
            </div>
            <div class="f_c_t_4">
            	<div class="f_tu2"><img src="images/xq_115.png" /></div>
            </div>
            <div class="f_c_t_5">
            	<div class="f_c_t_5_1">扫一扫<br />下载APP</div>
            </div>
        </div>
        
    </div>
</div>
<div class="fooder1">
	<div class="fooder1_content">Powered by Hanyu Copyright © 2011-2013 www.xuanman.com All rights reserved.沪ICP备13047191号</div>
</div>
</body>
</html>