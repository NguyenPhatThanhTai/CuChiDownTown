@php
  $title = get_theme_mod('meettheteam_title');
  $title_emphasis = get_theme_mod('meettheteam_title_emphasis');
  $subtitle = get_theme_mod('meettheteam_subtitle');
  $description = get_theme_mod('meettheteam_description');
  $button_text = get_theme_mod('meettheteam_button_text');
  $image1 = get_theme_mod('meettheteam_image_1');
  $image2 = get_theme_mod('meettheteam_image_2');
  $image3 = get_theme_mod('meettheteam_image_3');
@endphp

<section class="meettheteam-section">
  <div class="meettheteam-section__skew-image">
    <div class="meettheteam-section__skew-image__images">
      <div class="meettheteam-section__skew-image__images__group">
        <div class="meettheteam-section__skew-image__images__item"><img src="{{ esc_url($image1) }}" alt=""></div>
      </div>
      <div class="meettheteam-section__skew-image__images__group">
        <div class="meettheteam-section__skew-image__images__item"><img src="{{ esc_url($image2) }}" alt=""></div>
        <div class="meettheteam-section__skew-image__images__item"><img src="{{ esc_url($image3) }}" alt=""></div>
      </div>
    </div>
    <div class="meettheteam-section__skew-image__skewed">
      <div class="meettheteam-section__skew-image__skewed__content">
        <div class="meettheteam-section__skew-image__skewed__content__header">
          <div class="meettheteam-section__skew-image__skewed__content__header__pretitle">{{ $title }}</div>
          <h1 class="meettheteam-section__skew-image__skewed__content__header__title">{{ $title_emphasis }}</h1>
        </div>
        <div class="meettheteam-section__skew-image__skewed__content__team">
          <p class="meettheteam-section__skew-image__skewed__content__team__subtitle">{{ $subtitle }}</p>
          <p class="meettheteam-section__skew-image__skewed__content__team__description">{{ $description }}</p>
          <button class="meettheteam-section__skew-image__skewed__content__team__button btn">{{ $button_text }}</button>
        </div>
      </div>
    </div>
  </div>
</section>
