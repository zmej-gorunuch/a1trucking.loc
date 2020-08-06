window.addEventListener("load", function () {
    $(".carousel").addClass("loadSlider");
});

jQuery(function () {

    /*products carousel start*/

    var carouselContainers = document.querySelectorAll('.story-carousel__wrap');

    for (var i = 0; i < carouselContainers.length; i++) {
        var container = carouselContainers[i];
        initCarouselContainer(container);
    }

    function initCarouselContainer(container) {
        var carousel = container.querySelector('.story-carousel');
        var flkty = front.newSlider(carousel, {
            cellAlign: 'left',
            contain: true,
            wrapAround: true,
            pageDots: false,
            prevNextButtons: false
        });

        var carouselBtnPrev = container.querySelector('.--prev');
        var carouselBtnNext = container.querySelector('.--next');
        $(carouselBtnPrev).on('click', function () {
            flkty.previous();
        });
        $(carouselBtnNext).on('click', function () {
            flkty.next();
        });

    };

    /*story carousel start*/

    var storyCarousel = document.querySelector('.story-carousel');
    if (storyCarousel !== null) {
        storyCarousel = front.newSlider('.story-carousel', {
            cellAlign: 'center',
            contain: true,
            pageDots: false,
            verticalCells: true,
            prevNextButtons: false
        });
        $('.carousel-arrow.--prev').on('click', function () {
            storyCarousel.previous();
        });

        $('.carousel-arrow.--next').on('click', function () {
            storyCarousel.next();
        });
    }

    /*post carousel start*/

    var postCarousel = document.querySelector('.post-carousel');
    if (postCarousel !== null) {
        postCarousel = front.newSlider('.post-carousel', {
            cellAlign: 'left',
            contain: true,
            pageDots: true,
            groupCells: true,
            prevNextButtons: false
        });
        $('.post-carousel__arrow.--prev').on('click', function () {
            postCarousel.previous();
        });

        $('.post-carousel__arrow.--next').on('click', function () {
            postCarousel.next();
        });
    }


    /*app sliders start*/
    var appCarouselContainers = document.querySelectorAll('.app-carousel__wrap');

    for (var i = 0; i < appCarouselContainers.length; i++) {
        var appContainer = appCarouselContainers[i];
        initAppCarouselContainer(appContainer);
    }

    function initAppCarouselContainer(appContainer) {
        var appCarousel = appContainer.querySelector('.app-carousel');
        var flkty = front.newSlider(appCarousel, {
            cellAlign: 'center',
            contain: true,
            wrapAround: true,
            pageDots: true,
            prevNextButtons: true
        });

        var appCarouselBtnPrev = appContainer.querySelector('.--prev');
        var appCarouselBtnNext = appContainer.querySelector('.--next');
        $(appCarouselBtnPrev).on('click', function () {
            flkty.previous();
        });
        $(appCarouselBtnNext).on('click', function () {
            flkty.next();
        });
    };
    /*app sliders end*/
});

