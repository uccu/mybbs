(function(){
    folder =location.pathname.split("/");
    j(function(){
        var d = j('.nav-tabs li.'+folder[2]);
        if(d.length)d.addClass('active').removeAttr('href');
        j('form:not([data-default]) .advancedTextarea').advancedTextarea(500);
        j('.changeToDate').text(function(){return j(this).text().dateChange()});
    });
    window.UEDITOR_CONFIG = 'ueditor/';
    jQuery.fn.extend({
        advancedTextarea:function(b){
            window.UEDITOR_CONFIG.initialFrameHeight=b?b:500;
            for(var i=0;i < this.length;i++)UE.getEditor(this[i]);
        }
    })  
    var breadcrumb = function(a){
        var d = j('.nav-tabs li.'+folder[2]),
        e = '<ol class="breadcrumb"><li><a href="weixin/index">Home</a></li><li>'+d.html()+'</li>';
        if(a && folder[3]){
            e += '<li><a href="weixin/'+folder[2]+'/'+folder[3]+'">'+a+'</a></li>';
            if(folder[4] && !folder[4].match(/\d+/i))
                e += '<li><a href="weixin/'+folder[2]+'/'+folder[3]+'/'+folder[4]+(folder[5]?'/'+folder[5]:'')+(folder[6]?'/'+folder[6]:'')+'">详情</a></li>';
        }
        e += '</ol>';
        j('.alert_box').before(e);
    };
    window.subnav = function(){
        
        f = j('.subnav .col-md-12').addClass('col-md-10').removeClass('col-md-12');
        var e = '<div class="col-md-2"><div class="list-group t">';
        for(var i=0;i < arguments.length;i++){
            if(typeof arguments[i] === 'object'){
                for(var d in arguments[i])
                    e += '<a href="weixin/'+folder[2]+'/'+d+'" class="list-group-item">'+arguments[i][d]+'</a>'
            }else continue;
        }
        e += '</div></div>';f.before(e);
        if(folder[3]){
            breadcrumb(j('.subnav .list-group-item[href="weixin/'+folder[2]+'/'+folder[3]+'"]').addClass('cd active').removeAttr('href').html());
        }else for(var i=0;i < arguments.length;i++){
            if(typeof arguments[i] === 'string'){
                breadcrumb(j('.subnav .list-group-item[href="weixin/'+folder[2]+'/'+arguments[i]+'"]').addClass('cd active').removeAttr('href'));break;
            }
        }
        
        
    }
    
    
})();
