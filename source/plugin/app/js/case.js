!function(){
    function getMore(){
        $('body').height()-$('body').scrollTop()-$(window).height()
    }
    //let a = 0;
    function getlist(id,t){
        llr=0;//console.log(++a);
        if(!id)return;
        t = t?parseInt(t):0;
        $.post('app/cases/get_list/'+id+'/'+(t?6:15)+'/'+t,function(d){
            if(d.code!=200){
                alert(d.desc);return;
            }
            if(!d.data.length){

                $(window).unbind('scroll',ee);
                $('.more .col-xs-2 span').hide();
                $('.more .col-xs-2 p').show();
            }else{
                for(var s in d.data){
                    $('.anli .row').append(
                        '<div class="col-xs-4 anli-block" data-ctime="'+d.data[s].ctime+'"><a href="app/anli/'+d.data[s].aid+'"><div class="anli-block-in pr cp"><div class="anli-pic"'+(d.data[s].thumb?' style="background-image:url('+
                        d.data[s].thumb+')"':'')+'></div><h4>'+d.data[s].name+'</h4><p>'+d.data[s].des+'</p></div></a></div>'
                    );
                }
                $(window).unbind('scroll',ee).bind('scroll',ee);llr=1;
            }
            
        },'json')
    }
    var aid = 0,llr=0,ee = function(){
        var timeline = $('.anli-block:last').attr('data-ctime');
        if(llr)if($(document).height()-$(document).scrollTop()-$(window).height()<300)getlist(aid,timeline)
    };
    $(function(){
        $('.subnav li a').click(function(){
            var z = $(this),id = $(this).attr('data-tid');
            if(z.hasClass('active'))return;
            $('.subnav li a').removeClass('active');
            z.addClass('active');
            $('.subsubnav a').removeClass('active');
            $('.subsubnav').slideUp();
            $('.subsubnav.subsubnav_'+id).slideDown();
            aid = id;$('.anli .row').empty();
            getlist(id)
            //code
        });
        $('.subsubnav li a').click(function(){
            var z = $(this),id = $(this).attr('data-tid');
            if(z.hasClass('active'))return;
            $('.subsubnav li a').removeClass('active');
            z.addClass('active');
            aid = id;$('.anli .row').empty();
            getlist(id)
            //code
        });

        $('.subnav_all').click();
        
        
	    
        

    });
    



}()