<!--{subtemplate tool:header}-->
<!--{eval addjs('classie',0,'tool')}-->
<style>
.dn{display:none !important}
body>.back{
	width:100%;height:100%;z-index:-10;
	background-image:url(/source/plugin/my/pic/pixiv_1039353.jpg);
	background-size:cover;
	background-position:center center;
	filter:blur(10px);
	-webkit-filter:blur(10px);
}


.overlay{
	width:100%;height:100%;z-index:10;
}
.overlay>.back{
	width:100%;height:100%;z-index:-1;top:0;left:0;
	background-color:#000;
	opacity:0.8;
}
.overlay>.back.active{opacity:0.5}
.overlay>.back.dark{opacity:0.9}
.overlay>.main{
	display: table-cell;
	vertical-align: middle;
	text-align: center;
	z-index:2;
}
.login{
	width: 250px;
	background-color: #fff;
	padding: 25px;
	padding-top: 50px;
	box-shadow:3px 10px 30px #333;
	opacity:0.95;
	transform:scale(2) rotate(-5deg);
	opacity:0;
	filter:blur(1px);
	height: 500px;
    overflow: hidden;
    padding-bottom: 0;
	

}
.login.active{
	filter:blur(0px);
	transform:scale(1) rotate(0deg);opacity:0.95;
}
.login::before,.login::after{
	transition: all 1s;-moz-transition: all 1s;-webkit-transition: all 1s;-o-transition: all 1s;
	content:attr(before-content);position:absolute;
	top:0;left:0;width:100%;height:50px;
	background-color: rgba(94, 196, 80, 0.46);
	text-align:left;font-size: 1.5em;
    font-family: fantasy;padding: 10px 40px;opacity:1
}

.login::after{
	content:attr(after-content);opacity:0
}
.login.channel::before{opacity:0}
.login.channel::after{opacity:1}
input{
	height:57px;
}
.login_a,.channel_a{
	background: transparent;
    border: none;
    font-size: 0.4em;
    color: darkred;
    font-weight: bold;
    margin-right: 12px;padding:5px 15px;border-radius:3px;
    outline: 0;
}
.login_a:active,.channel_a:active{
	background-color:#ccc;color:#333
}


</style>

<div class="back pf"></div>

<div class="overlay pf dt">
	<div class="back pa t-1"></div>
	<div class="main pr">
		<div class="login tc center-block pr t-1" before-content="Login" after-content="Channel">
			<div class="tc">
				<span class="input input--hoshi">
					<input class="input__field input__field--hoshi" type="text" name="uid" id="uid">
					<label class="input__label input__label--hoshi input__label--hoshi-color-3" for="uid">
						<span class="input__label-content input__label-content--hoshi">UID</span>
					</label>
				</span>
			</div>
			<div class="tc">
				<span class="input input--hoshi">
					<input class="input__field input__field--hoshi" type="text" name="password" id="password">
					<label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password">
						<span class="input__label-content input__label-content--hoshi">Password</span>
					</label>
				</span>
			</div>
			<div class="tc">
				<span class="input input--hoshi">
					<input class="input__field input__field--hoshi" type="text" name="nickname" id="nickname">
					<label class="input__label input__label--hoshi input__label--hoshi-color-3" for="nickname">
						<span class="input__label-content input__label-content--hoshi">Nickname</span>
					</label>
				</span>
			</div>
			<div class="tc">
				<span class="input input--hoshi">
					<input class="input__field input__field--hoshi" type="text" name="avatar" id="avatar">
					<label class="input__label input__label--hoshi input__label--hoshi-color-3" for="avatar">
						<span class="input__label-content input__label-content--hoshi">Avatar</span>
					</label>
				</span>
			</div>
			<div class="tr">
				<button class="login_a t">登录</button>
			</div>

			<!--Channel-->
			<div class="tc dn channel">
				<span class="input input--hoshi">
					<input class="input__field input__field--hoshi" type="text" name="cid" id="cid">
					<label class="input__label input__label--hoshi input__label--hoshi-color-3" for="cid">
						<span class="input__label-content input__label-content--hoshi">Cid</span>
					</label>
				</span>
			</div>
			<div class="tr dn channel">
				<button class="channel_a t">进入频道</button>
			</div>
		</div>
		<input type="file" class="dn" />
		<video src="" class="dn" style="max-width:100%"></video>		
	</div>

</div>








<!--{eval addjs()}-->

<!--{subtemplate tool:footer}-->

