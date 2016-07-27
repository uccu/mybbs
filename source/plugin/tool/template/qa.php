<!--{subtemplate header}-->
<style>
.container-fluidt{
    border-bottom:3px solid #bbb;
}
.Z{
    padding: 20px 10px;
    padding-bottom:0;
}
.Q{
    color:#fb7fa3;
    border-bottom:1px solid #ccc;
    font-size:16px;
    padding-left:27px;
    position:relative;
}
.Q::before{
    content:'Q:';
    position:absolute;
    left:0;
    top: -8px;
    font-size: 1.5em;
    font-family: serif;
}
.A::before{
    content:'A:';
    color:#fb7fa3;
    position:absolute;
    left:0;
    top: 7px;
    font-size: 1.5em;
    font-family: serif;
}
.A{
    line-height:27px;
    padding-top:10px;
    position:relative;
    padding-left:27px;
    font-size:16px;
    color:#666;
}
</style>
<!--{loop $qa $q}-->
<div class="container-fluidt">
    <div class="Z">
        <div class="Q">
            <p>{q.title}</p>
        </div>
        <div class="A">
            <p>{q.des}</p>
        </div>
    </div>
</div>



<!--{/loop}-->
<!--{subtemplate footer}-->