$(function() {
    var open = true;
    var windowSize = $(window)[0].innerWidth;

    var targetSizeMenu = (windowSize <= 400) ? 200 : 250;

    if (windowSize <= 768) {
        $('.menu').css('width','0');
        $('.menu').css('padding','0');
        open = false;
    }

    $('.menu-btn').click(function() {
        if(open) {
            $('.menu').animate({'width':'0','padding':'0'});
            $('.content,header').css('width','100%');
            $('.content,header').animate({'left':'0'});
            open = false;
        } else {
            $('.menu').css('display','block');
            $('.menu').animate({'width':targetSizeMenu+'px','padding':'10px 0px'});
            if(windowSize > 768) {
                $('.content,header').css('width','calc(100% - 250px)');
            }
            $('.content,header').animate({'left':targetSizeMenu+'px'});
            open = true;
        }
    });
})