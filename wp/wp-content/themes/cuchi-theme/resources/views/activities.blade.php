{{--
  Template Name: Activities Template
--}}

@extends('layouts.app')

@section('content')
  @include('sections.memories')
  @include('sections.inonetour')
  @include('sections.highlighted-memories')
  @include('sections.teambuilding')
  @include('sections.our-insights')
  <!-- @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    @include('partials.content-page')
  @endwhile -->
@endsection
