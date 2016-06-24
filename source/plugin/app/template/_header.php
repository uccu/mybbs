<!--{subtemplate tool:header}-->
<!--{eval addcss('main')}-->
<!--{eval addjs('p')}-->

<div class="nav{if $g['control']=='index'} pa{else}" style="background: #333;{/if}">
<!--{if !$me}-->
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



        <div class="nav_z">
            <div class="nav_z_left">
                <div class="nav_z_left_1"><img src="images/xq_06.png" class="nav_tu1"/></div>
                <a href="app/index"><div class="nav_z_left_2">主页</div></a>
                <a href="app/twostar"><div class="nav_z_left_3">二次元明星</div></a>
                <a><div class="nav_z_left_3 cp">漫吧</div></a>
                <a><div class="nav_z_left_3 cp">漫展&周边</div></a>
                <a onclick="login1()"><div class="nav_z_left_3 cp">个人中心</div></a>
            </div>
            <div class="nav_z_right">
                <div class="nav_z_right_1">
                <input type="text" class="nav_text_1" value="搜索用户/标签" onfocus="if (value =='搜索用户/标签'){value =''}" onblur="if (value ==''){value='搜索用户/标签'}"  /></div>
                <div class="nav_z_right_2" onclick="zhuce1()">注册</div>
                <div class="nav_z_right_3" onclick="login1()">登录</div>
            </div>
        </div>

<div id="bai"></div>
<div id="fugai1">
	<div class="fugai_index_1" onclick="login2()"><img src="images/bc_03.png" class="fugai_index_tu1"/></div>
    <div class="fugai_index_2">登录</div>
    <form id="loginForm">
    <div class="fugai_index_3"><input type="text" value="请输入您的手机号" onfocus="if ('请输入您的手机号'){value =''}" onblur="if (value ==''){value='请输入您的手机号'}" name="phone" class="fugai_index_3_text1"/></div>
    <div class="fugai_index_3"><input type="text" value="6-16位密码，区分大小写" onfocus="if (value =='6-16位密码，区分大小写'){value =''}" onblur="if (value ==''){value='6-16位密码，区分大小写'}" name="pwd" class="fugai_index_3_text1"/></div>
    </form>
    <div class="fugai_index_4" onclick="wjpwd1()">忘记密码</div>
    <div class="fugai_index_5 cp">登录</div>
    <script>
        j('.fugai_index_5').click(function(){
            j.post('app/login/login',j('#loginForm').serializeArray(),function(d){
                if(d.code==200)location.reload(true)
            },'json')
        })
    </script>
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

{else}



        <div class="nav_z">
            <div class="nav_z_left">
                <div class="nav_z_left_1"><img src="images/xq_06.png" class="nav_tu1"/></div>
                <a href="app/index"><div class="nav_z_left_2">主页</div></a>
                <a href="app/twostar"><div class="nav_z_left_3">二次元明星</div></a>
                <a><div class="nav_z_left_3 cp">漫吧</div></a>
                <a><div class="nav_z_left_3 cp">漫展&周边</div></a>
                <a href="app/usercenter/index/{me.uid}"><div class="nav_z_left_3">个人中心</div></a>
            </div>
            <div class="nav_z_right_cos">
                <div class="nav_z_right_1_cos">
                <input type="text" class="nav_text_1" value="搜索用户/标签" onfocus="if (value =='搜索用户/标签'){value =''}" onblur="if (value ==''){value='搜索用户/标签'}"></div>
                <div class="nav_nav_z">
                	<div class="nav_nav_z_1"><img src="pic/{me.avatar}.avatar.jpg" class="nav_nav_tu1 img-circle"></div>
                    <a href="app/usercenter/index/{me.uid}"><div class="nav_nav_z_2">{me.nickname}</div></a>
                </div>
                <a><div class="nav_nav_right logout cp"><ins>退出登录</ins></div></a>
                <script>
                    j('.logout').click(function(){
                        j.post('app/login/logout',function(){
                            location.reload(true)
                        })
                    })
                </script>
            </div>
        </div>




{/if}
    </div>