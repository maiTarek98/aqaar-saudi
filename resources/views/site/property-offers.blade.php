@extends('site.index')
@section('title', trans('site.offers') )
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.offers')  ])
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
            <div class="profile-wrapper estates">
              <div class="card border-0 estate-history">
                <div class="card-header py-3 bg-transparent">
                  <h4 class="card-title"> سجل العرض :</h4>
                </div>
                <div class="card-body py-0">
                @if($offers->count() > 0)
                  <table class="table m-0">
                    <thead>
                      <th>اسم المستخدم</th>
                      <th>سعر العقار</th>
                      <th>التاريخ</th>
                      <th>الاجراء</th>
                    </thead>
                    <tbody>
                      @foreach($offers as $offer)
                        <tr>
                          <td>{{$offer->user?->name}}</td>
                          <td>{{$offer->amount}} @lang('site.riyal')</td>
                          <td>{{$offer->created_at->format('Y/m/d')}}</td>
                          <td>
                            <div class="estate-controls border-0 p-0 m-0">
                              @if($offer->status === 'approve')
                                <button disables class=" bg-transparent fw-bold main rounded-pill px-3 py-1">
                                    <span>العرض الفائز</span>
                                 </button>
                              @else
                                @php
                                  $hasApprovedOffer = $offers->contains(fn($o) => $o->status === 'approve');
                                @endphp
                                @if($offer->product?->status != 'closed')
                                <form method="post" action="{{route('offers.approve', $offer->id)}}">
                                  @csrf
                                  <button type="submit" class="main-btn rounded-pill px-3 py-1" {{ $hasApprovedOffer ? 'disabled' : '' }} @if($hasApprovedOffer) style="opacity: 0.6;" @endif>
                                    <span>قبول العرض</span>
                                  </button>
                                </form>
                                @else
                                <span>انتهي العرض، غير متاح الموافقة</span>
                                @endif
                              @endif
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                @endif
                </div>
              </div>
            </div>
          </div>
        </div>
     </div>
    </section>
@endsection