@extends('site.index')
@section('title','الرد على الخطاب' )
@section('content')
@include('site.includes.breadcrumb-section',['title' => 'الرد على الخطاب'])
<div class="container py-4">
  <h4> الرد على الخطاب: {{$letter->sender?->name}}</h4>

  <form method="POST" action="{{ route('letters.replySend', $letter->id) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="receiver_id" value="{{$letter->sender_id}}"> 
    <input type="hidden" name="status_changed_by" value="{{auth('web')->id()}}"> 
    <div class="mb-3">
      <label>نوع الخطاب</label>
      <input type="text" name="type" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>نص الرسالة</label>
      <textarea name="message" class="form-control" rows="5" required></textarea>
    </div>

    <div class="mb-3">
      <label>مرفق (اختياري)</label>
      <input type="file" name="attachment" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">إرسال الرد</button>
  </form>
</div>
@endsection
