@php
  $title = get_theme_mod('hashtags_title');
  $hashtags = get_theme_mod('hashtags_tags');
@endphp

<section class="hashtags-section"> 
  <h1>{{ $title }}</h1>
  <h4>{{ $hashtags }}</h4>
</section>
