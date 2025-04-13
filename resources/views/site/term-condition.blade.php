@extends('site.index')
@section('title', trans('site.term-conditions') )
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.term-conditions')  ])
 <!------------- services section -------------->
    <section class="bg-main py-5">
      <div class="container-fluid py-4">
       {!! app(App\Models\GeneralSettings::class)->terms() !!}
      </div>
    </section>
@endsection