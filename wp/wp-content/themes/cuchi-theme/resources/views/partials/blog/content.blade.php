<div class="blog-detail {{ $item['is_big_title'] ? 'pinned' : '' }} {{ $item['is_full_width'] ? 'blog-detail--full-width' : '' }}">
  <div class="blog-detail__left">
    <div class="blog-detail__left__author">{{ $item['author'] }}</div>
    <div class="blog-detail__left__date">{{ $item['date'] }}</div>
  </div>
  <div class="blog-detail__right">
    <div class="blog-detail__right__title">{{ $item['title'] }}</div>
    <p class="blog-detail__right__content">{{ $item['description'] }}</p>
    @if (!empty($item['list']))
        <ul class="blog-detail__right__list">
           @foreach ($item['list'] as $li)
                <li class="blog-detail__right__list__item"><span class="blog-detail__right__list__item__key">{{ $li['key'] }}:</span> {{ $li['content'] }}</li>
            @endforeach
        </ul>
    @endif
  </div>
</div>