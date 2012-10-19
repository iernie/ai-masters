$(function() {
    $('.nav a[href^="#"]').click(function(e) {
        e.preventDefault();
        $('html,body').animate({ scrollTop: $(this.hash).offset().top}, 200);
        return false;
    });
});

$(document).ready(function(){
    $('.row').each(function() {
        $(this).css({
            'height': $(window).height(),
            'padding-top': $(window).height()/2-$('.row div').height()/2-50
        });
    });
});