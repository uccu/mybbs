<!--{template _header}-->
<header nav="5"></header>
<div class="gz_body">
	<div class="gz_body_z">
    	<div class="gz_body_top">关注</div>
        
        <div class="gz_body_bot">
			<!--{loop $list $k=>$v}-->
				<div class="gz_body_bot_1">
					<div class="gz_body_bot_1_left">
						<a href="/app/usercenter/index/{$v.following}"><div class="gz_body_bot_1_left_top"><img src="/pic/{$v.avatar}.avatar.jpg" class="img-circle" /></div></a>
						<div class="gz_body_bot_1_left_bottom">{$v.nickname}</div>
					</div>
					<div class="gz_body_bot_1_right">
						<div class="gz_body_bot_1_right_top">{$v.interest}</div>
						<div class="gz_body_bot_1_right_bottom">
							<div class="gz_body_bot_1_right_bottom_1 cp" uid="{$v.following}">
								{if $v['doub'] == 0}<img src="images/yiguanzhu.png" />{else}<img src="images/xiangmu.png" />{/if}
							</div>
							<div class="gz_body_bot_1_right_bottom_2"><img src="images/siliao_05.png" data-toggle="tooltip" data-placement="bottom" title="尽请期待"/></div>
						</div>
					</div>
				</div>
			<!--{/loop}-->
        	


						<script>
							j('.gz_body_bot_1_right_bottom_1').click(function(){
								j.post('/app/usercenter/unfollow/'+j(this).attr('uid'),function(d){
									if(d.code==200)show_alert(1,'已取消关注~',function(){
										location.reload(true)
									});else show_alert(3,d.desc)
								},'json')
							})
						</script>
        </div>
        
    </div>
    
</div>



<!--{template _footer}-->