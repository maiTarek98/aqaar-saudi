@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="container-fluid">
            <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>            
            <!-- Main content -->
            <section class="content">
                <div class="main-section row g-3">
                    <div class="sticky-side col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="customer-avatar-section border-bottom pb-3">
                                    <div class="d-flex align-items-center flex-column">
                                        @if($blog->getFirstMediaUrl('blogs_image','thumb'))
                                        <img src="{{$blog->getFirstMediaUrl('blogs_image','thumb')}}" class="img-fluid rounded mb-3" data-toggle="modal" data-target="#exampleModal{{ $blog->id }}" width="" height="" alt="{{ $blog->name }}">
                                        @include('admin.components.modal_photo', [
                                        'image' => $blog->getFirstMediaUrl('blogs_image','thumb'),
                                        'id' => $blog->id,
                                        ])
                                         @endif
                                        <div class="customer-info text-center mb-3">
                                            <h5 class="mb-1">{{ $blog->name }}</h5>
                                        </div>
                                        <div type="button" class="status-tag {{ $blog->status == 'show' ? 'accepted' : 'declined' }} border-0" >
                                            <i class="highlight"></i>
                                            <p class="status-tag__txt">{{ $blog->status }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="customer-details py-3">
                                    <div class="d-flex flex-column gap-2">
                                        <div class="d-flex gap-2">
                                            <i class="bi bi-calendar-check"></i>
                                            <div>
                                                <small class="fw-bold mb-1"> @lang('main.users.created_at') </small>
                                                <p class="m-0">{{ $blog->created_at }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="main-side col-md-8">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">@lang('main.blogs.description')</h4>
                            </div>
                            <div class="card-body">
                               <p>{{ $blog->description }}</p> 
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('main.blogs.content')</h4>
                            </div>
                            <div class="card-body">
                               <p>{{ $blog->content }}</p> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div><!-- /.container-fluid -->

    </div>
@endsection
