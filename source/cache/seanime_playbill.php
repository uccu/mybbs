<?php defined('IN_PLAY') || exit('Access Denied');?><!DOCTYPE HTML5><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title><?php echo $g["template"]["title"];?></title><meta name="keywords" content="<?php echo $g["template"]["keywords"];?>"><meta name="description" content="<?php echo $g["template"]["description"];?>"><base href="<?php echo $g["template"]["baseurl"];?>"><?php addcss('m1'); ?><link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css"><script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/jquery-lazyload/1.9.5/jquery.lazyload.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js" type="text/javascript"></script><script src="//dn-cdnjsnet.qbox.me/crypto-js/3.1.2/rollups/md5.js"></script><script src="//apps.bdimg.com/libs/crypto-js/3.1.2/components/enc-base64-min.js" type="text/javascript"></script><?php addjs('p'); ?><?php addjs('p2'); ?></head><body><?php addcss() ?><?php addjs() ?><div class="playbill"><?php foreach($na as $k=>$v){ ?><h3>星期<?php echo $v;?></h3><div><ul><?php foreach($playbill_14[$k] as $v1){ ?><li><a href="seanime/lists/aid/<?php echo $v1["aid"];?>" target="_top" class="t button-1 bgc-6 bgc-h6"><i><?php if($v1['newname']){ ?><?php echo $v1["newname"];?><?php }else{ ?><?php echo $v1["name"];?><?php } ?> <em>（第<?php echo $v1["lastnum"];?>话）</em></i></a></li><?php } ?><?php foreach($playbill_7[$k] as $v1){ ?><li><a href="seanime/lists/aid/<?php echo $v1["aid"];?>" target="_top" class="t button-1 bgc-7 bgc-h7"><i><?php if($v1['newname']){ ?><?php echo $v1["newname"];?><?php }else{ ?><?php echo $v1["name"];?><?php } ?> <em>（第<?php echo $v1["lastnum"];?>话）</em></i></a></li><?php } ?><?php foreach($playbill_24[$k] as $v1){ ?><li><a href="seanime/lists/aid/<?php echo $v1["aid"];?>" target="_top" class="t button-1 bgc-5 bgc-h5"><i><?php if($v1['newname']){ ?><?php echo $v1["newname"];?><?php }else{ ?><?php echo $v1["name"];?><?php } ?> <em>（第<?php echo $v1["lastnum"];?>话）</em></i></a></li><?php } ?></ul></div><?php } ?></div><script>jq(function(){jq( ".playbill" ).accordion( "option", "active", <?php echo $w;?> )});</script><script>    <?php foreach($g['loadtimeset'] as $k=>$v){ ?>    console.log(<?php echo $v;?>-<?php echo $g["loadtimeset"]["start"];?>,"<?php echo $k;?>");    <?php } ?></script></body></html>