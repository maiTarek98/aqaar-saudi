<input type="number" name="added_by" value="{{ id('admin') }}" class="form-control" hidden>
    @if(request()->route()->getName() == 'blogs.edit')

<input type="number" name="blog_id" value="{{ $item->id }}" class="form-control" hidden>
@endif
<div class="row g-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">@lang('main.addNew') {{__('main.'.$model.'.'.$model)}} </h4>
                    </div>
                </div>
            @include('admin.layouts.alerts')
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-7 col-lg-auto">
                        <div class="box-wrapper">
                            <label for="logo" class="form-label">@lang('main.blogs.blogs_image') <span class="text-danger">*</span></label>
                            <div class="box">
                                <div class="js--image-preview">
                                    @if($item->getFirstMediaUrl('blogs_image','thumb'))
                                        <img src="{{$item->getFirstMediaUrl('blogs_image','thumb')}}">
                                    @endif
                                </div>
                                <div class="upload-options">
                                    <label>
                                        <input type="file" id="blogs_image" name="blogs_image" class="image-upload" accept="image/*" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-0 col-lg-6"></div>
                    
                    <div class="col-md-6">
                        <label for="name_ar"> @lang('main.blogs.name') @lang('main.ar')</label><span class="text-danger">*</span>
                        <input type="text" name="name_ar" value="{{ old('name_ar', $item->name_ar) }}"
                            class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" placeholder="">
                    </div>
                    <div class="col-md-6">
                        <label for="name_en"> @lang('main.blogs.name') @lang('main.en')</label><span class="text-danger">*</span>
                        <input type="text" name="name_en" value="{{ old('name_en', $item->name_en) }}"
                            class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="">
                    </div>
                    
                    
                    <div class="col-md-6">
                                          <label for="description_ar">@lang('main.blogs.description') (@lang('main.ar'))</label>
                                          <textarea rows="5" name="description_ar" class="form-control" id="description_ar" placeholder="">{{old('description_ar',$item->description_ar)}}</textarea>
                                        </div>
                    <div class="col-md-6">
                                          <label for="description_en">@lang('main.blogs.description') (@lang('main.en'))</label>
                                          <textarea rows="5" name="description_en" class="form-control" id="description_en" placeholder="">{{old('description_en',$item->description_en)}}</textarea>
                                        </div>
                    
                    <div class="form-group col-md-12">
                                          <label for="content_ar">@lang('main.blogs.content') (@lang('main.ar'))</label>
                                          <textarea rows="5" name="content_ar" class="form-control summernote" id="content_ar" placeholder="">{{old('content_ar',$item->content_ar)}}</textarea>
                                        </div>
                    <div class="form-group col-md-12">
                                          <label for="content_en">@lang('main.blogs.content') (@lang('main.en'))</label>
                                          <textarea rows="5" name="content_en" class="form-control summernote" id="content_en" placeholder="">{{old('content_en',$item->content_en)}}</textarea>
                                        </div>
                    
                    <div class="col-md-6">
                            <label for="status"> @lang('main.blogs.status')</label><span class="text-danger">*</span>
                            <select name="status" class="form-control">
                                <option value="show" @if($item->status == 'show') selected @endif>@lang('main.show')</option>
                                <option value="hide" @if($item->status == 'hide') selected @endif>@lang('main.hide')</option>
                            </select>
                        </div>
                    <div class="col-md-6">
                            <label for="in_home"> @lang('main.blogs.in_home')</label><span class="text-danger">*</span>
                            <select name="in_home" class="form-control">
                                <option value="yes" @if($item->in_home == 'yes') selected @endif>@lang('main.yes')</option>
                                <option value="no" @if($item->in_home == 'no') selected @endif>@lang('main.no')</option>
                            </select>
                        </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary float-start me-2">@lang('main.save')</button>
                        <button type="reset" class="btn btn-danger float-start">@lang('main.reset')</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">@lang('main.blogs.blog_seo')</h4>
                </div>
            </div>
            <div class="card-body"> 
                <div class="row g-3">
                    <div class="col-12">
                        <label>@lang('main.blogs.page_title') (Page Title)</label>
                        <input class="form-control" type="text" id="pageTitle" name="page_title" value="{{old('page_title', $item->blog_seo?->page_title)}}" placeholder="@lang('main.blogs.page_title')">
                    </div>
                    <div class="col-12">
                        <label>@lang('main.blogs.keywords') (Page Keywords)</label>
                        <input class="form-control" type="text" id="pageKeywords" name="keywords" value="{{old('keywords', $item->blog_seo?->keywords)}}" placeholder="@lang('main.blogs.keywords')">
                    </div>
                    <div class="col-12">
                        <label>رابط صفحة تعريفية (SEO Page URL)</label>
                        <input class="form-control" type="text" id="pageUrl" name="page_url" value="{{old('page_url', $item->blog_seo?->page_url)}}" placeholder="">
                    </div>
                    <div class="col-12">
                        <label>@lang('main.blogs.page_description') (Page Description)</label>
                        <textarea class="form-control" id="pageDescription" name="page_description" placeholder="@lang('main.blogs.page_description')">{{old('page_description', $item->blog_seo?->page_description)}}</textarea>
                    </div>
                    <div class="col-12">
                        <div class="preview">
                            <p><strong>{{old('page_title', $item->blog_seo?->page_title)}}</strong></p>
                            <a href="{{($item->blog_seo)? url('/blogs/').'/'.old('page_url', $item->blog_seo?->page_url) : '#'}}" id="previewUrl">
                            {{url('/blogs/')}}/{{old('page_url', $item->blog_seo?->page_url)}}</a>
                            <p>{{old('page_description', $item->blog_seo?->page_description)}}</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('custom-js')
<script type="text/javascript">
    $("input, textarea").on("input", function() {
        $(".preview").addClass("highlight-preview"); // Add class on input change
        
        let title = $("#pageTitle").val();
        let keywords = $("#pageKeywords").val();
        let url = $("#pageUrl").val();
        let desc = $("#pageDescription").val();

        $(".preview strong").text(title || "عنوان تجريبي");
        $("#previewUrl").text(`{{url('/blogs/')}}/${url}`);
        $(".preview p:last-child").text(desc || "نص تجريبي");
    });
    $("input, textarea").on("blur", function() {
        $(".preview").removeClass("highlight-preview");
    });
</script>
@endpush