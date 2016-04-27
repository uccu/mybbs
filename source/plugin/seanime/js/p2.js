jq(function(){
	var j=jq;
	j('.overlay_cancel').bind('click',function(){location.hash='#none'})
	j('.overlay_box.ui-draggable').children().draggable({ revert: true });
	window.onhashchange = function(e){
		if(j(location.hash).hasClass('overlay')){
			onwheel = function(){return false};
			j('body').addClass('ofh')
		}else{
			onwheel =null;
			j('body').remove('ofh')
		}
	}

	
});