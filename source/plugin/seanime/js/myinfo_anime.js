function getanimes(p){
	window.mpage=p;
	jq.ajax({url:'//4moe.com/seanime/ajax/getanimes/'+p,dataType:'json',success:function(d){
		var l = d.data.list,s='<div class="anime_list">',q=function(s,p){
			jq('.anime_change_'+s).bind('click',function(){var aid = jq(this).parent().parent().parent().parent().attr('aid'),des=jq("[aid="+aid+"].anime_block .anime_"+s+" i"),f=prompt(p,des.text());if(f!==null)jq.post('//4moe.com/seanime/ajax/changeanime'+s+'/'+aid,{des:f},function(d){des.html(f)},'json')});
		};
		for(var t in l){
			s+='<div aid="'+l[t].aid+'" lastnum="'+l[t].lastnum+'" regexp="'+l[t].regexp+'" order="'+l[t].order+'" class="anime_block t fz"><div class="anime_name cd"><a href="s/rla/st/1/'+l[t].aid+'"><i>'+l[t].name+'</i></a></div><div class="anime_newsname cd"><i>'+l[t].newsname+'</i></div><div class="anime_tag cd"><i>'+l[t].tag+'</i></div><div class="anime_dess cd"><i>'+l[t].dess+'</i></div><div class="anime_info"><ul><li><i class="anime_change_name cp t">修改名称</i></li><li><i class="anime_change_newsname cp t">修改别称</i></li><li><i class="anime_change_tag cp t">修改TAG</i></li><li><i class="anime_change_regexp cp t">修改正则</i></li><li><i class="anime_change_order cp t">设置优先</i></li><li><i class="anime_change_dess cp t">修改描述</i></li><li><i class="anime_change_lastnum cp t">修改进度</i></li><li><i class="anime_filterresource cp t">分类资源</i></li><li><i class="anime_returnresource cp t">清理资源</i></li><li><i class="anime_addplaybill cp t">加节目单</i></li><li><i class="anime_deleteplaybill cp t">删节目单</i></li><li><i class="anime_delete cp t">删除动漫</i></li></ul></div></div>'
		}
		if(!d.data.list ||d.data.list.length==0)s+='无记录';
		s+='</div><div class="pageset"><i class="fleshplaybill">刷新节目单</i><i class="fleshthemetags">刷新TAG</i><i class="newanime">创建新动漫</i> 共 '+d.data.maxpage+' 页/ '+d.data.maxrow+' 个结果 </div>';
		jq('.myinfo_body .anime').html(s);
		//jq('.myinfo_body img').lazyload({effect : "fadeIn" });
		jq('.newanime').bind('click',function(){
			if(confirm('确认创建？'))jq.post('//4moe.com/seanime/ajax/newanime/',function(d){
				if(d.code==200)getanimes(1);else{alert(d.code+':'+d.data)}
			},'json')
		});
		jq('.fleshthemetags').bind('click',function(){
			if(confirm('确认刷新？'))jq.post('//4moe.com/seanime/ajax/fleshthemetags/',function(d){
				if(d.code==200)alert('succeed');else{alert(d.code+':'+d.data)}
			},'json')
		});
		jq('.fleshplaybill').bind('click',function(){
			if(confirm('确认刷新？'))jq.post('//4moe.com/playbill/ajax/fleshplaybill/',function(d){
				if(d.code==200)alert('succeed');else{alert(d.code+':'+d.data)}
			},'json')
		});
		//jq('.games_infos .timeline').text(function(){return jq(this).text().timechange()});
		q('name','修改名字为：');
		q('dess','修改简介为：');
		q('newsname','修改别名为：');
		q('tag','修改TAG为：');
		jq('.anime_returnresource').bind('click',function(){
			var aid = jq(this).parent().parent().parent().parent().attr('aid');
			if(confirm('清理资源？'))jq.post('//4moe.com/seanime/ajax/animereturnresource/'+aid,function(d){if(d.code==200)alert('succeed')},'json');
		});
		jq('.anime_filterresource').bind('click',function(){
			var aid = jq(this).parent().parent().parent().parent().attr('aid'),f=prompt('匹配条件为：');
			if(f)jq.post('//4moe.com/seanime/ajax/animefilterresource/'+aid,{des:f},function(d){if(d.code==200)alert('succeed')},'json');
		});
		jq('.anime_addplaybill').bind('click',function(){
			var aid = jq(this).parent().parent().parent().parent().attr('aid'),f=prompt('星期几（0-6）？：');
			if(f)jq.post('//4moe.com/playbill/ajax/animeaddplaybill/'+aid,{des:f},function(d){if(d.code==200)alert('succeed')},'json');
		});
		jq('.anime_change_regexp').bind('click',function(){
			var w = jq(this).parent().parent().parent().parent(),aid=w.attr('aid'),f=prompt('修改正则为：',w.attr('regexp'));
			if(f!==null)jq.post('//4moe.com/seanime/ajax/changeanimeregexp/'+aid,{des:f},function(d){w.attr('regexp',f)},'json');
		});
		jq('.anime_change_order').bind('click',function(){
			var w = jq(this).parent().parent().parent().parent(),aid=w.attr('aid'),f=prompt('设置优先级为：',w.attr('order'));
			if(f!==null)jq.post('//4moe.com/seanime/ajax/changeanimeorder/'+aid,{des:f},function(d){w.attr('order',f)},'json');
		});
		jq('.anime_change_lastnum').bind('click',function(){
			var w = jq(this).parent().parent().parent().parent(),aid=w.attr('aid'),f=prompt('修改进度为：',w.attr('lastnum'));
			if(f!==null)jq.post('//4moe.com/seanime/ajax/changeanimelastnum/'+aid,{des:f},function(d){w.attr('lastnum',f)},'json');
		});
		jq('.anime_deleteplaybill').bind('click',function(){
			var aid = jq(this).parent().parent().parent().parent().attr('aid'),f=confirm('确认删除？');
			if(f)jq.post('//4moe.com/playbill/ajax/animedeleteplaybill/'+aid,function(d){if(d.code==200)alert('succeed');else{alert(d.code+':'+d.data)}},'json');
		});
		jq('.anime_delete').bind('click',function(){
			var aid = jq(this).parent().parent().parent().parent().attr('aid'),f=confirm('确认删除？');
			if(f)jq.post('//4moe.com/seanime/ajax/animedelete/'+aid,function(d){getanimes(1)},'json');
		});
		getpageset(p,d.data.maxpage,'page','','',function(){jq('.pageset a').bind('click',function(){
			var e=jq(this).attr('page');
			if(e)getanimes(e)
		})});
	}})
}getanimes(1);