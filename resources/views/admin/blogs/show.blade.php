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
                <div class="row g-3">
                    @if($blog->getFirstMediaUrl('blogs_image','thumb'))
                    <div class="col-12">
                        <div class="card border-0 h-100 py-2 px-3">
                            <label for="email">@lang('main.blogs.blogs_image')</label>
                            <img loading="lazy" class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $blog->id }}" id="image" src="{{$blog->getFirstMediaUrl('blogs_image','thumb')}}" alt="@lang('main.NoImageUploaded')" style="aspect-ratio: 15/4; object-fit: contain;object-position: right;">
                            @include('admin.components.modal_photo', [
                            'image' => $blog->getFirstMediaUrl('blogs_image','thumb'),
                            'id' => $blog->id,
                            ])
                        </div>
                    </div>
                    @endif
                    <div class="col-12">
                        <div class="card border-0 d-flex flex-row align-items-center justify-content-between h-100 py-2 px-3">
                            <label class="m-0"> @lang('main.blogs.status')</label>
    
                            <div class="status-tag {{ $blog->status == 'show' ? 'accepted' : 'declined' }}">
                                <i class="highlight"></i>
                                <p class="status-tag__txt">{{ $blog->status }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card border-0 h-100 py-2 px-3">
                            <label> @lang('main.blogs.name')</label>
                            <span>{{ $blog->name }}</span>
                        </div>
                    </div>
                    

                    <div class="col-md-6">
                        <div class="card border-0 h-100 py-2 px-3">
                            <label> @lang('main.blogs.description')</label>
                            <p>{{ $blog->description }}</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card border-0 h-100 py-2 px-3">
                            <label> @lang('main.blogs.content')</label>
                            <p>{{ $blog->content}}</p>
                        </div>
                    </div>
                
                    
                </div>
            </section>
        </div><!-- /.container-fluid -->

    </div>
@endsection
