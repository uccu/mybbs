<form action="{g.template.baseurl}_app/album/upload/1" method="post" enctype="multipart/form-data">

    <input type="file" name="file" />
    <input type="submit" value="submit" />

</form>
<pre>
<!--{loop $g['template'] $k=>$v}-->
<h2><!--{eval echo $k}--></h2>
<p><!--{eval var_dump($v)}--></p>
<!--{/loop}-->
</pre>
