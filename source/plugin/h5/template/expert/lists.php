<!--{subtemplate header}-->
<!--{eval addcss('lists','expert','h5')}-->

<div class="search">
    <div>搜索专家</div>
    <form method="post" class="dn">
    <input type="text" name="search">
    <input type="submit" class="dn">
    </form>
</div>


<div class="list container-fluid">

    <!--{loop $list $v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    <div class="row">
        <div class="col-xs-2 avatar">
            <img src="{thumb}">
        </div>
        <div class="col-xs-10">
            <div class="name">
                {nametrue}
                <img src="/pic/h5/expert/zj@2x.png">
            </div>
            <div class="tag">
                <p>{lable}</p>
                <p>从业经验：{experience}</p>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-xs-4">关注 {follow}</div>
        <div class="col-xs-4">粉丝 {fans}</div>
        <div class="col-xs-4">回答 {answer}</div>
    </div>
    <!--{/loop}-->
</div>



<!--{subtemplate tool:footer}-->