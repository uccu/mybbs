(function(){
	var j=jq,lastsTimeline=lastSize=allCount=0,sto,
		l = _s.s_a();if(!l[3])l[3] = 'all';
		if(['subtitle','ltype','sdtype','aid'].indexOf(l[3])>-1){
			if(!l[5])l[5] = 'time';if(!l[6])l[6] = 'DESC';
		}else if(['today','all','yesterday','my'].indexOf(l[3])>-1){
			if(!l[4])l[4] = 'time';if(!l[5])l[5] = 'DESC';
		}else{
			l[3] = 'all';l[5] = 'ASC';
		}

	j(function(){
		
		jq('.logout').click(function(){
                    jq.post('user/ajax/logout',function(d){
						if(!d.code){alert(d.data);return}
						location.reload(true);
					},'json')
                })
		j('#overlay-2 iframe').height(document.body.clientHeight*.7);
		allCount=j('.sourceslist_body ul').length;
		
		j('.sourceslist_title li:eq(3) i').css('cursor','pointer').bind('click',function(){
			if(['subtitle','ltype','sdtype','aid'].indexOf(l[3])>-1){
				if(!l[4]){location = 'seanime/lists/all/size/DESC';return}
				if(l[5] === 'size' && l[6]!=='ASC')l[6]='ASC';
				else l[6]='DESC';
				location = 'seanime/lists/'+l[3]+'/'+l[4]+'/size/'+l[6];
			}else{
				if(l[4] === 'size' && l[5]!=='ASC')l[5]='ASC';
				else l[5]='DESC';
				location = 'seanime/lists/'+l[3]+'/size/'+l[5];
			}
		});
		j('.sourceslist_title li:eq(4) i').css('cursor','pointer').bind('click',function(){
			if(['subtitle','ltype','sdtype','aid'].indexOf(l[3])>-1){
				if(!l[4]){location = 'seanime/lists/all';return}
				if(l[5] !== 'size' && l[6]!=='ASC')l[6]='ASC';
				else l[6]='DESC';
				location = 'seanime/lists/'+l[3]+'/'+l[4]+'/time/'+l[6];
			}else{
				if(l[4] !== 'size' && l[5]!=='ASC')l[5]='ASC';
				else l[5]='DESC';
				location = 'seanime/lists/'+l[3]+'/time/'+l[5];
			}
		})
		
		
		

		j('.sourceslist_body ul').find('li:eq(3) i').text(function(){lastSize =j(this).text();return j(this).text().sizechange()});
		j('.sourceslist_body ul').find('li:eq(4) i').text(function(){lastsTimeline =j(this).text();return j(this).text().timechange()});
		j('.sourceslist_body ul').find('li:eq(2) i').text(function(){return j(this).text().ltypechange()});
		
		var gain = function(){
			var //sid = j('[sid]:last').attr('sid'),
			lastS = l[5] === 'size' || l[4] === 'size' ? lastSize : lastsTimeline,url = 'seanime/lists_ajax/'+l[3]+'/'+l[4]+'/'+l[5];
			url += l[6]?'/'+l[6]:'';
			
			j.post(url,{data:lastS},function(w){
				if(!w.code)return;
				for(var d in w['data']){
					var g = '<ul class="sourceslist_block" sid="'+w['data'][d].sid+'"><li>';
					g +=w['data'][d].subtitle?'<a href="seanime/lists/subtitle/'+w['data'][d].subtitle+'"><i>'+w['data'][d].subtitle+'</i></a>':'<i>　</i>';
					g += '</li><li style="text-align:left"><a class="sdtype" href="seanime/lists/sdtype/'+w['data'][d].sdtype+'"><i>['+w['data'][d].sdtypename+']</i></a><a href="seanime/page/sid/'+w['data'][d].sid+'/'+w['data'][d].stimeline+'" target="overlay-iframe-2"><i>'+w['data'][d].sname+'</i></a><a class="outs" target="_blank" href="'+w['data'][d].outlink+'"><i>['+w['data'][d].outstation+']</i></a></li><li><a rel="external nofollow" href="seanime/down/straight/'+w['data'][d].sid+'/'+w['data'][d].stimeline+'"><i>'+w['data'][d].sloc_type.ltypechange()+'</i></a></li><li><i>'+w['data'][d].size.sizechange()+'</i></li><li><i>'+w['data'][d].stimeline.timechange()+'</i></li></ul>'
					j('.sourceslist_body').append(g);
					lastsTimeline =w['data'][d].stimeline;
					lastSize =w['data'][d].size;
					allCount +=1;
				}
				if(w['data'].length < 50)
					j('.sourceslist_bottom').html('<a class="t button-1 button-n bgc-1 bgc-h1"><i>已加载全部 '+ allCount +' 条资源</i></a>');
				j('.resource_gain').one('click',gain);
			},'json');
		};
		j('.resource_gain').one('click',gain);
		j('.search').bind({click:function(){
			var v = j('.search_input').val();
			if(v)location = 'seanime/lists/search/'+ v;
			else location = 'seanime/lists';
		}});
		if(_s.s_a()[3]=='search'){
			j('.sourceslist_bottom').html('<a class="t button-1 button-n bgc-1 bgc-h1"><i>已加载全部 '+ allCount +' 条资源(搜索模式最多显示100条)</i></a>');
			j('.search_input').val(decodeURI(l[4]))}
		j('.search_input').bind({keypress:function(e){if(e.which !== 13)return;j('.search').click()},keyup:function(e){
			if(sto)clearTimeout(sto);
			var v = j(this).val(),o = j(this).offset();
			j('.search_tags').css({opacity:0,display:'none',left:o.left,top:o.top+40}).find('ul').html('');
			
			if(v.length>0){
				sto = setTimeout(function(){
					j.post('seanime/ajax/themetags',{search:v},function(w){
						if(!w.code)return;
						var d = w.data;
						if(d.length)j('.search_tags').css({opacity:1,display:'block'});
						j('.search_tags ul').html('');
						for(var a in d){
							var z = '<a href="seanime/lists/aid/'+d[a].aid+'"><li><i>'+d[a].name+'</i></li></a>'
							j('.search_tags ul').append(z);
						}
					},'json');
				},500)
				
			}
		},blur:function(){
			setTimeout(function(){if(d.length)j('.search_tags').css({opacity:0,display:'none'})},1000);
		}});
		
	})
})()