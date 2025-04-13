@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>        
            <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="form-group col-sm-10">
                                    <label> @lang('main.locations.name')</label>
                                    <span>{{ $location->name }}</span>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label> @lang('main.locations.type')</label>
                                    <input type="text" name="name"
                                        value="{{ __('main.locations.'.$location->type) }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label> @lang('main.locations.childrens')</label>
                                    @if($location->children->isNotEmpty())
                                        <ul>
                                            @foreach($location->children as $child)
                                                <li>{{ $child->name_ar }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">{{ __('No Children Locations') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-sm-12">
                                    <label> @lang('main.locations.created_at')</label>
                                    <input type="text" name="name"
                                        value="{{ $location->created_at }}"
                                        class="form-control" readonly>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
        </div>
@endsection
