(()=>{
    folder =location.pathname.split("/");
    j(()=>{
        var d = j('.nav-tabs li.'+folder[2]);
        if(d.length)d.addClass('active').removeAttr('href');
    });
    var breadcrumb = function(a){
        var d = j('.nav-tabs li.'+folder[2]),
        e = '<ol class="breadcrumb"><li><a href="weixin/index">Home</a></li><li>'+d.html()+'</li>';
        if(a && folder[3])e += '<li><a href="'+folder[3]+'">'+a+'</a></li>';
        e += '</ol>';
        j('.alert_box').before(e);
    };
    subnav = function(){
        
        f = j('.subnav .col-md-12').addClass('col-md-10').removeClass('col-md-12');
        console.log(f);
        var e = '<div class="col-md-2"><div class="list-group">';
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
