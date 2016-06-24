<pre>

<!--{loop $g['template'] $k=>$v}-->
<h2><!--{eval echo $k}--></h2>
<p><!--{eval var_dump($v)}--></p>
<!--{/loop}-->
</pre>
<!--{template _header}-->
<header nav="4"></header>
<!--{template _footer}-->