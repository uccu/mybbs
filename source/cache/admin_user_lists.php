<?php defined('IN_PLAY') || exit('Access Denied');?><!DOCTYPE html5><html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="keywords" content="<?php echo $g["template"]["keywords"];?>"><meta name="description" content="<?php echo $g["template"]["description"];?>"><title><?php echo $g["template"]["title"];?></title><base href="<?php echo $g["template"]["baseurl"];?>"><link rel="stylesheet" href="//apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"><?php addcss('m',0,'tool') ?><script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/jquery-lazyload/1.9.5/jquery.lazyload.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script><script src="//dn-cdnjsnet.qbox.me/crypto-js/3.1.2/rollups/md5.js"></script><script src="//apps.bdimg.com/libs/crypto-js/3.1.2/components/enc-base64-min.js" type="text/javascript"></script><!--[if lt IE 9]>  <script src="//apps.bdimg.com/libs/html5shiv/r29/html5.min.js"></script>  <script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]--><script>window.j=jQuery.noConflict();</script><?php addjs('p',0,'tool') ?></head><body><?php addjs('p','header','admin') ?><style>.modal-backdrop{z-index:1}.modal{z-index:2}</style><div class="container"><div class="page-header"><h1>美容整形 <small>后台</small></h1></div><ul class="nav nav-tabs"><li role="presentation" class="index"><a href="index">Smile</a></li><li role="presentation" class="common"><a href="common">基本</a></li><li role="presentation" class="permission"><a href="permission">权限</a></li><li role="presentation" class="user"><a href="user">会员</a></li><li role="presentation" class="adviser"><a href="adviser">顾问</a></li><li role="presentation" class="project"><a href="project">项目</a></li> <li role="presentation" class="product"><a href="product">产品</a></li><li role="presentation" class="dropdown articleMod"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">资料<span class="caret"></span></a><ul class="dropdown-menu"><li><a href="article/theme_lists">库列表</a></li><li role="separator" class="divider"></li><li><a href="article/article_lists">文章列表</a></li><li><a href="article/media_lists">视频列表</a></li></ul><li role="presentation" class="diary"><a href="diary">日记</a></li><li role="presentation" class="store"><a href="store">门店</a></li><li role="presentation" class="expert"><a href="expert">专家</a></li><li role="presentation" class="community"><a href="community">社区</a></li><li role="presentation" class="score"><a href="score">积分</a></li><li role="presentation" class="shop"><a href="shop">商城</a></li><li role="presentation" class="feedback"><a href="feedback">反馈</a></li><li role="presentation" class="logout"><a href="admin/logout">退出</a></li></ul></div><div class="container"><ol class="breadcrumb"><li><a href="index">Home</a></li><li><a href="user">会员</a></li><li><a href="user/lists">会员列表</a></li></ol><div class="alert_box"></div></div><div class="container"><div class="col-md-2"><div class="list-group"><a class="list-group-item active cd">会员列表</a></div>   </div><div class="col-md-10"><div class="panel panel-default"><div class="panel-body form-inline"> <div class="form-group" style="margin-right:10px"><label for="exampleInputName2">账号</label><input type="text" class="form-control" id="example1" placeholder=""></div><div class="form-group" style="margin-right:10px"><label for="exampleInputEmail2">顾问</label><input type="text" class="form-control" id="example2" placeholder=""></div><button type="submit" class="btn btn-default search">搜索</button></div></div><div class="panel panel-default"><div class="panel-body"><table class="text-center table table-striped sortable-theme-bootstrap" data-sortable><thead><tr><th class="text-center">ID</th><th class="text-center">账号</th><th class="text-center">昵称</th><th class="text-center">性别</th><th class="text-center">地区</th><th class="text-center">创建时间</th><th class="text-center">积分</th><th class="text-center">顾问</th><th class="text-center" style="min-width:150px">操作</th></tr></thead><tbody><?php foreach($list as $user){ ?><tr><td><?php echo $user["uid"];?></td><td><?php echo $user["phone"];?></td><td><?php echo $user["nickname"];?></td><td><?php echo $user["sexx"];?></td><td><?php echo $user["area"];?></td><td><?php echo $user["cdate"];?></td><td><?php echo $user["score"];?></td><td><?php echo $user["advisername"];?></td><td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">查看</button><button type="button" style="margin-left:10px" class="btn btn-danger del_user">删除</button></td></tr><?php } ?></tbody></table><nav><ul class="pagination pageset"></ul></nav></div></div></div></div><div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel">修改</h4></div><div class="modal-body"><form><div class="form-group"><label for="move">UID</label><input type="text" class="form-control" disabled="disabled" id="uid" name="uid2"><input type="hidden" class="form-control" id="uid" name="uid"></div><div class="form-group"><label>头像</label><input type="file" /><p class="help-block"></p><img class='img-responsive img-circle' style="width:100px"  /></div><div class="form-group"><input class="form-control pic-form" name="avatar2" type="text" value="" disabled="disabled"/><input class="form-control pic-form" name="avatar" type="hidden" value=""/></div><div class="form-group"><label for="move">手机号</label><input type="text" class="form-control" name="phone" disabled="disabled"></div><div class="form-group"><label for="move">昵称</label><input type="text" class="form-control" name="nickname"></div><div class="form-group"><label for="move">姓名</label><input type="text" class="form-control" name="=name"></div><div class="form-group"><label for="move">出生年月日</label><input type="text" class="form-control" name="age" placeholder="格式：年-月-日"></div><div class="form-group"><label for="move">地区</label><select class="form-control" name="area"><option selected=“selected” value="">无</option><?php foreach($areas as $area){ ?><option value="<?php echo $area["name"];?>"><?php echo $area["name"];?></option><?php } ?></select></div><div class="form-group"><label for="exampleInputFile">性别</label></div><div class="form-group"><label class="radio-inline"><input type="radio" name="sex" id="inlineRadio1" value="1" checked="checked"> 男</label><label class="radio-inline"><input type="radio" name="sex" id="inlineRadio2" value="2"> 女</label></div><div class="form-group"><label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox1" name="marry" value="1"> 已结婚</label><label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox2" name="child" value="1"> 已生育</label><label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox3" name="plastic" value="1"> 做过医美</label><label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox3" name="plastic" value="1"> 日记是否有更新</label></div><div class="form-group"><label for="move">E-mail</label><input type="email" class="form-control" name="email" placeholder=""></div><div class="form-group"><label for="move">工作</label><select class="form-control" name="work"><option selected=“selected” value="">无</option><?php foreach($works as $work){ ?><option value="<?php echo $work["name"];?>"><?php echo $work["name"];?></option><?php } ?></select></div><div class="form-group"><label for="move">喜欢的项目：</label><?php foreach($projects as $project){ ?><label><input type="checkbox" id="inlineCheckbox1" name="interest" value="<?php echo $project["jid"];?>"> <?php echo $project["jname"];?></label><?php } ?></div><div class="form-group"><label for="move">积分</label><input type="text" class="form-control" name="score" placeholder=""></div><div class="form-group"><label for="move">消费增加积分</label><input type="text" class="form-control" name="shop" placeholder=""></div><div class="form-group"><label for="move">邀请人ID</label><input type="text" class="form-control" name="invate" placeholder=""></div><div class="form-group"><label for="move">顾问ID</label><input type="text" class="form-control" name="adviser" placeholder=""></div><div class="form-group"><label for="move">重设密码</label><input type="password" class="form-control" name="pwd" placeholder=""></div></form></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">关闭</button><button type="button" class="btn btn-primary save">保存</button></div></div></div></div><script>j('.search').click(()=>{var a1=j('#example1').val(),a2=j('#example2').val();a1=a1?a1:0;a2=a2?a2:0;location = 'user/lists/1/'+a1+'/'+a2});   getPageSet(<?php echo $currentPage;?>,<?php echo $maxPage;?>,'href','user/lists/',(folder[5]?'/'+folder[5]:'')+(folder[6]?'/'+folder[6]:''));   j('#myModal').on('show.bs.modal',function(e){var b=j(e.relatedTarget),t=b.parent().parent(),id=t.find('td:eq(0)').text(),m=j(this);j.post('user/get_user_detail/'+id,(d)=>{m.find('[name=uid]').val(d.data.uid);m.find('[name=uid2]').val(d.data.uid);m.find('img').attr('src','http://120.26.230.136:6087/pic/'+d.data.avatar);m.find('[name=avatar]').val(d.data.avatar);m.find('[name=avatar2]').val(d.data.avatar);m.find('[name=phone]').val(d.data.phone);m.find('[name=nickname]').val(d.data.nickname);m.find('[name=name]').val(d.data.name);m.find('[name=age]').val(d.data.age.dateChange());m.find('[name=area]').val(d.data.area);m.find('[name=work]').val(d.data.work);if(d.data.sex)m.find('[name=sex][value='+d.data.sex+']').click();m.find('[name=email]').val(d.data.email);m.find('[name=marry]').attr('checked',false);if(d.data.marry=='1')m.find('[name=marry]').click();m.find('[name=diary]').attr('checked',false);if(d.data.diary=='1')m.find('[name=diary]').click();m.find('[name=child]').attr('checked',false);if(d.data.child=='1')m.find('[name=child]').click();m.find('[name=plastic]').attr('checked',false);if(d.data.plastic=='1')m.find('[name=plastic]').click();m.find('[name=interest]').attr('checked',false);for(var k in d.data.interest)m.find('[name=interest][value='+d.data.interest[k]+']').click();m.find('[name=score]').val(d.data.score);m.find('[name=invate]').val(d.data.invate);m.find('[name=adviser]').val(d.data.adviser);m.find('[name=pwd]').val('');},'json');m.find('.help-block').html('');});   j('#myModal [type=file]').change(function(){   var form = packFormData('#myModal [type=file]',{uid:j('#myModal [name=uid]').val()});j.ajax({url:'common/up_avatar',data:form,contentType:false,processData:false,type:'post',beforeSend:function(xhr){j('.help-block').html('uploading file waiting...')},success:function(d){if(d.code!==200){j('.help-block').html('upload failed');return}j('.help-block').html('upload successed');j('#myModal [name=avatar]').val(d.data[0]);j('#myModal [name=avatar2]').val(d.data[0]);}})});j('#myModal .save').click(function(){var s=j(this),d=j('#myModal form').serializeArray();for(e in d){d[e].name = d[e].name=='interest'?'interest[]':d[e].name}j.post('user/change_info',d,function(d){if(d.code!==200)alert(d.desc);location.reload(true)})});j('.del_user').click(function(){var id=j(this).parent().parent().find('td:eq(0)').text();j('.alert_box').html('').append('<div id="alert" class="alert alert-danger alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认删除？</h4><p></p><p><button type="button" class="btn btn-danger yes" style="margin-right:10px">删除</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');j('.alert').slideDown().find('.yes').one('click',function(){j.post('user/del_user',{uid:id},function(){location.reload(true)})})});</script></body></html>