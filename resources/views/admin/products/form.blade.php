<input type="number" name="added_by" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>
<div class="row g-3 mb-4"> 
    <input type="hidden" name="page" value="{{ request('page') }}" class="form-control">

    @if(\Route::currentRouteName() == 'products.edit')
    <input type="hidden" class="product_id" value="{{$product->id}}">
    @endif
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">@lang('main.products.product_prices')</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm p-0 px-1 btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">   
                <div class="row g-3">
                    <div class="col-lg-7">
                        <div class="box-wrapper">
                            <label for="categorys_image" class="form-label">@lang('main.products.products_image') <span class="text-danger">*</span></label>
                            <div class="box">
                                <div class="js--image-preview">
                                    @if($product->getFirstMediaUrl('products_image','thumb'))
                                    <img loading="lazy" class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $product->id }}" id="image" src="{{$product->getFirstMediaUrl('products_image','thumb')}}" alt="@lang('main.NoImageUploaded')">
                                    @include('admin.components.modal_photo', [
                                    'image' => $product->getFirstMediaUrl('products_image','thumb'),
                                    'id' => $product->id,
                                    ])
                                    @endif
                                </div>
                                <div class="upload-options">
                                    <label>
                                        <input type="file" id="products_image" name="products_image" class="image-upload" accept="image/*" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.products.product_price')<span class="text-danger">*</span></label>
                            <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="category_id">
                                @lang('main.products.product_discount')</span>
                            </label>
                            <div class="input-group">
                                <input type="text" name="discount" id="discount" value="{{ old('discount', $product->discount) }}" class="form-control @error('discount') is-invalid @enderror" id="discount" placeholder="" >
                               
                                <select name="discount_type" id="discount_type" class="input-group-text form-control form-select"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.products.product_discount_type')" style="width: fit-content;flex: 0 2 auto;padding-inline-end: 2.2rem;">
                                    <option value="pound" {{ $product->discount_type == 'pound' ? 'selected' : '' }}>@lang('main.products.pound')</option>
                                    <option value="percent" {{ $product->discount_type == 'percent' ? 'selected' : '' }}>@lang('main.products.percent')</option>
                                </select>
                                
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <p id="error_percent_message" style="color: red; display: none;">⚠️ الخصم لا يمكن أن يكون أكثر من 100%</p>
                        <p id="error_message" style="color: red; display: none;">⚠️ الخصم لا يمكن أن يكون أكثر من سعر المنتج</p>
                    </div>
                    
                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.products.product_status') <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="show" {{ $product->status == 'show' ? 'selected' : '' }}>@lang('main.products.published')</option>
                                <option value="hide" {{ $product->status == 'hide' ? 'selected' : '' }}>@lang('main.products.inactive')</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>  

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>تحديد المنتج كـ <span class="text-danger">*</span></label>
                            <select name="tags[]" class="select2 form-control" multiple>
                                <option value="new_arrival" {{ $product->new_arrival == 'yes' ? 'selected' : '' }}>@lang('main.products.product_new_arrival')</option>
                                <option value="we_choose_for_u" {{ $product->we_choose_for_u == 'yes' ? 'selected' : '' }}>@lang('main.products.product_we_choose_for_u')</option>
                            </select>
                        </div>          
                    </div>
                    <div class="col-md-12">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center gap-2">
                                <label>@lang('main.products.stock') <span class="text-danger">*</span></label>
                                <input type="checkbox" class="cm-toggle" id="" name="stock" @if($product->stock == 'on') checked="" @endif>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="is_in_home"> @lang('main.products.is_in_home')</label><span class="text-danger">*</span>
                            <select name="is_in_home" class="form-select">
                                <option value="yes" @if($product->is_in_home == 'yes') selected @endif>@lang('main.yes')</option>
                                <option value="no" @if($product->is_in_home == 'no') selected @endif>@lang('main.no')</option>
                            </select>
                        </div>
                    </div> 
                </div>       
            </div>
        </div>

        {{--<div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">@lang('main.products.product_seo')</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm p-0 px-1 btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body"> 
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label>عنوان صفحة تعريفية (Page Title)</label>
                            <input class="form-control" type="text" id="pageTitle" name="page_title" value="{{old('page_title', $product->page_title)}}" placeholder="إمممم">
                        </div>
                    </div>
    
                    <div class="col-12">
                        <div class="form-group">
                            <label>رابط صفحة تعريفية (SEO Page URL)</label>
                            <input class="form-control" type="text" id="pageUrl" name="page_url" value="{{old('page_url', $product->page_url)}}" placeholder="">
                        </div>
                    </div>
    
                    <div class="col-12">
                        <div class="form-group">
                            <label>وصف صفحة تعريفية (Page Description)</label>
                            <textarea class="form-control" id="pageDescription" name="page_description" placeholder="سسسسسس">{{old('page_description', $product->page_description)}}</textarea>
                        </div>
                    </div>
    
                    <div class="col-12">
                        <div class="preview">
                            <p><strong>إمممم</strong></p>
                            <a href="#" id="previewUrl">
                                {{url('/products/')}}/
                            </a>
                            <p>سسسسسس</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}                             
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">@lang('main.products.product_informations')</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm p-0 px-1 btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body row g-3">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="store_id"> @lang('main.products.store')<span class="text-danger">*</span></label>
                        <select name="store_id" class="form-select store">
                            <option value="">@lang('main.choose')</option>
                            @foreach(\App\Models\Store::get() as $value)
                                <option value="{{$value->id}}" @if($value->id == old('store_id', $product->store_id)  || $value->id == request('store_id') || auth('admin')->user()->store?->id == $value->id) selected @endif >{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="category_id">
                            @lang('main.products.category')<span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <select name="category_id" class="form-select category">
                                <option value="">@lang('main.choose')</option>
                                @foreach(\App\Models\Category::whereNull('parent_id')->get() as $value)
                                    <option value="{{$value->id}}" @if($value->id == old('category_id', $product->category_id)) selected @endif >{{$value->title}}</option>
                                @endforeach
                            </select>
                            @if(auth('admin')->user()->account_type != 'vendors' && auth('admin')->user()->account_type != 'subadmins'  && \Request::route()->getName() == 'products.create')
                            <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.add new category')">
                                <a role="button" data-bs-toggle="modal" data-bs-target="#addNewCategory" >
                                    <i class="fas fa-plus"></i>
                                </a>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="category_id">
                            @lang('main.products.brand')<span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <select name="brand_id" class="form-control brand">
                                <option value="">@lang('main.choose')</option>
                                @foreach(\App\Models\Brand::get() as $value)
                                    <option value="{{$value->id}}" @if($value->id == old('brand_id', $product->brand_id)) selected @endif >{{$value->title}}</option>
                                @endforeach
                            </select>
                            @if(auth('admin')->user()->account_type != 'vendors' && auth('admin')->user()->account_type != 'subadmins'  && \Request::route()->getName() == 'products.create')
                            <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.add new brand')">
                                <a role="button" data-bs-toggle="modal" data-bs-target="#addNewBrand" >
                                    <i class="fas fa-plus"></i>
                                </a>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">                      
                    <div class="form-group">
                        <label>@lang('main.products.product_name') (@lang('main.ar'))<span class="text-danger">*</span></label>
                        <input type="text" name="name_ar" value="{{ old('name_ar', $product->name_ar) }}" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" placeholder="" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">                      
                    <div class="form-group">
                        <label>@lang('main.products.product_name') (@lang('main.en'))<span class="text-danger">*</span></label>
                        <input type="text" name="name_en" value="{{ old('name_en', $product->name_en) }}" class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">                      
                    <div class="form-group">
                        <label>@lang('main.products.product_overview') (@lang('main.ar'))</label>
                        <textarea type="text" name="overview_ar" class="form-control @error('overview_ar') is-invalid @enderror" id="overview_ar">{{ old('overview_ar', $product->overview_ar) }}</textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">                      
                    <div class="form-group">
                        <label>@lang('main.products.product_overview') (@lang('main.en'))</label>
                        <textarea type="text" name="overview_en" class="form-control @error('overview_en') is-invalid @enderror" id="overview_en">{{ old('overview_en', $product->overview_en) }}</textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">                      
                    <div class="form-group">
                        <label>@lang('main.products.product_sku') </label>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control @error('sku') is-invalid @enderror" id="sku" placeholder="" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">                      
                    <div class="form-group">
                        <label>@lang('main.products.product_barcode') </label>
                        <input type="text" name="barcode" value="{{ old('barcode', $product->barcode) }}" class="form-control @error('barcode') is-invalid @enderror" id="barcode" placeholder="" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">@lang('main.products.products_images')</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm p-0 px-1 btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="upload-wrapper mb-3">
                    <div class="upload__box">
                        <div class="upload__btn-box">
                            <button type="button" class="upload__btn d-inline-block">
                                <i class="bi bi-cloud-arrow-up fs-1"></i>
                                <h5 class="upload__box_title">
                                Drag and Drop Your Files to Start Transfer
                                </h5>
    
                                <p class="upload__box_text m-0">Or click here</p>
                                <input type="file" accept="images/*" name="document[]" multiple="" data-max_length="20" class="upload__inputfile">
                            </button>
                        </div>
                        
                        <div class="upload__img-wrap row g-3 row-cols-lg-5">
                            @if($product->getFirstMediaUrl('document','thumb'))
                                @foreach($product->getMedia('document') as $key => $media)
                                <?php $imageUrl=url('/storage/products_images/'.$media->id.'/'.$media->file_name);?>
                                <div class="col">
                                    <div class='upload__img-box'>
                                        <div 
                                        data-number='{{$key+1}}' 
                                        data-file='{{$media->file_name}}' 
                                        class='img-bg'>
                                            <div class='upload__img-close'></div>
                                            <img src="{{$imageUrl}}" >
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                {{--<div class="form-group">
                    <label>@lang('main.products.link_video')</label>
                    <textarea type="text" name="link_video" class="form-control @error('link_video') is-invalid @enderror" id="link_video">{{ old('link_video', $product->link_video) }}</textarea>
                    <div class="help-block with-errors"></div>
                </div>--}}
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">@lang('main.products.product_descriptions')</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm p-0 px-1 btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">    
                <div class="row g-3">
                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.products.product_description') (@lang('main.ar'))</label>
                            <textarea type="text" name="description_ar" class="form-control @error('description_ar') is-invalid @enderror" id="description_ar">{{ old('description_ar', $product->description_ar) }}</textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.products.product_description') (@lang('main.en'))</label>
                            <textarea type="text" name="description_en" class="form-control @error('description_en') is-invalid @enderror" id="description_en">{{ old('description_en', $product->description_en) }}</textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>                             
            </div>
        </div>
    </div>
</div>

<div class="order-action mt-4 d-flex gap-3 justify-content-center">                
    <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm"><i class="fa-regular fa-floppy-disk"></i> @lang('main.save')</button>
    <button type="reset" class="btn btn-danger px-5 rounded-pill shadow-sm"><i class="fa-solid fa-rotate-left"></i> @lang('main.reset')</button>
</div>
@push('custom-js')
<script type="text/javascript">
document.getElementById("discount").addEventListener("input", validateDiscount);
document.getElementById("discount_type").addEventListener("change", validateDiscount);

function validateDiscount() {
    let price = parseFloat(document.getElementById("price").value);
    let discount = parseFloat(document.getElementById("discount").value);
    let discountType = document.getElementById("discount_type").value;
    let errorMessage = document.getElementById("error_message");
    let errorPercentMessage = document.getElementById("error_percent_message");

    if (discountType === "percent") {
        errorMessage.style.display = "none";
        if (discount > 100) {
            errorPercentMessage.style.display = "block";
        } else {
            errorPercentMessage.style.display = "none";
        }
    } else if (discountType === "pound") {
        errorPercentMessage.style.display = "none";
        if (discount > price) {
            errorMessage.style.display = "block";
        } else {
            errorMessage.style.display = "none";
        }
    }
}

    function callAjax(){
        var priceParent = $('#div');
        $.ajax({
            url: "{{url('admin/fetch-subcategory')}}",
            type: "POST",
            async: true,
            data: {
                category_id: idproduct, 
                product_id: product,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (data) {
                $(priceParent).html('');
                $(priceParent).html(data.options);
            }
        });
    }

    if ($('select[name="category_id"]').val() != "0") {
        var idproduct = $('select[name="category_id"]').val();
        var product= $('.product_id').val();
        callAjax();
    }

    $(document).on('change', 'select[name="category_id"]' , function () {
        var idproduct = this.value;
        var priceParent = $('#div');
        var product= $('.product_id').val();
        $.ajax({
            url: "{{url('admin/fetch-subcategory')}}",
            type: "POST",
            async: true,
            data: {
                product_id: product,
                category_id: idproduct,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (data) {
                $(priceParent).html('');
                $(priceParent).html(data.options);
            }
        });
    });   

     $("input, textarea").on("input", function() {
        $(".preview").addClass("highlight-preview"); // Add class on input change
        
        let title = $("#pageTitle").val();
        let url = $("#pageUrl").val();
        let desc = $("#pageDescription").val();

        $(".preview strong").text(title || "عنوان تجريبي");
        $("#previewUrl").text(`{{url('/products/')}}/${url}`);
        $(".preview p:last-child").text(desc || "نص تجريبي");
    });
    $("input, textarea").on("blur", function() {
        $(".preview").removeClass("highlight-preview");
    });

</script>
@endpush