/* gallery */
$('.gallery-row').magnificPopup({
    delegate: 'a',
    type: 'image',
    gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0, 1]
    },

    callbacks: {

        elementParse: function (item) {
            if (item.el[0].className == 'video') {

                item.type = 'iframe',
                    item.iframe = {
                        markup: '<div class="mfp-iframe-scaler">' +
                            '<div class="mfp-close"></div>' +
                            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                            '<div class="mfp-title">Some caption</div>' +
                            '</div>',
                        patterns: {
                            youtube: {
                                index: 'youtube.com/',
                                id: 'v=',
                                src: '//www.youtube.com/embed/%id%?autoplay=1'
                            },
                            vimeo: {
                                index: 'vimeo.com/',
                                id: '/',
                                src: '//player.vimeo.com/video/%id%?autoplay=1'
                            },
                            gmaps: {
                                index: '//maps.google.',
                                src: '%id%&output=embed'
                            }
                        },

                    },
                    item.srcAction = 'iframe_src'

                //console.log(item.el[0].title);
            } else {
                item.type = 'image',
                    item.tLoading = 'Loading image #%curr%...',
                    item.mainClass = 'mfp-img-mobile',
                    item.image = {
                        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                        titleSrc: function (item) {

                            return item.el[0].title + '<small>by Marsel Van Oosten</small>';
                        }
                    }
            }
        }

    }
});

$('.home-works').magnificPopup({
    delegate: 'a',
    type: 'image',
    gallery:{enabled:true},
    image: {
        titleSrc: function(item) {
            return item.el.parents('.app-carousel__item').find('.works-item__title').html();
        }
    }
});

