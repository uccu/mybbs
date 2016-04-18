jq(function(){
	jq('.overlay_cancel').bind('click',function(){location.hash='#none'})
	jq('.overlay_box.ui-draggable').children().draggable({ revert: true });
	window.onhashchange = function(e){
		if(jq(location.hash).hasClass('overlay')){
			onwheel = function(){return false};
		}else{
			onwheel = null
		}
		
	}
	

	
});