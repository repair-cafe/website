$( document ).ready(function() {
    $('#eventSearch select[name="category"]').change(function() {
        this.form.submit();
    });

    // Smooth scrolling when clicking links with smooth-scroll class
    $('a.smooth-scroll').bind('click', function(event) {
        event.preventDefault();

        var $anchor = $(this);
        smoothScroll($($anchor.attr('href')));
    });

    // Close the anchor-navigation on item click
    $('#anchorNavigationCollapse ul li a').click(function(event) {
        var toggler = $('.anchor-navigation-toggler:visible');
        var $anchor = $(this);
        // if toggler is visible (= small screens)
        if(toggler.length > 0) {
            // close navigation
            toggler.click();
            // wait till navigation is closed before scrolling to avoid offset errors
            $('#anchorNavigationCollapse').one('hidden.bs.collapse', function () {
                smoothScroll($($anchor.attr('href')));
            });
        } else {
            smoothScroll($($anchor.attr('href')));
        }
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

    function smoothScroll(target) {
        var offsetTop = target.offset().top;

        if ('scrollBehavior' in document.documentElement.style) {
            window.scrollTo({
                left: 0,
                top: offsetTop,
                behavior: 'smooth',
            });
        } else {
            window.scrollTo(0, offsetTop);
        }
    }
});
