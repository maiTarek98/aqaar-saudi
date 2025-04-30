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
                  
                    <div class="main-side col-md-8">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">@lang('main.pages.title')</h4>
                            </div>
                            <div class="card-body">
                               <p>{{ $page->title }}</p> 
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('main.pages.content')</h4>
                            </div>
                            <div class="card-body">
                               <p>{{ $page->content }}</p> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div><!-- /.container-fluid -->

    </div>
@endsection
