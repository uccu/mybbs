<pre>
<!--{loop $g['template'] $k=>$v}-->
<h2><!--{eval echo $k}--></h2>
<p><!--{eval var_dump($v)}--></p>
<!--{/loop}-->
</pre>

