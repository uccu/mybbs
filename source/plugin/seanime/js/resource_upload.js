var f={
	form:0,
	sloc_type:1,
	sdtype:58,
	aid:69,
	nextpage:function(){
		if([67,68,81,91].indexOf(parseInt(f.sdtype))!==-1)jq('.subtitle').hide(0);else jq('.subtitle').show(0);
		if([74,91].indexOf(f.sdtype)!==-1)jq('.quality').hide(0);else jq('.quality').show(0);
		jq(".upload_font").hide('slide',400,function(){jq(".upload_detail").show('slide',400);jq('.pageset .last').button('enable').one('click',f.lastpage)});
		jq(".pageset .next").button('disable')
	},
	lastpage:function(){
		jq(".upload_detail").hide('slide',400,function(){jq(".upload_font").show('slide',400);jq('.pageset .next').button('enable').one('click',f.nextpage)});
		jq(".pageset .last").button('disable')
	},
	o:function(){
		jq(document).on({
			dragleave:function(e){e.preventDefault()}, 
			drop:function(e){e.preventDefault()}, 
			dragenter:function(e){e.preventDefault()}, 
			dragover:function(e){e.preventDefault()} 
		});
		jq(".sdtype input:first").attr('checked','checked');
		jq(".sdtype,.sloc_type").buttonset();
		jq("button").button();jq('.wp').tooltip();
		jq('.dragpic').draggable();jq('.dragpic').draggable();
		//-------------------------------
		jq(".pageset .next").one('click',f.nextpage);
		jq("label").bind('click',function(){
			jq(this).parent().find('input').removeAttr('checked');
			var d = jq('#'+jq(this).attr('for'));d.attr('checked','checked');
			switch(d.val()){
				case '1':case '2':case '3':case '4':jq('.sloc .sloc_t:not(.disshow)').hide('blind',300,function(){jq('.'+d.attr('id')).show('blind',300).removeClass('disshow')}).addClass('disshow');f.sloc_type=d.val();break;
				default:f.sdtype=d.val();break;
			}
		});
		jq("a.sloc_change").bind('click',function(){
			var d = jq(this);
			jq('.sloc .sloc_t:not(.disshow)').hide('blind',300,function(){jq('.'+d.attr('sloc')).show('blind',300).removeClass('disshow')}).addClass('disshow')
		});
		jq(".sdes_info li:first p").bind('click',function(){jq(".dragpic").toggle('blind',300)});
		jq(".sloc_torrent button").bind('click',function(){jq(".sloc_torrent input").click()});
		jq(".dragpic button").bind('click',function(){jq(".dragpic input").click()});
		jq(".sloc_torrent input").bind('change',function(){f.formd('.sloc_torrent input',{here:1})});
		jq(".dragpic input").bind('change',function(){f.postpic(f.formd('.dragpic input',{here:1},0,1))});
		jq(".sloc_torrent_url button").bind('click',function(){f.posttorrent({here:1,file:btoa(jq(".sloc_torrent_url input").val())})});
		jq(".sloc_torrent,.dragpic").bind({
			dragover:function(e){
				jq(this).css('border','4px dashed #987')},
			dragleave:function(e){jq(this).css('border','4px dashed #CCC')}});
		jq(".sloc_torrent").get(0).addEventListener("drop",function(e){
			e.preventDefault();
			jq(".sloc_torrent button").css('z-index',1);
			jq('.sloc_torrent').css('border','4px dashed #CCC');
			var fileList = e.dataTransfer.files;
			f.formd(fileList,{here:1},'f');
		});
		jq(".dragpic").get(0).addEventListener("drop",function(e){
			e.preventDefault();
			jq(".dragpic button").css('z-index',1);
			jq('.dragpic').css('border','4px dashed #CCC');
			var fileList = e.dataTransfer.files;
			f.postpic(f.formd(fileList,{here:1},'f',1));
		});
		jq(".sloc_magnet input,.sloc_link input,.sloc_pan input:first").bind('change',function(){f.sloc=jq(this).val()});
		jq(".sloc_pan input:last").bind('change',function(){f.pw=jq(this).val()});
		jq('.size input,.size select').bind('change',function(){var t=jq(".size select").val(),d=parseInt(jq('.size input').val());f.size=t=='1024'?d*1024:d;});
		jq('.sname input').bind('change',function(){f.sname=jq(this).val().encodeh()});
		jq('.quality input').bind('change',function(){f.quality=jq(this).val()});
		jq('.aid input').bind('change',function(){f.aid=parseInt(jq(this).val())});
		jq('.outlink input').bind('change',function(){f.outlink=jq(this).val()});
		jq('.sdes textarea').bind('change',function(){f.sdes=jq(this).val().encodeh()});
		jq('.subtitle input').bind('change',function(){f.subtitle=jq(this).val().encodeh()});
		jq('.pageset .send').bind('click',f.send);
		if(_s.s_a()[3]=='upd')jq.post('//4moe.com/seanime/ajax/resource/get',{sid:_s.s_a()[4]},f.typein,'json')
	},
	typein:function(d){
		if(d)d=d.data;
		jq(".sloc_type [for='"+jq(".sloc_type [value='"+d.sloc_type+"']").attr('id')+"']").click();
		jq(".sdtype [for='"+jq(".sdtype [value='"+d.sdtype+"']").attr('id')+"']").click();
		jq('.sname input').val(d.sname.decodeh()).change();
		jq('.size input').val(d.size).change();
		if(d.sloc_type==2)jq('.sloc_magnet input').val(d.sloc).change();
		else if(d.sloc_type==3)jq('.sloc_link input').val(d.sloc).change();
		else if(d.sloc_type==4){
			jq('.sloc_pan input:first').val(d.sloc).change();
			jq('.sloc_pan input:last').val(d.pw).change()
		}else{jq('.sloc_torrent_url input').val(d.sloc);f.sloc=d.sloc}
		jq('.aid input').val(d.aid).change();
		jq('.quality input').val(d.quality).change();
		jq('.subtitle input').val(d.subtitle.decodeh()).change();
		jq('.outlink input').val(d.outlink).change();
		jq('.sdes textarea').val(d.sdes.decodeh()).change();
	},
	formd:function(file,v,t,x){
		var form = new FormData();
		if(typeof v==="object")for(d in v)form.append(d,v[d]);
		if(t!=='f')file=jq(file).get(0).files;
		
		if(typeof x!=='undefined'){
			if(file.length)form.append("file",file[0]);
			else{alert('选择失败，请选择正确的文件');return}
			return form;
		}else {
			if(file.length)form.append("file",file[0]);
			else{alert('选择失败，请选择正确的文件');return}
			if(!file[0])return;
			if(!file[0].name.match(/\.torrent$/i)){alert('请选择TORRENT的文件');return}
			f.form=form;jq('.sloc_torrent p.lin').text('');
			jq('.sloc_torrent p:eq(1)').text(file[0].name);
			f.posttorrent();
		}
		return form;
	},
	send:function(){
		var data = [1,['sloc_type',f.sloc_type],['sdtype',f.sdtype],['aid',f.aid]],url=_s.s_a()[3]=='upd'?'//4moe.com/seanime/ajax/resource/upd':'//4moe.com/seanime/ajax/resource/';
		if(_s.s_a()[3]=='upd')data[data.length]=['sid',_s.s_a()[4]];
		if(!f.sname){
			alert('名称错误');return;
		}else if(!f.sloc){
			alert('资源错误');return;
		}else{
			data[data.length]=['sname',f.sname];
			data[data.length]=['sloc',f.sloc];
		}
		if(f.pw)data[data.length]=['quality',f.pw];
		if(f.hash)data[data.length]=['hash',f.hash];
		if(f.size)data[data.length]=['size',f.size];
		if(f.subtitle!==undefined)data[data.length]=['subtitle',f.subtitle];
		if(f.quality!==undefined)data[data.length]=['quality',f.quality];
		if(f.outlink!==undefined)data[data.length]=['outlink',f.outlink];
		if(f.sdes!==undefined)data[data.length]=['sdes',f.sdes];
		if(typeof adf!=='undefined')data=adt.sendplus(data);
		jq.ajax({
			url:url,type:'post',data:{info:data},dataType:'json',
			error:function(){alert('上传失败');jq(w).text('上传失败')},
			success:function(d){if(d.code==200){alert('上传成功');location='//4moe.com/s/s/'+d.data}else alert('上传失败,错误代码'+d.code+":"+d.data)}
	})},
	postpic:function(form){
		w='.dragpic div.lin';
		jq.getJSON('http://4moe.com/tools/ajax/gettietuku/',function(p){
			if(p[0]==400)alert('上传失败,错误代码'+p[0]+":"+p[1]);
			form.append('Token',p[1]);
			jq.ajax({
				url:'http://up.tietuku.cn/',
				data:form,
				contentType: false,
				processData: false,
				type:'post',
				beforeSend:function(xhr){jq(w).text('开始上传')},
				success:function(h){
					var d=jq('.sdes textarea'),p=d.positions('get'),url=h.s_url,img="[img_s]";
					if(typeof  p==="number")p=[p,p];
					if(url.match(/\.gif$/i)){url=h.linkurl;img="[img]"}
					d.val(d.val().substring(0,p[0])+img+url+'[/img]'+d.val().substring(p[1]));
					jq('.sdes textarea').change();
					jq(w).text('上传完成')
				},
				dataType:'json',
				error:function(){alert('上传失败');jq(w).text('上传失败')}
			})
			
		})
		
	},
	posttorrent:function(s,w){
		if(!w)w='.sloc_torrent p.lin';
		jq.ajax({
			url:'http://x.4moe.com/a/anime.php',
			data:s?s:f.form,
			contentType: s?"application/x-www-form-urlencoded":false,
			processData: s?true:false,
			type:'post',
			beforeSend:function(xhr){jq(w).text('开始上传')},
			success:function(d){
				f.sloc=d[0];f.size=parseInt(d[1]/1024/1024);f.hash=d[2];
				jq('.size input').val(f.size);
				jq('.size option').removeAttr("selected");
				jq('.size option:last').attr("selected","selected");
				jq(w).text('上传完成')
			},
			dataType:'json',
			error:function(){alert('上传失败');jq(w).text('上传失败')}
		})
	},
	uploadProgress:function(evt){
		
		
	}









};jq(function(){f.o()});
