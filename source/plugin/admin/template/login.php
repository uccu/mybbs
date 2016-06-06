<!--{subtemplate tool:header}-->
<div class="modal db" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">登录</h4>
            </div>
            <div class="modal-body">
                <form>
                    
                    <div class="form-group">
                        <label for="phone">账号</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="手机号">
                    </div>
                    <div class="form-group">
                        <label for="pdw">密码</label>
                        <input type="password" class="form-control" id="pdw" name="pwd" placeholder="密码">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="help-block"></p>
                <button type="button" class="btn btn-primary login">登录</button>
            </div>
        </div>
    </div>
</div>
<script>
  j('.login').click(function(){
    var f=j('form').serializeArray();
    j.post('admin/admin_login',f,function(d){
      if(d.code!=200){j('.help-block').html(d.desc);return}location='index'
    },'json')
  })
  
  
</script>
<!--{subtemplate tool:footer}-->