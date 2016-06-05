j(function(j){
   j('.insave').on('click',function(){
        var s=j(this),f=s.attr('for'),d=j('form#'+f).serializeArray();
        if(d)j.post(s.attr('data-action'),d,function(c){
            if(c.code!==200){alert(c.code+':'+c.desc)}
            location.reload(true)
        },'json')
    });
    var defaultForm = j('form[data-default]');
    for(var i=0;i <defaultForm.length;i++){
        j.getJSON(j(defaultForm[i]).attr('data-default'),function(f){
            for(var g in f.data)j('[name='+g+']').val(f.data[g]).advancedTextarea(500);
        })
    }
    
    
    
});
