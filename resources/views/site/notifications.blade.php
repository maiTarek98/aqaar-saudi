@extends('site.index')
@section('title', trans('site.notifications'))
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.notifications')  ])
<h4>الإشعارات</h4>

@foreach($user->notifications as $notification)
    <div class="alert alert-info">
        <strong>{{ $notification->data['title'] }}</strong><br>
        {{ $notification->data['body'] }}
        <small class="text-muted d-block">{{ $notification->created_at->diffForHumans() }}</small>
    </div>
@endforeach


@endsection