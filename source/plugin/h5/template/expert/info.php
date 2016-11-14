<!--{subtemplate header}-->
<!--{eval addcss('info','expert','h5')}-->
<div class="info-top">
    <div class="avatar">
        <img src="{info.thumb}">
    </div>
    <div class="name">
        {info.nametrue}
        <img src="/pic/h5/expert/zj.png">
        {if $info['sex']==1}
        <img src="/pic/h5/expert/male.png">
        {elseif $info['sex']==2}
        <img src="/pic/h5/expert/female.png">
        {/if}
    </div>
    <div class="tag">
        <p>{info.label}</p>
        <p>从业经验：{info.experience}</p>
    </div>
</div>


<!--{subtemplate tool:footer}-->