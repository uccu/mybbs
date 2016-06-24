var setNav = function(a){
    j('.nav_z_left_2').addClass('nav_z_left_3').removeClass('nav_z_left_2');
    j('.nav_z_left_3').eq(a).addClass('nav_z_left_2').removeClass('nav_z_left_3');
};
j(function(){if(j('header').length)setNav(parseInt(j('header').attr('nav')));});


