@extends('admin.index')
@push('custom-css')
    <style>
       
    </style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="content-header">
            @include('admin.partials.breadcrumb')
        </div>
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        الخطابات الجديدة                          
                    </h3>
                    </div>
                <div class="card-body px-0">
                       <table class="table">
                <thead>
                  <tr>
                    <th>العقار</th>
                    <th>المرسل</th>
                    <th>نوع الاستفسار</th>
                    <th>التاريخ</th>
                    <th>الإجراء</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($letters as $letter)
                    <tr>
                      <td>{{ $letter->product->title }}</td>
                      <td>{{ $letter->sender->name }}</td>
                      <td>{{ $letter->type }}</td>
                      <td>{{ $letter->created_at->format('Y-m-d H:i') }}</td>
                      <td>
                        <a href="{{ route('productSingleLetter', ['product' => $letter->product_id,'letter' => $letter->id]) }}" class="btn btn-sm btn-primary">عرض</a>
                      </td>
                    </tr>
                  @empty
                     <td class="text-center text-muted" style="font-size: 25px" colspan="10">
                            <i class="fa-regular fa-trash-can" style="
                    font-size: 100px;
                    color: #d3d3d3;
                    display: block;"></i>            
                            <h5>{{ trans('main.noData') }}</h5>
                        </td>
                  @endforelse
                </tbody>
              </table>
            
              {{ $letters->links() }}      
                </div>         
            </div>
        </div>
    </div>
</div>
@endsection