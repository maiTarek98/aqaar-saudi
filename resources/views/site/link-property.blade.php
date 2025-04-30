@extends('site.index')
@section('title', trans('site.car-report') )
@section('content')
<div class="py-5">
        <div class="container-fluid">
          <div class="bg-light rounded-2 py-5 px-4 text-center">
            <h2 class="fs-4 main">! رابط عقارك جاهز للمشاركة</h2>
            <p class="col-md-6 m-auto">تم إنشاء رابط خاص لعقارك يمكنك مشاركته فقط مع الأشخاص الذين تعرفهم والمهتمين. استخدم الرابط لتقديم عروض مميزة وتسهيل التواصل مع المهتمين بعرضك</p>
            <div class="private-link col-md-6 m-auto">
              <div class="copy-text">
                <input type="text" class="text" value="{{url('verify-property/'.$product->access_links[0]['token'])}}">
                <button><i class="fa fa-clone"></i></button>
              </div>
            </div>
            <div class="estate-qr col-lg-2 col-md-3 col-4 m-auto">
              <img src="{{ asset('storage/qr_codes/qr_' . $product->id . '.png') }}" alt="QR Code for Product {{ $product->id }}">
            </div>
          </div>
        </div>
    </div>
@endsection
@push('custom-js')
<script>
  

</script>
@endpush