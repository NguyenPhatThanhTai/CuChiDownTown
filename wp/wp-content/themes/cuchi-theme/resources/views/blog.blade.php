{{--
  Template Name: Blog Template
--}}

@extends('layouts.app')

@php
    $blog_array = carbon_get_theme_option('blog_array');
@endphp

@section('content')
<section class="blogcontent-section">
  <div class="blogcontent-section__block">
    @if ($blog_array)
      @foreach ($blog_array as $item)
          @switch($item['_type'])
              @case('image_only')
                  @include('partials.blog.image-only', ['item' => $item])
                  @break

              @case('slick')
                  @include('partials.blog.slick', ['item' => $item])
                  @break

              @case('content')
                  @include('partials.blog.content', ['item' => $item])
                  @break
          @endswitch
      @endforeach
  @endif
  </div>
</section>
@include('sections.our-insights')
@endsection
