<!--{subtemplate tool:header}-->
<div class="container">
    <h4><strong>{g.title}</strong></h4>
</div>
<style>.media iframe{width:100% !important;max-width:480px;height:300px !important;background:#000}</style>
<div class="container text-center media" style="overflow:hidden">
    {if $g['media']}
    {g.media}
    {elseif $g['pic']}
        <img src="pic/{g.pic}" class="center-block img-responsive" />
    {/if}
</div>

<div class="container">
    <p>{g.template.adescription}</p>
    
</div>
<!--{subtemplate tool:footer}-->