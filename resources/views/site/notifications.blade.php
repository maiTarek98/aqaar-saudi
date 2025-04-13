@extends('site.index')
@section('title', trans('site.notifications'))
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.notifications')  ])
<section class="mb-5 pb-md-4">
      <div class="container-fluid">
        <div class="notifi">
           @forelse(auth('web')->user()->notifications()->select('type','id','data','created_at')->orderBy('id','DESC')->get() as $notif)
            <div class="notifi_item">
                <a href="https://www.edraak.org/programs/course/aktc-arabic-v1/" class="link">
                    <span class="new"></span>
                </a>
                <div class="row justify-content-between align-items-center"><a href="{{url('/'.$notif->data['redirect'])}}">
                    <div class="col-lg-9 col-md-8">
                        <div class="d-flex flex-wrap flex-md-nowrap gap-3 align-items-md-center">
                            <div class="notifi_img">
                                <img src="{{url('site')}}/images/logo-fav.png" alt="logo fav icon" srcset="" loading="lazy">
                            </div>
                            <p class="notifi_text">
                                {{$notif->data['title']}} : 
                                {{$notif->data['text']}}</p>
                        </div>
                    </div>
                    <div class="col-auto text-center">
                        <small class="notifi_time">
                            <i class="bi bi-clock"></i>
                            @php 
                  $now = \Carbon\Carbon::now();
                  $created= $notif->created_at;
                  $x= $created->diffForHumans($now);
                  echo $x;
                @endphp
                        </small>
                    </div>
                    </a>
                </div>
            </div>
           @empty
            <h3>@lang('site.no notification')</h3>
           @endforelse
        </div>
      </div>
    </section>  
@endsection