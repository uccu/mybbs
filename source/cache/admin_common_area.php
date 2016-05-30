<?php defined('IN_PLAY') || exit('Access Denied');?><!DOCTYPE html5><html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="keywords" content="<?php echo $g["template"]["keywords"];?>"><meta name="description" content="<?php echo $g["template"]["description"];?>"><title><?php echo $g["template"]["title"];?></title><base href="<?php echo $g["template"]["baseurl"];?>"><link rel="stylesheet" href="//apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"><?php addcss('m',0,'tool') ?><script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/jquery-lazyload/1.9.5/jquery.lazyload.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script><script src="//dn-cdnjsnet.qbox.me/crypto-js/3.1.2/rollups/md5.js"></script><script src="//apps.bdimg.com/libs/crypto-js/3.1.2/components/enc-base64-min.js" type="text/javascript"></script><!--[if lt IE 9]>  <script src="//apps.bdimg.com/libs/html5shiv/r29/html5.min.js"></script>  <script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]--><?php addjs('p',0,'tool') ?></head><body><?php addjs('p','header','admin') ?><div class="container"><div class="page-header"><h1>美容整形 <small>后台</small></h1></div><ul class="nav nav-tabs"><li role="presentation" class="index"><a href="index">Smile</a></li><li role="presentation" class="common"><a href="common">基本</a></li><?php if($userType>2){ ?><li role="presentation" class="permission"><a href="permission">权限</a></li><?php } ?><li role="presentation" class="user"><a href="user">会员</a></li><li role="presentation" class="adviser"><a href="adviser">顾问</a></li><li role="presentation" class="project"><a href="project">项目</a></li> <li role="presentation" class="product"><a href="product">产品</a></li><li role="presentation" class="dropdown articleMod"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">资料<span class="caret"></span></a><ul class="dropdown-menu"><li><a href="article/theme_lists">库列表</a></li><li role="separator" class="divider"></li><li><a href="article/article_lists">文章列表</a></li><li><a href="article/media_lists">视频列表</a></li></ul><li role="presentation" class="diary"><a href="diary">日记</a></li><li role="presentation" class="store"><a href="store">门店</a></li><li role="presentation" class="expert"><a href="expert">专家</a></li><li role="presentation" class="community"><a href="community">社区</a></li><li role="presentation" class="score"><a href="score">积分</a></li><li role="presentation" class="shop"><a href="shop">商城</a></li><li role="presentation" class="feedback"><a href="feedback">反馈</a></li><li role="presentation" class="logout"><a href="admin/logout">退出</a></li></ul></div><div class="container"><ol class="breadcrumb"><li><a href="index">Home</a></li><li><a href="common">基本设置</a></li><li><a href="common/area">地区列表</a></li></ol><div class="alert_box"></div></div><div class="container"><div class="col-md-2"><div class="list-group"><a href="common/pic" class="list-group-item">切图设置</a><a href="common/ad" class="list-group-item">社区广告</a><a href="common/shop" class="list-group-item">商城切图</a><a class="list-group-item active cd">地区列表</a><a href="common/work" class="list-group-item">工作列表</a></div>   </div><div class="col-md-10">   <div class="panel panel-default"><div class="panel-body form-inline"> <div class="form-group" style="margin-right:10px"><label for="exampleInputName2">省市</label><input type="text" class="form-control" id="example1" placeholder=""></div><div class="form-group" style="margin-right:10px"><label for="exampleInputEmail2">城市</label><input type="text" class="form-control" id="example2" placeholder=""></div><button type="submit" class="btn btn-default search">搜索</button></div></div><div class="panel panel-default"><div class="panel-body"><table class="text-center table table-striped sortable-theme-bootstrap" data-sortable><thead><tr><th class="text-center">省市</th><th class="text-center">城市</th><th class="text-center">区县</th><th class="text-center">操作</th></tr></thead><tbody><?php foreach($list as $p){ ?><tr><td><?php echo $p["province"];?></td><td><?php echo $p["city"];?></td><td><?php echo $p["district"];?></td><td><!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">修改</button>--><button type="button" style="margin-left:10px" class="btn btn-danger del">删除</button></td></tr><?php } ?></tbody></table><div class="text-right fr"><button type="button" class="btn btn-success add" data-toggle="modal" data-target="#myModal">添加</button></div><nav><ul class="pagination pageset"></ul></nav></div></div></div></div><div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel">修改</h4></div><div class="modal-body"><form><div class="form-group"><label for="move">省市</label><input type="text" class="form-control" name="province" ></div><div class="form-group"><label for="move">城市</label><input type="text" class="form-control" name="city" ></div><div class="form-group"><label for="move">区县</label><input type="text" class="form-control" name="district" ></div></form></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">关闭</button><button type="button" class="btn btn-primary save">保存</button></div></div></div></div><script>   var goods = 'area',control = 'common';   j('.search').click(()=>{var a1=j('#example1').val(),a2=j('#example2').val();a1=a1?a1:0;a2=a2?a2:0;location = control+'/area/'+a1+'/'+a2});   j('#myModal').on('show.bs.modal',function(e){var b=j(e.relatedTarget),t=b.parent().parent(),m=j(this);m.find('input').val('');m.find('[name=province]').val(t.find('td:eq(0)').text());m.find('[name=city]').val(t.find('td:eq(1)').text());m.find('[name=district]').val(t.find('td:eq(2)').text());m.find('.help-block').html('');});   j('#myModal .save').click(function(){var s=j(this),d=j('#myModal form').serializeArray();j.post(control+'/change_'+goods,d,function(){location.reload(true)})});j('.del').click(function(){var t=j(this).parent().parent(),province=t.find('td:eq(0)').text(),city=t.find('td:eq(1)').text(),district=t.find('td:eq(2)').text();j('.alert_box').html('').append('<div id="alert" class="alert alert-danger alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认删除？</h4><p></p><p><button type="button" class="btn btn-danger yes" style="margin-right:10px">删除</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');j('.alert').slideDown().find('.yes').one('click',function(){j.post(control+'/del_'+goods,{province:province,city:city,district:district},function(){location.reload(true)})})});</script></body></html>