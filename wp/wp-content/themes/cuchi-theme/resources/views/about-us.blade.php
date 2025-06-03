{{--
  Template Name: About Us Template
--}}

@extends('layouts.app')

@section('content')
@include('sections.aboutus')
@include('sections.meettheteam')
@include('sections.our-insights')
  <!-- @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    @include('partials.content-page')
  @endwhile -->
@endsection
