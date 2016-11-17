<!--{subtemplate header}-->
<!--{eval addcss('lists','fuli','h5')}-->


<div class="list container">

    <!--{loop $list $v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    <div class="row">
        <div class="col-xs-3 avatar">
            <img src="{thumb}">
        </div>
        <div class="col-xs-9">
            <div class="name">
                {title}
            </div>
            <div class="tag">
                <p>{content}　</p>
                <button>查看详情</button>
            </div>
        </div>
    </div>
    <!--{/loop}-->
</div>



<!--{subtemplate tool:footer}-->