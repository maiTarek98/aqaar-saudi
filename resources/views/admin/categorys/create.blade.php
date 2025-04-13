@extends('admin.index')
@section('content')
    <div class="content-wrapper">
     <div class="container-fluid add-form-list">
        <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">@lang('main.addNew') @if(request('parent_id')) @lang('main.subcategory') @else {{__('main.'.$model.'.'.$model)}} @endif</h4>
                        </div>
                    </div>
                    @include('admin.layouts.alerts')
                    <div class="card-body">
                        <form data-toggle="validator" class="from-prevent-multiple-submits" method="post" action="{{ route($model.'.store',['parent_id' => request('parent_id')]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @include('admin.'.$model.'.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
      </div>
@endsection
