var _f={
	maxpage:0,
	sid:0,
	cid:0,
	reply:0,
	maxpage_reply:0,
	lasthuifu:[],
	sp:function(p,m){
		_f.maxpage=m;
		if(!m)return '';
		var s='',f=(p>5?p-5:1)-(p+5>m?5+m-p:0);
		for(i=f<1?1:f;i<p;i++)s+="<i class='bsh_f1' onclick='_f.to("+i+")'>"+i+"</i>";
		s+="<i class='paget'>"+p+"</i>";
		for(i=p+1;i<=m&&i<(p+6+(p>5?0:6-p));i++)s+="<i class='bsh_f1' onclick='_f.to("+i+")'>"+i+"</i>";
		s+=p<=1?"|<i class='paget'>首页</i><i class='paget'>上页</i>":"|<i class='bsh_f1' onclick='_f.to(1)'>首页</i><i class='bsh_f1' onclick='_f.to("+(p-1)+")'>上页</i>";
		s+="<i class='paget'>"+p+"</i>";
		s+=p>=m?"<i class='paget'>下页</i><i class='paget'>末页</i>":"<i class='bsh_f1' onclick='_f.to("+(p+1)+")'>下页</i><i class='bsh_f1' onclick='_f.to("+m+")'>末页</i>";
		s+="跳转到<input type='text' maxlength='2' onKeyUp='_f.ko()' />页<i class='bsh_f1'>跳转</i>";
		return s;
	},
	rsp:function(p,m){
		_f.maxpage=m;
		if(!m)return '';
		var s='',f=(p>5?p-5:1)-(p+5>m?5+m-p:0);
		for(i=f<1?1:f;i<p;i++)s+="<i class='bsh_f1' onclick='_f.rto("+i+")'>"+i+"</i>";
		s+="<i class='paget'>"+p+"</i>";
		for(i=p+1;i<=m&&i<(p+6+(p>5?0:6-p));i++)s+="<i class='bsh_f1' onclick='_f.rto("+i+")'>"+i+"</i>";
		s+=p<=1?"|<i class='paget'>首页</i><i class='paget'>上页</i>":"|<i class='bsh_f1' onclick='_f.rto(1)'>首页</i><i class='bsh_f1' onclick='_f.rto("+(p-1)+")'>上页</i>";
		s+="<i class='paget'>"+p+"</i>";
		s+=p>=m?"<i class='paget'>下页</i><i class='paget'>末页</i>":"<i class='bsh_f1' onclick='_f.rto("+(p+1)+")'>下页</i><i class='bsh_f1' onclick='_f.rto("+m+")'>末页</i>";
		s+="跳转到<input type='text' maxlength='2' onKeyUp='_f.rko()' />页<i class='bsh_f1'>跳转</i>";
		return s;
	},
	sts:function(sHtml) {
		return sHtml.encodeh();
	},
	ko:function(){
		var p =parseInt(jq('.pageset input').val());
		p=!isNaN(p)&&p>0?p:1;
		p=p>_f.maxpage?_f.maxpage:p;
		jq('.pageset i:last').unbind('click').bind('click',function(){_f.to(p)});
	},
	rko:function(){
		var p =parseInt(jq('.pageset_reply input').val());
		p=!isNaN(p)&&p>0?p:1;
		p=p>_f.maxpage_reply?_f.maxpage_reply:p;
		jq('.pageset_reply i:last').unbind('click').bind('click',function(){_f.rto(p)});
	},
	to:function(p,to){
		if(_f.lasthuifu.length)_f.shouqi();
		jq.ajax({
			url:'//4moe.com/json/c/s/'+_f.sid+'/'+p+'.json',type:'post',dataType:'json',
			error:function(){alert('wrong!')},
			success:function(d){
				var cs='',po={1:-159,56:-36,55:-77},poi=[1,56,55];
				for(c in d){
					d[c]['pos']=poi.indexOf(parseInt(d[c]['usergroup']))!=-1?po[d[c]['usergroup']]:5;
					cs+='<li class="comment_block" cid="'+d[c]['cid']+'"><div class="avator_pic"><img src="http://4moe.com/uc_server/avatar.php?uid='+d[c]['uid']+'&size=small"></div><div class="comment_info"><div class="comment_info_username"><i style="background-position:0 '+d[c]['pos']+'px">'+d[c]['username']+'</i></div><div class="content">'+d[c]['comment']+'</div><div class="info_plus"><i>'+d[c]['date']+'</i><em class="bsh_f1 huifu">回复('+d[c]['reply']+')</em>'+(d[c]['uid']==play_uid||play_uid==1?'<em class="bsh_f1 del_comment">删除</em>':'')+'<em>#'+d[c]['cid']+'</em></div></div></li>'
				}
				jq('.comment_ajax').css('opacity',0).html(cs).animate({opacity:1},400);
				jq('.pageset').css('opacity',0).html(_f.sp(p,_f.maxpage)).animate({opacity:1},400);
				if(!to)jq("body").stop(1).animate({scrollTop:jq(".comment").offset().top-150}, 1000);
				jq('.comment_block em.huifu').unbind('click').bind('click',_f.huifu);
				jq('.comment_block em.del_comment').unbind('click').bind('click',_f.del_comment);
			},
		})
		
	},
	rto:function(p){
		jq.ajax({
			url:'//4moe.com/json/r/c/'+_f.cid+'/'+p+'.json',type:'post',dataType:'json',
			error:function(){alert('wrong!')},
			success:function(d){
				var cs='',po={1:-159,56:-36,55:-77},poi=[1,56,55];
				for(c in d){
					d[c]['pos']=poi.indexOf(parseInt(d[c]['usergroup']))!=-1?po[d[c]['usergroup']]:5;
					cs+='<li class="reply_block" cid="'+d[c]['cid']+'"><div class="avator_pic"><img src="http://4moe.com/uc_server/avatar.php?uid='+d[c]['uid']+'&size=small"></div><div class="comment_info"><div class="comment_info_username"><i style="background-position:0 '+d[c]['pos']+'px">'+d[c]['username']+'</i></div><div class="content">'+d[c]['comment']+'</div><div class="info_plus"><i>'+d[c]['date']+'</i>'+(d[c]['uid']==play_uid||play_uid==1?'<em class="bsh_f1 del_comment">删除</em>':'')+'<em>#'+d[c]['cid']+'</em></div></div></li>'
				}
				jq('.comment_reply').css('opacity',0).html(cs).animate({opacity:1},400);
				jq('.pageset_reply').css('opacity',0).html(_f.rsp(p,_f.maxpage_reply)).animate({opacity:1},400);
				jq('.reply_block em.del_comment').unbind('click').bind('click',_f.del_comment);
			},
		})
		
	},
	del_comment:function(){
		var ct = jq(this).parent().parent().parent(),c = ct.attr('cid'),h=ct.hasClass('reply_block');
		jq.ajax({
			url:'//4moe.com/s/d/c/'+c,type:'post',dataType:'json',
			beforeSend:function(){
				return confirm('确认删除') ? true :false
			},
			success:function(d){
				if(d[0]==200){
					alert('删除成功(｀・ω・´)');
					ct.remove();
					if(h){
						_f.reply--;
						_f.maxpage_reply=parseInt(_f.reply/5)+((_f.reply % 5) > 0 ? 1 : 0);
						_f.lasthuifu[1]='回复('+_f.reply+')';
						_f.rto(1);
					}
				}else{
					alert('错误'+d[0]+':'+d[1])}},
			error:function(){alert('wrong!')}
		})
	},
	postcomment:function(){
		jq.ajax({
			url:'//4moe.com/send/c/s/'+_f.sid,type:'post',dataType:'json',
			data:{message:_f.sts(jq('.comment_info textarea').val())},
			beforeSend:function(){
				if(jq('.comment_info textarea').val()==''){
					alert('你什么都没输入哦(｀・ω・´)');return false
				}else if(play_uid==0){alert('没有登录不能评论不造么(｀・ω・´)');return false}
			},
			success:function(d){if(d[0]==200){alert('发送成功(｀・ω・´)');_f.to(1);jq('.comment_info textarea').val('')}else{alert('错误'+d[0]+':'+d[1])}},
			error:function(){alert('wrong!')}
		});
	},
	postreply:function(){
		jq.ajax({
			url:'send/r/c/'+_f.cid,type:'post',dataType:'json',
			data:{message:_f.sts(jq('.comment_info textarea').val())},
			beforeSend:function(){
				if(jq('.comment_info textarea').val()==''){
					alert('你什么都没输入哦(｀・ω・´)');return false
				}else if(play_uid==0){alert('没有登录不能评论不造么(｀・ω・´)');return false}
			},
			success:function(d){if(d[0]==200){alert('发送成功(｀・ω・´)');_f.reply++;_f.maxpage_reply=parseInt(_f.reply/5)+((_f.reply % 5) > 0 ? 1 : 0);_f.lasthuifu[1]='回复('+_f.reply+')';_f.rto(_f.maxpage_reply);jq('.comment_info textarea').val('')}else{alert('错误'+d[0]+':'+d[1])}},
			error:function(){alert('wrong!')}
		});
	},
	huifu:function(e){
		if(_f.lasthuifu.length)jq('[cid='+_f.lasthuifu[0]+'] em.huifu').unbind('click').bind('click',_f.huifu).html(_f.lasthuifu[1]);
		_f.lasthuifu=[jq(this).parent().parent().parent().attr('cid'),jq(this).html()];
		_f.reply='';
		for(v in _f.lasthuifu[1])if(!isNaN(_f.lasthuifu[1][v]))_f.reply+=_f.lasthuifu[1][v];
		_f.reply=parseInt(_f.reply);
		_f.maxpage_reply=parseInt(_f.reply/5)+((_f.reply % 5) > 0 ? 1 : 0);
		_f.cid=_f.lasthuifu[0];_f.rto(1);
		jq(this).html('收起').unbind('click').bind('click',_f.shouqi);
		jq('.biaoqing i.y').unbind('click').bind('click',_f.postreply);
		jq('.comment_block em.del_comment').unbind('click').bind('click',_f.del_comment);
		jq('.comment_extend textarea').attr('placeholder','回复 '+jq(this).parent().parent().find('.comment_info_username i').html()+' :');
		jq('.comment_extend').stop(1).css({'display':'none','margin-left':'125px'}).insertAfter(jq(this).parent().parent().parent()).slideDown()
	},
	shouqi:function(){
		jq('.comment_reply').html('');jq('.pageset_reply').html('');
		if(_f.lasthuifu.length){
			jq('[cid='+_f.lasthuifu[0]+'] em.huifu').unbind('click').bind('click',_f.huifu).html(_f.lasthuifu[1]);
			_f.lasthuifu=[];
		}
		jq('.biaoqing i.y').unbind('click').bind('click',_f.postcomment);
		jq('.comment_extend textarea').attr('placeholder','在这里输入评论');
		jq('.comment_extend').stop(1).css({'display':'none','margin-left':'auto'}).insertBefore(jq('.comment_ajax')).slideDown();
		jq("body").stop(1).animate({scrollTop:jq(".comment").offset().top-150}, 1000);
	},
	jq:function(){
		_f.sid=_s.s_a()[3]?_s.s_a()[3]:26668;
		jq(function(){
			jq('.yanwenzi').bind('click',function(){jq('.biaoqing_box').slideToggle()});
			jq('.biaoqing_box a').bind('click',function(){
				var d=jq('.comment_info textarea'),p=d.positions('get');
				if(typeof  p==="number")p=[p,p];
				d.val(d.val().substring(0,p[0])+jq(this).text()+d.val().substring(p[1]))
			});
			jq('.biaoqing i.y').bind('click',_f.postcomment);
			jq(".wp img").lazyload({effect : "fadeIn" });jq("ul.fy img").lazyload({effect : "fadeIn" });
			_f.to(1,1);
		})
	}
};
_f.jq();