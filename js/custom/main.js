jQuery(document).ready(function ($) {

    $('.nav-primary > ul > li').doubleTapToGo();

    // Responsive iframes
    function responsiveIframe() {
        $('iframe').each(function () {
            var iw = $(this).width();
            var ih = $(this).height();
            var ip = $(this).parent().width();
            var ipw = ip / iw;
            var ipwh = Math.round(ih * ipw);
            $(this).css({
                'width': ip,
                'height': ipwh
            });
        });
    }

    responsiveIframe();

    // Trigger video resize if browser is resized
    $(window).resize(function () {
        responsiveIframe();
    });

    // Watch body height to see if font size settings are changed
    var watch_el = $('body');
    var el_height = watch_el.innerHeight();

    window.setInterval(function () {
        var new_height = watch_el.innerHeight();
        if (new_height != el_height) {
            el_height = new_height;
            responsiveIframe();
        }
    }, 200);

     $(window).on("scroll", function() {
         var fromTop = $(window).scrollTop();
         $("body").toggleClass("down", (fromTop > 400));
     });

     $('#menu-item-13').find('a').on('click', function(e) {
        e.preventDefault();
        $('.nav-primary-team').toggle();
        $(this).unbind('click');

     });
     var $menuItem = $('.nav-primary-team ul li')
     
     if ( $menuItem.hasClass('current-menu-item') ) {
        $('.nav-primary-team').toggle();
     }

     //Pagination
     function pagination() {
        $('.page-numbers').not('.next, .prev').click(function(e) {
            e.preventDefault();
            var val = $(this).text();
            $('#pagival').val(val);
            $('#filterform').submit();
            $('html,body').animate({scrollTop:$('#filterform').offset().top}, 500);
        });

        $('.next, .prev').click(function(e) {
            e.preventDefault();
            var pagival = $('#pagival');
            var pagifinal = pagival.val();
            if( $(this).hasClass('next') ) {
                var pagiresult = parseInt(pagifinal) + 1;
                pagival.val(pagiresult);
            }
            else if( $(this).hasClass('prev') ) {
                var pagiresult = parseInt(pagifinal) - 1;
                pagival.val(pagiresult);
            }

            $('#filterform').submit();
            $('html,body').animate({scrollTop:$('#filterform').offset().top}, 500);
        });
    }

    //Start business ajax filter
    function ws_filter_ajx() {
        var filter = $('#filterform');
        if( filter ) {
            $.ajax({
                url:filter.attr('action'),
                data:filter.serialize(), // form data
                type:filter.attr('method'), // POST
                cache: false,
                beforeSend: function() {
                    $('.loader').show();
                },
                complete: function(){
                    $('.loader').hide();
                },
                success:function(data){
                    $('#result').html(data);
                    pagination();
                },
                async: "false",
            });
        }

    }

    $('#filterform').submit(function(){
      ws_filter_ajx();
      return false;
    });

    $('#filterform input[type="submit"]').click(function(e) {
      $('#pagival').val('1');
    }); 

    pagination();

    $("#address").geocomplete({
        details: "form",
        types: ["geocode", "establishment"],
    }).keyup(function(){
        if( $(this).val().length === 0 ) {
            $('.hidden').val('');
        }
    });
     
});

(function (window, $, undefined) {
    'use strict';

    $('nav').before('<button class="menu-toggle" role="button" aria-pressed="false"></button>'); // Add toggles to menus
    $('.sub-menu').before('<button class="sub-menu-toggle" role="button" aria-pressed="false"></button>'); // Add toggles to sub menus

    // Show/hide the navigation
    $('.menu-toggle, .sub-menu-toggle').on('click', function () {
        var $this = $(this);
        $this.attr('aria-pressed', function (index, value) {
            return 'false' === value ? 'true' : 'false';
        });

        $this.toggleClass('activated');
        $this.next('nav, .sub-menu').slideToggle('fast');

    });

})(this, jQuery);

/*
 By Osvaldas Valutis, www.osvaldas.info
 Available for use under the MIT License
 */


(function ($, window, document, undefined) {
    $.fn.doubleTapToGo = function (params) {
        if (!( 'ontouchstart' in window ) && !navigator.msMaxTouchPoints && !navigator.userAgent.toLowerCase().match(/windows phone os 7/i)) return false;

        this.each(function () {
            var curItem = false;

            $(this).on('click', function (e) {
                var item = $(this);
                if (item[0] != curItem[0]) {
                    e.preventDefault();
                    curItem = item;
                }
            });

            $(document).on('click touchstart MSPointerDown', function (e) {
                var resetItem = true,
                    parents = $(e.target).parents();

                for (var i = 0; i < parents.length; i++)
                    if (parents[i] == curItem[0])
                        resetItem = false;

                if (resetItem)
                    curItem = false;
            });
        });
        return this;
    };
})(jQuery, window, document);

(function($) {
    $(document).ready(function(){
        $(window).scroll(function(){
            if ($(this).scrollTop() > 200) {
                $('.scroll-menu').addClass('scrolled');
            } else {
                $('.scroll-menu').removeClass('scrolled');
            }
        });
    });
})(jQuery);