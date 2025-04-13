@extends('site.index')
@section('title', trans('site.aboutus'))
@section('content')
<!-- about us --> 
<section class="about-us py-5">
  <div class="container-fluid">
    @include('site.includes.about-section')
  </div>
</section>
@endsection