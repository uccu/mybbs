j(function(){
    alert('2');
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
      j.post('tool/captcha/get_captcha',f,function(d){if(d.code!=200){j('.help-block').html(d.desc);return}j('.help-block').html('已发送验证码');t(60),'json'})
  },t=function(r){
      if(!r){
          j('.get_captcha').addClass('btn-success').html('获取验证码');
          j('.get_captcha').one('click',g);return;
      }
      j('.get_captcha').removeClass('btn-success').html('剩余'+r+'秒');
      setTimeout(function(){t(r-1)},1000);
  };
  
  j('.get_captcha').one('click',g);
  })