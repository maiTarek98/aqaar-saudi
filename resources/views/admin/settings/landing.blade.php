@extends('admin.index')
@section('content')
 <div class="content-wrapper">
    <div class="container-fluid add-form-list">
        <div class="content-header">
            @include('admin.partials.breadcrumb')
        </div>
         <div class="card">
             <div class="card-header d-flex justify-content-between">
                 <div class="header-title">
                     <h4 class="card-title">@lang('main.edit')</h4>
                 </div>
             </div>
             @include('admin.layouts.alerts')

             <div class="card-body">
                  <form method="post" action="{{route('settings.updateLanding')}}" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                     <div class="row gy-4">
                        @if($value == 'banner')
                        <input type="hidden" name="type" value="banner">
                        
                        <div class="col-7 col-lg-auto">
                            <div class="box-wrapper">
                                <label for="banner_image" class="form-label">@lang('main.settings.banner_image') <span class="text-danger">*</span></label>
                                <div class="box">
                                    <div class="js--image-preview">
                                        @if (!empty($settings->banner_image))
                                        <img src="{{url('/storage/'.$settings->banner_image)}}">
                                        @endif
                                    </div>
                                    <div class="upload-options">
                                        <label>
                                            <input type="file" id="banner_image" name="banner_image" class="image-upload" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-0 col-lg-6"></div>
                        
                         <div class="col-md-6">
                             <label for="banner_title_ar"> @lang('main.settings.banner_title') (@lang('main.ar'))</label>
                             <input type="text" name ="banner_title_ar" value="{{old('banner_title_ar',$settings->banner_title_ar)}}" class="form-control" id="banner_title_ar" placeholder="@lang('main.settings.banner_title') (@lang('main.ar'))">
                         </div>
    
                         <div class="col-md-6">
                             <label for="banner_title_en"> @lang('main.settings.banner_title') (@lang('main.en'))</label>
                             <input type="text" name ="banner_title_en" value="{{old('banner_title_en',$settings->banner_title_en)}}" class="form-control" id="banner_title_en" placeholder="@lang('main.settings.banner_title') (@lang('main.en'))">
                         </div>
                        
                         <div class="col-md-6">
                             <label for="banner_text_ar"> @lang('main.settings.banner_text') (@lang('main.ar'))</label>
                             <textarea type="text" name ="banner_text_ar" class="form-control" id="banner_text_ar" placeholder="@lang('main.settings.banner_text') (@lang('main.ar'))">{{old('banner_text_ar',$settings->banner_text_ar)}}</textarea>
                         </div>
                         <div class="col-md-6">
                             <label for="banner_text_en"> @lang('main.settings.banner_text') (@lang('main.en'))</label>
                             <textarea type="text" name ="banner_text_en" class="form-control" id="banner_text_en" placeholder="@lang('main.settings.banner_text') (@lang('main.en'))">{{old('banner_text_en',$settings->banner_text_en)}}</textarea>
                         </div>
                    
                        @elseif($value == 'about')
                        <input type="hidden" name="type" value="about">
                        
                        <div class="col-7 col-lg-auto">
                            <div class="box-wrapper">
                                <label for="about_image" class="form-label">@lang('main.settings.about_image') <span class="text-danger">*</span></label>
                                <div class="box">
                                    <div class="js--image-preview">
                                        @if (!empty($settings->about_image))
                                        <img src="{{url('/storage/'.$settings->about_image)}}">
                                        @endif
                                    </div>
                                    <div class="upload-options">
                                        <label>
                                            <input type="file" id="about_image" name="about_image" class="image-upload" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-0 col-lg-6"></div>
                        
                         <div class="col-md-6">
                             <label for="about_title_ar"> @lang('main.settings.about_title') (@lang('main.ar'))</label>
                             <input type="text" name ="about_title_ar" value="{{old('about_title_ar',$settings->about_title_ar)}}" class="form-control" id="about_title_ar" placeholder="@lang('main.settings.about_title') (@lang('main.ar'))">
                         </div>
    
                         <div class="col-md-6">
                             <label for="about_title_en"> @lang('main.settings.about_title') (@lang('main.en'))</label>
                             <input type="text" name ="about_title_en" value="{{old('about_title_en',$settings->about_title_en)}}" class="form-control" id="about_title_en" placeholder="@lang('main.settings.about_title') (@lang('main.en'))">
                         </div>
                        
                         <div class="col-md-6">
                             <label for="about_text_ar"> @lang('main.settings.about_text') (@lang('main.ar'))</label>
                             <textarea type="text" name ="about_text_ar" class="form-control" id="about_text_ar" placeholder="@lang('main.settings.about_text') (@lang('main.ar'))">{{old('about_text_ar',$settings->about_text_ar)}}</textarea>
                         </div>
                         <div class="col-md-6">
                             <label for="about_text_en"> @lang('main.settings.about_text') (@lang('main.en'))</label>
                             <textarea type="text" name ="about_text_en" class="form-control" id="about_text_en" placeholder="@lang('main.settings.about_text') (@lang('main.en'))">{{old('about_text_en',$settings->about_text_en)}}</textarea>
                         </div>

                        @elseif($value == 'feature')
                        <input type="hidden" name="type" value="feature">
                        
                        <div class="col-7 col-lg-auto">
                            <div class="box-wrapper">
                                <label for="feature_image" class="form-label">@lang('main.settings.feature_image') <span class="text-danger">*</span></label>
                                <div class="box">
                                    <div class="js--image-preview">
                                        @if (!empty($settings->feature_image))
                                        <img src="{{url('/storage/'.$settings->feature_image)}}">
                                        @endif
                                    </div>
                                    <div class="upload-options">
                                        <label>
                                            <input type="file" id="feature_image" name="feature_image" class="image-upload" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-0 col-lg-6"></div>
                        
                         <div class="col-md-6">
                             <label for="feature_title_ar"> @lang('main.settings.feature_title') (@lang('main.ar'))</label>
                             <input type="text" name ="feature_title_ar" value="{{old('feature_title_ar',$settings->feature_title_ar)}}" class="form-control" id="feature_title_ar" placeholder="@lang('main.settings.feature_title') (@lang('main.ar'))">
                         </div>
    
                         <div class="col-md-6">
                             <label for="feature_title_en"> @lang('main.settings.feature_title') (@lang('main.en'))</label>
                             <input type="text" name ="feature_title_en" value="{{old('feature_title_en',$settings->feature_title_en)}}" class="form-control" id="feature_title_en" placeholder="@lang('main.settings.feature_title') (@lang('main.en'))">
                         </div>
                        
                         <div class="col-md-6">
                             <label for="feature_text_ar"> @lang('main.settings.feature_text') (@lang('main.ar'))</label>
                             <textarea type="text" name ="feature_text_ar" class="form-control summernote" id="feature_text_ar" placeholder="@lang('main.settings.feature_text') (@lang('main.ar'))">{{old('feature_text_ar',$settings->feature_text_ar)}}</textarea>
                         </div>
                         <div class="col-md-6">
                             <label for="feature_text_en"> @lang('main.settings.feature_text') (@lang('main.en'))</label>
                             <textarea type="text" name ="feature_text_en" class="form-control summernote" id="feature_text_en" placeholder="@lang('main.settings.feature_text') (@lang('main.en'))">{{old('feature_text_en',$settings->feature_text_en)}}</textarea>
                         </div>

                        @endif
                     </div>                     
                     <button type="submit" class="btn btn-primary mt-4">@lang('main.save')</button>
                 </form>
             </div>
         </div>
        <!-- Page end  -->
    </div>
      </div>
@endsection
