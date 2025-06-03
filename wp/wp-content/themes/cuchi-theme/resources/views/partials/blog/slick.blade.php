 <div class="blogcontent-section__slick-block">
    <div class="blogcontent-section__slick cucci-slick-2">
       @foreach ($item['slides'] ?? [] as $slide)
            @php
                $slide_url = wp_get_attachment_image_url($slide['image'], 'full');
            @endphp
            @if ($slide_url)
              <div class="blogcontent-section__slick__item img-container"><img src="{{ $slide_url }}" alt=""></div>
            @endif
        @endforeach
    </div>
    <div class="blogcontent-section__slick-block__navigation"> <img class="cucci-slick-next" src="{{ asset('images/arrow-next.svg') }}" alt=""></div>
  </div>