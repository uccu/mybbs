<!--{subtemplate tool:header}-->
<div class="modal db" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">注册</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" class="form-control" id="phone" name="invate" >
                    <div class="form-group">
                        <label for="phone">账号</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="手机号">
                    </div>
                    <div class="form-group">
                        <label for="pdw">密码</label>
                        <input type="password" class="form-control" id="pdw" name="pwd" placeholder="密码">
                    </div>
                    <div class="form-group">
                        <label for="pdw">重复密码</label>
                        <input type="password" class="form-control" id="pdw" name="pwd2" placeholder="重复密码">
                    </div>
                        <label for="pdw">验证码</label>
                    <div class="form-group form-inline">
                        <input type="password" class="form-control" id="captcha" name="captcha" placeholder="">
                        <button type="button" class="btn btn-success get_captcha">获取验证码</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="help-block"></p>
                <button type="button" class="btn btn-primary register">注册</button>
            </div>
        </div>
    </div>
</div>
<script>
    folder =location.pathname.split("/");
  j('[name=invate]').val(folder[3]);
  j('.register').click(function(){
    if(j('[name=phone]').val().length!=11){j('.help-block').html('手机号错误');return}
    if(j('[name=pwd]').val().length<6){j('.help-block').html('密码需要至少6位字符');return}
    if(j('[name=pwd]').val()!=j('[name=pwd2]').val()){j('.help-block').html('密码不一致');return}
    var f=j('form').serializeArray();
    j.post('user/in/create',f,function(d){
      if(d.code!=200){j('.help-block').html(d.desc);return}location='tool/downloadapp'
    },'json')
  });
  var g = function(){
      var f=j('form').serializeArray();
      j.post('tool/captcha/get_captcha',f,d=>{if(d.code!=200){j('.help-block').html(d.desc);return}j('.help-block').html('已发送验证码');t(60),'json'})
  },t=function(r){
      if(!r){
          j('.get_captcha').addClass('btn-success').html('获取验证码');
          j('.get_captcha').one('click',g);return;
      }
      j('.get_captcha').removeClass('btn-success').html('剩余'+r+'秒');
      setTimeout(function(){t(r-1)},1000);
  };
  
  j('.get_captcha').one('click',g);
  
  
</script>
<!--{subtemplate tool:footer}-->