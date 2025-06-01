@extends('site.index')
@push('custom-css')
<style>
    .reply-message {
        margin-right: 30px;
        border-right: 2px solid #007bff;
        padding-right: 15px;
    }
</style>
@endpush
@section('title', trans('site.letters-reply') )
@section('content')
    @include('site.includes.breadcrumb-section',['title' => trans('site.letters-reply')])

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
                @foreach ($messages as $msg)
                <div class="profile-wrapper estates mb-3">
                    <div class="card border-0 estate-history">
                        <div class="card-header py-2 border-0 bg-transparent">
                            <h5 class="card-title">الخطاب من: {{ \App\Models\User::find($msg->sender_id)?->name }}</h5>
                            <small class="text-muted">ID : {{ \App\Models\User::find($msg->sender_id)?->card_code }}</small>
                            <small class="text-muted">بتاريخ: {{ $msg->created_at->format('Y/m/d H:i') }}</small>
                        </div>
                    </div>
                    <div class="card-body py-0">
                        <div class="form-group mb-4">
                          <label>نوع الخطاب</label>
                          <input
                            type="text"
                            class="form-control"
                            readonly
                            disabled
                            value="{{ $msg->type }}"
                          />
                        </div>
                        @if($msg->getMedia('attachments')->count())
                          <div class="form-group mb-4">
                            <label class="col-form-label">مرفقات</label>
                            @foreach($msg->getMedia('attachments') as $key => $media)
                            <div class="file-input position-relative form-control">
                              <span class="button"><i class="bi bi-paperclip"></i></span>
                              <a href="{{ asset('storage/product_letters/'.$media->id.'/' . $media->file_name) }}" download class="label">
                                تحميل المرفق
                              </a>
                            </div>
                            @endforeach
                          </div>
                        @endif
                        <div class="form-group mb-4">
                          <label>نص الرسالة</label>
                          <textarea class="form-control" rows="5" readonly disabled>{{ $msg->message }}</textarea>
                        </div>
                        <div class="d-flex gap-2 col-lg-8">
                            @if(($msg->receiver_id === auth('web')->id() || auth('web')->user()->property_delegations()->exists()) && $msg->status == 'accept')
                                <form method="POST" action="{{ route('letters.accept', $msg->id) }}">
                                  @csrf
                                  <input type="hidden" name="status_changed_by" value="{{auth('web')->id()}}"> 
                                  <button class="btn btn-success flex-grow-1">قبول</button>
                                </form>
                                <form method="POST" action="{{ route('letters.reject', $msg->id) }}">
                                  @csrf
                                  <input type="hidden" name="status_changed_by" value="{{auth('web')->id()}}"> 
                                  <button class="btn btn-danger flex-grow-1">رفض</button>
                                </form>
                            @else
                                <button class="btn @if($msg->status == 'approve') btn-success @else btn-danger @endif flex-grow-1"> {{__('main.letters.'.$msg->status)}}</button>
                            @endif
                            @if($msg->status != 'approve')
                            <a href="{{ route('letters.replyForm', $msg->id) }}" class="btn btn-info flex-grow-1">الرد بمستند</a>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($msg->childs->where('status','!=','pending')->count())
                    <div class="ms-4 mt-3 border-start ps-3">
                        <h6 class="text-primary">الردود:</h6>
                        @foreach($msg->childs->where('status','!=','pending') as $child)
                            <div class="card border mb-2">
                                <div class="card-header py-2 bg-light">
                                    <strong>رد من: {{ $child->sender?->name }}</strong>
                                    <small class="text-muted d-block">ID: {{ $child->sender?->card_code }}</small>
                                    <small class="text-muted">بتاريخ: {{ $child->created_at->format('Y/m/d H:i') }}</small>
                                </div>
                                <div class="card-body py-2">
                                    <div class="form-group mb-2">
                                        <label>نوع الخطاب</label>
                                        <input type="text" class="form-control" value="{{ $child->type }}" readonly disabled>
                                    </div>
                                    @if($child->getMedia('attachment')->count())
                                        <div class="form-group mb-2">
                                            <label>مرفق</label>
                                            <div class="file-input position-relative form-control">
                                                <a href="{{ asset('storage/product_letters/'.$child->getMedia('attachment')[0]->id.'/' . $child->getMedia('attachment')[0]->file_name) }}" download class="label">
                                                    تحميل المرفق
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="form-group">
                                        <label>نص الرسالة</label>
                                        <textarea class="form-control" rows="3" readonly disabled>{{ $child->message }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @endforeach
            </div>
        </div>
      </div>
    </section>
@endsection
@push('custom-js')

@endpush