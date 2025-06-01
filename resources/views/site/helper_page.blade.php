@extends('site.index')
@section('title', $page->title )
@section('content')
@include('site.includes.breadcrumb-section',['title' =>$page->title  ])
 <!------------- services section -------------->
    <section class="helper-page">
        <div class="container-fluid py-5">
            {!! $page->content !!}
        </div>
    </section>
@endsection