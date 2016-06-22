<pre>

<!--{loop $g['template'] $k=>$v}-->
<h2><!--{eval echo $k}--></h2>
<p><!--{eval var_dump($v)}--></p>
<!--{/loop}-->
</pre>


<base href="{baseurl}">

{baseurl}

{title}
{keywords}
{description}


{$coser.uid}

{$coser['uid']}

//1

<!--{loop $album $k=>$p}-->   //foreach($album as $k=>$v){
    {p.aid}




<!--{/loop}-->                 //  }

<!--{if $me == 'adasd'}-->


<!--{elseif $me == 'adasd'}-->
<!--{else}-->
<!--{/if}-->



<!--{subtemplate album/admin}-->


