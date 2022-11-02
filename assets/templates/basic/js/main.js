(function ($) {
  "user strict";

  // preloader
  $(".preloader").delay(800).animate({
    "opacity": "0"
  }, 800, function () {
      $(".preloader").css("display", "none");
  });

// wow
if ($('.wow').length) {
  var wow = new WOW({
    boxClass: 'wow',
    // animated element css class (default is wow)
    animateClass: 'animated',
    // animation css class (default is animated)
    offset: 0,
    // distance to the element when triggering the animation (default is 0)
    mobile: false,
    // trigger animations on mobile devices (default is true)
    live: true // act on asynchronously loaded content (default is true)
  });
  wow.init();
}

//Create Background Image
(function background() {
  let img = $('.bg_img');
  img.css('background-image', function () {
    var bg = ('url(' + $(this).data('background') + ')');
    return bg;
  });
})();


// header-fixed
var fixed_top = $(".header-section");
$(window).on("scroll", function(){
    if( $(window).scrollTop() > 100){  
        fixed_top.addClass("animated fadeInDown header-fixed");
    }
    else{
        fixed_top.removeClass("animated fadeInDown header-fixed");
    }
});

// navbar-click
$(".navbar li a").on("click", function () {
  var element = $(this).parent("li");
  if (element.hasClass("show")) {
    element.removeClass("show");
    element.find("li").removeClass("show");
  }
  else {
    element.addClass("show");
    element.siblings("li").removeClass("show");
    element.siblings("li").find("li").removeClass("show");
  }
});

// scroll-to-top
var ScrollTop = $(".scrollToTop");
$(window).on('scroll', function () {
  if ($(this).scrollTop() < 100) {
      ScrollTop.removeClass("active");
  } else {
      ScrollTop.addClass("active");
  }
});

// slider
var swiper = new Swiper('.news-banner-slider', {
  slidesPerView: 1,
  spaceBetween: 0,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  loop: true,
  autoplay: {
    speed: 1000,
    delay: 5000,
  },
  breakpoints: {
    991: {
      slidesPerView: 1,
    },
    767: {
      slidesPerView: 1,
    },
    575: {
      slidesPerView: 1,
    },
  } 
});

//search
$(document).on('click', '#top-search-trigger', function () {
  $('.search-form').toggleClass('show');
  $(this).toggleClass('active');
  $(this).hasClass('active') ? $(this).html(`<i class="las la-times"></i>`) : $(this).html(`<i class="las la-search"></i>`);
});

$(function () {
  var width = $(window).width();
  $marquee = $('.top-news-ticker-runner').marquee({
    speed: width < 400 ? 30 : 50,
    duplicated: true,
    pauseOnHover: true,
    gap: 0
  }).bind('paused', function () {
    $('.top-news-ticker .pause-btn .fa-pause').addClass('d-none').siblings().removeClass('d-none');
  }).bind('resumed', function () {
    $('.top-news-ticker .pause-btn .fa-play').addClass('d-none').siblings().removeClass('d-none');
  });
  $('.top-news-ticker .pause-btn').on('click', function () {
    $marquee.marquee('toggle');
  });
});

// footer-toggle
$('.footer-toggle').on('click', function (e) {
  var element = $(this).parent('.footer-wrapper');
  if (element.hasClass('open')) {
    element.removeClass('open');
    element.find('.footer-bottom-area').removeClass('open');
    element.find('.footer-bottom-area').slideUp(300, "swing");
  } else {
    element.addClass('open');
    element.children('.footer-bottom-area').slideDown(300, "swing");
    element.siblings('.footer-wrapper').children('.footer-bottom-area').slideUp(300, "swing");
    element.siblings('.footer-wrapper').removeClass('open');
    element.siblings('.footer-wrapper').find('.footer-toggle').removeClass('open');
    element.siblings('.footer-wrapper').find('.footer-bottom-area').slideUp(300, "swing");
  }
});


$('.header-bar').on('click', function() {
  $('.menu-area, .overlay, .header-bar').addClass('active')
})
$('.search-bar').on('click', function() {
  $('.search-form, .overlay').addClass('active')
})
$('.close-search').on('click', function() {
  $('.overlay, .search-form').removeClass('active')
})
$('.menu-close').on('click', function() {
  $('.overlay, .menu-area, .header-bar').removeClass('active')
})
$('.overlay').on('click', function(){
  $('.search-form, .overlay, .menu-area, .header-bar').removeClass('active')
})

$(".menu>li>.submenu").parent("li").addClass("menu-item-has-children");
$('.menu li a').on('click', function (e) {
  var element = $(this).parent('li');
  if (element.hasClass('open')) {
    element.removeClass('open');
    element.find('li').removeClass('open');
    element.find('ul').slideUp(300, "swing");
  } else {
    element.addClass('open');
    element.children('ul').slideDown(300, "swing");
    element.siblings('li').children('ul').slideUp(300, "swing");
    element.siblings('li').removeClass('open');
    element.siblings('li').find('li').removeClass('open');
    element.siblings('li').find('ul').slideUp(300, "swing");
  }
})

  

})(jQuery);