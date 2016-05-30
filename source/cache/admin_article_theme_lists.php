<?php defined('IN_PLAY') || exit('Access Denied');?><!DOCTYPE html5><html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="keywords" content="<?php echo $g["template"]["keywords"];?>"><meta name="description" content="<?php echo $g["template"]["description"];?>"><title><?php echo $g["template"]["title"];?></title><base href="<?php echo $g["template"]["baseurl"];?>"><link rel="stylesheet" href="//apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"><?php addcss('m',0,'tool') ?><script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/jquery-lazyload/1.9.5/jquery.lazyload.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script><script src="//dn-cdnjsnet.qbox.me/crypto-js/3.1.2/rollups/md5.js"></script><script src="//apps.bdimg.com/libs/crypto-js/3.1.2/components/enc-base64-min.js" type="text/javascript"></script><!--[if lt IE 9]>  <script src="//apps.bdimg.com/libs/html5shiv/r29/html5.min.js"></script>  <script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]--><?php addjs('p',0,'tool') ?></head><body><?php addjs('p','header','admin') ?><div class="container"><div class="page-header"><h1>美容整形 <small>后台</small></h1></div><ul class="nav nav-tabs"><li role="presentation" class="index"><a href="index">Smile</a></li><li role="presentation" class="common"><a href="common">基本</a></li><?php if($userType>2){ ?><li role="presentation" class="permission"><a href="permission">权限</a></li><?php } ?><li role="presentation" class="user"><a href="user">会员</a></li><li role="presentation" class="adviser"><a href="adviser">顾问</a></li><li role="presentation" class="project"><a href="project">项目</a></li> <li role="presentation" class="product"><a href="product">产品</a></li><li role="presentation" class="dropdown articleMod"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">资料<span class="caret"></span></a><ul class="dropdown-menu"><li><a href="article/theme_lists">库列表</a></li><li role="separator" class="divider"></li><li><a href="article/article_lists">文章列表</a></li><li><a href="article/media_lists">视频列表</a></li></ul><li role="presentation" class="diary"><a href="diary">日记</a></li><li role="presentation" class="store"><a href="store">门店</a></li><li role="presentation" class="expert"><a href="expert">专家</a></li><li role="presentation" class="community"><a href="community">社区</a></li><li role="presentation" class="score"><a href="score">积分</a></li><li role="presentation" class="shop"><a href="shop">商城</a></li><li role="presentation" class="feedback"><a href="feedback">反馈</a></li><li role="presentation" class="logout"><a href="admin/logout">退出</a></li></ul></div><div class="container"><ol class="breadcrumb"><li><a href="index">Home</a></li><li><a href="article">资料</a></li><li><a href="article/theme_lists">库列表</a></li></ol><div class="alert_box"></div></div><div class="container"><div class="col-md-2"><div class="list-group"><a class="list-group-item active cd">库列表</a><a href="article/article_lists" class="list-group-item">文章列表</a><a href="article/media_lists" class="list-group-item">视频列表</a></div>   </div><div class="col-md-10"><div class="panel panel-default"><div class="panel-body"><table class="text-center table table-striped sortable-theme-bootstrap" data-sortable><thead><tr><th class="text-center">ID</th><th class="text-center">名字</th><th class="text-center">创建时间</th><th class="text-center">操作</th></tr></thead><tbody><?php foreach($list as $p){ ?><tr><td><?php echo $p["tid"];?></td><td><?php echo $p["tname"];?></td><td><?php echo $p["cdate"];?></td><td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">查看详情</button><button type="button" style="margin-left:10px" class="btn btn-danger del">删除</button></td></tr><?php } ?></tbody></table><div class="text-right fr"><button type="button" class="btn btn-success add" data-toggle="alert" data-target="#alert">添加</button></div><nav><ul class="pagination pageset"></ul></nav></div></div></div></div><div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel">修改</h4></div><div class="modal-body"><form><div class="form-group"><label for="move">TID</label><input type="text" class="form-control" disabled="disabled" id="uid" name="tid2"><input type="hidden" class="form-control" id="uid" name="tid"></div><div class="form-group"><label for="move">名字</label><input type="text" class="form-control" name="tname" ></div><div class="form-group"><label for="move">排序编号</label><input type="text" class="form-control" name="torder" ></div>   </form></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">关闭</button><button type="button" class="btn btn-primary save">保存</button></div></div></div></div><script>   var goods = 'theme',control = 'article';   j('#myModal').on('show.bs.modal',function(e){var b=j(e.relatedTarget),t=b.parent().parent(),id=t.find('td:eq(0)').text(),m=j(this);j.post(control+'/get_'+goods+'_detail/'+id,(d)=>{for(var k in d.data){m.find('[name='+k+']').val(d.data[k]);m.find('[name='+k+'2]').val(d.data[k]);m.find('#pic_'+k).attr('src',location.origin+'/pic/'+d.data[k]);}},'json');m.find('.help-block').html('');});   j('#myModal [type=file]').change(function(){var that = j(this),id = that.attr('id'),f = that.attr('data-circle') ? {circle:1} : {},form = packFormData('#'+id,f);j.ajax({url:location.origin+'/admin/common/up_pic',data:form,contentType:false,processData:false,type:'post',beforeSend:()=>that.parent().find('.help-block').html('uploading file waiting...'),success:d=>{if(d.code!==200){that.parent().find('.help-block').html('upload failed');return}that.parent().find('.help-block').html('upload successed');j('#myModal [name='+id+']').val(d.data[0]);j('#myModal [name='+id+'2]').val(d.data[0]);that.parent().find('img').attr('src',location.origin+'/pic/'+d.data[0]);}})});j('#myModal .save').click(function(){var s=j(this),d=j('#myModal form').serializeArray();for(e in d){d[e].name = d[e].name=='interest'?'interest[]':d[e].name}j.post(control+'/change_'+goods,d,function(){location.reload(true)})});j('.add').click(function(){j('.alert_box').html('').append('<div id="alert" class="alert alert-success alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认添加？</h4><p></p><p><button type="button" class="btn btn-success yes" style="margin-right:10px">添加</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');j('.alert').slideDown().find('.yes').one('click',function(){j.post(control+'/add_'+goods,function(){location.reload(true)})})});j('.del').click(function(){var id=j(this).parent().parent().find('td:eq(0)').text();j('.alert_box').html('').append('<div id="alert" class="alert alert-danger alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认删除？</h4><p>请确保该库内没有任何资料</p><p><button type="button" class="btn btn-danger yes" style="margin-right:10px">删除</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');j('.alert').slideDown().find('.yes').one('click',function(){j.post(control+'/del_'+goods+'/'+id,function(){location.reload(true)})})});</script></body></html>