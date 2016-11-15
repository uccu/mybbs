<!--{subtemplate header}-->
<!--{eval addcss('lists','inquiry','h5')}-->
<div class="search tc">
    <form method="post" action="/h5/inquiry/lists">
        <input type="text" name="search" placeholder="搜索问题" class="tc">
        <input type="submit" class="dn">
    </form>
</div>
<div class="title">
    {equip}
</div>

<div class="list container-fluid">
    <!--{loop $list $v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    
    <div class="row">
        <div class="col-xs-12 avatar">
            <img src="{thumb}">
            {nickname}
        </div>
        <div class="col-xs-12">
            <div class="name">
                <a href="/h5/inquiry/info/{id}">{title}</a>
            </div>
            <div class="img">
                {if count($img)==1}
                    <div class="row tc">
                        <div class="col-xs-12"><img src="{img.0}" class="img-responsive"></div>
                    </div>
                {elseif count($img)==2}
                    <div class="row tc">
                        <div class="col-xs-6" style="background-image:url({img.0});height:150px"></div>
                        <div class="col-xs-6" style="background-image:url({img.1});height:150px"></div>
                    </div>
                {elseif count($img)==3}
                    <div class="row tc">
                        <div class="col-xs-4" style="background-image:url({img.0});height:100px"></div>
                        <div class="col-xs-4" style="background-image:url({img.1});height:100px"></div>
                        <div class="col-xs-4" style="background-image:url({img.2});height:100px"></div>
                    </div>
                {else}
                    {content}
                {/if}
            </div>
        </div>
        
    </div>
    <div class="row tc tag">
        <div class="col-xs-3">{answer} 回答</div>
        <div class="col-xs-3"> {read} 阅读</div>
        <div class="col-xs-3">{collect} 关注</div>
    </div>
    <!--{/loop}-->
</div>

<!--{subtemplate tool:footer}-->