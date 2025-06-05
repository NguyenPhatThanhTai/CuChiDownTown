<section class="bookingfeature-section">
  <div class="bookingfeature-section__block {{ $item['is_reversed'] ? 'reverse' : '' }}">
    <div class="bookingfeature-section__left">
      <div class="bookingfeature-section__left__title">{{ $item['title'] }}</div>

      @foreach ($item['highlight_features'] ?? [] as $hf)
        <div class="bookingfeature-section__left__highlight">{{ $hf['text'] }}</div>
      @endforeach

      @foreach ($item['features'] ?? [] as $f)
        <div class="bookingfeature-section__left__description">{{ $f['text'] }}</div>
      @endforeach
      
      @if (!empty($item['select'][0]))
        @php
            $icon = wp_get_attachment_image_url($item['select'][0]['icon'], 'full');
        @endphp
        <div class="bookingfeature-section__left__booking">
          <div class="bookingfeature-section__left__booking__content"><img class="bookingfeature-section__left__booking__content__icon" src="{{ $icon }}" alt=""/>
            <div class="bookingfeature-section__left__booking__content__main">
              <div class="bookingfeature-section__left__booking__content__main__title">{{ $item['select'][0]['title'] }}</div>
              <div class="bookingfeature-section__left__booking__content__main__description">
                <div class="bookingfeature-section__left__booking__content__main__description__block"><span class="bookingfeature-section__left__booking__content__main__description__label">{{ $item['select'][0]['from_label'] }} </span><span class="bookingfeature-section__left__booking__content__main__description__date">MON, NOV 4, 2025</span></div>
                <div class="bookingfeature-section__left__booking__content__main__description__block"><span class="bookingfeature-section__left__booking__content__main__description__label">{{ $item['select'][0]['to_label'] }} </span><span class="bookingfeature-section__left__booking__content__main__description__date">SUN, NOV 8, 2025</span></div>
              </div>
            </div>
          </div>
          <div class="bookingfeature-section__left__booking__action">
          <button class="bookingfeature-section__left__booking__button btn btn--primary" type="button" class="btn btn-book-now" data-room-name="{{ $item['title'] }}" data-room-id="{{ $item['select'][0]['room_id'] }}" data-price="{{ $room['price'] }}" onclick="openBookingPopup(this)"> {{ $item['select'][0]['button_text'] }} </button>
            <div class="bookingfeature-section__left__booking__stock">{{ $item['stock_availability_text'] }}</div>
          </div>
        </div>
      @endif
    </div>
    <div class="bookingfeature-section__right">
      @foreach ($item['images'] ?? [] as $image)
        @php
            $image_url = wp_get_attachment_image_url($image['src'], 'full');
        @endphp
        <div class="bookingfeature-section__right__item">
          <img class="bookingfeature-section__right__item__image" src="{{ $image_url }}" alt=""/>
          <div class="bookingfeature-section__right__item__content">
            @if (!empty($image['features']))
              @foreach ($image['features'] as $text)
                <div class="bookingfeature-section__right__item__content__text">
                  {{ $text['feature'] ?? '' }}
                </div>
              @endforeach
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
