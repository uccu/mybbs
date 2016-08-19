$(function(){
    $('.z-pic-d').bind('click',function(){
        if($(this).hasClass('active'))return;
        $('.pic-block,.pict-block').removeClass('active');
        var tt = $('.pic-block').eq($(this).index());
        var al = $('.picList').offset().left;
        var tl = tt.offset().left;
        var tw = tt.width();
        var ww = 1200;
        var z = ww/2-(tl-al)-tw/2;
        $('.picList').css('left',z);
        tt.addClass('active');
        $('.pict-block').eq($(this).index()).addClass('active');
        //console.log(z)
    });
    $('.z-pic-d').eq(0).click();
})