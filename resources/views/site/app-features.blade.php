@extends('site.index')
@section('title', trans('site.features'))
@section('content')
    <!-- features -->
    <section class="about-us py-5">
        <div class="container-fluid">
          @include('site.includes.feature-section')
        </div>
    </section>
@endsection