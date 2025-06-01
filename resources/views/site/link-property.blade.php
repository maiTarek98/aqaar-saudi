@extends('site.index')
@section('title', trans('site.link-qr') )
@section('content')
@include('site.includes.breadcrumb-section',['title' => trans('site.link-qr')])
<div class="py-5">
        <div class="container-fluid">
          <div class="bg-light rounded-2 py-5 px-4 text-center">
            <h2 class="fs-4 main">! رابط عقارك جاهز للمشاركة</h2>
            <p class="col-md-6 m-auto">تم إنشاء رابط خاص لعقارك يمكنك مشاركته فقط مع الأشخاص الذين تعرفهم والمهتمين. استخدم الرابط لتقديم عروض مميزة وتسهيل التواصل مع المهتمين بعرضك</p>
           
            @if($product->access_links->isNotEmpty())
            <div class="private-link col-md-8 m-auto">
              <div class="copy-text">
                <input type="text" class="text" value="{{url('verify-property/'.$product->access_links[0]['token'].'?source=external&ref='.$product->access_links[0]['current_level'])}}">
                <button><i class="fa fa-clone"></i></button>
              </div>
            </div>
            <div class="estate-qr col-lg-2 col-md-3 col-4 m-auto">
              <img src="{{ asset('storage/qr_codes/qr_' . $product->id . '.png') }}" alt="QR Code for Product {{ $product->id }}" class="w-100">
            </div>
            @elseif($product->private_links)
            @foreach($product->private_links as $key => $val)
             @php $numbers = json_decode($product->phone_numbers, true); @endphp
              {{$numbers[$key]}}
            <div class="private-link col-md-8 m-auto">
              <div class="copy-text">
                <input type="text" class="text" value="{{url('private-property/'.$val->token.'?source=external')}}">
                <button><i class="fa fa-clone"></i></button>
              </div>
            </div>
            <div class="estate-qr col-lg-2 col-md-3 col-4 m-auto">
              <img src="{{ asset('storage/qr_codes/qr_' . $product->id .'_'. $key.'.png') }}" alt="QR Code for Product {{ $product->id }}" class="w-100">
            </div>
            @endforeach
            @endif
          </div>
        </div>
    </div>
@endsection
@push('custom-js')
<script>
  

</script>
@endpush