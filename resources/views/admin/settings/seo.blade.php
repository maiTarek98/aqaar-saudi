@extends('admin.index')
@push('custom-css')
<style type="text/css">
    .copy_txt{
        color: red;
        border: 1px solid red;
        padding: 10px;
        display: none;
    }
    /* Custom styling for the tags input */
    .bootstrap-tagsinput {
        width: 100%;
        padding: 8px;
        border: 2px solid var(--main);
        border-radius: 5px;
        background-color: #f8f9fa;
        min-height: 45px;
    }

    /* Styling for individual tags */
    .bootstrap-tagsinput .tag {
        background-color: var(--main);
        color: white;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 20px;
        margin: 3px;
        display: inline-flex;
        align-items: center;
    }

    /* Remove button inside the tag */
    .bootstrap-tagsinput .tag [data-role="remove"] {
        margin-inline-start: 3px !important;
        margin-inline-end: 0 !important;
        cursor: pointer;
    }

    .bootstrap-tagsinput .tag [data-role="remove"]:hover {
        color: #ffcccc;
    }

    /* Placeholder styling */
    input[type="text"]::placeholder {
        color: #aaa;
        font-style: italic;
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    @include('admin.partials.breadcrumb')
                </div>
            </div>
        </div>
        <div class="content add-form-list">
         <div class="card my-4">
             <div class="card-header d-flex justify-content-between">
                 <div class="header-title">
                     <h4 class="card-title">@lang('main.sitemap')</h4>
                 </div>
             </div>
             <div class="card-body">
                <h5>@lang('main.generate sitemap')</h5>
                    <div class="copy-link">
                        <div class="items">
                            <input type="text" id="copy" class="copy-link-input form-control"value="{{url('/sitemap.xml')}}" readonly>
                        </div>
                    </div>
                    <div class='d-flex align-items-center gap-2 my-3'>
                            <button type="button" onclick="copyToClipboard('copy')" class="copy-link-button btn btn-success">
                                <span class="material-icons">@lang('main.copy link')</span>
                            </button>
                        <a class="btn btn-primary" href="{{route('generateSitemap')}}">@lang('main.update link')</a>
                    </div>
                    <div class="copy_txt d-none" >
                        <span> @lang('main.link copied to clipboard')</span>
                    </div>
                  
             </div>
         </div>
         <div class="card">
             <div class="card-header d-flex justify-content-between">
                 <div class="header-title">
                     <h4 class="card-title">@lang('main.edit')</h4>
                 </div>
             </div>
             @include('admin.layouts.alerts')

             <div class="card-body">
                  <form method="post" action="{{route('settings.updateSeo')}}" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                     <div class="row gy-4">
                         <div class="col-md-6">
                             <label for="meta_title_ar"> @lang('main.meta_title_ar')</label>
                             <input type="text" name ="meta_title_ar" value="{{old('meta_title_ar',$settings->meta_title_ar)}}" class="form-control" id="meta_title_ar" placeholder="@lang('main.meta_title_ar')">
                         </div>
    
                         <div class="col-md-6">
                             <label for="meta_title_en"> @lang('main.meta_title_en')</label>
                             <input type="text" name ="meta_title_en" value="{{old('meta_title_en',$settings->meta_title_en)}}" class="form-control" id="meta_title_en" placeholder="@lang('main.meta_title_en')">
                         </div>
    
                         <div class="col-md-6">
                             <label for="meta_description_ar"> @lang('main.meta_description_ar')</label>
                             <textarea type="text" name ="meta_description_ar" class="form-control" id="meta_description_ar" placeholder="@lang('main.meta_description_ar')">{{old('meta_description_ar',$settings->meta_description_ar)}}</textarea>
                         </div>
                         <div class="col-md-6">
                             <label for="meta_description_en"> @lang('main.meta_description_en')</label>
                             <textarea type="text" name ="meta_description_en" class="form-control" id="meta_description_en" placeholder="@lang('main.meta_description_en')">{{old('meta_description_en',$settings->meta_description_en)}}</textarea>
                         </div>
    
                         <div class="col-md-12">
                             <label for="tags"> @lang('main.keywords')</label>
                             <input type="text" name ="keywords" class="form-control" id="tags" data-role="tagsinput" value="{{old('keywords',$settings->keywords)}}" placeholder="@lang('main.keywords')">
                         </div>
                     </div>                     
                     <button type="submit" class="btn btn-primary mt-4">@lang('main.save')</button>
                 </form>
             </div>
         </div>
        <!-- Page end  -->
    </div>
    </div>
</div>
@endsection
@push('custom-js')
 <script>
    $('#tags').tagsinput();

    function copyToClipboard(id) {
        document.getElementById(id).select();
        document.execCommand('copy');
        $('.copy_txt').fadeIn(500);
        $(".copy_txt").fadeOut(700);
    }
</script>
@endpush