<!--{template _header}-->
<script type="text/javascript">
	
</script>
<ul class="dn dc-block">
<!--{loop $pictures $p}-->
<li e="{p.src}" pid="{p.pid}" des="{p.des}" tag="
<!--{loop $p['tag'] $t}-->
<div>{$t}</div>
<!--{/loop}-->
"></li>
<!--{/loop}-->
</ul>
<div class="l_body">
	<div class="l_body_z">
    	<div class="l_body_z_bottom">{album.title}（<font color="#5cbac0">1</font>/{count}）</div>
    	<div class="l_body_z_top">
            <div class="l_body_z_top_content">
            	<img class="l_body_tu2 center-block" style="height:auto;width:auto;max-height:425px"/>
            	<div class="l_body_left"><img src="images/xc_03.png" /></div>
                <div class="l_body_right"><img src="images/xc_05.png" /></div>
            </div>
        </div>
        <div class="l_body_tag">

        </div>
		<div style="width:100%;height:10px;"></div>
        <div class="l_body_content">
        	
        </div>
    </div>
</div>
<div class="l_lunbo">
<style>
.pre_x{
position:absolute;width:38px;height:38px;top:38px;left:0;background:url(/images/xct_27.png);z-index:10
}
.aft_x{
position:absolute;width:38px;height:38px;top:38px;right:0;background:url(/images/xct_30.png);z-index:10
}
.l_lunbo_z_3{width:170px;height:130px;float:none;display:inline-block}
.bor{width:170px;height:130px;border:2px solid #5cbac0;padding:4px;}
</style>
<div class="pr center-block" style="width:1050px;">
	<div class="pre_x"></div>
	<div class="l_lunbo_z text-center pr">
        <div class="l_lunbo_z_3 bor"><img src="images/xct_19.png" class="l_lunbo_tu3"/></div>
        <div class="l_lunbo_z_3"><img src="images/xct_21.png" class="l_lunbo_tu3"/></div>
        <div class="l_lunbo_z_3"><img src="images/xct_23.png" class="l_lunbo_tu3"/></div>
        <div class="l_lunbo_z_3"><img src="images/xct_25.png" class="l_lunbo_tu3"/></div>
        <div class="l_lunbo_z_3"><img src="images/xct_21.png" class="l_lunbo_tu3"/></div>
    </div>
	<div class="aft_x"></div>
</div>

</div>
<script>
{if !$pictures}
location = '/app/usercenter/index/{album.uid}';
{/if}
function cl(n){
    j('img.l_body_tu2')[0].src = '/pic/'+j('.dc-block li').eq(n).attr('e')+'.large.jpg';
}
function cn(n){
    j('.l_body_z_bottom font').html((n+1).toString());
}
function ca(n){
    var t = j('.dc-block li').eq(n).attr('tag');
    if(!t)j('.l_body_tag').html('');else 
    j('.l_body_tag').html(
        j('.dc-block li').eq(n).attr('tag')+'<span><img src="images/xc_10.png" /></span>'
    );
}
function cd(n){
    j('.l_body_content').html(
        j('.dc-block li').eq(n).attr('des')
    );
}
function cp(n){

}
function ct(n){
    var p = parseInt(n/5);
    for(var i=0;i<5;i++){
        if(i+p*5>length-1){
            j('.l_lunbo_z_3').eq(i).hide();
            continue;
        }
        j('.l_lunbo_z_3').eq(i).show();
        j('.l_lunbo_z_3').eq(i).attr('to',i+p*5);
        j('.l_lunbo_z_3').eq(i).removeClass('bor');
        if(n==i+p*5)j('.l_lunbo_z_3').eq(i).addClass('bor');
        j('.l_lunbo_tu3').eq(i).attr('src','/pic/'+j('.dc-block li').eq(i+p*5).attr('e')+'.small.jpg');
    }
}
var now = 0,length = j('.dc-block li').length;
cl(0);ct(0);ca(0);cd(0);

j('.l_body_left').click(function(){
    now--;if(now<0)now = length-1;
    cl(now);cn(now);ct(now);ca(now);cd(now);
});
j('.l_body_right').click(function(){
    now++;if(now==length)now = 0;
    cl(now);cn(now);ct(now);ca(now);cd(now);
});
j('.l_lunbo_z_3').click(function(){
    now = j(this).attr('to');
    cl(now);cn(now);ct(now);ca(now);cd(now);
});
j('.pre_x').click(function(){
    var p = parseInt(now/5),mp = parseInt((length-1)/5);
    p--;
    if(p<0)p=mp;
    now = p*5;
    cl(now);cn(now);ct(now);ca(now);cd(now);
});
j('.aft_x').click(function(){
    var p = parseInt(now/5),mp = parseInt((length-1)/5);
    p++;
    if(p>mp)p=0;
    now = p*5;
    cl(now);cn(now);ct(now);ca(now);cd(now);
})

</script>
<!--{template _footer}-->