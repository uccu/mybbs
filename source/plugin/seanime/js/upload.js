(function() {
	var j=jq,sto,k={},sid=_s.s_a()[4],r={
		sname:function(){
			var a=j('.sname input').val();
			if(!a){
				alert('resource error');
				return false
			}
			return a;
		},sloc_type:function(){
			return j('.sloc_type a').attr('value')
		},sdtype:function(){
			return j('.sdtype a').attr('value')
		
		},show:function(){
			return j('a.show').attr('value')
		},size:function(){
			var m = parseInt(j('.size input').val());
			if(!m)return true;
			return (j('span.input.size a.dn.gb').length?1:1024)*m
		},sloc:function(){
			var sloc_type = this.sloc_type();
			if(sloc_type==1){
				if(k.durl && k.durl.match(/^https?:.*\.torrent$/i)){
					delete k.base32 ;delete k.pw;
					return k.durl;
				}
				alert('torrent error:'+k.durl);return false;
			}else if(sloc_type==2){
				delete(k.durl);delete(k.hash);delete(k.md5);delete(k.base32);delete(k.pw);
				var m = j('.magnet_up input').val(),l;
				if((l=m.match(/^magnet:\?xt=urn:btih:([a-z0-9]{40})/i)) && l[1]){
					k.hash = l[1];return m;
				}else if((l=m.match(/^magnet:\?xt=urn:btih:([a-z0-9]{32})/i))&& l[1]){
					k.base32 = l[1];return m;
				}else{
					alert('magnet error');
					return false;
				}
			}else if(sloc_type==3){
				delete(k.durl);delete(k.hash);delete(k.md5);delete(k.base32);delete(k.pw);
				var m = j('.link_up input').val();
				if(m.match(/^https?:/i))return m;
				alert('link error');
				return false;
			}else if(sloc_type==4){
				delete(k.durl);delete(k.hash);delete(k.md5);delete(k.base32);delete(k.pw);
				var m = j('.pan_up input').eq(0).val(),n = j('.pan_up input').eq(1).val();
				if(!m.match(/^https?:/i)){
					alert('Disk Link error');
					return false
				}
				if(n)k.pw = n;
				return m;
			}
			alert('sloc error');
			return false
		},subtitle:function(){
			var m = j('.subtitle input').val();
			return m?m:true;
		},outlink:function(){
			var m = j('.outlink input').val();
			return m.match(/^https?:/i)?m:true;
		},outstation:function(){
			if(this.outlink()!==true)return j('.outstation input').val();
			else return true
		},sdes:function(){
			var m = j('textarea.sdes').val();
			return m?m:true;
		}
	};
	
	j('.see .sloc_type li').click(function(){
		var v = j(this).attr('value'),t = j(this).find('i').text();
		j('.upup').children().addClass('dn');
		if(t=='Torrent'){
			j('.torrent_up').removeClass('dn');
		}else if(t=='Torrent\''){
			j('.torrent_url_up').removeClass('dn');
		}else if(t=='Magnet'){
			j('.magnet_up').removeClass('dn');
		}else if(t=='Link'){
			j('.link_up').removeClass('dn');
		}else if(t=='NetDisk'){
			j('.pan_up').removeClass('dn');
		}
		j('.see .sloc_type li.selected').removeClass('selected');
		j(this).addClass('selected');
		j(this).parent().parent().find('a').attr('value',v);
		j(this).parent().parent().find('a i').html(t)
	});
	j('.see .sdtype li').click(function(){
		var v = j(this).attr('value'),t = j(this).find('i').text();
		j('.see .sdtype li.selected').removeClass('selected');
		j(this).addClass('selected');
		j(this).parent().parent().find('a').attr('value',v);
		j(this).parent().parent().find('a i').html(t)
	});
	j('.see .outstation li').click(function(){
		var v = j(this).attr('value'),t = j(this).find('i').text();
		if(t=='本站')j('.outlink_up').addClass('dn');
		else{
			j('.outlink_up input').val('');
			j('.outlink_up').removeClass('dn');
		}
		j('.see .outstation li.selected').removeClass('selected');
		j(this).addClass('selected');
		j(this).parent().parent().find('a').attr('value',v);
		j(this).parent().parent().find('a i').html(t)
	});
	j('.see .show').click(function(){
		var d = j(this);
		if(d.attr('value')=='1'){
			d.attr('value','0');d.find('i').html('隐藏');
		}else{
			d.attr('value','1');d.find('i').html('显示');
		}
	});
	j('span.input.size a').click(function(){
		j('span.input.size a').toggleClass('dn');
	});
	
	j('.torrent_up input').change(function(){
		if(j(this).val()){
			var f = j(this)[0].files[0],form = new FormData(),v={here:1},t={};
			if(!f.name.match(/\.torrent$/i)){
				k.durl = null;
				j(this).val('');alert('error file');return;
			}
			form.append("file",f);
			for(var d in v)form.append(d,v[d]);
			j.ajax({
				url:'http://x.4moe.com/a/anime.php',
				data:form,
				contentType: false,
				processData: false,
				type:'post',
				beforeSend:function(xhr){j('.torrent_up a').html('uploading file')},
				success:function(d){
					var sloc=d[0],size=parseInt(d[1]/1024/1024),hash=d[2],md5=d[3];
					if(!j('span.input.size a.dn.gb').length)j('span.input.size a.dn').click();
					j('.size input').val(size);k.durl=sloc;k.hash=hash;k.md5=md5;
					j('.torrent_up a').html('upload succeed')
				},
				dataType:'json',
				error:function(){k.krul = null;alert('上传失败');j('.torrent_up a').html('upload failed')}
			})
			j('.torrent_up a').html('selected one file');
			
		}else j('.torrent_up a').html('');
	});
	j('.theme input').bind({keyup:function(e){
			delete(k.aid);
			if(sto)clearTimeout(sto);
			var v = j(this).val();
			j('.search_tags').css({opacity:0,display:'none',left:0,top:40}).find('ul').html('');
			if(v.length>0){
				sto = setTimeout(function(){
					j.post('seanime/ajax/themetags',{search:v},function(w){
						if(!w.code)return;
						var d = w.data;
						if(d.length)j('.search_tags').css({opacity:1,display:'block'});
						j('.search_tags ul').html('');
						for(var a in d){
							var z = '<a class="cp" aid="'+d[a].aid+'"><li><i>'+d[a].name+'</i></li></a>'
							j('.search_tags ul').append(z);
						}
						j('.search_tags a').one({click:function(){
							k.aid = j(this).attr('aid');
							j('.theme input').val(j(this).find('i').text())
						}})
					},'json');
				},500)
				
			}
	},blur:function(){
		setTimeout(function(){j('.search_tags').css({opacity:0,display:'none'})},300);
	}});
	
	j('.upload').click(function(){
		var g=[];
		for(var d in r){
			if(typeof r[d]==='function'){
				var h=r[d]();
				if(h ===false)return;
				else if(h !==true)g[g.length] = [d,h];
			}
		}
		/*delete k.durl;*/
		for(var d in k){
			if(d=='durl')continue;
			g[g.length] = [d,k[d]];
		}
		var l = {info:g},url='seanime/ajax/resource';
		if(sid){l.sid=sid;url+='/upd'}
		j.post(url,l,function(d){
			if(!d.code){alert(d.data);return}
			window.parent.location.hash = '';
			window.parent.location.reload(true);
		},'json')
	});
	
	
	
    window.parent.location.hash="overlay-2";
	if (!String.prototype.trim) {
		(function() {
			var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
			String.prototype.trim = function() {
				return this.replace(rtrim, '');
			};
		})();
	}

	[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
		if( inputEl.value.trim() !== '' ) {
			classie.add( inputEl.parentNode, 'input--filled' );
		}

		inputEl.addEventListener( 'focus', onInputFocus );
		inputEl.addEventListener( 'blur', onInputBlur );
	} );

	function onInputFocus( ev ) {
		classie.add( ev.target.parentNode, 'input--filled' );
	}

	function onInputBlur( ev ) {
		if( ev.target.value.trim() === '' ) {
			classie.remove( ev.target.parentNode, 'input--filled' );
		}
	}
                

	
	if(sid){
		j.post('seanime/ajax/resource/get',{sid:sid},function(d){
			if(!d.data.sid){
				alert('无数据');
				window.parent.location.hash = '';
				window.parent.location.reload(true);return;
			}
			if(d.data.sname)j('.sname input').val(d.data.sname);
			if(d.data.sloc_type){
				jq('.see .sloc_type li[value='+d.data.sloc_type+']').click();
				if(d.data.sloc_type==1){
					if(d.data.sloc)k.durl=d.data.sloc;
					if(d.data.hash)k.hash=d.data.hash;
					if(d.data.md5)k.md5=d.data.md5;
				}else if(d.data.sloc_type==2){
					if(d.data.sloc)j('.magnet_up input').val(d.data.sloc)
				}else if(d.data.sloc_type==3){
					if(d.data.sloc)j('.link_up input').val(d.data.sloc)
				}else if(d.data.sloc_type==4){
					if(d.data.sloc)j('.pan_up input').eq(0).val(d.data.sloc);
					if(d.data.pw)j('.pan_up input').eq(1).val(d.data.pw);
				}
			}
			if(d.data.sdtype)j('.see .sdtype li[value='+d.data.sdtype+']').click();
			j('.see .outstation li[value='+d.data.outstation+']').click();
			if(d.data.show=='0')j('.see .show').click();
			j('.size input').val(d.data.size);
			if(d.data.aid!='69'){
				k.aid = d.data.aid;
				j('.theme input').val(d.data.name);
			}
			if(d.data.subtitle)j('.subtitle input').val(d.data.subtitle);
			if(d.data.outlink)j('.outlink input').val(d.data.outlink);
			if(d.data.sdes)j('textarea.sdes').val(d.data.sdes);
		},'json')
	}
	
	
	
	
	
	
	
	
	
	
	
})();