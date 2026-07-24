"use strict";

// Always hide spinner, even if jQuery/CDN scripts fail to load.
(function () {
    var hideSpinner = function () {
        var spinner = document.getElementById('spinner');
        if (spinner) {
            spinner.classList.remove('show');
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', hideSpinner);
    } else {
        hideSpinner();
    }
})();

if (window.jQuery) {
    (function ($) {
        // Initiate wowjs if available
        if (typeof WOW !== 'undefined') {
            new WOW().init();
        }

        // Sticky Navbar
        $(window).scroll(function () {
            if ($(this).scrollTop() > 45) {
                $('.navbar').addClass('sticky-top shadow-sm');
            } else {
                $('.navbar').removeClass('sticky-top shadow-sm');
            }
        });

        // Back to top button
        $(window).scroll(function () {
            var nearBottom = ($(window).scrollTop() + $(window).height()) > ($(document).height() - 80);

            if ($(this).scrollTop() > 300 && !nearBottom) {
                $('.back-to-top').fadeIn('slow');
            } else {
                $('.back-to-top').fadeOut('slow');
            }
        });

        $('.back-to-top').click(function () {
            $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
            return false;
        });
    })(window.jQuery);
}
