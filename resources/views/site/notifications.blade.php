@extends('site.index')
@section('title', trans('site.notifications'))
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.notifications')  ])
<div class="container-fluid py-5">
    <div class="notifications">
        @forelse($user->notifications as $notification)
            <div class="alert alert-light notifi d-flex justify-content-between">
                <div>
                    <strong>{{ $notification->data['title'] }}</strong><br>
                    {{ $notification->data['body'] }}
            
                    @if(!empty($notification->data['url']))
                        <div class="mt-2">
                            <a href="{{ $notification->data['url'] }}" class="btn btn-sm btn-primary">
                                {{ trans('site.view_details') }}
                            </a>
                        </div>
                    @endif
                </div>
                <small class="text-muted d-block">{{ $notification->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <div class="col text-center m-auto">
                <div class="py-5">
                    <p class="fw-bold fs-5">@lang('site.noNotifications')</p>
                    <img class="w-100" src="{{ asset('images/empty-box.png') }}" >
                </div>
            </div>
        @endforelse
        
    </div>
    
</div>


@endsection