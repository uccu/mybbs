<?php defined('IN_PLAY') || exit('Access Denied');?><!DOCTYPE HTML5><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title><?php echo $g["template"]["title"];?></title><meta name="keywords" content="<?php echo $g["template"]["keywords"];?>"><meta name="description" content="<?php echo $g["template"]["description"];?>"><base href="<?php echo $g["template"]["baseurl"];?>"><?php addcss('m1'); ?><link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css"><script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/jquery-lazyload/1.9.5/jquery.lazyload.min.js" type="text/javascript"></script><script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js" type="text/javascript"></script><script src="//dn-cdnjsnet.qbox.me/crypto-js/3.1.2/rollups/md5.js"></script><script src="//apps.bdimg.com/libs/crypto-js/3.1.2/components/enc-base64-min.js" type="text/javascript"></script><?php addjs('p'); ?><?php addjs('p2'); ?></head><body><?php addcss() ?><?php addjs() ?><div class="box-b1">        <span class="search_box t"><input class="search_input t-1 b-8 o-5 o-f1 b-f1 w-580" style="margin:180px auto 100px auto" placeholder="多条件请用空格隔开" /><div class="search_tags"><ul></ul></div></span><a class="search t button-1 bgc-1 bgc-h1"><i>搜索</i></a>    </div><div class="box-b1"></div><div class="box-b1 t padding-0 margin-auto"><div class="sourceslist_box w-1000"><div class="sourceslist_top"></div><div class="playbill w-1000 ofh tl"><?php if($playbill){ ?><a class="t button-2 b-1 b-h5 c-h5 fr" href="seanime/playbill" target="overlay-iframe-2" rel="nofollow" style="margin:1px"><i>查看完整历史更新</i></a><?php } ?></div><div class="playbill w-1000 ofh pr"><?php if($playbill){ ?><ul><li class="playbill_n"><a class="button-1 button-1plus bgc-1"><i>24小时历史更新</i></a></li><?php foreach($playbill_y as $v){ ?><li class="playbill_b"><a href="seanime/lists/aid/<?php echo $v["aid"];?>" class="t button-1 bgc-7 bgc-h7" title="<?php echo $v["remark"];?>"><i><?php if($v['newname']){ ?><?php echo $v["newname"];?><?php }else{ ?><?php echo $v["name"];?><?php } ?> <em>（第<?php echo $v["lastnum"];?>话）</em></i></a></li><?php } ?><?php foreach($playbill_t as $v){ ?><li class="playbill_b"><a href="seanime/lists/aid/<?php echo $v["aid"];?>" class="t button-1 bgc-5 bgc-h5" title="<?php echo $v["remark"];?>"><i><?php if($v['newname']){ ?><?php echo $v["newname"];?><?php }else{ ?><?php echo $v["name"];?><?php } ?> <em>（第<?php echo $v["lastnum"];?>话）</em></i></a></li><?php } ?></ul><?php } ?></div><ul class="sourceslist_menu"><li><a class="" href="seanime/lists"><i>所有资源</i></a></li><li><a class="" href="seanime/lists/today"><i>今日更新</i></a></li><li><a class="" href="seanime/lists/yesterday"><i>昨日更新</i></a></li><li><a class="" href="seanime/lists/ltype/1"><i>种子资源</i></a></li><li><a class="" href="seanime/lists/ltype/2"><i>磁力资源</i></a></li><li><a class="" href="seanime/lists/ltype/3"><i>外链资源</i></a></li><li><a class="" href="seanime/lists/ltype/4"><i>网盘资源</i></a></li></ul><ul class="sourceslist_menu sdtype"></ul><div class="sourceslist"><ul class="sourceslist_title"><li><i>字幕组/压制组</i></li><li><i>资源名称</i></li><li><i>下载地址</i></li><li><i>资源大小</i></li><li><i>上传时间</i></li></ul><div class="sourceslist_body"><?php foreach($list as $a=>$b){ ?><ul class="sourceslist_block" sid="<?php echo $b["sid"];?>"><li><?php if($b['subtitle']){ ?><a href="seanime/lists/subtitle/<?php echo $b["subtitle"];?>"><i><?php echo $b["subtitle"];?></i></a><?php }else{ ?><i>　</i><?php } ?></li><li style="text-align:left"><a class="sdtype" href="seanime/sdtype/<?php echo $b["sdtype"];?>"><i><?php echo $b["sdtype"];?></i></a><a href="seanime/page/sid/<?php echo $b["sid"];?>/<?php echo $b["stimeline"];?>" rel="nofollow" target="overlay-iframe-2"><i><?php echo $b['sname'];?></i></a><a target="_blank" href="<?php echo $b['outlink'];?>"><i class="outs"><?php if($b['outstation']==1){ ?>[动漫花园]<?php }elseif($b['outstation']==2){ ?>[NYAA]<?php }elseif($b['outstation']==3){ ?>[Leopard]<?php }elseif($b['outlink']){ ?>[外站]<?php }else{ ?>[本站]<?php } ?></i></a></li><li><a rel="external nofollow" href="seanime/down/straight/<?php echo $b["sid"];?>/<?php echo $b["stimeline"];?>"><i><?php echo $b["sloc_type"];?></i></a></li><li><i><?php echo $b["size"];?></i></li><li><i><?php echo $b["stimeline"];?></i></li></ul><?php } ?></div></div><div class="sourceslist_bottom"><?php $count = count($list) ?><?php if($count<100){ ?><a class="t button-1 button-n bgc-1 bgc-h1"><i>已加载全部 <?php echo $count;?> 条资源</i></a><?php }else{ ?><a class="t button-1 bgc-1 bgc-h1 resource_gain"><i>加载更多</i></a><?php } ?></div></div></div><div id="overlay-2" class="overlay nos cd">    <div class="overlay_bg overlay_cancel"></div>    <div class="overlay_box ui-draggable">        <div class="box-o0"><iframe id="overlay-iframe-2" name="overlay-iframe-2" style="width:800px;min-height:400px;height:70%;background:#fff;max-width: 99%;border: 0;"></iframe></div>    </div></div><script>    <?php foreach($g['loadtimeset'] as $k=>$v){ ?>    console.log(<?php echo $v;?>-<?php echo $g["loadtimeset"]["start"];?>,"<?php echo $k;?>");    <?php } ?></script></body></html>