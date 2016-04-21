jq=jQuery.noConflict();
(function(){
window._s={s_a:function(){var lp=location.pathname;return lp.split("/")}};
window.btoa=function(s){return CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(s))}
window.atob=function(s){return CryptoJS.enc.Base64.parse(s).toString(CryptoJS.enc.Utf8)}
window.getpageset=function(p,m,a,f,b,c){
	p=parseInt(p);
	var s='',g=(p>5?p-5:1)-(p+5>m?5+m-p:0);if(!b)b='';
	for(i=g<1?1:g;i<p;i++)s+="<a "+a+"='"+f+i+b+"'><i class='t'>"+i+"</i></a>";
	s+="<i class='paget'>"+p+"</i>";
	for(i=p+1;i<=m&&i<(p+6+(p>5?0:6-p));i++)s+="<a "+a+"='"+f+i+b+"'><i class='t'>"+i+"</i></a>";
	s+=p<=1?"|<i class='paget'>首页</i><i class='paget'>上页</i>":"|<a "+a+"='"+f+1+b+"'><i class='t'>首页</i></a><a "+a+"='"+f+(p-1)+b+"'><i class='t'>上页</i></a>";
	s+="<i class='paget'>"+p+"</i>";
	s+=p>=m?"<i class='paget'>下页</i><i class='paget'>末页</i>":"<a "+a+"='"+f+(p+1)+b+"'><i class='t'>下页</i></a><a "+a+"='"+f+m+b+"'><i class='t'>末页</i></a>";
	s+='跳转到<input maxlength="2" />页<a '+a+'="'+f+1+b+'"><i>跳转</i></a>';
	jQuery(function(){
		jQuery('.pageset').append(s);
		jQuery('.pageset input').bind('keyup',function(){
			jQuery('.pageset a:last').attr(a,f+parseInt(jQuery('.pageset input').val())+b);
		});
		if(c)c()
	})
}
String.prototype.encodeh=function(){return this.replace(/[()'<>&"]/g,function(c){return {'(':'&222;',')':'&333;',"'":'&#039;','<':'&lt;','>':'&gt;','&':'&amp;','"':'&quot;'}[c];})};
String.prototype.decodeh=function(){return this.replace(/&222;|&333;|&#039;|&lt;|&gt;|&amp;|&quot;/g,function(c){return {'&222;':'(','&333;':')','&#039;':"'",'&lt;':'<','&gt;':'>','&amp;':'&','&quot;':'"'}[c]})};
String.prototype.sizechange=function(){return this!=''?(this<1000?this+"MB":((parseInt(this/10.24))/100)+"GB"):"未知";};
String.prototype.ltypechange=function(){return {'1':'Torrent','2':'Magnet','3':'Link','4':'Pan'}[this]};
Number.prototype.t2=function(){if(this.toString().length===1)return '0'+this;else return this.toString()};
String.prototype.timechange=function(){
	var g = new Date();
	g.setTime(this*1000);
	return g.getFullYear()+'-'+(g.getMonth()+1).t2()+'-'+g.getDate().t2()+' '+g.getHours().t2()+":"+g.getMinutes().t2()
}
jQuery.fn.extend({
	positions:function(value){
		var elem = this[0];
		if (elem&&(elem.tagName=="TEXTAREA"||(elem.type&&elem.type.toLowerCase()=="text"))){
			if(jQuery.browser&&jQuery.browser.msie){
				var rng;
				if(elem.tagName == "TEXTAREA"){
					rng = event.srcElement.createTextRange();
					rng.moveToPoint(event.x,event.y);
				}else rng = document.selection.createRange();
				if(typeof value === "number"){
					var index=this.position();
					index>value?( rng.moveEnd("character",value-index)):(rng.moveStart("character",value-index))
					rng.select();
				}else{
					rng.moveStart("character",-event.srcElement.value.length);
					return  rng.text.length;
				}
			}else{
				if( value === undefined ){
					return elem.selectionStart;
				}else if(typeof value === "number" ){
					elem.selectionEnd = value;
					elem.selectionStart = value;
				}else if(value === "get" ){
					return [elem.selectionStart,elem.selectionEnd];
				}else if(typeof value === "object" ){
					elem.selectionEnd = value[1];
					elem.selectionStart = value[0];
				}
			}
		}else if( value === undefined )return undefined;
	}
});
window.packformdata=function(file,v,t,x){
		var form = new FormData();
		if(typeof v==="object")for(d in v)form.append(d,v[d]);
		if(!t)file=jq(file).get(0).files;
		if(file.length)form.append("file",file[0]);
		else{alert('选择失败，请选择正确的文件');return}
		if(!file[0])return;
		return typeof x ==='function' ? x(form) : form
	}




})();