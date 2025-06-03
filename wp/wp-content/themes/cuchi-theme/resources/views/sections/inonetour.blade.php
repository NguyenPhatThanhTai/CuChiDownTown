@php
  $title = get_theme_mod('in_one_tour_title');
  $description = get_theme_mod('in_one_tour_description');
  $button_text = get_theme_mod('in_one_tour_button_text');
  $image = get_theme_mod('in_one_tour_button_image_upload');
@endphp

<section class="inonetour-section" style="background-image: url('{{ asset('images/GradientPurple.png') }}');">
  <div class="inonetour-section__block">
    <div class="inonetour-section__block__content"> 
      <h1 class="inonetour-section__block__content__title">{{ $title }}</h1>
      <div class="inonetour-section__block__content__description">{{ $description }}</div>
      <button class="inonetour-section__block__content__button btn btn--primary">{{ $button_text }}</button>
    </div>
    <div class="inonetour-section__block__image"><img src="{{ esc_url($image) }}" alt=""></div>
  </div>
</section>
