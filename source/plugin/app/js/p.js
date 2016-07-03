var setNav = function(a){
    j('.nav_z_left_2').addClass('nav_z_left_3').removeClass('nav_z_left_2');
    j('.nav_z_left_3').eq(a).addClass('nav_z_left_2').removeClass('nav_z_left_3');
};
j(function(){if(j('header').length)setNav(parseInt(j('header').attr('nav')));});
function show_alert(status,words,f){
    if(status==1){
        var d = '<div class="show_alert_box"><div><span>'+words+'</span></div></div>';
        j('body').append(d);
        j('.show_alert_box').animate({'opacity':1}).one('click',function(){
            j(this).fadeOut(function(){j(this).remove();if(f)f(this)})
        });
        setTimeout(function(){j('.show_alert_box').click()},1000);
    }else if(status==3){
        var d = '<div class="show_alert_box error"><div><span>'+words+'</span></div></div>';
        j('body').append(d);
        j('.show_alert_box').animate({'opacity':1}).one('click',function(){
            j(this).fadeOut(function(){j(this).remove();if(f)f(this)})
        });
        setTimeout(function(){j('.show_alert_box').click()},1000);
    }else if(status==2){
        var d = '<div class="show_alert_box"><div>'+'<div class="show_alert_body">'+
        '<div><h3 class="pr">'+words+'</h3></div>'+
        '<div class="pr" style="margin-top:30px;left: -35px;"><button class="cancel">取消</button><button class="yes">确定</button></div>'+
        '</div></div></div>';
        j('body').append(d);
        j('.show_alert_box').animate({'opacity':1}).find('.yes').one('click',function(){
            j('.show_alert_box').fadeOut(function(){j('.show_alert_box').remove();if(f)f(this)})
        });
        j('.show_alert_box .cancel').click(function(){j('.show_alert_box').fadeOut(function(){j('.show_alert_box').remove()})})
    }
}

