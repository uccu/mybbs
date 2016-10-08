<!--{subtemplate tool:header}-->
<!--{eval addjs('classie',0,'tool')}-->
<div class="jumbotron cd nos">
    <div class="container">
        
    </div>
</div>
<div class="container">
<style>
video{width: 100%;}
*{outline:0}
</style>



<div class="container">
    <div class="row" style="padding:20px">
        <button class="t btn btn-default btn-block connect">连接</button>
    </div>
    <div class="row" style="padding:20px">
        <div class="col-md-6">
            <span class="input input--hoshi">
                <input class="input__field input__field--hoshi" type="password" id="password" name="password" style="height:57px;">
                <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password">
                    <span class="input__label-content input__label-content--hoshi">密码</span>
                </label>
            </span>
        </div>
        <div class="col-md-6">
            <button class="t btn btn-default btn-block login" style="height:99px">登录</button>
        </div>
    </div>
     <div class="row" style="padding:20px">
        <div class="col-md-6">
    
            <span class="input input--hoshi">
                <input class="input__field input__field--hoshi" type="text" id="channel" name="channel" style="height:57px">
                <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="channel">
                    <span class="input__label-content input__label-content--hoshi">频道</span>
                </label>
            </span>
         </div>
        <div class="col-md-6">
            <button class="t btn btn-default btn-block channel" style="height:99px">进入频道</button>
        </div>
    </div>
    <span class="input input--hoshi">
        <input class="input__field input__field--hoshi dn" type="file" id="file" name="file" style="height:57px;outline:0">
        <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="file">
            <span class="input__label-content input__label-content--hoshi"></span>
        </label>
    </span>
</div>



<button class="info">信息</button>

<button class="play">播放</button>

<button class="sync">同步</button>


<video></video>
<!--{eval addjs()}-->
<!--{subtemplate _footer}-->

