<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="offcanvasRightLabel"><i class="bi bi-funnel"></i> @lang('main.search')</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>
        <form action="{{ $route }}" method="get" class="filter-form">
            <div class="row g-3 row-cols-1 align-items-end">
                @if(request()->segment(2) == 'reports' || request()->segment(2) == 'orders')
                <input type="hidden" name="type" value="{{isset($type)}}">
                <input type="hidden" name="report_period" value="{{isset($report_period)}}">
                <div class="col">
                    <label for="store_id">@lang('main.store_name')</label>
                    <select class="form-select" name="store_id" id="store_id">
                        <option value="" hidden>@lang('main.store_name')</option>
                        @foreach(\App\Models\Store::get() as $store)
                        <option value="{{$store->id}}" @if($store->id == request()->store_id) selected @endif>{{$store->name}}</option>
                        @endforeach
                    </select>        
                </div>
        
                <div class="col">
                    <label for="vendor_id">@lang('main.vendor_name')</label>
                    <select class="form-select" name="vendor_id" id="vendor_id">
                        <option value="" hidden>@lang('main.vendor_name')</option>
                        @foreach(\App\Models\User::has('store')->where('account_type','vendors')->get() as $vendor)
                        <option value="{{$vendor->id}}" @if($vendor->id == request()->vendor_id) selected @endif>{{$vendor->name}}</option>
                        @endforeach
                    </select>        
                </div>
                @endif
                @if(request()->segment(2) == 'products')
                <div class="col">
                    <label for="store_id">@lang('main.store_name')</label>
                    <select class="form-select" name="store_id" id="store_id">
                        <option value="" hidden>@lang('main.store_name')</option>
                        @foreach(\App\Models\Store::get() as $store)
                        <option value="{{$store->id}}" @if($store->id == request()->store_id) selected @endif>{{$store->name}}</option>
                        @endforeach
                    </select>        
                </div>

                <div class="col">
                    <label for="subcategory_id">@lang('main.category_name')</label>
                    <select class="form-select" name="category_id" id="category_id">
                        <option value="" hidden>@lang('main.category_name')</option>
                        @foreach((new class { use \App\Http\Traits\VendorStoreTrait; })->getCategories() as $category)
                        <option value="{{$category->id}}" @if($category->id == request()->category_id) selected @endif>{{$category->title}}</option>
                        @endforeach
                    </select>        
                </div>
        
                {{--<div class="col">
                    <label for="subcategory_id">@lang('main.subcategory_name')</label>
                    <select class="form-select" name="subcategory_id" id="subcategory_id">
                        <option value="" hidden>@lang('main.subcategory_name')</option>
                        @foreach(\App\Models\Category::whereNotNull('parent_id')->get() as $subcategory)
                        <option value="{{$subcategory->id}}" @if($subcategory->id == request()->subcategory_id) selected @endif>{{$subcategory->title}}</option>
                        @endforeach
                    </select>        
                </div> --}}
                
                @endif
                
                 @if(request()->segment(2) == 'pending_vendors')
                <div class="col">
                    <label for="status">@lang('main.filterByVendorStatus')</label>
                    <select class="form-select" name="status" id="status">
                        <option value="" hidden>@lang('main.filterBy')</option>
                        <option @if('pending' == request()->status) selected @endif value="pending">@lang('main.pending_vendors.pending')</option>
                        <option @if('accepted' == request()->status) selected @endif value="accepted">@lang('main.pending_vendors.accepted')</option>
                    </select>        
                </div>
                @endif
                @if(request()->segment(2) != 'reports' && request()->segment(2) != 'contacts' && request()->segment(2) != 'pending_vendors' && request()->segment(2) != 'orders' && request()->segment(2) != 'users' && request()->segment(2) != 'roles')
                <div class="col">
                    <label for="status">@lang('main.filterByStatus')</label>
                    <select class="form-select" name="status" id="status">
                        <option value="" hidden>@lang('main.filterBy')</option>
                        <option @if('show' == request()->status) selected @endif value="show">@lang('main.show')</option>
                        <option @if('hide' == request()->status) selected @endif value="hide">@lang('main.hide')</option>
                    </select>        
                </div>
                @endif
                @if(request()->segment(2) != 'pages' && request()->segment(2) != 'stores' && request()->segment(2) != 'users' && request()->segment(2) != 'pending_vendors'&& request()->segment(2) != 'reports' && request()->segment(2) != 'contacts' && request()->segment(2) != 'orders' && request()->segment(2) != 'roles')
                <div class="col">
                    <label for="in_home">@lang('main.filterByHome')</label>
                    <select class="form-select" name="in_home" id="in_home">
                        <option value="" hidden>@lang('main.filterBy')</option>
                        <option @if('yes' == request()->in_home) selected @endif value="yes">@lang('main.yes')</option>
                        <option @if('no' == request()->in_home) selected @endif value="no">@lang('main.no')</option>
                    </select>        
                </div>
                @endif
                
                @if(request()->segment(2) == 'contacts' )
                <div class="col">
                    <label for="is_viewed">@lang('main.filterByViewes')</label>
                    <select class="form-select" name="is_viewed" id="is_viewed">
                        <option value="" hidden>@lang('main.filterBy')</option>
                        <option @if('yes' == request()->is_viewed) selected @endif value="yes">@lang('main.yes')</option>
                        <option @if('no' == request()->is_viewed) selected @endif value="no">@lang('main.no')</option>
                    </select>        
                </div>
                @endif
                @if(request()->segment(2) != 'reports')
                <div class="col">
                    <label for="country_id">@lang('main.searchKeyword')</label>
                    <input type="text" name="search" value="{{ request()->search }}" class="form-control"
                        placeholder="@lang('main.search')">
                </div>
                @endif
                @if(request()->segment(2) == 'users')
                <div class="col">
                    <input type="hidden" name="account_type" value="{{request()->account_type}}">
                    <label for="role">@lang('main.role_name')</label>
                    <select class="form-select" name="role" id="role">
                        <option value="">@lang('main.role_name')</option>
                        @foreach(\Spatie\Permission\Models\Role::get() as $role)
                        <option value="{{$role->name}}" @if($role->name == request()->role) selected @endif>{{$role->name}}</option>
                        @endforeach
                    </select>        
                </div>
                @if(request()->segment(2) != 'reports')
                <div class="col">
                    <label for="from_date">@lang('main.fromDate')</label>
                    <input type="date" name="from_date" id="from_date" value="{{ request()->from_date }}" class="form-control">
                </div>
                <div class="col">
                    <label for="to_date">@lang('main.toDate')</label>
                    <input type="date" name="to_date" id="to_date" value="{{ request()->to_date }}" class="form-control">
                </div>
                @endif
                @endif
                <div class="col">
                    <button type="submit" class="btn btn-primary w-100">
                        <li class="fa fa-search"></li>
                        <span>@lang('main.search')</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>