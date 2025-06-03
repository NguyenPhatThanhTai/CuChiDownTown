@php
  $title = get_theme_mod('highlighted_memories_title');
  $video_urls = get_theme_mod('video_urls');
  $videos = array_filter(array_map('trim', explode(',', $video_urls)));
@endphp

<section class="highlighted-moments-section">
  <h1 class="highlighted-moments-section__title">{{ $title }}</h1>
  <div class="highlighted-moments-section__slider">
    <div class="highlighted-moments-section__slick cucci-slick">
      @foreach ($videos as $video)
        <div class="highlighted-moments-section__item video-container">
          <video src="{{ $video }}" alt=""> </video><img class="btn-play" src="{{ asset('images/play.svg') }}" alt="play">
        </div>
      @endforeach
    </div>
    <div class="highlighted-moments-section__navigation"> <img class="highlighted-moments-section__navigation__prev cucci-slick-prev" src="{{ asset('images/arrow-prev.svg') }}" alt=""><img class="highlighted-moments-section__navigation__next cucci-slick-next" src="{{ asset('images/arrow-next.svg') }}" alt=""></div>
  </div>
</section>
