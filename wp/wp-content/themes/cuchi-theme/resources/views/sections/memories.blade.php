@php
  $title = get_theme_mod('memories_title');
  $description = get_theme_mod('memories_description');
  $image_urls = get_theme_mod('image_urls');
  $images = array_filter(array_map('trim', explode(',', $image_urls)));
@endphp

<section class="memories-section"> 
  <div class="memories-section__title">{{ $title }}</div>
  <div class="memories-section__description">{{ $description }}</div>
  <div class="memories-section__list">
    @if(!empty($images))
      @foreach($images as $image)
        @php
          $attachment_id = is_numeric($image) ? (int) $image : attachment_url_to_postid($image);
          $caption = $attachment_id ? wp_get_attachment_caption($attachment_id) : '';
          $attachment = $attachment_id ? get_post($attachment_id) : null;
        @endphp

        <div class="memories-section__item"> 
          <div class="memories-section__item__image"><img src="{{ esc_url($image) }}" alt=""></div>
          <div class="memories-section__item__content"> 
            <div class="memories-section__item__content__title">
              @if($caption)
                <p>{{ $caption }}</p>
              @endif
            </div>
            <div class="memories-section__item__content__description">
               @if (!empty($attachment->post_content))
                    <div class="image-description">
                        <p>{{ $attachment->post_content }}</p> {{-- This is the description --}}
                    </div>
                @endif
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>
</section>
