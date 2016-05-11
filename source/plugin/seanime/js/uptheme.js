(function() {
	var j=jq,sto,k={},aid=_s.s_a()[4],updf=function(){
		var s=j('form').serializeArray(),url='seanime/ajax/theme/upd/'+aid;
		j.post(url,s,function(d){
			if(!d.code){alert(d.data);return}
			window.parent.location.hash = '';
			window.parent.location.reload(true);
		},'json')
	}
	j('.typein').click(function(){
		j.post('seanime/ajax/filter_theme_in/'+aid,function(d){
			if(!d.code){alert(d.data);return}
			for(var s in d.data.matchs)
				console.log(d.data.matchs[s]+':'+d.data.count[s]);
			alert('succeed');
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
    if(aid){
		j.post('seanime/ajax/theme/get/'+aid,function(d){
			if(!d.data.name){
				alert('无数据');
				window.parent.location.hash = '';
				window.parent.location.reload(true);return;
			}
			for(var f in d.data)j('span.'+f+' input').val(d.data[f]);
			j('.upload').click(updf);
		},'json')       
	}
	
	
	
	
	
	
	
	
	
	
	
	
})();