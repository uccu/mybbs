(()=>{
    folder =location.pathname.split("/");
    j(()=>{
        var d = j('.nav-tabs li.'+folder[2]);
        if(d.length)d.addClass('active').removeAttr('href');
        
    })
    
    
    
})()