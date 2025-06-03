@php
  $title = get_theme_mod('intro_2_title');
  $description = get_theme_mod('intro_2_description');
  $subtitle = get_theme_mod('intro_2_subtitle_main');
  $subtitleEmphasis = get_theme_mod('intro_2_subtitle_emphasis');
  $buttonText = get_theme_mod('intro_2_button_text');
  $image = get_theme_mod('intro_2_button_image_upload');
@endphp

<section class="intro2-section">
  <div class="intro2-section__skew-image">
    <div class="intro2-section__skew-image__skewed">
      <div class="intro2-section__skew-image__skewed__content">
        <h1 class="intro2-section__skew-image__skewed__content__title">{{ $title }}</h1>
        <div class="intro2-section__skew-image__skewed__content__subtitle">
          <div class="intro2-section__skew-image__skewed__content__subtitle__main">{{ $subtitle }} </div>
          <div class="intro2-section__skew-image__skewed__content__subtitle__emphasize">{{ $subtitleEmphasis }}</div>
        </div>
        <p class="intro2-section__skew-image__skewed__content__description">{{ $description }}</p>
        <button class="intro2-section__skew-image__skewed__content__button btn btn--primary">{{ $buttonText }}</button>
      </div>
    </div><img class="intro2-section__skew-image__image" src="{{ esc_url($image) }}" alt="Intro Image">
  </div>
  <p class="intro2-section__description">{{ $description }}</p>
</section>
