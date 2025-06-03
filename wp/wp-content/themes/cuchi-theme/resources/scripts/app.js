import domReady from '@roots/sage/client/dom-ready';

// jQuery (already included by Sage/WordPress)
import $ from 'jquery';

// jQuery UI (optional: you can import only what you need)
import 'jquery-ui/ui/widgets/datepicker';
import 'jquery-ui/themes/base/all.css'; // optional: include jQuery UI default styles

// Slick
import 'slick-carousel/slick/slick.min.js';
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';


import '../styles/main.css';

/**
 * Application entrypoint
 */
domReady(async () => {
  // DATEPICKER
  $('.datepicker')
    .datepicker({
      dateFormat: 'D, M d, yy',
      altField: function () {
        return $(this).next('.datepicker-alt');
      },
      altFormat: 'yy-mm-dd',
    })
    .datepicker('setDate', new Date());

  $('.datepicker').each(function () {
    const $input = $(this);
    const $icon = $input.siblings('.icon-updown');

    $input.on('focus', function () {
      $icon.addClass('icon-updown__open');
    });

    $input.on('blur', function () {
      setTimeout(() => {
        if (!$input.is(':focus')) {
          $icon.removeClass('icon-updown__open');
        }
      }, 100);
    });
  });

  // SLICK: https://kenwheeler.github.io/slick/
  $('.cucci-slick').slick({
    centerMode: true,
    centerPadding: '20%',
    prevArrow: $('.cucci-slick-prev'),
    nextArrow: $('.cucci-slick-next'),
    slidesToShow: 1,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 1,
        },
      },
    ],
  });
  $('.cucci-slick-2').slick({
    nextArrow: $('.cucci-slick-next'),
    slidesToShow: 1,
  });
  $('.cucci-slick-3').slick({
    prevArrow: $('.cucci-slick-3-prev'),
    nextArrow: $('.cucci-slick-3-next'),
    slidesToShow: 3,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: true,
          centerMode: true,
          slidesToShow: 1,
        },
      },
    ],
  });

  $('#header-more-button').on('click', function () {
    $('#header-more-button').toggleClass('hide');
    $('#header-drawer').toggleClass('show');
  });

  $('#header-close-button').on('click', function () {
    $('#header-more-button').toggleClass('hide');
    $('#header-drawer').toggleClass('show');
  });

  // VIDEO PLAYER
  const containers = document.querySelectorAll('.video-container');
  containers.forEach(container => {
    const video = container.querySelector('video');
    const playBtn = container.querySelector('.btn-play');
    playBtn.addEventListener('click', () => {
      if (video.paused) {
        video.play();
        playBtn.classList.add('hide'); // hide if you only want it hidden on play
      } else {
        video.pause();
        playBtn.classList.remove('hide'); // show again on pause
      }
    });

    video.addEventListener('pause', () => {
      playBtn.classList.remove('hide');
    });

    video.addEventListener('ended', () => {
      playBtn.classList.remove('hide');
    });
  });
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
