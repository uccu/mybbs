<?php defined('IN_PLAY') || exit('Access Denied');?><!DOCTYPE html5><html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="keywords" content="<?php echo $g["template"]["keywords"];?>"><meta name="description" content="<?php echo $g["template"]["description"];?>"><title><?php echo $g["template"]["title"];?></title><base href="<?php echo $g["template"]["baseurl"];?>"><link rel="stylesheet" href="//apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"><?php addcss('m',0,'tool') ?><script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/jquery-lazyload/1.9.5/jquery.lazyload.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script><script src="//dn-cdnjsnet.qbox.me/crypto-js/3.1.2/rollups/md5.js"></script><script src="//apps.bdimg.com/libs/crypto-js/3.1.2/components/enc-base64-min.js" type="text/javascript"></script><!--[if lt IE 9]>  <script src="//apps.bdimg.com/libs/html5shiv/r29/html5.min.js"></script>  <script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]--><script>window.j=jQuery.noConflict();</script><?php addjs('p',0,'tool') ?></head><body><?php addjs('p') ?><?php addjs('inform') ?><script type="text/javascript" src='ueditor/ueditor.config.js'></script><script type="text/javascript" src='ueditor/ueditor.all.min.js'></script><style>.modal-backdrop{z-index:1}.modal{z-index:2}</style><div class="container"><div class="page-header"><h1>美容整形 <small>微信后台</small></h1></div><ul class="nav nav-tabs t"><li role="presentation" class="index"><a href="weixin/index">Smile</a></li><li role="presentation" class="pinpai"><a href="weixin/pinpai">品牌</a></li><li role="presentation" class="shili"><a href="weixin/shili">实例</a></li><li role="presentation" class="hudong"><a href="weixin/hudong">互动</a></li><li role="presentation" class="logout"><a href="weixin/admin/logout">退出</a></li></ul></div><div class="container"><div class="alert_box"></div></div><div class="container subnav"><div class="col-md-12"><?php echo $subnav;?><div class="panel panel-default"><div class="panel-body"><table class="text-center table table-striped"><thead><tr><th class="text-center">ID</th><th class="text-center">标题</th><th class="text-center">发布时间</th><th class="text-center">操作</th></tr></thead><tbody><?php foreach($list as $p){ ?><tr><td><?php echo $p["aid"];?></td><td><?php echo $p["atitle"];?></a></td><td class="changeToDate"><?php echo $p["actime"];?></td><td><div class="btn-group t" role="group" aria-label="opition"><a type="button" class="btn btn-info" href="weixin/<?php echo $g["control"];?>/<?php echo $g["method"];?>/detail/<?php echo $p["aid"];?>">详情</a><button type="button" data-button="永久删除" data-content="删除后将不能恢复" class="btn btn-danger indel" data-action="weixin/<?php echo $g["control"];?>/del_<?php echo $g["method"];?>/<?php echo $p["aid"];?>">删除</button></div></td></tr><?php } ?></tbody></table><div class="text-right fr"><a type="button" class="btn btn-info" href="weixin/<?php echo $g["control"];?>/<?php echo $g["method"];?>/detail/0">添加</a></div><nav><ul class="pagination pageset"></ul></nav></div></div><script></script><?php defined('IN_PLAY') || exit('Access Denied');?></body></html>