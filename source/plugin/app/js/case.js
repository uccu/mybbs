!function(){
    function getMore(){
        $('body').height()-$('body').scrollTop()-$(window).height()
    }
    $(function(){
        $('.subnav li a').click(function(){
            var z = $(this),id = $(this).attr('data-tid');
            if(z.hasClass('active'))return;
            $('.subnav li a').removeClass('active');
            z.addClass('active');
            $('.subsubnav a').removeClass('active');
            $('.subsubnav').slideUp();
            $('.subsubnav.subsubnav_'+id).slideDown();

            //code
        });
        $('.subsubnav li a').click(function(){
            var z = $(this),id = $(this).attr('data-tid');
            if(z.hasClass('active'))return;
            $('.subsubnav li a').removeClass('active');
            z.addClass('active');

            //code
        });

        $('.subnav_all').click();
        



    });
    



}()