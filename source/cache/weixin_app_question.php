<?php defined('IN_PLAY') || exit('Access Denied');?><!DOCTYPE html5><html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="keywords" content="<?php echo $g["template"]["keywords"];?>"><meta name="description" content="<?php echo $g["template"]["description"];?>"><title><?php echo $g["template"]["title"];?></title><base href="<?php echo $g["template"]["baseurl"];?>"><link rel="stylesheet" href="//apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"><?php addcss('m',0,'tool') ?><script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/jquery-lazyload/1.9.5/jquery.lazyload.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script><script src="//dn-cdnjsnet.qbox.me/crypto-js/3.1.2/rollups/md5.js"></script><script src="//apps.bdimg.com/libs/crypto-js/3.1.2/components/enc-base64-min.js" type="text/javascript"></script><!--[if lt IE 9]>  <script src="//apps.bdimg.com/libs/html5shiv/r29/html5.min.js"></script>  <script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]--><script>window.j=jQuery.noConflict();</script><?php addjs('p',0,'tool') ?></head><body><?php addjs('p') ?><style>td{border-top:none !important}</style> <div class="container" style="padding-top:40px"> <form> <table class="table"><tr><td style="vertical-align:middle; text-align:center;">*性别</td><td style="vertical-align:middle; text-align:center;"><input type="text" class="form-control"  name="name"></td></tr><tr><td style="vertical-align:middle; text-align:center;">*电话</td><td style="vertical-align:middle; text-align:center;"><input type="text" class="form-control"  name="phone"></td></tr>   <tr><td style="vertical-align:middle; text-align:center;">年龄</td><td style="vertical-align:middle; text-align:center;"><input type="text" class="form-control"  name="age"></td></tr><tr><td style="vertical-align:middle; text-align:center;">性别</td><td style="vertical-align:middle; text-align:left" class="form-inline"><lable><input style="margin-top:0;margin-right:5px;margin-left:5px" type="radio"   name="sex" value="1">男</label><lable><input style="margin-top:0;margin-right:5px;margin-left:5px" type="radio"   name="sex" value="2">女</label></td></tr><tr><td style="vertical-align:middle; text-align:center;">留言</td><td style="vertical-align:middle; text-align:center;"><textarea class="form-control" rows="10" name="content"></textarea></td></tr>   </table> </form> <div class="text-center"> <button style="outline:0;margin-bottom:20px;width:240px;padding:15px;background:#F586A1;border-radius:100px;border:none;box-shadow:0 0 5px #777;color:#fff;font-size:18px">提交</button> <h4 style="margin-bottom:10px;">电话咨询请直接拨打咨询电话</h4> <a href="tel:4008808888"><h3 style="color:red">400-880-8888</h3></a> </div> </div><script>j('button').click(function(){var s = j('form').serializeArray();j.post('weixin/hudong/up',s,function(d){if(d.code!=200)alert(d.desc);else alert('提交成功');},'json')})</script><?php defined('IN_PLAY') || exit('Access Denied');?></body></html>