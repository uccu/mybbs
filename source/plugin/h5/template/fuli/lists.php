<!--{subtemplate header}-->
<!--{eval addcss('lists','fuli','h5')}-->


<div class="list container">

    <!--{loop $list $v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    <div class="row" style="padding: 15px 0;border-bottom: 2px solid #f1f1f1;background:#fff">
        <div class="col-xs-3 avatar">
            <img src="{thumb}" style="margin-top: 20px;">
        </div>
        <div class="col-xs-9">
            <h4 class="name">{title}</h4>
            <div class="tag">
                <p style="color:#a1a1a1;">{content}　</p>
                <a href="/h5/fili/info/{id}" style="background: #ffedbf;border: 0;border-radius: 30px;padding: 2px 17px;color: #ff9c00;">查看详情</a>
            </div>
        </div>
    </div>
    <!--{/loop}-->
</div>


<div class="pf bbg" style="width:100%;bottom:0;left:0;z-index:1">
    <img src="/pic/h5/d.png" alt="" class="img-responsive">
    <span class="db pa clos" style="height:100%;width:40px;z-index:3;top:0;left:0"></span>
    <script>j('.clos').click(function(){j('.bbg').fadeOut()})</script>
</div>
<!--{subtemplate tool:footer}-->