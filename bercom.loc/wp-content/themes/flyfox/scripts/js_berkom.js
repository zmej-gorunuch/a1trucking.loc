let front = {
    hamburger: $('.hamburger'),
    nav: $('.navbar'),
    header_drop: $('.header-drop'),
    btnFilter: $('.js-filter-btn'),
    wrapFilter: $('.js-filter-wrap'),
    slider_options_default: {
        wrapAround: true,
        pageDots: false,
        prevNextButtons: true,
        autoPlay: false,
        cellAlign: 'left',
        contain: true
    },

    init: function () {
        this.events();
        this.headerScroll();
    },

    newSlider: function (selector, options) {
        options = (options !== undefined) ? Object.assign({}, this.slider_options_default, options) : this.slider_options_default;
        return new Flickity(selector, options);
    },

    headerScroll: function () {
        if ($(window).scrollTop() > 5) {
            $('.header').addClass('fixed');
        } else {
            $('.header').removeClass('fixed');
        }
    },
    toggleFilter: function () {
        if (!this.btnFilter.hasClass('open')) {
            this.btnFilter.addClass("active");
            this.wrapFilter.toggleClass('open');
        } else {
            this.btnFilter.removeClass("active");
            this.wrapFilter.toggleClass('open');
        }
    },
    toggleNav: function () {

        if (!this.hamburger.hasClass('open')) {
            this.hamburger.addClass('open');
            this.nav.toggleClass('active');
            $("body").addClass('active');
        } else {
            this.hamburger.removeClass('open');
            this.nav.toggleClass('active');
            $("body").removeClass('active');
        }
    },
    navMouseOver: function () {
        $(".primary-navigation .menu > .menu-item-has-children").hover(function () {
            $("body").addClass('BackDropped');
        }, function () {
            $("body").removeClass('BackDropped');
        });
    },
    openTab: function (element, tabName, parent) {
        let i, tab_content, tab_links;

        tab_content = $(element).closest(parent).find('.tab-content');

        for (i = 0; i < tab_content.length; i++) {
            tab_content[i].style.display = "none";
        }

        tab_links = $(element).closest('.tabs-ul').find('.tab-links');

        for (i = 0; i < tab_links.length; i++) {
            //tab_links[i].className = tab_links[i].className.replace(" active", "");
            // console.log(tab_links[i].parentNode);
            tab_links[i].parentNode.classList.remove('current')
        }

        document.getElementById(tabName).style.display = "block";
        console.log($(element));
        $(element).parent().addClass('current');
    },
    inputFileHandler: function () {
        $cvFile = $('.file__input');

        $('.file__title').on('click', function (e) {
            if ($cvFile[0].value) {
                e.preventDefault();
                $cvFile[0].value = '';
                $('.file__title').html('');
                $cvFile.click();
            } else {
                $cvFile.click();
            }

        });
        $('.file__btn').on('click', function (e) {
            if ($cvFile[0].value) {
                e.preventDefault();
                $cvFile[0].value = '';
                $('.file__title').html('');
            } else {
                $cvFile.click();
            }

        });

        $cvFile.on('click', function (e) {

            if ($(this)[0].value) {
                e.preventDefault();
            } else {
                return;
            }
        });

        $cvFile.on('change', function (e) {
            $value = $(this)[0].value;
            $lastslashindex = $value.lastIndexOf('\\');
            $result = $value.substring($lastslashindex + 1);
            if ($result != '') {
                $('.file__title').html($result);
            }
        });
    },

    events: function () {
        let self = this;

        self.navMouseOver();
        $(window).on('scroll', function () {
            self.headerScroll();
        });

        $(document).on('click', '.hamburger', function () {
            self.toggleNav();
        });
        $(document).on('click', '.js-filter-btn', function () {
            self.toggleFilter();
        });
    }
};

let modal = {
    closeButton: $('.modal-content__close'),
    closeOverlay: $('.modal'),
    can: 1,
    init: function () {
        this.events();
    },
    openModal: function (id) {
        let modalWindow = $(id);
        modalWindow.fadeIn();
        modalWindow.find('.modal-content').removeClass('animate-away').addClass('animate-in');

        $('body, html').addClass('active');
    },

    closeModal: function (id) {
        let modalWindow = $(id);
        modalWindow.find('.modal-content').removeClass('animate-in').addClass('animate-away');
        modalWindow.fadeOut();
        $('body, html').removeClass('active');
    },

    events: function () {

        $(document).on('click', '.modalTrigger', function (e) {
            e.preventDefault();
            let self = $(this),
                target = self.attr('data-modal');
            modal.openModal(target);

        });

        $(document).on('click', '.modal', function (event) {
            let self = '#' + $(this).attr('id');
            if (event.target.className == 'modal-body') {
                modal.closeModal(self);
            }
        });

        $(document).on('click', '.modal-content__close', function () {
            let self = '#' + $(this).closest('.modal').attr('id');
            modal.closeModal(self);
        });
    }
};

jQuery(function () {
    front.init();
    modal.init();
    front.inputFileHandler();
});

$(function () {
    // $(".phone-mask").mask("+380 (99) 999-99-99");


    $(document).on("click", '.has-children > a', function (e) {
        e.preventDefault();
        if (!$(this).parent().find('.sub-menu').hasClass('open')) {
            $(this).parent().find('.sub-menu').addClass('open');
        } else {
            $(this).parent().find('.sub-menu').removeClass("open");
            //  $(this).parent().toggleClass('open');
        }
    });

    $(document).on("click", '.back-level', function (e) {
        if ($(this).parents('.sub-menu').hasClass('open')) {
            $(this).parents('.sub-menu').removeClass("open");
        }
    });
});