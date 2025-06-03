<div class="bookingplace-section">
  <div class="bookingplace-section__block">
    <div class="bookingplace-section__item">
      <h1 class="bookingplace-section__title">{{ $item['title'] }}</h1>
      @foreach ($item['highlight_features'] ?? [] as $hf)
        <div class="bookingplace-section__subtitle">{{ $hf['text'] }}</div>
      @endforeach
      <img class="bookingplace-section__image" src="{{  wp_get_attachment_image_url($item['images'][0]['src'], 'full') }}" alt="">
    </div>
    <div class="bookingplace-section__item">
      <img class="bookingplace-section__image" src="{{  wp_get_attachment_image_url($item['images'][1]['src'], 'full') }}" alt="">
      @if (!empty($item['select'][0]))
        @php
            $icon = wp_get_attachment_image_url($item['select'][0]['icon'], 'full');
        @endphp
        <div class="bookingfeature-section__left__booking">
          <div class="bookingfeature-section__left__booking__content">
            <img class="bookingfeature-section__left__booking__content__icon" src="{{ $icon }}" alt="">
              <div class="bookingfeature-section__left__booking__content__main">
              <div class="bookingfeature-section__left__booking__content__main__title">{{ $item['select'][0]['title'] }}</div>
              <div class="bookingfeature-section__left__booking__content__main__description">
                <span class="bookingfeature-section__left__booking__content__main__description__label">{{ $item['select'][0]['from_label'] }} </span>
                <span class="bookingfeature-section__left__booking__content__main__description__date"></span>
                <span class="bookingfeature-section__left__booking__content__main__description__label">{{ $item['select'][0]['to_label'] }} </span>
                <span class="bookingfeature-section__left__booking__content__main__description__date"></span>
              </div>
            </div>
          </div>
          <button class="bookingfeature-section__left__booking__button btn btn--primary" type="button" class="btn btn-book-now" data-room-name="{{ $item['title'] }}" data-room-id="{{ $item['select'][0]['title'] }}" data-price="{{ $room['price'] }}" onclick="openBookingPopup(this)"> {{ $item['select'][0]['button_text'] }} </button>
        </div>
      @endif
    </div>
    <div class="bookingplace-section__item">
      <div class="bookingplace-section__content">
        @foreach ($item['features'] ?? [] as $f)
          <p>{{ $f['text'] }}</p>
        @endforeach
      </div>
      <img class="bookingplace-section__image" src="{{  wp_get_attachment_image_url($item['images'][2]['src'], 'full') }}" alt="">
    </div>
  </div>
</div>