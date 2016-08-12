<!--{subtemplate _header}-->
<header nav="2"></header>
<style>
.ip_tu_1{margin:9px;height:auto}
.search input{width: 60%;
    border: 1px solid #ccc;
    margin: 20px 0;
    height: 33px;
    padding: 10px;
    color:#ccc;
    border-radius:4px
}
.search input:focus{
    color:#999;
}
.search button{
    margin-left: 30px;
    background: #5cbac0;
    outline: 0;
    width: 100px;
    height: 33px;
    border: 0;
    color: #fff;
    
}
.search strong{
    margin: 28px 20px 0 20px;
    font-size: 15px;
    line-height: 20px;
    font-weight: normal;
    padding: 0 5px;
    border-bottom: 2px solid #fff;
}
.search strong:hover,.search strong.active{
    border-bottom: 2px solid #5cbac0;
    color: #5cbac0;
}
.ip_1_2_3{float:right}
.ip_1_2_4{float:right;width:auto}
</style>
<div class="container search" style="width: 1022px;">
    <input type="text" class="t" /><button >搜索</button>
    <strong class="fr cp t" z='team'>团队</strong><strong class="fr cp t active" z='user'>用户</strong><strong class="fr cp t" z='album'>相册</strong>
</div>
<script>
!function(){
    j('.search button').click(function(){
        location = '/app/search/'+folder[3]+'/'+j('.search input').val()
    });
    j('.search input').val(decodeURI(folder[4]!='0'?folder[4]:'')).keypress(function(e){
        if(e.which==13)j('.search button').click();
    });
    j('.search strong:not(.active)').click(function(){
        location = '/app/search/'+j(this).attr('z')+'/'+folder[4];
    })

}()

</script>
<div class="container" style="width: 1040px;overflow:hidden;height:auto;min-height:500px">
{if !$list}
    <h1 class="text-center" style="padding-top:90px;color:#ccc">没有搜索到任何东西~~</h1>
{/if}
<!--{loop $list $c}-->
    	<div class="ip_tu_1">
        	<a href="/app/usercenter/index/{c.uid}"><div class="ip_tu_1_1"><img src="/pic/{c.avatar}.medium.jpg" class="ip_tu1"></div></a>
            <div class="ip_tu_1_2">
            	<div class="ip_1_2_1"><img src="/pic/{c.avatar}.avatar.jpg" class="ip_tu3"></div>
                <div class="ip_1_2_2">{c.nickname}</div>
                <div class="ip_1_2_4">{c.fans}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                
                
                
            </div>
        </div>
<!--{/loop}-->
        

</div>


<nav class="text-center">
                    <ul class="pagination pageset">
                        <script>
                            getPageSet({currentPage},{maxPage},'href','{g.plugin}/{g.control}/{g.method}/'+(folder[4]?folder[4]:'0')+'/',
                            (folder[6]?'/'+folder[6]:'')+
                            (folder[7]?'/'+folder[7]:''));
                            j('.a_cos_top_con_3 a').eq(folder[5]?1:0).css('color','#75cbdb')
                        </script>
                    </ul>
                </nav>
<!--{subtemplate _footer}-->