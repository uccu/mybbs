<!--{subtemplate _header}-->
<div class="banner">
<!--{loop $banner $k=>$b}-->
    <div class="banner_block"{if $k} style="display:none"{/if}>
        <img src="pic/{b.pic}.jpg" class="banner_tu1"/>
        <div class="jiaru">
            <div class="jr_z">
                <div class="jr_1"><img src="images/sy_04.png" /></div>
                <div class="jr_2">
                    <div class="jr_2_1">{b.title}</div>
                    <div class="jr_2_2">{b.content}</div>
                    {if $b['button']}<a href="{b.href}"><div class="jr_2_3">{b.button}</div></a>{/if}
                </div>
                <div class="jr_3"><img src="images/sy_06.png" /></div>
            </div>
        </div>
    </div>
    
<!--{/loop}-->
<script>
(function(){
    s=0,l=j('.banner_block').length,f=function(){
        j('.banner_block').eq(s).fadeOut();
        var t = s-1<0?l-1:s-1;
        j('.banner_block').eq(t).fadeIn();
        s=t;
    },d=function(){
        j('.banner_block').eq(s).fadeOut();
        var t = s+1>l-1?0:s+1;
        j('.banner_block').eq(t).fadeIn();
        s=t;
    };
    j('.banner .jr_1').on('click',f);
    j('.banner .jr_3').on('click',d)
})();
</script>
</div>
<div class="guanfang">
	<div class="guanfang_1">
    	<div class="guanfang_1_1">官方IP授权COS</div>
        <a href="/app/character"><div class="guanfang_1_2">MORE</div></a>
    </div>
</div>
<div class="ip_tu">
	<div class="ip_tu_zs">
        <!--{loop $character $k=>$c}-->
        <!--{if !$k}-->
    	<div class="ip_tu_1">
        	<a href="/app/character/coser/{c.cid}"><div class="ip_tu_1_1"><img src="pic/{c.thumb}.medium.jpg" class="ip_tu1"/></div></a>
            <div class="ip_tu_1_2">
                <div class="ip_wenzi_left">{c.name}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2" /></div>
                <div class="ip_1_2_4">{c.fans}</div>
            </div>
            <div class="ip_weizi_bot">出自：{c.pname}</div>
        </div>
        <!--{else}-->
        <div class="ip_tu_2">
        	<a href="/app/character/coser/{c.cid}"><div class="ip_tu_1_1"><img src="pic/{c.thumb}.medium.jpg" class="ip_tu1"/></div></a>
            <div class="ip_tu_1_2">
                <div class="ip_wenzi_left">{c.name}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2" /></div>
                <div class="ip_1_2_4">{c.fans}</div>
            </div>
            <div class="ip_weizi_bot">出自：{c.pname}</div>
        </div>
        {/if}
        <!--{/loop}-->
    </div>
</div>
<div class="guanfang">
 	<div class="guanfang_1">
    	<div class="guanfang_1_1">推荐明星</div>
        <a href="/app/starlist"><div class="guanfang_1_2">MORE</div></a>
    </div>
</div>
<div class="mingxing">
    <div style="width: 1000px;height: 420px;margin: 0 auto;position: relative;">
		<svg height="420" width="1000">
          <defs>
            <clipPath id="svgPath1">
              <path  d="M0 0 L277 0 L139 420 L0 420 L0 0 Z"></path>
             </clipPath>
             <clipPath id="svgPath2">
              <path  d="M287 0 L564 0 L426 420 L149 420 L287 0 Z"></path>
             </clipPath>
             <clipPath id="svgPath3">
              <path  d="M574 0 L851 0 L713 420 L436 420 L574 0 Z"></path>
             </clipPath>
             <clipPath id="svgPath4">
              <path  d="M861 0 L1000 0 L1000 420 L723 420 L861 0 Z"></path>
             </clipPath>
          </defs>
          <g>
            <a xlink:href="/app/usercenter/index/{star.0.uid}">
            <image style="-webkit-clip-path: url({href}#svgPath1);clip-path: url({href}#svgPath1);" xlink:href="pic/{star.0.pic}.jpg" x="000" y="0" height="420px" width="277px" /></a>
            <a xlink:href="/app/usercenter/index/{star.1.uid}">
            <image style="-webkit-clip-path: url({href}#svgPath2);clip-path: url({href}#svgPath2);" xlink:href="pic/{star.1.pic}.jpg" x="149" y="0" height="420px" width="415px" /></a>
            <a xlink:href="/app/usercenter/index/{star.2.uid}">
            <image style="-webkit-clip-path: url({href}#svgPath3);clip-path: url({href}#svgPath3);" xlink:href="pic/{star.2.pic}.jpg" x="436" y="0" height="420px" width="415px" /></a>
            <a xlink:href="/app/usercenter/index/{star.3.uid}">
            <image style="-webkit-clip-path: url({href}#svgPath4);clip-path: url({href}#svgPath4);" xlink:href="pic/{star.3.pic}.jpg" x="723" y="0" height="420px" width="277px" /></a>
          </g>
        </svg>
       <div class="con_fg_1" style="text-shadow: 0 0 10px #000;">
       		<a href="/app/usercenter/index/{star.0.uid}"><div class="con_fg_1_1">
            	<div class="con_fg_1_top">
                	<div class="con_fg_1_top_1">{star.0.nickname}</div>
                    <div class="con_fg_1_top_2"><img src="images/sy_11.png" class="con_fg_1_top_2_tu1"></div>
                    <div class="con_fg_1_top_3">{star.0.fans}</div>
                </div>
                <div class="con_fg_1_bot">
                    {if $star[0]['sign']}签约coser{/if}
                </div>
            </div></a>
            <a href="/app/usercenter/index/{star.1.uid}"><div class="con_fg_1_2">
            	<div class="con_fg_1_top">
                	<div class="con_fg_1_top_1">{star.1.nickname}</div>
                    <div class="con_fg_1_top_2"><img src="images/sy_11.png" class="con_fg_1_top_2_tu1"></div>
                    <div class="con_fg_1_top_3">{star.1.fans}</div>
                </div>
                <div class="con_fg_1_bot">
                    {if $star[1]['sign']}签约coser{/if}
                </div>
            </div></a>
            <a href="/app/usercenter/index/{star.2.uid}"><div class="con_fg_1_3">
            	<div class="con_fg_1_top">
                	<div class="con_fg_1_top_1">{star.2.nickname}</div>
                    <div class="con_fg_1_top_2"><img src="images/sy_11.png" class="con_fg_1_top_2_tu1"></div>
                    <div class="con_fg_1_top_3">{star.2.fans}</div>
                </div>
                <div class="con_fg_1_bot">
                    {if $star[2]['sign']}签约coser{/if}
                </div>
            </div></a>
            <a href="/app/usercenter/index/{star.3.uid}"><div class="con_fg_1_4">
            	<div class="con_fg_1_top">
                	<div class="con_fg_1_top_1">{star.3.nickname}</div>
                    <div class="con_fg_1_top_2"><img src="images/sy_11.png" class="con_fg_1_top_2_tu1"></div>
                    <div class="con_fg_1_top_3">{star.3.fans}</div>
                </div>
                <div class="con_fg_1_bot">
                    {if $star[3]['sign']}签约coser{/if}
                </div>
            </div></a>
       </div>
    </div>
</div>
<div class="tj_z">	
    <div class="sp_z">
    	<div class="sp_z_1">视频展示</div>
        <div class="sp_z_2" style="text-shadow: 0 0 10px #000;">
        	<div class="sp_z_2_1">赛事视频</div>
            <!--{loop $contestVideo $v}-->
            <div class="sp_z_2_2">
            	<a href="/app/video/index/{v.vid}"><img src="pic/{v.thumb}.medium.jpg" class="sp_tu1"/>
            	<div class="sp_z_2_2_1">
                	<div class="sp_z_2_2_1_text">{v.title}</div>
                    <div class="sp_z_2_2_1_tu1"><img src="images/xq_71.png" /></div>
                </div></a>
            </div>
            <!--{/loop}-->
        </div>
        <div class="sp_z_2" style="text-shadow: 0 0 10px #000;">
        	<div class="sp_z_2_1">明星视频</div>
            <!--{loop $video $v}-->
            <div class="sp_z_2_2">
            	<a href="/app/video/index/{v.vid}"><img src="pic/{v.thumb}.medium.jpg" class="sp_tu1"/>
            	<div class="sp_z_2_2_1">
                	<div class="sp_z_2_2_1_text">{v.title}</div>
                    <div class="sp_z_2_2_1_tu1"><img src="images/xq_71.png" /></div>
                </div></a>
            </div>
            <!--{/loop}-->
        </div>
    </div>
</div>
<div class="guanfang">
    <div class="guanfang_1">
        <div class="guanfang_1_1">个人排行榜</div>
        <div class="guanfang_1_2"></div>
    </div>
</div>
   
<div class="tj_z1">
    <div class="ip_tu_zong">
    	<div class="ip_tu_1s">
        	<div class="ip_tu_1_1">
            	<a href="/app/usercenter/index/{cosers.0.uid}"><img src="pic/{cosers.0.thumb}.medium.jpg" class="ip_tu1"/></a>
            	<div class="ip_tu_1_1_dw"><img src="images/123_03.png" /></div>
            </div>
            <div class="ip_tu_1_2">
            	<div class="ip_1_2_1"><img src="pic/{cosers.0.avatar}.avatar.jpg" class="ip_tu3"/></div>
                <div class="ip_1_2_2">{cosers.0.nickname}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                <div class="ip_1_2_4">{cosers.0.fans}</div>
            </div>
            
        </div>
        <div class="ip_tu_2s">
        	<div class="ip_tu_1_1">
            	<a href="/app/usercenter/index/{cosers.1.uid}"><img src="pic/{cosers.1.thumb}.medium.jpg" class="ip_tu1"/></a>
            	<div class="ip_tu_1_1_dw"><img src="images/123_06.png" /></div>
            </div>
            <div class="ip_tu_1_2">
            	<div class="ip_1_2_1"><img src="pic/{cosers.1.avatar}.avatar.jpg" class="ip_tu3"/></div>
                <div class="ip_1_2_2">{cosers.1.nickname}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                <div class="ip_1_2_4">{cosers.1.fans}</div>
            </div>
           
        </div>
        <div class="ip_tu_2s">
        	<div class="ip_tu_1_1">
            	<a href="/app/usercenter/index/{cosers.2.uid}"><img src="pic/{cosers.2.thumb}.medium.jpg" class="ip_tu1"/></a>
            	<div class="ip_tu_1_1_dw"><img src="images/123_08.png" /></div>
            </div>
            <div class="ip_tu_1_2">
            	<div class="ip_1_2_1"><img src="pic/{cosers.2.avatar}.avatar.jpg" class="ip_tu3"/></div>
                <div class="ip_1_2_2">{cosers.2.nickname}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                <div class="ip_1_2_4">{cosers.2.fans}</div>
            </div>
            
        </div>
        <div class="ip_tu_2s_1">
        
        	<div class="geren_left">4</div>
            <div class="geren_right">
            	<a href="/app/usercenter/index/{cosers.3.uid}"><div class="geren_r_1"><img src="pic/{cosers.3.avatar}.avatar.jpg" /></div></a>
                <div class="geren_r_2">
                    <div class="geren_r_2_1">{cosers.3.nickname}</div>
                    <div class="geren_r_2_2">
                    	<div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                        <div class="geren_r_2_2_1">{cosers.3.fans}</div>
                    </div>
                </div>
            </div>
            <div class="geren_left">5</div>
            <div class="geren_rights">
            	<a href="/app/usercenter/index/{cosers.4.uid}"><div class="geren_r_1"><img src="pic/{cosers.4.avatar}.avatar.jpg" /></div></a>
                <div class="geren_r_2">
                    <div class="geren_r_2_1">{cosers.4.nickname}</div>
                    <div class="geren_r_2_2">
                    	<div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                        <div class="geren_r_2_2_1">{cosers.4.fans}</div>
                    </div>
                </div>
            </div>
            <div class="geren_left">6</div>
            <div class="geren_rights">
            	<a href="/app/usercenter/index/{cosers.5.uid}"><div class="geren_r_1"><img src="pic/{cosers.5.avatar}.avatar.jpg" /></div></a>
                <div class="geren_r_2">
                    <div class="geren_r_2_1">{cosers.5.nickname}</div>
                    <div class="geren_r_2_2">
                    	<div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                        <div class="geren_r_2_2_1">{cosers.5.fans}</div>
                    </div>
                </div>
            </div>
            <div class="geren_left">7</div>
            <div class="geren_rights">
            	<a href="/app/usercenter/index/{cosers.6.uid}"><div class="geren_r_1"><img src="pic/{cosers.6.avatar}.avatar.jpg" /></div></a>
                <div class="geren_r_2">
                    <div class="geren_r_2_1">{cosers.6.nickname}</div>
                    <div class="geren_r_2_2">
                    	<div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"/></div>
                        <div class="geren_r_2_2_1">{cosers.6.fans}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="guanfang">
    <div class="guanfang_1">
        <div class="guanfang_1_1">团体排行榜</div>
        <div class="guanfang_1_2"></div>
    </div>
</div>
<div class="tuanti">
	<div class="tuanti_1" style="text-shadow: 0 0 10px #000;">
    	<div class="tuanti_1_1">
        	<a href="/app/teamcenter/index/{team.0.tid}"><img src="pic/{team.0.pic}.medium.jpg" class="tuanti_1_1_tu1"/>
        	<div class="tuanti_1_1_dw">
            	<div class="tuanti_1_1_dw_1"><img src="images/qz_11.png" /><div class="tuanti_1_fg_1">1</div></div>
                <div class="tuanti_1_1_dw_2">
                	<font size="+1">{team.0.name}</font>&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/sy_11.png" class="tuanti_1_1_dw_2_tu1"/>&nbsp;
                    {team.0.fans}
                </div>
            </div></a>
        </div>
        <div class="tuanti_1_2">
            <a href="/app/teamcenter/index/{team.1.tid}"><img src="pic/{team.1.pic}.medium.jpg" class="tuanti_1_1_tu1"/>
            <div class="tuanti_1_1_dw">
            	<div class="tuanti_1_1_dw_1"><img src="images/qz_14.png" /><div class="tuanti_1_fg_1">2</div></div>
                <div class="tuanti_1_1_dw_2">
                	<font size="+1">{team.1.name}</font>&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/sy_11.png" class="tuanti_1_1_dw_2_tu1"/>&nbsp;
                    {team.1.fans}
                </div>
            </div></a>
        </div>
        <div class="tuanti_1_2">
            <a href="/app/teamcenter/index/{team.2.tid}"><img src="pic/{team.2.pic}.medium.jpg" class="tuanti_1_1_tu1"/>
            <div class="tuanti_1_1_dw">
            	<div class="tuanti_1_1_dw_1"><img src="images/qz_14.png" /><div class="tuanti_1_fg_1">3</div></div>
                <div class="tuanti_1_1_dw_2">
                	<font size="+1">{team.2.name}</font>&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/sy_11.png" class="tuanti_1_1_dw_2_tu1"/>&nbsp;
                    {team.2.fans}
                </div>
            </div></a>
        </div>
    </div>
    <div class="tuanti_2" style="text-shadow: 0 0 10px #000;">
    	<div class="tuanti_2_1">
        	<a href="/app/teamcenter/index/{team.3.tid}"><img src="pic/{team.3.pic}.medium.jpg" class="tuanti_1_1_tu2"/>
        	<div class="tuanti_1_1_dws">
            	<div class="tuanti_1_1_dw_1s"><img src="images/qz_19.png" /><div class="tuanti_1_fg_2">4</div></div>
                <div class="tuanti_1_1_dw_2s">
                	<font size="+1">{team.3.name}</font>&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/sy_11.png" class="tuanti_1_1_dw_2_tu1"/>&nbsp;
                    {team.3.fans}
                </div>
            </div></a>
        </div>
        <!--{loop $team $k=>$t}-->
        {if $k>3}
        <div class="tuanti_2_2">
        	<a href="/app/teamcenter/index/{t.tid}"><img src="pic/{t.pic}.medium.jpg" class="tuanti_1_1_tu2"/>
        	<div class="tuanti_1_1_dws">
            	<div class="tuanti_1_1_dw_1s"><img src="images/qz_19.png" /><div class="tuanti_1_fg_2"><!--{eval echo $k+1}--></div></div>
                <div class="tuanti_1_1_dw_2s">
                	<font size="+1">{t.name}</font>&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/sy_11.png" class="tuanti_1_1_dw_2_tu1"/>&nbsp;
                    {t.fans}
                </div>
            </div></a>
        </div>
       	{/if}
        <!--{/loop}-->
    </div>
    
</div>
<div class="guanfang">
    <div class="guanfang_1">
        <div class="guanfang_1_1">大赛实况</div>
        <a href=""><div class="guanfang_1_2 dn">MORE</div></a>
    </div>
</div>
    
<div class="dasai">
	<div class="dasai_1">
    	<a href="/app/actually/index/{contest.0.cid}">
        	<div class="dasai_1_1" style="background-image:url(pic/{contest.0.thumb}.medium.jpg)">
        	<div class="dasai_1_fg"><img src="images/sj_03.png"></div>
        </div></a>
        <div class="dasai_1_2">
        	<div class="dasai_1_2_1">{contest.0.title}</div>
            <div class="dasai_1_2_2">{contest.0.description}</div>
            <a href="/app/actually/index/{contest.0.cid}"><div class="dasai_1_2_3">查看全文</div></a>
        </div>
        <a href="/app/actually/index/{contest.1.cid}">
        <div class="dasai_1_1" style="background-image:url(pic/{contest.1.thumb}.medium.jpg)">
        <div class="dasai_1_fg"><img src="images/sj_03.png"></div></div>
        	
        </a>
        <div class="dasai_1_2">
        	<div class="dasai_1_2_1">{contest.1.title}</div>
            <div class="dasai_1_2_2">{contest.1.description}</div>
            <a href="/app/actually/index/{contest.1.cid}"><div class="dasai_1_2_3">查看全文</div></a>
        </div>
    </div>
   <div class="dasai_2">
        <div class="dasai_1_2">
        	<div class="dasai_1_2_1">{contest.2.title}</div>
            <div class="dasai_1_2_2">{contest.2.description}</div>
            <a href="/app/actually/index/{contest.2.cid}"><div class="dasai_1_2_3">查看全文</div></a>
        </div>
        <a href="/app/actually/index/{contest.2.cid}"><div class="dasai_1_1" style="background-image:url(pic/{contest.2.thumb}.medium.jpg)">
        	<div class="dasai_2_fg"><img src="images/sj_06.png"></div>
        </div></a>
        <div class="dasai_1_2">
        	<div class="dasai_1_2_1">{contest.3.title}</div>
            <div class="dasai_1_2_2">{contest.3.description}</div>
            <a href="/app/actually/index/{contest.3.cid}"><div class="dasai_1_2_3">查看全文</div></a>
        </div>
        <a href="/app/actually/index/{contest.3.cid}"><div class="dasai_1_1" style="background-image:url(pic/{contest.3.thumb}.medium.jpg)">
        	<div class="dasai_2_fg"><img src="images/sj_06.png"></div>
        </div></a>
    </div>
</div>    
<div class="guanfang">
    <div class="guanfang_1">
        <div class="guanfang_1_1">赛事烽火</div>
        <div class="guanfang_1_2"></div>
    </div>
</div>    
<div class="fenghuo">
	<div class="fh_z"><img src="images/sy_71.png" /></div>
</div>
<!--{subtemplate _footer}-->