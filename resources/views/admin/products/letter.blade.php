@extends('admin.index')
@push('custom-css')
    <style></style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="content-header">
            @include('admin.partials.breadcrumb')
        </div>
        <div class="content">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">
                      عرض الخطاب          
                    </h3>
                 </div>
                <div class="card-body">
                    <p><strong>العقار:</strong> {{ $letter->product->title }}</p>
                    <p><strong>المرسل:</strong> {{ $letter->sender->name }}</p>
                    <p><strong>نوع الاستفسار:</strong> {{ $letter->type }}</p>
        
                    @if($letter->getMedia('attachments')->count())
                        <p><strong>المستندات المرفقة:</strong></p>
                        <div class="row gy-3 row-cols-lg-4">
                            @foreach($letter->getMedia('attachments') as $key => $media)
                            <div class="col">
                                <a href="{{ asset('storage/product_letters/'.$media->id.'/' . $media->file_name)}}" download class="d-flex border bg-white rounded-3 gap-2 py-2 px-3">
                                    <i class="fas fa-download text-primary fs-5"></i>
                                    <div>{{$media->file_name}}</div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    @endif
                    
                    @if($letter->status == 'pending')
                    
                    <div class="d-flex-gap-2">
                        <form method="POST" action="{{ route('letterAccept', ['product' => $letter->product_id,'letter' => $letter->id]) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">قبول</button>
                      </form>
                        <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $letter->id }}" aria-expanded="false" aria-controls="collapseExample{{ $letter->id }}">
                                        تعديل محتوى الخطاب
                        </button>    
                    </div>
                    <div class="bg-white p-3 mt-3 rounded-3 collapse" id="collapseExample{{ $letter->id }}">
                        
                        <form method="POST" action="{{ route('letterEditAccept', ['letter' => $letter->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
            
                            <div class="form-group mb-3">
                                <label for="message">الرسالة</label>
                                <textarea name="message" id="message" rows="6" class="form-control">{{ old('message', $letter->message) }}</textarea>
                            </div>
                            <div class="form-group mb-4">
                              <label for="">إرفاق مستندات معدلة</label>
                              <input type="file" name="attachments[]" class="form-control" multiple accept=".pdf,.doc,.docx,.jpg,.png">
                           </div>
                            <button type="submit" class="btn btn-primary">تعديل وقبول</button>
                        </form>
                    </div>
                    @else
                    <div class="border-top pt-3 mt-3">
                        {{__('main.letters.'.$letter->status)}}
                    </div>
                    @endif
                       
                 </div>
            </div>

            
            <hr>
            
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">
                       الردود على الخطاب       
                    </h3>
                </div>
                <div class="card-body">                               
                    @if($replies->isEmpty())
                        <p>لا يوجد ردود حتى الآن.</p>
                    @else
                        @foreach($replies as $reply)
                        <div class="bg-light p-4 rounded-3 mb-3">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span>
                                    <strong>من:</strong> {{ $reply->sender->name ?? 'غير معروف' }}
                                </span>
                                |
                                <strong>الحالة:</strong>
                                @if($reply->status == 'pending')
                                    <span class="badge bg-primary">تم الإرسال</span>
                                @elseif($reply->status == 'accept')
                                    <span class="badge bg-success">تمت الموافقة</span>
                                @else
                                    <span class="badge bg-success">{{__('main.letters.'.$reply->status)}}</span>
                                @endif
                            </div>
                            <p><strong>نوع الاستفسار:</strong> {{ $reply->type }}</p>
                            <p><strong>الرسالة:</strong> {{ $reply->message }}</p>
                            @if($reply->getMedia('attachment')->count())
                            <div class="form-group mb-2">
                                <label>مرفق</label>
                                <a href="{{ asset('storage/product_letters/'.$reply->getMedia('attachment')[0]->id.'/' . $reply->getMedia('attachment')[0]->file_name) }}" download class="d-flex border bg-white rounded-3 gap-2 py-2 px-3">
                                    <i class="fas fa-download text-primary fs-5"></i>
                                    <div>{{$reply->getMedia('attachment')[0]->file_name}}</div>
                                </a>
                            </div>
                            @endif
            
                            @if($reply->status == 'pending')
                                <div class"d-flex gap-2">
                                    <form method="POST" action="{{ route('letterAccept', ['product' => $reply->product_id,'letter' => $reply->id])}}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">قبول الرد</button>
                                    </form>
                                    
                                    <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $reply->id }}" aria-expanded="false" aria-controls="collapseExample{{ $reply->id }}">
                                        تعديل محتوى الخطاب
                                    </button>    
                                </div>
                                
                                <div class="bg-white p-3 mt-3 rounded-3 collapse" id="collapseExample{{ $reply->id }}">
                                    <form method="POST" action="{{ route('letterEditAccept', ['letter' => $reply->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        
                                        <div class="form-group mb-3">
                                            <label for="message">الرسالة</label>
                                            <textarea name="message" id="message" rows="6" class="form-control">{{ old('message', $reply->message) }}</textarea>
                                        </div>
                                        <div class="form-group mb-4">
                                          <label for="">إرفاق مستندات معدلة</label>
                                          <input type="file" name="attachment" class="form-control" multiple accept=".pdf,.doc,.docx,.jpg,.png">
                                       </div>
    
                                        <button type="submit" class="btn btn-primary">تعديل وقبول</button>
                                    </form>
                                </div>
                            @else
                                <div class="border-top pt-3 mt-3">
                                    {{__('main.letters.'.$reply->status)}}
                                </div>
                            @endif
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
