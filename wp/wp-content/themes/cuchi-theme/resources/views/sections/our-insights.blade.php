@php
  $title = get_theme_mod('our_insights_title', 'Explore insights');
  $stickyText = get_theme_mod('our_insights_sticky_text', 'Disconnect to Reconnect');
  $image_urls = get_theme_mod('our_insights_image_urls');
  $images = array_filter(array_map('trim', explode(',', $image_urls)));
@endphp

<section class="our-insights">
  <h3 class="our-insights__title">{{ $title }}</h3>
  <div class="our-insights__list cucci-slick-3">
    @if(!empty($images))
      @foreach($images as $image)
        @php
          $attachment_id = is_numeric($image) ? (int) $image : attachment_url_to_postid($image);
          $caption = $attachment_id ? wp_get_attachment_caption($attachment_id) : '';
          $attachment = $attachment_id ? get_post($attachment_id) : null;
        @endphp
        <a class="our-insights__item" href="#"> 
            <div class="our-insights__item__image">
              <img src="{{ esc_url($image) }}" alt="">
            </div>
            <div class="our-insights__item__description">
              @if($caption)
                <p>{{ $caption }}</p>
              @endif
            </div>
          </a>
      @endforeach
    @endif
    <!-- <a class="our-insights__item" href="#"> 
      <div class="our-insights__item__image"><img src="../img/our-insight-2.jpg" alt=""></div>
      <div class="our-insights__item__description">Pedal Through Paradise: Scenic Bicycle Tours in Cuchi</div></a><a class="our-insights__item" href="#"> 
      <div class="our-insights__item__image"><img src="../img/our-insight-3.jpg" alt=""></div>
      <div class="our-insights__item__description">Pedal Through Paradise: Scenic Bicycle Tours in Cuchi</div></a> -->
  </div>
  <div class="our-insights__navigation">
    <img class="our-insights__navigation__prev cucci-slick-3-prev" src="{{ asset('images/arrow-prev.svg') }}" alt="">
    <img class="our-insights__navigation__next cucci-slick-3-next" src="{{ asset('images/arrow-next.svg') }}" alt="">
  </div>
  <div class="our-insights__sticky-footer">{{ $stickyText }}</div><img class="our-insights__go-to-top" src="{{ asset('images/arrow-top.svg') }}" alt="" onclick="window.scrollTo(0,0)">
</section>
