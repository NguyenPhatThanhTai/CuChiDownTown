@php
  $title = get_theme_mod('intro_1_title');
  $description = get_theme_mod('intro_1_description');
  $buttonText = get_theme_mod('intro_1_button_text');
  $image = get_theme_mod('intro_1_button_image_upload');
@endphp

<section class="intro1-section">
  <div class="intro1-section__skew-image">
    <div class="intro1-section__skew-image__skewed"></div><img class="intro1-section__skew-image__image" src="{{ esc_url($image) }}" alt="Intro Image">
  </div>
  <div class="intro1-section__card">
    <div class="intro1-section__card__content">
      <h3 class="intro1-section__card__content__title">{{ $title }}</h3>
      <p class="intro1-section__card__content__text">{{ $description }}</p>
    </div>
    <div class="intro1-section__card__button">
      <button class="btn btn--secondary">{{ $buttonText }}</button>
    </div>
  </div>
</section>
