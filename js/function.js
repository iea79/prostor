/*!
 *
 * Evgeniy Ivanov - 2018
 * busforward@gmail.com
 * Skype: ivanov_ea
 *
 */

var app = {
    pageScroll: '',
    lgWidth: 1200,
    mdWidth: 992,
    smWidth: 768,
    resized: false,
    iOS: function() { return navigator.userAgent.match(/iPhone|iPad|iPod/i); },
    touchDevice: function() { return navigator.userAgent.match(/iPhone|iPad|iPod|Android|BlackBerry|Opera Mini|IEMobile/i); }
};

function isLgWidth() { return $(window).width() >= app.lgWidth; } // >= 1200
function isMdWidth() { return $(window).width() >= app.mdWidth && $(window).width() < app.lgWidth; } //  >= 992 && < 1200
function isSmWidth() { return $(window).width() >= app.smWidth && $(window).width() < app.mdWidth; } // >= 768 && < 992
function isXsWidth() { return $(window).width() < app.smWidth; } // < 768
function isIOS() { return app.iOS(); } // for iPhone iPad iPod
function isTouch() { return app.touchDevice(); } // for touch device


$(document).ready(function() {
    // Хак для клика по ссылке на iOS
    if (isIOS()) {
        $(function(){$(document).on('touchend', 'a', $.noop)});
    }

	// Запрет "отскока" страницы при клике по пустой ссылке с href="#"
	$('[href="#"]').click(function(event) {
		event.preventDefault();
	});

    $('.mainSlider').slick({
        dots: true,
        arrows: false,
        autoplay: true,
        pauseOnHover: false,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    dots: false
                }
            },
        ]
        // autoplay: true,
    });

    $('.instaBox').slick({
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 8000,
        pauseOnHover: true,
    });

    // Inputmask.js
    // $('[name=tel]').inputmask("+9(999)999 99 99",{ showMaskOnHover: false });
    // formSubmit();

    checkOnResize();

    $('.popularCats__slider').slick({
        dots: false,
        infinite: true,
        arrows: true,
        nextArrow: $('.popularCats__next'),
        prevArrow: $('.popularCats__prev'),
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    $('.review__slider').slick({
        dots: false,
        infinite: false,
        arrows: true,
        nextArrow: $('.review__next'),
        prevArrow: $('.review__prev'),
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    adaptiveHeight: true,
                }
            },
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    adaptiveHeight: true,
                }
            }
        ]
    });

    $('.related.products').insertAfter('.productsPage__content').show();

    $('#order_comments_field').appendTo('.woocommerce-billing-fields__field-wrapper');
    $('.woocommerce-billing-fields .form-row-first').removeClass('form-row-first');


    try {
        $('.select, .shipping_method').select2({
            placeholder: $(this).data('placeholder'),
            minimumResultsForSearch: -1
        });
    } catch (e) {

    }

    $('[data-fancybox]').fancybox({
        padding : 0,
    });

    $('#usp_add-another').on('click', () => {
        let wrap = $('#user-submitted-image');
        setTimeout(function () {
            // alert('click');
            wrap.append('<label class="form__upload"></label>');
            let label = $('.form__upload').last();
            $('#user-submitted-image > .usp-clone').appendTo(label);
            $('#user-submitted-image > img').appendTo(label);
            label.append('<span class="btn btn_primary">Загрузить изображение</span>');
            $('.usp-js').insertAfter(label);
        }, 10);
    });

    $('.usp-images').on('change', '.usp-input', function() {
        $(this).parent().find('.btn').hide();
    });

    if (isXsWidth()) {
        $('body').on('click', '.bapf_head', () => {
            $('.bapf_body').toggleClass('open');
        });
    }

    $('.woocommerce-product-search').on('submit', () => {
        showLoader();
    });

    $('[href*="https://"]:not([target="_blank"]), [href*="http://"]:not([target="_blank"]), [href*="/shop"]').on('click', () => {
        showLoader();
    });

});

function showLoader() {
    $('body').append('<div class="page-loader"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');
}

function toggleHeaderSearch() {
    const open = $('.searchPopup__open'),
          hide = $('.searchPopup__close, .searchPopup__overlay'),
          field = $('.searchPopup .search-field'),
          wrap = $('.searchPopup');
    open.on('click', () => {
        wrap.addClass('open');
        field.focus();
    });
    hide.on('click', () => {
        wrap.removeClass('open');
    });
}
toggleHeaderSearch();

$(window).resize(function() {
    var windowWidth = $(window).width();
    // Запрещаем выполнение скриптов при смене только высоты вьюпорта (фикс для скролла в IOS и Android >=v.5)
    if (app.resized == windowWidth) { return; }
    app.resized = windowWidth;

	checkOnResize();
});

function checkOnResize() {
    // fontResize();
    initVideoSliderInPage();
    replaceFilterInLoop();
    initPopularProductSlider();
}

function replaceFilterInLoop() {
    const filter = $('.berocket_single_filter_widget'),
          widgetArea = $('.widget-area')
          prodBody = $('.productsPage__body');
    if (isXsWidth()) {
        filter.prependTo(prodBody);
    } else {
        filter.prependTo(widgetArea);
    }
}

function getInstaData() {
    try {
        // $.instagramFeed({
        //     'username': 'pro_brp',
        //     'container': "#instaBox",
        //     'display_profile': false,
        //     'display_biography': false,
        //     'display_gallery': true,
        //     'display_captions': true,
        //     'max_tries': 8,
        //     'callback': null,
        //     'styling': true,
        //     'items': 8,
        //     'items_per_row': 4,
        //     'margin': 1,
        //     'lazy_load': true,
        //     // 'on_error': console.error
        // });
        // let token = 'IGQVJYTDA5R2FNVE41UXdlN3puUFg5aFh0NDJSbHQ1RGg0b2VDQlBodk83c3Q3Y3dJQjZAxYk5XQnJXd2NRZAEJSbDQ2UGNIdVRNMldJbmhZAMEMwWXB1bVZADR2pxUGdpdFlrQ3ZAPN0dfQXNWamVjRDlmTgZDZD',
        //     userName = 'pro_brp';

        // fetch(`https://graph.instagram.com/${userName}?fields=id,username&access_token=${token}`)
        //     .then(value => {return value.json()})
        //     .then(json => {});
        $.getJSON('/wp-content/themes/prostor/get-insta.php', {mode: 'no-cors'}, function(json, textStatus) {
                console.log(json);
        });

        // const inst = fetch(`https://www.instagram.com/pro_brp/?__a=1`, { mode: 'no-cors'});
        //
        // console.log(inst.json());

    } catch (e) {

    }

}
getInstaData();

function initPopularProductSlider() {
    if (isXsWidth()) {
        $('.popularLine .products:not(.slick-initialized)').slick({
            dots: false,
            infinite: false,
            arrows: true,
            nextArrow: $('.products__next'),
            prevArrow: $('.products__prev'),
            slidesToShow: 2,
            slidesToScroll: 2,
            responsive: [
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });

    } else {
        $('.popularLine .products.slick-initialized').slick('destroy');
    }
}

function initVideoSliderInPage() {
    if (isXsWidth()) {
        $('.archive .videoLine__row:not(.slick-initialized), .home .videoLine__row:not(.slick-initialized)').slick({
            dots: false,
            infinite: false,
            arrows: true,
            nextArrow: $('.videoLine__next'),
            prevArrow: $('.videoLine__prev'),
            slidesToShow: 2,
            slidesToScroll: 2,
            responsive: [
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    } else {
        $('.home .videoLine__row.slick-initialized, .archive .videoLine__row.slick-initialized').slick('destroy');
    }
}

function quantityProducts() {
    let minus = ".quantity__wrapper .icon_minus",
        plus = ".quantity__wrapper .icon_plus",
        input = $(".quantity input");


    // minus.click(quantityMinus);
    // plus.click(quantityPlus);
    $('body').on('click', minus, function() {quantityMinus($(this))});
    $('body').on('click', plus, function() {quantityPlus($(this))});

    function quantityMinus(el) {
        input = $(el).closest(".quantity__wrapper").find("input");
        if (input.val() > 1) {
            input.val(+input.val() - 1);
            $('[name="update_cart"]').prop('disabled', false);
        }
    }

    function quantityPlus(el) {
        input = $(el).closest(".quantity__wrapper").find("input");
        input.val(+input.val() + 1);
        $('[name="update_cart"]').prop('disabled', false);
    }


}
quantityProducts();

// Stiky menu // Липкое меню. При прокрутке к элементу #header добавляется класс .stiky который и стилизуем
function stikyMenu() {
    let HeaderTop = $('header').offset().top + $('.home').innerHeight();
    let currentTop = $(window).scrollTop();

    setNavbarPosition();

    $(window).scroll(function(){
        setNavbarPosition();
    });

    function setNavbarPosition() {
        currentTop = $(window).scrollTop();

        if( currentTop > HeaderTop ) {
            $('header').addClass('stiky');
        } else {
            $('header').removeClass('stiky');
        }

        $('.navbar__link').each(function(index, el) {
            let section = $(this).attr('href');

            if ($('section').is(section)) {
                let offset = $(section).offset().top;

                if (offset <= currentTop && offset + $(section).innerHeight() > currentTop) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            }
        });
    }
};

function openMobileNav() {
    $('.menu__toggle').on('click', function() {
        var wrapp = $('.nav');

        wrapp.toggleClass('open');
        $(this).toggleClass('active');
        $('body').toggleClass('modal-open');
    });
};
openMobileNav();

// Scroll to ID // Плавный скролл к элементу при нажатии на ссылку. В ссылке указываем ID элемента
function srollToId() {
    $('[data-scroll-to]').click( function(){
        var scroll_el = $(this).attr('href');
        if ($(scroll_el).length != 0) {
            $('html, body').animate({ scrollTop: $(scroll_el).offset().top }, 500);
        }
        return false;
    });
}

function showMoreReview() {
    const btn = $('.reviewPage__more'),
          itemCount = 2;


    btn.on('click', () => {
        let offset = 0;
        $('.review__item').each(function(index, el) {
            if ($(el).hasClass('hidden')) {
                if (offset > 1) {
                    return;
                } else {
                    offset++;
                    $(el).removeClass('hidden');
                }
            }
        });

        if (!$('.review__item').last().hasClass('hidden')) {
            btn.hide();
        }
    });

}

showMoreReview();

// Проверка направления прокрутки вверх/вниз
function checkDirectionScroll() {
    var tempScrollTop, currentScrollTop = 0;

    $(window).scroll(function(){
        currentScrollTop = $(window).scrollTop();

        if (tempScrollTop < currentScrollTop ) {
            app.pageScroll = "down";
        } else if (tempScrollTop > currentScrollTop ) {
            app.pageScroll = "up";
        }
        tempScrollTop = currentScrollTop;

    });
}
checkDirectionScroll();

// Видео youtube для страницы
function uploadYoutubeVideo() {
    if ($(".js-youtube")) {

        $(".js-youtube").each(function () {
            // Зная идентификатор видео на YouTube, легко можно найти его миниатюру
            $(this).css('background-image', 'url(http://i.ytimg.com/vi/' + this.id + '/sddefault.jpg)');

            // Добавляем иконку Play поверх миниатюры, чтобы было похоже на видеоплеер
            // $(this).append($('<img src="img/play.svg" alt="Play" class="video__play">'));

        });

        $('.video__play, .video__prev').on('click', function () {
            // создаем iframe со включенной опцией autoplay
            let wrapp = $(this).closest('.js-youtube'),
                videoId = wrapp.attr('id'),
                iframe_url = "https://www.youtube.com/embed/" + videoId + "?autoplay=1&autohide=1";

            if ($(this).data('params')) iframe_url += '&' + $(this).data('params');

            // Высота и ширина iframe должны быть такими же, как и у родительского блока
            let iframe = $('<iframe/>', {
                'frameborder': '0',
                'src': iframe_url,
                'allow': "autoplay"
            })

            // Заменяем миниатюру HTML5 плеером с YouTube
            $(this).closest('.video__wrapper').append(iframe);

        });
    }
};

uploadYoutubeVideo();

function sortProducts() {
    let wrap = $('.productsSort'),
        current = $('.productsSort__current'),
        item = $('.productsSort__link');

    item.each(function(i, el) {
        if ($(this).attr('selected')) {
            console.log($(el).html());
            current
                .html($(el).html())
                .addClass($(el).attr('class'))
                .removeClass('productsSort__link');

        }
    });
}

sortProducts();


// Деление чисел на разряды Например из строки 10000 получаем 10 000
// Использование: thousandSeparator(1000) или используем переменную.
// function thousandSeparator(str) {
//     var parts = (str + '').split('.'),
//         main = parts[0],
//         len = main.length,
//         output = '',
//         i = len - 1;

//     while(i >= 0) {
//         output = main.charAt(i) + output;
//         if ((len - i) % 3 === 0 && i > 0) {
//             output = ' ' + output;
//         }
//         --i;
//     }

//     if (parts.length > 1) {
//         output += '.' + parts[1];
//     }
//     return output;
// };


// Хак для яндекс карт втавленных через iframe
// Страуктура:
//<div class="map__wrap" id="map-wrap">
//  <iframe style="pointer-events: none;" src="https://yandex.ru/map-widget/v1/-/CBqXzGXSOB" width="1083" height="707" frameborder="0" allowfullscreen="true"></iframe>
//</div>
// Обязательное свойство в style которое и переключет скрипт
// document.addEventListener('click', function(e) {
//     var map = document.querySelector('#map-wrap iframe')
//     if(e.target.id === 'map-wrap') {
//         map.style.pointerEvents = 'all'
//     } else {
//         map.style.pointerEvents = 'none'
//     }
// })

// Простая проверка форм на заполненность и отправка аяксом
// function formSubmit() {
//     $("[type=submit]").on('click', function (e){
//         e.preventDefault();
//         var form = $(this).closest('.form');
//         var url = form.attr('action');
//         var form_data = form.serialize();
//         var field = form.find('[required]');
//         // console.log(form_data);

//         empty = 0;

//         field.each(function() {
//             if ($(this).val() == "") {
//                 $(this).addClass('invalid');
//                 // return false;
//                 empty++;
//             } else {
//                 $(this).removeClass('invalid');
//                 $(this).addClass('valid');
//             }
//         });

//         // console.log(empty);

//         if (empty > 0) {
//             return false;
//         } else {
//             $.ajax({
//                 url: url,
//                 type: "POST",
//                 dataType: "html",
//                 data: form_data,
//                 success: function (response) {
//                     // $('#success').modal('show');
//                     // console.log('success');
//                     console.log(response);
//                     // console.log(data);
//                     // document.location.href = "success.html";
//                 },
//                 error: function (response) {
//                     // $('#success').modal('show');
//                     // console.log('error');
//                     console.log(response);
//                 }
//             });
//         }

//     });

//     $('[required]').on('blur', function() {
//         if ($(this).val() != '') {
//             $(this).removeClass('invalid');
//         }
//     });

//     $('.form__privacy input').on('change', function(event) {
//         event.preventDefault();
//         var btn = $(this).closest('.form').find('.btn');
//         if ($(this).prop('checked')) {
//             btn.removeAttr('disabled');
//             // console.log('checked');
//         } else {
//             btn.attr('disabled', true);
//         }
//     });
// }


// Проверка на возможность ввода только русских букв, цифр, тире и пробелов
// $('#u_l_name').on('keypress keyup', function () {
//     var that = this;
//
//     setTimeout(function () {
//         if (that.value.match(/[ -]/) && that.value.length == 1) {
//             that.value = '';
//         }
//
//         if (that.value.match(/-+/g)) {
//             that.value = that.value.replace(/-+/g, '-');
//         }
//
//         if (that.value.match(/ +/g)) {
//             that.value = that.value.replace(/ +/g, ' ');
//         }
//
//         var res = /[^а-яА-Я -]/g.exec(that.value);
//
//         if (res) {
//             removeErrorMsg('#u_l_name');
//             $('#u_l_name').after('<div class="j-required-error b-check__errors">Измените язык ввода на русский</div>');
//         }
//         else {
//             removeErrorMsg('#u_l_name');
//         }
//
//         that.value = that.value.replace(res, '');
//     }, 0);
// });
