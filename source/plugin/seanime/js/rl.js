(function(){
	var j=jQuery,s='',g=function(){},lpa=_s.s_a(),lpas,lpal;
	if(lpa[5]){lpa[5]=decodeURI(lpa[5]).decodeh();lpal='/'+lpa[5];if(lpa[2]!='su'&&lpa[2]!='rlf'&&lpa[2]!='rla')j(function(){j('.search input').val(lpa[5]);var f=lpa[5].split(" "),t=j('.sourceslist_body ul');for(var i in f){for(var h=0;h<t.length;h++)t.eq(h).find('i:eq(2)').html(t.eq(h).find('i:eq(2)').html().replace(eval("/"+f[i]+"/ig"),'<em style="color:red">'+f[i]+'</em>'))}})}else lpal='/';
	lpas='//4moe.com/s/'+lpa[2]+'/'+lpa[3]+'/';
	g.prototype={getSearchTags:function(){
		j.ajax({url:'//4moe.com/seanime/ajax/themetags/'+j('.search input').val(),type:'post',dataType:'json',success:function(d){
			if(d.length==0){j('.searchTags').hide();return}
			if(g.hideSearchTags_of_settimeout)clearTimeout(g.hideSearchTags_of_settimeout);
			j('.searchTags').show().find('ul').html('');
			
			for(k in d){
				var w=j('<li><i aid='+d[k][1]+'>'+d[k][0]+'</i></li>').click(function(){
					j('.search input').val(j(this).find('i').html());j('.searchTags').hide();location='//4moe.com/s/rla/st/1/'+j(this).find('i').attr('aid');
				});
				j('.searchTags ul').append(w);
			}
			
		}})
		
	}};
	g=new g;




	j(function(){
		
		
		
		j('.search button').bind('click',function(){
			location='//4moe.com/s/rl/st/1/'+j('.search input').val();
		});
		j('.search input').bind('blur',function(e){
			if(g.hideSearchTags_of_settimeout)clearTimeout(g.hideSearchTags_of_settimeout);
			g.hideSearchTags_of_settimeout=setTimeout(function(){j('.searchTags').hide();},500);
		});
		j('.search input').bind('keyup',function(e){
			if(g.getSearchTags_of_settimeout)clearTimeout(g.getSearchTags_of_settimeout);
			if(e.which==13 || e.which==10)j('.search button').click();
			else{
				g.getSearchTags_of_settimeout=setTimeout(g.getSearchTags,500);
			}
		});
		j('.sourceslist_title li:eq(3) i').css('cursor','pointer').bind('click',function(){
			var lpas='//4moe.com/s/'+lpa[2]+'/';
			location=lpa[3]=='si'?lpas+'is/'+1+lpal:lpas+'si/'+1+lpal;
		});
		j('.sourceslist_title li:eq(4) i').css('cursor','pointer').bind('click',function(){
			var lpas='//4moe.com/s/'+lpa[2]+'/';
			location=lpa[3]=='st'?lpas+'ts/'+1+lpal:lpas+'st/'+1+lpal;
		})
		j('.sourceslist_body ul').find('li:eq(3) i').text(function(){return j(this).text().sizechange()});
		j('.sourceslist_body ul').find('li:eq(4) i').text(function(){return j(this).text().timechange()});
		getpageset(page,maxpage,'href',lpas,lpal)
})})()