<!--{subtemplate header}-->
<!--{eval addcss('lists','expert','h5')}-->

<div class="search tc">
    <span class="db">搜索专家</span>
    <form method="post" class="dn">
        <input type="text" name="search">
        <input type="submit" class="dn">
    </form>
</div>
<script>
j('.search .db').click(function(){
    j(this).addClass('dn');j('.search form').removeClass('dn');
    j('.search [name=search]').focus();
});
j('.search [name=search]').blur(function(){
    j('.search form').addClass('dn');j('.search .db').removeClass('dn');
})

</script>


<div class="list container-fluid">

    <!--{loop $list $v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    <div class="row">
        <div class="col-xs-3 avatar">
            <img src="{thumb}">
        </div>
        <div class="col-xs-9">
            <div class="name">
                {nametrue}
                <img src="/pic/h5/expert/zj@2x.png">
            </div>
            <div class="tag">
                <p>{lable}　</p>
                <p>从业经验：{experience}　</p>
            </div>
        </div>
    </div>
    <div class="row tc">
        <div class="col-xs-4"><span class="nn">关注</span> {follow}</div>
        <div class="col-xs-4"><span class="nn">粉丝</span> {fans}</div>
        <div class="col-xs-4"><span class="nn">回答</span> {answer}</div>
    </div>
    <!--{/loop}-->
</div>



<!--{subtemplate tool:footer}-->