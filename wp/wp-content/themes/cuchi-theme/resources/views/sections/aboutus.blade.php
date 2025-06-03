@php
  $title = get_theme_mod('aboutus_title');
  $subtitle = get_theme_mod('aboutus_subtitle');
  $description = get_theme_mod('aboutus_description');
  $image1 = get_theme_mod('aboutus_image_1');
  $image2 = get_theme_mod('aboutus_image_2');
  $image3 = get_theme_mod('aboutus_image_3');
@endphp

<section class="aboutus-section">
  <div class="aboutus-section__block">
    <div class="aboutus-section__content">
      <div class="aboutus-section__content__title">{{ $title }}</div>
      <div class="aboutus-section__content__subtitle">{{ $subtitle }}</div>
      <div class="aboutus-section__content__description">{{ $description }}</div>
    </div>
    <div class="aboutus-section__images">
      <div class="aboutus-section__images__item"><img src="{{ esc_url($image1) }}" alt=""></div>
      <div class="aboutus-section__images__item"><img src="{{ esc_url($image2) }}" alt=""></div>
      <div class="aboutus-section__images__item"><img src="{{ esc_url($image3) }}" alt=""></div>
    </div>
  </div>
</section>
