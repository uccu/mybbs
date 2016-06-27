var setNav = function(a){
    j('.nav_z_left_2').addClass('nav_z_left_3').removeClass('nav_z_left_2');
    j('.nav_z_left_3').eq(a).addClass('nav_z_left_2').removeClass('nav_z_left_3');
};
j(function(){if(j('header').length)setNav(parseInt(j('header').attr('nav')));});
function show_alert(status,words,f){
    var d = '<div class="show_alert_box"><div><span>'+words+'</span></div></div>';
    j('body').append(d);
    j('.show_alert_box').animate({'opacity':1}).one('click',function(){
        j(this).fadeOut(function(){j(this).remove();if(f)f(this)})
    })
}

