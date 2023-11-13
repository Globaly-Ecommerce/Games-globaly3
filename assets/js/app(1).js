// Template Name: Visuals
// Template URL: https://techpedia.co.uk/template/visuals
// Description: Visual Entertainment Streaming And Blog
// Version: 1.0.0
(function (window, document, $, undefined) {
  "use strict";
  var Init = {
    i: function (e) {
      Init.s();
      Init.methods();
    },
    s: function (e) {
      (this._window = $(window)),
        (this._document = $(document)),
        (this._body = $("body")),
        (this._html = $("html"));
    },
    methods: function (e) {
      Init.w();
      Init.BackToTop();
      Init.preloader();
      Init.animation();
      Init.hamburgerMenu();
      Init.intializeSlick();
      Init.formValidation();
      Init.continueEmail();
      Init.backToLogin();
      Init.videoPlay();
      Init.VideoPlayer();
      Init.VideoPlayerHeight();
      Init.countdownInit(".countdown", "2023/11/01");
      Init.searchInput();
    },
    w: function (e) {
      this._window.on("load", Init.l).on("scroll", Init.res);
    },
    BackToTop: function () {
      var btn = $("#backto-top");
      $(window).on("scroll", function () {
        if ($(window).scrollTop() > 300) {
          btn.addClass("show");
        } else {
          btn.removeClass("show");
        }
      });
      btn.on("click", function (e) {
        e.preventDefault();
        $("html, body").animate(
          {
            scrollTop: 0,
          },
          "300"
        );
      });
    },
    preloader: function () {
      setTimeout(function () { $('#preloader').hide('slow') }, 2000);
    },
    countdownInit: function (countdownSelector, countdownTime) {
      var eventCounter = $(countdownSelector);
      if (eventCounter.length) {
        eventCounter.countdown(countdownTime, function (e) {
          $(this).html(
            e.strftime(
              '<li>%D<span>Days</span></li>\
              <li>%H<span>Hrs</span></li>\
              <li>%M<span>Min</span></li>\
              <li class="m-0">%S<span>Sec</span></li>'
            )
          );
        });
      }
    },
    intializeSlick: function (e) {
      if ($(".full-page-slider").length) {
        $(".full-page-slider").slick({
          infinite: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          arrows: false,
          centerPadding: '0',
          autoplay: false,
          autoplaySpeed: 3000,
          responsive: [
            {
              breakpoint: 1480,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 1199,
              settings: {
                slidesToShow: 2,
              },
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
              },
            },
          ],
        });
      }
      if ($(".hero-banner-1").length) {
        $(".hero-banner-1").slick({
          slidesToShow: 1,
          slidesToScroll: 7,
          arrows: false,
          centerMode: false,
          infinite: true,
          swipeToSlide: true,
          draggable: true,
          touchThreshold: 10,
          variableWidth: true,
          responsive: [
            {
              breakpoint: 575,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                variableWidth: false,
              },
            },
          ],
        });
      }
      if ($(".hero-banner-slider-2").length) {
        $(".hero-banner-slider-2").slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          centerPadding: '0',
          centerMode: true,
          autoplay: true,
          cssEase: 'linear',
          fade: true,
          autoplaySpeed: 2000,
          infinite: true,
          swipeToSlide: true,
        });
      }
      if ($(".rated-slider").length) {
        $(".rated-slider").slick({
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: true,
          centerPadding: '12',
          centerMode: false,
          autoplay: true,
          cssEase: 'linear',
          autoplaySpeed: 2000,
          responsive: [
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 2,
              },
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
              },
            },
          ],
        });
      }
      if ($(".reviews-slider").length) {
        $(".reviews-slider").slick({
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          centerMode: false,
          autoplay: false,
          cssEase: 'linear',
          autoplaySpeed: 2000,
        });
      }
      if ($(".suggestion-slider").length) {
        $(".suggestion-slider").slick({
          infinite: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          arrows: true,
          centerPadding: '12',
          centerMode: true,
          autoplay: false,
          cssEase: 'linear',
          autoplaySpeed: 2000,
          responsive: [
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 2,
              },
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
              },
            },
            {
              breakpoint: 492,
              settings: {
                slidesToShow: 1,
              },
            },
          ],
        });
      }
      if ($(".movie-slider").length) {
        $(".movie-slider").slick({
          infinite: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          arrows: false,
          centerPadding: '30',
          centerMode: true,
          autoplay: true,
          cssEase: 'linear',
          autoplaySpeed: 2000,
          responsive: [
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              },
            },
            {
              breakpoint: 492,
              settings: {
                slidesToShow: 1,
              },
            },
          ],
        });
      }
    },
    animation: function () {
      $('.item').on('click', function () {
        $('.item').removeClass('active','slow');
        $(this).addClass('active','slow');
      })
      var hover = $('.animition-set');
      hover.mouseover(function(){
        var x = $(this).position();
        var display = $(this).attr('display-arial');
        if(display == 'false'){
          $(this).attr('display-arial','true');
          $('.manga-popup').css({
          opacity : 1,
          top: x.top, left: x.left,
          });
        }
      })
      hover.mousedown(function(){
        $(this).attr('display-arial','false');
        $('.manga-popup').css({
          opacity : 0,
        });
      })
    },
    hamburgerMenu: function () {
      if ($(".hamburger-menu").length) {
        $('.hamburger-menu').on('click', function() {
          $('.bar').toggleClass('animate');
          $('.mobile-navar').toggleClass('active');
          return false;
        })
        $('.has-children').on ('click', function() {
             $(this).children('ul').slideToggle('slow', 'swing');
             $('.icon-arrow').toggleClass('open');
        });
      }
    },
    VideoPlayerHeight: function () {
      if ($(".aks-vp-start").length) {
        $('.aks-vp-start').on('click', function () {
          $('.videoplayer').removeClass('col-lg-6');
          $('.videoplayer').addClass('col-lg-12','slow');
          $('.videoplayer').removeClass('no_variable_height');
          $('.videoplayer').addClass('variable_height','slow');
        })
      }
    },
    VideoPlayer: function () {
      if ($("#video").length) {
        $("#video").aksVideoPlayer({
          file: [
              {
              file: "assets/media/videos/video-1080.mp4",
              label: "1080p"
              },
              {
              file: "assets/media/videos/video-720.mp4",
              label: "720p"
              },
              {
              file: "assets/media/videos/video-540.mp4",
              label: "540p"
              },
              {
              file: "assets/media/videos/video-360.mp4",
              label: "360p"
              },
              {
              file: "assets/media/videos/video-240.mp4",
              label: "240p"
              }
          ],
          poster: "assets/media/thumbnail/detail/anime-trailer.png",
          forward: true,
        });
      }
    },
    videoPlay:function(){
      $('#videoModal').on('hidden.bs.modal', function () {
        $('#videoModal video').get(0).pause();
      });
      $("#closeVideoModalButton").click(function() {
        $("#videoModal").modal("hide");
      });
    },
    searchInput: function(){
      let inputBox = document.querySelector('.input-box'),
      closeIcon = document.querySelector('.close-icon');
      closeIcon.addEventListener('click', () => {
        inputBox.classList.remove('open');
      });
    },
    continueEmail: function () {
      $('#continue-email').on('click',function(){
        $('.hide-link').hide()
        $('.login-sec').show()
      })
    },
    backToLogin: function () {
      $('#backtologin').on('click',function(){
        $('.hide-form').hide()
        $('.hide-link').show()
      })
    },
    formValidation: function () {
      if ($(".contact-form").length) {
        $(".contact-form").validate();
      }
    },
  }
  Init.i();
})(window, document, jQuery);





