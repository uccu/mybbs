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
</style>
<div class="container search" style="width: 1050px;">
    <input type="text" class="t" /><button >搜索</button>
    <strong class="fr cp t active" z='team'>团队</strong><strong class="fr cp t" z='user'>用户</strong><strong class="fr cp t" z='album'>相册</strong>
</div>
<script>
!function(){
    j('.search button').click(function(){
        location = '/app/search/'+folder[3]+'/'+j('.search input').val()
    });
    j('.search input').val(decodeURI(folder[4])).keypress(function(e){
        if(e.which==13)j('.search button').click();
    });
    j('.search strong:not(.active)').click(function(){
        location = '/app/search/'+j(this).attr('z')+'/'+folder[4];
    })

}()

</script>
<div class="container" style="width: 1050px;overflow:hidden;height:auto;min-height:500px">
{if !$list}
    <h1 class="text-center" style="padding-top:90px;color:#ccc">没有搜索到任何东西~~</h1>
{/if}
<!--{loop $list $t}-->
    	<div class="c_td_1">
        	<div class="c_td_1_1">
            	<a href="/app/teamcenter/index/{t.tid}" >
                    <div class="c_td_1_1 bips" style="background-image:url(/pic/{t.pic}.medium.jpg);background-size:cover">
                        <div class="c_td_1_1_z">
                            <div class="c_td_1_z_1 "><img class="img-circle" style="width:60px;height:60px" src="/pic/{t.thumb}.avatar.jpg"></div>
                            <div class="c_td_1_z_2">{t.name}</div>
                        </div>
                    </div>
                </a>
                <div class="c_td_1_2">{t.desc}</div>
            </div>
        </div>
<!--{/loop}-->
        

</div>


<nav class="text-center">
                    <ul class="pagination pageset">
                        <script>
                            getPageSet({currentPage},{maxPage},'href','{g.plugin}/{g.control}/{g.method}/'+folder[4]+'/',
                            (folder[6]?'/'+folder[6]:'')+
                            (folder[7]?'/'+folder[7]:''));
                            j('.a_cos_top_con_3 a').eq(folder[5]?1:0).css('color','#75cbdb')
                        </script>
                    </ul>
                </nav>
<!--{subtemplate _footer}-->