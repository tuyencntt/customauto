( function( $ ) {

    "use strict";

    $( document ).ready( function () {

        if ($('.customerssay').length > 0) {

            $('.customerssay').autoshowroom_owlCarousel({
                loop: true,
                center: true,
                margin: 30,
                responsiveClass: true,
                autoplay: false,
                dots: true,
                stagePadding: 100,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1,
                        nav: false
                    },
                    768: {
                        items: 1,
                        nav: false
                    },
                    992: {
                        items: 2,
                        nav: false
                    },
                    1200: {
                        items: 2,
                        nav: false
                    },
                    1366: {
                        items: 3,
                        nav: false
                    },
                    1900: {
                        items: 4,
                        nav: false
                    }
                }
            })
        }

    });
} )( jQuery );
