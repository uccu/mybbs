jq(function(){
	jq('.overlay:not(.overlay_sel),overlay_cancel').bind('click',function(){location.hash='#none'})
	jq('.overlay.overlay_sel .overlay_box').children().draggable({ revert: true });
	window.onhashchange = function(e){
		if(jq(location.hash).hasClass('overlay')){
			onwheel = function(){return false};
		}else{
			onwheel = null
		}
		
	}
	

	
});