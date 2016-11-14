<!--{subtemplate header}-->
<!--{eval addcss('info','expert','h5')}-->
<div class="info-top">
    <div class="avatar">
        <img src="{info.thumb}">
    </div>
    <div class="name">
        {info.nametrue}
        <img src="/pic/h5/expert/zj@2x.png">
        {if $info['sex']==1}
        <img src="/pic/h5/expert/male@2x.png">
        {elseif $info['sex']==2}
        <img src="/pic/h5/expert/female@2x.png">
        {/if}
    </div>
    <div class="tag">
        <p>{info.label}</p>
        <p>从业经验：{info.experience}</p>
    </div>
</div>
<div class="info-mi row">

    <div class="col-xs-3">
        <div>{fans}</div>
        <div class="text-muted">粉丝</div>
    </div>
    <div class="col-xs-3">
        <div>{follow}</div>
        <div class="text-muted">关注</div>
    </div>
    <div class="col-xs-3">
        <div>{inquiry}</div>
        <div class="text-muted">发布</div>
    </div>
    <div class="col-xs-3">
        <div>{answer}</div>
        <div class="text-muted">回答</div>
    </div>
</div>

<div class="describe">

    {info.describe}


</div>


<!--{subtemplate tool:footer}-->