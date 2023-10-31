!(function($) {
    "use strict";

    // Smooth scroll for the navigation menu and links with .scrollto classes
    var scrolltoOffset = $('#header').outerHeight() - 1;
    $(document).on('click', '.nav-menu a, .mobile-nav a, .scrollto', function(e) {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            if (target.length) {
                e.preventDefault();

                var scrollto = target.offset().top - scrolltoOffset;

                if ($(this).attr("href") == '#header') {
                    scrollto = 0;
                }

                $('html, body').animate({
                    scrollTop: scrollto
                }, 1500, 'easeInOutExpo');

                if ($(this).parents('.nav-menu, .mobile-nav').length) {
                    $('.nav-menu .active, .mobile-nav .active').removeClass('active');
                    $(this).closest('li').addClass('active');
                }

                if ($('body').hasClass('mobile-nav-active')) {
                    $('body').removeClass('mobile-nav-active');
                    
                    $('.mobile-nav-overly').fadeOut();
                }
                return false;
            }
        }
    });

    // Activate navigation on current page
    // $(document).ready(function() {
    //     var currentUrl = window.location.href;

    //     $('#header nav li > a').each(function() {
    //         var linkUrl = this.href;

    //         if (linkUrl == currentUrl) {
    //             // $(this).remove();
    //             $(this).closest('li').addClass('active');
    //         }
    //     });
    // });

    // Activate navigation on current page
    $(document).ready(function() {
        if (!window.location.origin){
            // For IE
            window.location.origin = window.location.protocol + "//" + (window.location.port ? ':' + window.location.port : '');      
        }

        if (window.location.protocol.indexOf('https') == 0){
            var el = document.createElement('meta');
                el.setAttribute('http-equiv', 'Content-Security-Policy');
                el.setAttribute('content', 'upgrade-insecure-requests');
                document.head.append(el);
        }

        var currentUrl = window.location.origin + window.location.pathname,
            newCurrentUrl = currentUrl.split("/").splice(0, 5).join("/");

            $('#header nav li > a').each(function() {
            var linkUrl = this.href;

            if (linkUrl == newCurrentUrl) {
                $(this).closest('li').addClass('active');
            }
        });
    });

    // Activate smooth scroll on page load with hash links in the url
    $(document).ready(function() {
        if (window.location.hash) {
            var initial_nav = window.location.hash;
            if ($(initial_nav).length) {
                var scrollto = $(initial_nav).offset().top - scrolltoOffset;
                $('html, body').animate({
                    scrollTop: scrollto
                }, 1500, 'easeInOutExpo');
            }
        }
    });

    // Mobile Navigation
    if ($('.nav-menu').length) {
        var $mobile_nav = $('.nav-menu').clone().prop({
            class: 'mobile-nav d-lg-none'
        });

        $('body').append($mobile_nav);
        $('#header .container').append('<button type="button" class="mobile-nav-toggle d-lg-none"><i class="fa fa-bars"></i></button>');
        $('body').append('<div class="mobile-nav-overly"></div>');

        $(document).on('click', '.mobile-nav-toggle', function(e) {
            $('body').toggleClass('mobile-nav-active');
            $('.mobile-nav-overly').toggle();
        });

        $(document).on('click', '.mobile-nav .drop-down > a', function(e) {
            e.preventDefault();
            $(this).next().slideToggle(300);
            $(this).parent().toggleClass('active');
        });

        $(document).on('click', '.mobile-nav-close', function(e) {
            if ($('body').hasClass('mobile-nav-active')) {
                $('body').removeClass('mobile-nav-active');
                $('.mobile-nav-overly').fadeOut();
            }
        });

        $(document).click(function(e) {
            var container = $(".mobile-nav, .mobile-nav-toggle");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if ($('body').hasClass('mobile-nav-active')) {
                    $('body').removeClass('mobile-nav-active');
                    $('.mobile-nav-overly').fadeOut();
                }
            }
        });
    } else if ($(".mobile-nav, .mobile-nav-toggle").length) {
        $(".mobile-nav, .mobile-nav-toggle").hide();
    }

    // Toggle .header-scrolled class to #header when page is scrolled
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#header').addClass('header-scrolled');
            $('#topbar').addClass('topbar-scrolled');
            $('nav.mobile-nav').addClass('scrolled');
        } else {
            $('#header').removeClass('header-scrolled');
            $('#topbar').removeClass('topbar-scrolled');
            $('nav.mobile-nav').removeClass('scrolled');
        }
    });

    if ($(window).scrollTop() > 100) {
        $('#header').addClass('header-scrolled');
        $('#topbar').addClass('topbar-scrolled');
        $('nav.mobile-nav').addClass('scrolled');
    }

    // Back to top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });

    $('.back-to-top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 1500, 'easeInOutExpo');
        return false;
    });

    // initialize select2
    if ($.isFunction($.fn.select2)) {
        $('.select2').select2({
            width: '100%',
            theme: 'bootstrap4',
        });
    }

    // enable numeric only
    $('.numeric').on('keyup', function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    // initialize datepicker
    if ($.isFunction($.fn.datepicker)) {
        $('.date').datepicker({
            'format' : 'yyyy-mm-dd',
            'autoclose' : true,
            'minView' : 2,
            'weekStart' : 1,
            'language' : 'en',
            //'startDate' : '',
            //'endDate' : '{{ date("Y-m-d") }}',
            'todayHighlight': true,
        });
    }

    // initialize venobox
    if ($.isFunction($.fn.venobox)) {
        $('.venobox').venobox();
    }

    // initialize matchheight
    if ($.isFunction($.fn.matchHeight)) {
        $('.match-height').matchHeight();
    }

    // autofocus on modal show
    $('.modal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });

    // custom ci3 pagination to bootstrap 4
    $('ul.pagination-ci3-bs4 > li').find('a, span').addClass('page-link');
})(jQuery);