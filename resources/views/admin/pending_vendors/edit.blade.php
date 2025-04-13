@extends('admin.index')
@section('content')
    <div class="content-wrapper">
     <div class="container-fluid add-form-list">
        <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>
         <div class="card my-4">
             @include('admin.layouts.alerts')
             <div class="card-body">
                 <form data-toggle="validator" class="from-prevent-multiple-submits" method="post" action="{{ route($model.'.update',[$item->id,'parent_id' => request('parent_id')]) }}"
                             enctype="multipart/form-data">
                     @csrf @method('PUT')
                     @include('admin.'.$model.'.form')
                 </form>
             </div>
         </div>
        <!-- Page end  -->
    </div>
      </div>
@endsection
