(function(){
	var j=jq,sdt = [
		["58","新番连载"],["82","完整动画"],["83","BDRIP"],["84","DVDRIP"],["57","OVA/SP"],["64","剧场版"],
		["67","音乐"],["68","MV/MAD"],["73","漫画"],["74","小说"],["81","图包"],["85","历年更新"],["90","游戏"],["91","RAW"]]
	,sdtr={};
	
	for(var d in sdt)sdtr[sdt[d][0]]=sdt[d][1];
	j(function(){
		
		j('.sdtype.change').text(function(){return sdtr[j(this).text()]});
		j('.size.change').text(function(){return j(this).text().sizechange()});
		window.parent.location.hash="overlay-2";
		j('img[data-original]').lazyload({effect : "fadeIn" });
	})
	
		
})()