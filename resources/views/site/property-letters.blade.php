@extends('site.index')
@section('title', trans('site.letters') )
@section('content')
    @include('site.includes.breadcrumb-section',['title' => trans('site.letters')])
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
                  <h4 class="card-title"> سجل الخطابات :</h4>
                </div>
                <div class="card-body py-0">
                @if($letters->count() > 0)
                  <table class="table m-0">
                    <thead>
                      <th>اسم المستخدم</th>
                      <th>التاريخ</th>
                      <th>الاجراء</th>
                    </thead>
                    <tbody>
                      @foreach($letters as $letter)
                      <tr>
                        @php
                            $user1 = \App\Models\User::find($letter->user1);
                            $user2 = \App\Models\User::find($letter->user2);
                            
                            if($user1->id == auth('web')->user()->id){
                                $user = $user2?->name;
                            }else{
                                $user = $user1?->name;
                            }
                        @endphp

                        <td> {{ $user }}</td>
                        <td>{{ \Carbon\Carbon::parse($letter->last_message_at)->format('Y/m/d H:i')}}</td>
                        <td>
                            <div class="estate-controls border-0 p-0 m-0">
                                <a href="{{ route('letter.messages', ['product_id' => $letter->product_id, 'user1' => $letter->user1, 'user2' => $letter->user2]) }}">
                                    <i class="bi bi-eye"></i>
                                    <span>عرض الخطاب</span>
                                </a>
                            </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                @else
                    <span>لا يوجد خطابات للعرض</span>
                @endif
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