<?php defined('IN_PLAY') || exit('Access Denied');?><!DOCTYPE html><html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="keywords" content="<?php echo $g["template"]["keywords"];?>"><meta name="description" content="<?php echo $g["template"]["description"];?>"><title><?php echo $g["template"]["title"];?></title><base href="<?php echo $g["template"]["baseurl"];?>"><link rel="stylesheet" href="//apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"><?php addcss('component',0,'tool') ?><?php addcss('m',0,'tool') ?><script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/jquery-lazyload/1.9.5/jquery.lazyload.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script><script src="//dn-cdnjsnet.qbox.me/crypto-js/3.1.2/rollups/md5.js"></script><script src="//apps.bdimg.com/libs/crypto-js/3.1.2/components/enc-base64-min.js" type="text/javascript"></script><!--[if lt IE 9]>  <script src="//apps.bdimg.com/libs/html5shiv/r29/html5.min.js"></script>  <script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]--><?php addjs('p',0,'tool') ?></head><body><?php addjs('p',0,'adminloader') ?><?php addjs('inform',0,'adminloader') ?><!--<script type="text/javascript" src='ueditor/ueditor.config.js'></script><script type="text/javascript" src='ueditor/ueditor.all.min.js'></script>--><style>.modal-backdrop{z-index:1}.modal{z-index:2}</style><div class="container"><?php echo $pageHeader;?><?php echo $nav;?></div><div class="container"><div class="alert_box"><style>.delSuccess:target,.saveSuccess:target{display:block}</style><div id="delSuccess" class="delSuccess alert alert-danger alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><p>删除成功</p></div><div id="saveSuccess" class="saveSuccess alert alert-success alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><p>保存成功</p></div></div></div><div class="container subnav"><div class="col-md-12"><?php echo $subnav;?><!-- --></div></div></body></html>