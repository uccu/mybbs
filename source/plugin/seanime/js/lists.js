(function(){
	var j=jq,lastsTimeline,sdt = [
		["58","新番连载"],["82","完整动画"],["83","BDRIP"],["84","DVDRIP"],["57","OVA/SP"],["64","剧场版"],
		["67","音乐"],["68","MV/MAD"],["73","漫画"],["74","小说"],["81","图包"],["85","历年更新"],["90","游戏"],["91","RAW"]],sdtt={},
		l = _s.s_a();if(!l[3])l[3] = 'all';
		if(['subtitle','ltype','sdtype'].indexOf(l[3])>-1){
			if(!l[5])l[5] = 'time';if(!l[6])l[6] = 'DESC';
		}else if(['today','all','yesterday'].indexOf(l[3])>-1){
			if(!l[4])l[4] = 'time';if(!l[5])l[5] = 'DESC';
		}

	j(function(){
		
		
		
		
		j('.sourceslist_title li:eq(3) i').css('cursor','pointer').bind('click',function(){
			if(['subtitle','ltype','sdtype'].indexOf(l[3])>-1){
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
			if(['subtitle','ltype','sdtype'].indexOf(l[3])>-1){
				if(l[5] !== 'size' && l[6]!=='ASC')l[6]='ASC';
				else l[6]='DESC';
				location = 'seanime/lists/'+l[3]+'/'+l[4]+'/time/'+l[6];
			}else{
				if(l[4] !== 'size' && l[5]!=='ASC')l[5]='ASC';
				else l[5]='DESC';
				location = 'seanime/lists/'+l[3]+'/time/'+l[5];
			}
		})
		
		for(var d in sdt){
			sdtt[sdt[d][0]] = sdt[d][1];
			j('.sourceslist_menu.sdtype').append('<li><a class="" href="seanime/lists/sdtype/'+sdt[d][0]+'"><i>'+sdt[d][1]+'</i></a></li>')
		}
		
		j('.sourceslist_body ul').find('li:eq(1) i:first').text(function(){j(this).parent().attr('href','seanime/lists/sdtype/'+j(this).text());return '['+sdtt[j(this).text()]+']'});
		j('.sourceslist_body ul').find('li:eq(3) i').text(function(){return j(this).text().sizechange()});
		j('.sourceslist_body ul').find('li:eq(4) i').text(function(){lastsTimeline =j(this).text();return j(this).text().timechange()});
		j('.sourceslist_body ul').find('li:eq(2) i').text(function(){return j(this).text().ltypechange()});
		
		j('.resource_gain').bind('click',function(){
			var //sid = j('[sid]:last').attr('sid'),
			url = 'seanime/lists_ajax/'+l[3]+'/'+l[4]+'/'+l[5];
			url += l[6]?l[6]:'';
			j.post(url,{data:lastsTimeline});
			
		});
		//getpageset(page,maxpage,'href',lpas,lpal)
		
		
	})
})()