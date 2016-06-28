<!--{template _header}-->
<style type="text/css">
.nh_top_z_right_tu1{width:558px;height:375px;}
.d_shipin_1_1_tu1{width:225px;height:140px; border-radius:5px;}
</style>
<header nav="4"></header>
<script type="text/jscript">
function nh_blog(){
	document.getElementById("nh_blog").style.display="block";
	document.getElementById("nh_shipin").style.display="none";
	document.getElementById("nh_xiangce").style.display="none";	
}
function nh_shipin(){
	document.getElementById("nh_blog").style.display="none";
	document.getElementById("nh_shipin").style.display="block";
	document.getElementById("nh_xiangce").style.display="none";	
}
function nh_xiangce(){
	document.getElementById("nh_blog").style.display="none";
	document.getElementById("nh_shipin").style.display="none";
	document.getElementById("nh_xiangce").style.display="block";	
}

</script>
<div class="nh_top">
	<div class="nh_top_z">
    	<div class="nh_top_z_left">
        	<div class="nh_top_z_left1"><div><font size="+2">{if $rank < 100 }{rank}{else}99+{/if}</font><br />排行榜</span></div></div>
            
			{if $me['uid'] == $coser['uid']}
				<div class="nh_top_z_left2">
					<div class="nh_top_z_left2_1"><img src="/pic/{coser.avatar}.avatar.jpg" /></div>
					<div class="nh_top_z_left2_2">{coser.nickname} &nbsp;&nbsp;&nbsp;
						<a href="centertupdate.html"><img src="images/tc-46.png" class="n_tu1"/></a>
					</div>
					<div class="nh_top_z_left2_3">
					关注 {coser.follow}&nbsp;&nbsp;|&nbsp;&nbsp;粉丝 {coser.fans}<br />
						<font color="#666">
							{if $coser['area']}{coser.area}/{/if}
							{if $coser['age']}{coser.age}岁/{els{/if}
							{if $coser['constel']}{coser.constel}{/if}
						</font>
					</div>
					<div class="nh_top_z_left2_4">
						{if $coser['interest']}爱好：{coser.interest}{/if}
					</div>
				</div>
			{else}
				<div class="nh_top_z_left2">
					<div class="nh_top_z_left2_1s" {if $coser['uid']!=$me['uid']}style="margin:auto"{/if}><img src="images/zb_03.png" /></div>
					<div class="nh_top_z_left2_2s">{coser.nickname}</div>
					<div class="nh_top_z_left2_3s">
						关注 {coser.follow}&nbsp;&nbsp;|&nbsp;&nbsp;粉丝 {coser.fans}<br />
						<font color="#666">
							{if $coser['area']}{coser.area}/{/if}
							{if $coser['age']}{coser.age}岁/{/if}
							{if $coser['constel']}{coser.constel}{/if}
						</font>
					</div>
					<div class="nh_top_z_left2_4s">
						{if $coser['interest']}爱好：{coser.interest}{/if}
					</div>
					<div class="nh_top_z_left2_5">
						<div class="nh_top_z_left2_5_1"><img src="images/guanzhu_03.png" /></div>
						<div class="nh_top_z_left2_5_2"><img src="images/siliao_05.png" /></div>
					</div>
				</div>
            {/if}
			<div class="nh_top_z_left3"></div>
        </div>
        <div class="nh_top_z_right" style="background-image:url(/pic/{coser.cover}.large.jpg);background-size:cover;background-position:center">
			{if $me['uid'] == $coser['uid']}
        	<div class="nh_top_z_right_fg"></div>
			<input type="file" style="display:none" name="cover" />
			<script>
			j('.nh_top_z_right_fg').click(function(){
				j('[name=cover]').click();
			});j('[name=cover]').change(function(){
				var v = {large:1,medium:1,box:'user'},f = packFormData(j(this),v);
				j.ajax({
					data:f,contentType:false,processData:false,type:'post',url:'/_tool/picture/upload',
					success:function(d){

					}
				})
			})
			</script>
			{else}
			{/if}
        </div>
	</div>
</div>

<div class="nh_top1" id="nh_xiangce">
	<div class="nh_top1_z">
    	<div class="nh_top1_z_top">
        	<div class="nh_top1_z_top_1">
            	<div class="nh_top1_z_top_1_1" onclick="nh_xiangce()">相册</div>
            	<div class="nh_top1_z_top_1_2" onclick="nh_shipin()">视频</div>
                <div class="nh_top1_z_top_1_2">BLOG</div>
            </div>
			{if $me['uid'] == $coser['uid']}
            <div class="nh_top1_z_top_2"><a href="centerphotomanage.html"><div class="n_p_z_1_right_gl">管理</div></a></div>
			{else}
			<div class="nh_top1_z_top_2"><a href="blog.html"><div class="nh_more">MORE</div></a></div>
			{/if}
        </div>
        <div class="nh_top1_z_bot">
		<!--{loop $album $k=>$v}-->
			
			<div class="d_p_z_2_1">
            	<div class="d_p_z_2_1_top">
                	<a href="photoone.html"><img src="/pic/{$v.thumb}.medium.jpg" /></a>
                    <div class="d_p_z_2_top_num">{$v.count}</div>
                </div>
                <div class="d_p_z_2_1_bottom">{$v.title}</div>
            </div>
		<!--{/loop}-->  
        </div>
    </div>
</div>

<div class="nh_top2" id="nh_shipin">
	<div class="nh_top2_z">
    	<div class="nh_top1_z_top">
        	<div class="nh_top1_z_top_1">
            	<div class="nh_top1_z_top_1_2" onclick="nh_xiangce()">相册</div>
            	<div class="nh_top1_z_top_1_1" onclick="nh_shipin()">视频</div>
                <div class="nh_top1_z_top_1_2">BLOG</div>
            </div>
			{if $me['uid'] == $coser['uid']}
            <div class="nh_top1_z_top_2"><a href="videomanage.html"><div class="n_p_z_1_right_gl">管理</div></a></div>
			{else}
			<div class="nh_top1_z_top_2"><a href="videolist.html"><div class="nh_more">MORE</div></a></div>
			{/if}
        </div>
        <div class="nh_top2_z_bot">
			<!--{loop $video $k=>$v}-->
				<div class="d_shipin_1_1">
					<a href="video.html"><img src="/pic/{$v.thumb}.medium.jpg"  class="d_shipin_1_1_tu1"/>
					<div class="t_z_2_2_1">
						<div class="t_z_2_2_1_text">{$v.title}</div>
						<div class="t_z_2_2_1_tu1"><img src="/images/xq_71.png" /></div>
					</div></a>
				</div>
			<!--{/loop}-->
            
        </div>
        
    </div>
</div>
<div class="nh_top3" id="nh_blog">
	<div class="nh_top1_z">
    	<div class="nh_top1_z_top">
        	<div class="nh_top1_z_top_1">
            	<div class="nh_top1_z_top_1_2" onclick="nh_xiangce()">相册</div>
            	<div class="nh_top1_z_top_1_2" onclick="nh_shipin()">视频</div>
                <div class="nh_top1_z_top_1_1">BLOG</div>
            </div>
			{if $me['uid'] == $coser['uid']}
            <div class="nh_top1_z_top_2"><a href="#"><div class="n_p_z_1_right_gl">管理</div></a></div>
			{else}
			<div class="nh_top1_z_top_2"><a href="blog.html"><div class="nh_more">MORE</div></a></div>
			{/if}
		</div>
        <div class="nh_top1_z_bot">
			<div class="e_st_z_1">
                <a href="#"><div class="e_st_z_1_1"><img src="images/xq_102.png" /></div></a>
                <div class="e_st_z_1_2">团员面基~~</div>
                <a href="#"><div class="e_st_z_1_3">查看详情</div></a>
            </div>
            <div class="e_st_z_1">
                <a href="#"><div class="e_st_z_1_1"><img src="images/xq_104.png" /></div></a>
                <div class="e_st_z_1_2">团员面基~~</div>
                <a href="#"><div class="e_st_z_1_3">查看详情</div></a>
            </div>
            <div class="e_st_z_1">
                <a href="#"><div class="e_st_z_1_1"><img src="images/xq_106.png" /></div></a>
                <div class="e_st_z_1_2">团员面基~~</div>
                <a href="#"><div class="e_st_z_1_3">查看详情</div></a>
            </div>
            <div class="e_st_z_1">
                <a href="#"><div class="e_st_z_1_1"><img src="images/xq_108.png" /></div></a>
                <div class="e_st_z_1_2">团员面基~~</div>
                <a href="#"><div class="e_st_z_1_3">查看详情</div></a>
            </div>
        </div>
    </div>
</div>
{if $me['uid'] == $coser['uid']}
<div class="n_tuandui">
	<div class="n_tuandui_z">
    	<div class="d_p_z_1">
        	<div class="d_p_z_1_left">团队</div>
            <div class="n_p_z_1_right"></div>
        </div>
    	<div class="n_tuandui_z_1">
        	<div class="n_tuandui_z_1_text1">我加入的团队</div>
            <div class="n_tuandui_z_1_tu1"><a href="teamdetails.html"><img src="/pic/{team.avatar}.avatar.jpg" class="n_tuandui_tu1"/></a></div>
            <div class="n_tuandui_z_1_text2">{team.name}</div>
        </div>
        <div class="n_tuandui_z_2">
        	<div class="n_tuandui_z_2_text1">我管理的团队</div>
            <div class="n_tuandui_z_2_tu1"><a href="teamdetails.html"><img src="/pic/{captainTeam.avatar}.avatar.jpg" class="n_tuandui_tu2"/></a></div>
            <div class="n_tuandui_z_2_text2">{captainTeam.name}</div>
        </div>
        <div class="n_tuandui_z_3"><a href="mybasis.html"><div class="n_p_z_1_right_gl">管理</div></a></div>
    </div>
</div>

{/if}
<div class="d_zhibo">
	<div class="d_zhibo_z">
    	<div class="d_p_z_1">
        	<div class="d_p_z_1_left">直播</div>
            {if $me['uid'] == $coser['uid']}
			<div class="n_p_z_1_right"><a href="zhibo.html"><div class="n_p_z_1_right_gl">管理</div></a></div>
			{else}
			{/if}
        </div>
    	<div class="d_zhibo_1">
			{if $live['yy']}
			<a href="{live.yy}">
				<div class="d_zhibo_1_1">
					<div class="d_zhibo_1_top"><img src="images/zb_11.png" /></div>
					<div class="d_zhibo_1_bottom">yy语音</div>
				</div>
			</a>
			{/if}
			{if $live['bilibili']}
			<a href="{live.bilibili}">
				<div class="d_zhibo_1_1">
					<div class="d_zhibo_1_top"><img src="images/zb_13.png" /></div>
					<div class="d_zhibo_1_bottom">B站直播间</div>
				</div>
			</a>
			{/if}
			{if $live['yahu']}
			<a href="{live.yahu}">
				<div class="d_zhibo_1_1">
					<div class="d_zhibo_1_top"><img src="images/zb_15.png" /></div>
					<div class="d_zhibo_1_bottom">雅虎直播</div>
				</div>
			</a>
			{/if}
        </div>
    </div>
</div>


<!--{template _footer}-->