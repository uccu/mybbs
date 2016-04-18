jq(function(){
	var j=jq;
	j('.overlay_cancel').bind('click',function(){location.hash='#none'})
	j('.overlay_box.ui-draggable').children().draggable({ revert: true });
	window.onhashchange = function(e){onwheel = j(location.hash).hasClass('overlay') ? function(){return false}: null}

	
});