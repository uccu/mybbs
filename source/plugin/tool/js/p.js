(function(){
btoa=function(s){return CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(s))}
atob=function(s){return CryptoJS.enc.Base64.parse(s).toString(CryptoJS.enc.Utf8)}

String.prototype.encodeh=function(){return this.replace(/[()'<>&"]/g,function(c){return {'(':'&222;',')':'&333;',"'":'&#039;','<':'&lt;','>':'&gt;','&':'&amp;','"':'&quot;'}[c];})};
String.prototype.decodeh=function(){return this.replace(/&222;|&333;|&#039;|&lt;|&gt;|&amp;|&quot;/g,function(c){return {'&222;':'(','&333;':')','&#039;':"'",'&lt;':'<','&gt;':'>','&amp;':'&','&quot;':'"'}[c]})};
String.prototype.sizechange=function(){return this!=''?(this<1000?this+"MB":((parseInt(this/10.24))/100)+"GB"):"未知";};
String.prototype.ltypechange=function(){return {'1':'Torrent','2':'Magnet','3':'Link','4':'Pan'}[this]};
Number.prototype.t2=function(){if(this.toString().length===1)return '0'+this;else return this.toString()};
String.prototype.timeChange=function(){
	var g = new Date();
	g.setTime(this*1000);
	return g.getFullYear()+'-'+(g.getMonth()+1).t2()+'-'+g.getDate().t2()+' '+g.getHours().t2()+":"+g.getMinutes().t2()
}
String.prototype.dateChange=function(){
	var g = new Date();g.setTime(this*1000);return g.getFullYear()+'-'+(g.getMonth()+1).t2()+'-'+g.getDate().t2()
}
window.getPageSet=function(p,m,a,f,b,c){
	p=parseInt(p);if(!a)a='href';
	var s='',g=(p>5?p-5:1)-(p+5>m?5+m-p:0);if(!b)b='';
	s+='<li><a '+a+'="'+f+1+b+'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
	for(i=g<1?1:g;i<p;i++)
		s+="<li><a "+a+"='"+f+i+b+"'><i class='t'>"+i+"</i></a></li>";
	s+="<li class='active'><a class='paget'>"+p+"<span class='sr-only'>(current)</span></a></li>";
	for(i=p+1;i<=m&&i<(p+6+(p>5?0:6-p));i++)
		s+="<li><a "+a+"='"+f+i+b+"'><i class='t'>"+i+"</i></a></li>";
	s+='<li><a '+a+'="'+f+m+b+'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
	jQuery(function(){
		jQuery('.pageset').append(s);
		if(c)c()
	})
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
window.packFormData=function(file,v,t,x){
		var form = new FormData();
		if(typeof v==="object")for(d in v)form.append(d,v[d]);
		if(!t)file=jQuery(file).get(0).files;
		if(file.length)form.append("file",file[0]);
		else{alert('选择失败，请选择正确的文件');return}
		if(!file[0])return;
		return typeof x ==='function' ? x(form) : form
	}




})();