(function() {
	j=jq;
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
				j(this).val('');alert('error file');
			}
			form.append("file",f);
			for(var d in v)form.append(d,v[d]);
			jq.ajax({
				url:'http://x.4moe.com/a/anime.php',
				data:form,
				contentType: false,
				processData: false,
				type:'post',
				beforeSend:function(xhr){j('.torrent_up a').html('uploading file')},
				success:function(d){
					var sloc=d[0],size=parseInt(d[1]/1024/1024),hash=d[2],md5=d[3];
					jq('.size input').val(size);
					if(j('span.input.size a.dn.gb').length)j('span.input.size a').click();
					j('.torrent_up a').html('upload succeed')
				},
				dataType:'json',
				error:function(){alert('上传失败');j('.torrent_up a').html('upload failed')}
			})
			j('.torrent_up a').html('selected one file');
			
		}else j('.torrent_up a').html('');
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
                
    j('.password').bind({keypress:function(e){if(e.which !== 13)return;j('.login').click()}});
    j('.login').click(function(){
		var f = {};
		f.lname = j('.loginname').val();
		f.pwd = j('.password').val();
		if(!f.lname || !f.pwd){alert('error');return}
		f.pwd = CryptoJS.MD5(f.pwd).toString();
        j.post('user/ajax/login',f,function(d){
			if(!d.code){alert(d.data);return}
			window.parent.location.hash = '';
			window.parent.location.reload(true);
		},'json')
    })
})();