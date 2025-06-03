@php
    $image_url = wp_get_attachment_image_url($item['image'], 'full');
@endphp

<img class="blogcontent-section__image" src="{{ $image_url }}" alt="">