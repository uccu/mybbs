<?php defined('IN_PLAY') || exit('Access Denied');?><!DOCTYPE html5><html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="keywords" content="<?php echo $g["template"]["keywords"];?>"><meta name="description" content="<?php echo $g["template"]["description"];?>"><title><?php echo $g["template"]["title"];?></title><base href="<?php echo $g["template"]["baseurl"];?>"><link rel="stylesheet" href="//apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"><?php addcss('m',0,'tool') ?><script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/jquery-lazyload/1.9.5/jquery.lazyload.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script><script src="//dn-cdnjsnet.qbox.me/crypto-js/3.1.2/rollups/md5.js"></script><script src="//apps.bdimg.com/libs/crypto-js/3.1.2/components/enc-base64-min.js" type="text/javascript"></script><!--[if lt IE 9]>  <script src="//apps.bdimg.com/libs/html5shiv/r29/html5.min.js"></script>  <script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]--><?php addjs('p',0,'tool') ?></head><body><?php addjs('p','header','admin') ?><div class="container"><div class="page-header"><h1>美容整形 <small>后台</small></h1></div><ul class="nav nav-tabs"><li role="presentation" class="index"><a href="index">Smile</a></li><li role="presentation" class="common"><a href="common">基本</a></li><?php if($userType>2){ ?><li role="presentation" class="permission"><a href="permission">权限</a></li><?php } ?><li role="presentation" class="user"><a href="user">会员</a></li><li role="presentation" class="adviser"><a href="adviser">顾问</a></li><li role="presentation" class="project"><a href="project">项目</a></li> <li role="presentation" class="product"><a href="product">产品</a></li><li role="presentation" class="dropdown articleMod"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">资料<span class="caret"></span></a><ul class="dropdown-menu"><li><a href="article/theme_lists">库列表</a></li><li role="separator" class="divider"></li><li><a href="article/article_lists">文章列表</a></li><li><a href="article/media_lists">视频列表</a></li></ul><li role="presentation" class="diary"><a href="diary">日记</a></li><li role="presentation" class="store"><a href="store">门店</a></li><li role="presentation" class="expert"><a href="expert">专家</a></li><li role="presentation" class="community"><a href="community">社区</a></li><li role="presentation" class="score"><a href="score">积分</a></li><li role="presentation" class="shop"><a href="shop">商城</a></li><li role="presentation" class="feedback"><a href="feedback">反馈</a></li><li role="presentation" class="logout"><a href="admin/logout">退出</a></li></ul></div><div class="container"><ol class="breadcrumb"><li><a href="index">Home</a></li><li><a href="common">基本设置</a></li><li><a href="common/pic">切图设置</a></li></ol><div class="alert_box"></div></div><div class="container"><div class="col-md-2"><div class="list-group"><a class="list-group-item active cd">切图设置</a>   <a href="common/ad" class="list-group-item">社区广告</a><a href="common/shop" class="list-group-item">商城切图</a><a href="common/area" class="list-group-item">地区列表</a><a href="common/work" class="list-group-item">工作列表</a></div></div><div class="col-md-10"><div class="panel panel-default"><div class="panel-body"><table class="text-center table table-striped sortable-theme-bootstrap" data-sortable><thead><tr><th class="text-center">编号顺序</th><th class="text-center">图片</th><th class="text-center">链接类型</th><th class="text-center">ID/值</th><th class="text-center" style="min-width:140px">操作</th></tr></thead><tbody><?php foreach($pic as $k=>$v){ ?><?php $n=$k+1 ?><tr><td class="text-center"><?php echo $n;?></td><td><a class="text_img cp" data-trigger="hover" title="图片" data-html="true" data-content="<img class='img-responsive' src='http://120.26.230.136:6087/pic/<?php echo $v["pic"];?>' />"><?php echo $v["pic"];?></a></td>   <td><a data-type="<?php echo $v["type"];?>"><?php if($v['type']=='none'){ ?>无<?php }elseif($v['type']=='article'){ ?>资料<?php }elseif($v['type']=='forum'){ ?>帖子<?php }elseif($v['type']=='link'){ ?>外部链接<?php }elseif($v['type']=='project'){ ?>项目<?php }elseif($v['type']=='product'){ ?>产品<?php }elseif($v['type']=='shop'){ ?>商品<?php } ?></a></td> <td><a data-value="<?php echo $v["value"];?>"><?php echo $v["value"];?></a></td><td><div class="btn-group" role="group" aria-label="opition"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">修改</button><button type="button" class="btn btn-danger del_pic">删除</button></div></td></tr><?php } ?></tbody></table><div class="text-right"><button type="button" class="btn btn-success add_pic" data-toggle="alert" data-target="#alert">添加</button></div></div></div></div></div><div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel">修改</h4></div><div class="modal-body"><form><div class="form-group"><label>切图图片</label><input type="file" />   <p class="help-block"></p></div><input class="form-control pic-form" name="pic2" type="text" value="" disabled="disabled"/><input class="form-control pic-form" name="pic" type="hidden" value=""/><input class="form-control pic-form" name="id" type="hidden" value=""/><div class="form-group"><label for="exampleInputFile">链接类型</label><select class="form-control" name="type"><option value="article">资料</option><option value="forum">帖子</option><option value="project">项目</option><option value="product">产品</option><option value="shop">商品</option><option value="link">外部链接</option><option value="none" selected=“selected”>无</option></select> </div><div class="form-group"><label for="value">ID/值</label><input type="text" class="form-control" id="value" name="value" placeholder="值"></div><div class="form-group"><label for="move">移动到 第N个切图之后</label><input type="text" class="form-control" id="move" name="move"></div></form></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">关闭</button><button type="button" class="btn btn-primary save">保存</button></div></div></div></div><script>j('#myModal').on('show.bs.modal',function(e){var b=j(e.relatedTarget),t=b.parent().parent().parent(),r=t.find('.text_img').text(),y=t.find('[data-type]').attr('data-type'),v=t.find('[data-value]').attr('data-value'),id=t.find('td:eq(0)').text(),m=j(this);m.find('[name=pic]').val(r);m.find('[name=pic2]').val(r);m.find('[name=type]').val(y);m.find('[name=value]').val(v);m.find('[name=id]').val((parseInt(id)-1).toString());m.find('.help-block').html('');m.find('[name=move]').val('');});j('#myModal [type=file]').change(function(){var form = packFormData('#myModal [type=file]');j.ajax({url:'common/up_pic/common',data:form,contentType:false,processData:false,type:'post',beforeSend:function(xhr){j('.help-block').html('uploading file waiting...')},success:function(d){if(d.code!==200){j('.help-block').html('upload failed');return}j('.help-block').html('upload successed');j('#myModal [name=pic]').val(d.data[0]);j('#myModal [name=pic2]').val(d.data[0]);}})});j('#myModal .save').click(function(){var s=j(this),d=j('#myModal form').serializeArray();j.post('common/change_pic',d,function(){location.reload(true)})});j('.del_pic').click(function(){var id=j(this).parent().parent().parent().find('td:eq(0)').text();j('.alert_box').html('').append('<div id="alert" class="alert alert-danger alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认删除？</h4><p></p><p><button type="button" class="btn btn-danger yes" style="margin-right:10px">删除</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');j('.alert').slideDown().find('.yes').one('click',function(){j.post('common/del_pic',{id:parseInt(id)-1},function(){location.reload(true)})})});j('.add_pic').click(function(){j('.alert_box').html('').append('<div id="alert" class="alert alert-success alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认添加？</h4><p></p><p><button type="button" class="btn btn-success yes" style="margin-right:10px">添加</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');j('.alert').slideDown().find('.yes').one('click',function(){j.post('common/add_pic',function(){location.reload(true)})})});</script></body></html>