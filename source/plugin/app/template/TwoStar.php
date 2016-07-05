<!--{template _header}-->
<style>
.ip_1_2_3{float:left}
.ip_1_2_4{float:left;width:auto}
</style>
<header nav=1></header>
<div class="guanfang">
	<div class="guanfang_1">
    	<div class="guanfang_1_1">COS明星</div>
        <a href="/app/starlist"><div class="guanfang_1_2">MORE</div></a>
    </div>
</div>
<div class="ip_tu">
	<div class="ip_tu_zs">
    <!--{loop $cosers $k=>$c}-->
    {if $k<4}
    	<div class="ip_tu_{if !$k}1{else}2{/if}">
        	<a href="/app/usercenter/index/{c.uid}"><div class="ip_tu_1_1"><img src="/pic/{c.thumb}.medium.jpg" class="ip_tu1"></div></a>
            <div class="ip_tu_1_2">
            	<div class="ip_1_2_1"><img src="/pic/{c.avatar}.avatar.jpg" class="ip_tu3"></div>
                <div class="ip_1_2_2">{c.nickname}</div>
                <div class="ip_wenzi_right">
                {if $c['sign']}签约明星{else}明星COSER{/if}
                </div>
            </div>
            <div class="ip_tu_1_3"><div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"></div>
            <div class="ip_1_2_4">{c.fans}</div></div>
        </div>
        {/if}
    <!--{/loop}-->
    </div>
   
</div>
<div class="ip_tu">
	<div class="ip_tu_zs">
    	<!--{loop $cosers $k=>$c}-->
    {if $k>3}
    	<div class="ip_tu_{if $k==4}1{else}2{/if}">
        	<a href="/app/usercenter/index/{c.uid}"><div class="ip_tu_1_1"><img src="/pic/{c.thumb}.medium.jpg" class="ip_tu1"></div></a>
            <div class="ip_tu_1_2">
            	<div class="ip_1_2_1"><img src="/pic/{c.avatar}.avatar.jpg" class="ip_tu3"></div>
                <div class="ip_1_2_2">{c.nickname}</div>
                <div class="ip_wenzi_right">
                {if $c['sign']}签约明星{else}明星COSER{/if}
                </div>
            </div>
            <div class="ip_tu_1_3"><div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"></div>
            <div class="ip_1_2_4">{c.fans}</div></div>
        </div>
        {/if}
    <!--{/loop}-->
    </div>
   
</div>
<div class="guanfang">
	<div class="guanfang_1">
    	<div class="guanfang_1_1">COS团队</div>
        <a href="/app/teamlist"><div class="guanfang_1_2">MORE</div></a>
    </div>
</div>

<div class="c_tuandui">
	<div class="c_tuandui_content">
    <!--{loop $team $k=>$t}-->
    {if $k==2}
     </div>
</div>
<div class="c_tuanduis">
	<div class="c_tuandui_content">
    {/if}

    	<div class="c_td_{if $k==2||$k==0}1{else}2{/if}">
        <a href="/app/teamcenter/index/{t.tid}" >
        	<div class="c_td_1_1" style="background-image:url(/pic/{t.pic}.medium.jpg);background-size:cover">
            	
            	<div class="c_td_1_1_z">
                	<div class="c_td_1_z_1 "><img class="img-circle" style="width:60px;height:60px" src="/pic/{t.thumb}.avatar.jpg"></div>
                    <div class="c_td_1_z_2">{t.name}</div>
                </div>
            </div>
        </a>
            <div class="c_td_1_2">{t.desc}</div>
        </div>
      <!--{/loop}-->
    </div>
</div>
<!--{template _footer}-->