@extends('site.index')
@section('title', trans('site.user-card') )
@section('content')
      @include('site.includes.breadcrumb-section',['title' => trans('site.user-card')])
    <section class="profile py-5">
      <div class="container-fluid">
        <!-- profile nav-sm -->
        <div class="profile-nav-sm rounded-3">
          <p class="m-0">الملف الشخصي</p>
          <button class="btn toggle-profile-nav p-0 border-0 bg-transparent" data-toggle=".profile-nav">
            <img
            src="images/menu.png"
            alt="menu icon"
          />
          </button>
        </div>

        <div class="row d-flex justify-content-between align-items-start">
        @include('site.includes.profile-menu')
        <!-- profile data col -->
          <div class="profile-data col col-md-7 col-lg-8">
            <div class="profile-wrapper">
              <div class="card-wrapper">
                <div class="card user-card {{auth('web')->user()->user_type}}">
                    <div class="card-header px-5">
                        <h4 class="card-title fs-5 m-0">بطاقة هوية رقمية</h4>
                    </div>
                    <div class="card-body px-5">
                        <div class="d-flex align-items-center gap-4 py-4">
                            <div class="user-img">
                            @if(auth('web')->user()->photo_profile)
                                <img loading="lazy" src="{{auth('web')->user()->photo_profile}}" alt="{{$user->name}}">
                            @endif
                            </div>
                            <div>
                                <h5 class="user-name">{{auth('web')->user()->name}}</h5>
                                <h6 class="user-type my-3">{{auth('web')->user()->user_type}}</h6>
                                <p class="user-id">ID NO. {{auth('web')->user()->card_code}}</p>

                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>            
                
@endsection
@push('custom-js')

@endpush