$( document ).ready(function() {
    $('#eventSearch select[name="category"]').change(function() {
        this.form.submit();
    });

    // Smooth scrolling when clicking links with smooth-scroll class (requires jquery.easing plugin)
    $('a.smooth-scroll').bind('click', function(event) {
        console.log('bla');
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});
