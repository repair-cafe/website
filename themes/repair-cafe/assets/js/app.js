$( document ).ready(function() {
    $('#eventSearch select[name="category"]').change(function() {
        this.form.submit();
    });

    // Smooth scrolling when clicking links with smooth-scroll class (requires jquery.easing plugin)
    $('a.smooth-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

    // lazy load static map images on collapse show
    $('.additional-info.collapse').on('show.bs.collapse', function () {
        var eventId = $(this).data('eventId');
        var image = $('img[data-lazy-load-event-id=' + eventId + ']:not(.loaded)');
        var loadingSpinner = $('i.fa-spinner[data-lazy-load-event-id=' + eventId + ']');
        if(image.length > 0) {
            image.on('load', function() {
                image.addClass('loaded');
                if(loadingSpinner.length > 0) {
                    loadingSpinner.hide();
                }
            });
            image.attr('src', image.data('lazyLoadSrc'));
        }
    });
});
