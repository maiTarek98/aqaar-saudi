@extends('site.index')
@section('title', trans('site.privacy-policy') )
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.privacy-policy')  ])
 <!------------- services section -------------->
    <section class="bg-main py-5">
      <div class="container-fluid py-4">
       {!! app(App\Models\GeneralSettings::class)->privacy() !!}
      </div>
    </section>
@endsection