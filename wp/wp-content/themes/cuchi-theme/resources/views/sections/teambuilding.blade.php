@php
  $title = get_theme_mod('teambuilding_title');
  $subtitle = get_theme_mod('teambuilding_subtitle');
  $description = get_theme_mod('teambuilding_description');
  $image1 = get_theme_mod('teambuilding_image_1');
  $image2 = get_theme_mod('teambuilding_image_2');
  $image3 = get_theme_mod('teambuilding_image_3');
@endphp

<section class="teambuilding-section">
  <div class="teambuilding-section__skew-image">
    <div class="teambuilding-section__skew-image__skewed">
      <div class="teambuilding-section__skew-image__skewed__content">
        <h1 class="teambuilding-section__skew-image__skewed__content__title">{{ $title }}</h1>
        <p class="teambuilding-section__skew-image__skewed__content__subtitle">{{ $subtitle }}</p>
        <p class="teambuilding-section__skew-image__skewed__content__description">{{ $description }}</p>
      </div>
    </div>
    <div class="teambuilding-section__skew-image__images">
      <div class="teambuilding-section__skew-image__images__group">
        <div class="teambuilding-section__skew-image__images__item"><img src="{{ esc_url($image1) }}"></div>
        <div class="teambuilding-section__skew-image__images__item"><img src="{{ esc_url($image2) }}"></div>
      </div>
      <div class="teambuilding-section__skew-image__images__group">
        <div class="teambuilding-section__skew-image__images__item"><img src="{{ esc_url($image3) }}"></div>
      </div>
    </div>
  </div>
</section>
