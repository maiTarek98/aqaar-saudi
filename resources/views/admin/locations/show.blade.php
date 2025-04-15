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
                <div class="main-section row g-3">
                    <div class="sticky-side col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="customer-avatar-section position-relative overflow-hidden border-bottom pb-3">
                                    <div class="d-flex align-items-center flex-column">
                                        <img class="img-fluid mb-3" width="90" src="{{ url('/dashboard') }}/dist/img/location_map.png" alt="">
                                        <div class="customer-info text-center">
                                            <h5 class="mb-1">{{ __('main.locations.'.$location->type) }} {{ $location->name }}</h5>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="customer-details py-3">
                                    <div class="d-flex flex-column gap-2">
                                        <div class="d-flex gap-2">
                                            <i class="bi bi-patch-check"></i>
                                            <div>
                                                <small class="fw-bold mb-1"> @lang('main.locations.created_at') </small>
                                                <p class="m-0">{{ $location->created_at }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="main-side col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    المدن التابعة {{ __('main.locations.'.$location->type) }} {{ $location->name }}:
                                </h3>
                            </div>
                            <div class="card-body">
                                @if($location->children->isNotEmpty())
                                    @foreach($location->children as $child)
                                        <div class="card basic mb-2">
                                            <div class="card-body py-2 px-3">
                                                <p class="mb-0 fw-bold">{{ $child->name_ar }}</p>
                                                @if($child->children->isNotEmpty())
                                                <div class="card shadow-none mt-2">
                                                    <div class="card-body p-2">
                                                        <small class="d-block fw-semibold mb-2"> المناطق التابعة للمدينة </small>
                                                        <ul class="d-flex align-items-center gap-1 m-0">
                                                            @foreach($child->children as $grandchild)
                                                                <li class="tag">{{ $grandchild->name_ar }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- 
                                    @foreach($location->children as $child)
                                        <div class="accordion-item mb-2 border-0">
                                        <h2 class="accordion-header bg-light px-3 d-flex align-items-center" id="heading-{{ $child->id }}">
                                            <button class="accordion-button bg-transparent pe-0 ps-2 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $child->id }}" aria-expanded="true" aria-controls="collapse-{{ $child->id }}">
                                                <i class="bi bi-geo me-2"></i>
                                                {{ $child->name_ar }}
                                            </button>
                                        </h2>
                                
                                        <div id="collapse-{{ $child->id }}" class="accordion-collapse collapse show" aria-labelledby="heading-{{ $child->id }}">
                                            <div class="accordion-body">
                                                @if($child->children->isNotEmpty())
                                                    <div class="ps-4">
                                                        <small class="d-block fw-semibold mb-2"> المناطق التابعة للمدينة </small>
                                                        @foreach($child->children as $grandchild)
                                                            <div class="d-flex gap-1">
                                                                <p class="m-0">
                                                                    {{ $grandchild->name_ar }}
                                                                </p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    --}}
                                @else
                                    <span class="text-muted">{{ __('main.No Children Locations') }}</span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
