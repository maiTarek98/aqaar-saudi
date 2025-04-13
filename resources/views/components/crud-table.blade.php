<form class="table-filter d-flex gap-md-2 justify-content-between gap-1">
    <div class="col-auto">
        <button type="button" class="form-control" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        <i class="bi bi-funnel d-md-inline d-none"></i> @lang('main.search')
        </button>
    </div>
    <div class="d-flex gap-md-2 gap-1">
        <div class="col-auto">
            <select name="per_page" id="per_page" class="col-md-1 form-select">
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>@lang('main.number') : 10</option>
                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>@lang('main.number') : 20</option>
                <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>@lang('main.number') : 30</option>
                <option value="40" {{ request('per_page') == 40 ? 'selected' : '' }}>@lang('main.number') : 40</option>
                <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>@lang('main.all')</option>
            </select>
        </div>
        <div class="col-auto">
            <button id="sortButton" type="button" class="form-control" 
            @if(request('sortBy') === null) data-sort="asc" @else data-sort="{{request('sortBy')}}" @endif>
                <i id="sortIcon" class="bi {{ request('sortBy') === null ? 'bi-sort-numeric-down-alt' : (request('sortBy') == 'desc' ? 'bi-sort-numeric-down-alt' : 'bi-sort-numeric-down') }} d-md-inline d-none"></i>
                <span>@lang('main.sorting')  {{ request('sortBy') === null ? __('main.the latest') : (request('sortBy') == 'desc' ? __('main.the latest') : __('main.the oldest')) }} </span>
            </button>
        </div>

    </div>
</form>
@if(!empty($_GET) && count($_GET) > 0 && ! request('per_page') && ! request('page') && ! request('sortBy') && ! request('account_type') ) 
<div class="selected-filters">
    <span style="min-width: max-content;line-height: 2.1;">
        {{__('main.search')}}
        :</span>
    <ul id="selected-filters-list">
        @if(request('status'))
            <li data-filter="status">
                @if(request()->segment(2) == 'pending_vendors')
                    {{__('main.pending_vendors.'.request('status'))}}
                @else
                    {{__('main.'.request('status'))}}
                @endif
                <a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['status' => null])}}"><i class="fas fa-times"></i></a></li>    
        @endif
        @if(request('in_home'))
            <li data-filter="in_home">
                {{__('main.blogs.in_home')}}: {{__('main.'.request('in_home'))}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['in_home' => null])}}"><i class="fas fa-times"></i></a></li>    
        @endif
        @if(request('store_id'))
            <li data-filter="store_id">
                {{getStore(request('store_id'))->name}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['store_id' => null])}}"><i class="fas fa-times"></i></a></li>    
        @endif
        @if(request('category_id'))
            <li data-filter="category_id">
                {{getCategory(request('category_id'))->title}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['category_id' => null])}}"><i class="fas fa-times"></i></a></li>    
        @endif
        @if(request('is_viewed'))
            <li data-filter="is_viewed">
                {{__('main.is_viewed-'.request('is_viewed'))}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['is_viewed' => null])}}"><i class="fas fa-times"></i></a></li>    
        @endif
        @if(request('from_date'))
            <li data-filter="from_date">
                {{__('main.from_date')}} {{request('from_date')}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['from_date' => null])}}"><i class="fas fa-times"></i></a></li>    
        @endif
        @if(request('to_date'))
            <li data-filter="to_date">
                {{__('main.to_date')}} {{request('to_date')}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['to_date' => null])}}"><i class="fas fa-times"></i></a></li>    
        @endif

        @if(request('role'))
            <li data-filter="role">
                {{__('main.role')}} {{request('role')}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['role' => null])}}"><i class="fas fa-times"></i></a></li>    
        @endif
        @if(request('search'))
            <li data-filter="search"> {{__('main.search for')}} {{request('search')}} <a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['search' => null])}}"><i class="fas fa-times"></i></a></li>    
        @endif
    </ul>
        <a href="{{ request()->url() }}" id="clear-all-filters" class="btn btn-outline-danger">@lang('main.delete all filters')</a>
</div>
@endif
@php $model1 = $model; @endphp
<div class="table-responsive">
    <table class="data-table table mb-0 tbl-server-info text-center" id="">
        <thead class="bg-white text-uppercase">
        <tr>
            @if(request()->segment(2) == 'categorys' ||request()->segment(2) == 'products' )
            <th><i class="fa fa-sort text-muted"></i></th>
            @endif
            <th><input type="checkbox" id="master" class="sub_chk"></th>
            @foreach($fields as $field)
            <th>{{ ucfirst(__('main.'.$model.'.'.$field)) }}</th>
            @endforeach
            @if(request()->segment(3) != 'activity-logs')
            <th>@lang('main.actions')</th>
            @endif
        </tr>
        </thead>
        <tbody @if(request()->segment(2) == 'categorys' ||request()->segment(2) == 'products' ) id="tablecontents" @endif>
            @forelse($result as $item)
            <tr class="row1" data-id="{{ $item->id }}">
                @if(request()->segment(2) == 'categorys' ||request()->segment(2) == 'products' )
                <td><i class="fa fa-sort text-muted"></i></td>
                @endif
                @if(!(request()->segment(2) == 'users' && $item->id == 1))
                <td><input type="checkbox" class="sub_chk" data-id="{{ $item->id }}"></td>
                @else
                <td></td>
                @endif
                @foreach($fields as $field)
                @if ($field === 'username')
                <td>{{ $item->user?->name ?? 'N/A' }}</td>
                @elseif ($field === 'name_'.\App::getLocale())
                <td>
                    <p class="mb-1">{{ $item->name ?? 'N/A' }}</p>
                    @if(request()->segment(2) == 'products')
                    <small><i class="fa fa-star"></i>{{$item->avg_rate}}</small>
                    <small>({{$item->product_reviews()->count()}} @lang('main.products.no_reviews'))</small>
                    @endif
                </td>
                @elseif ($field === 'name')
                <td>
                    <p class="mb-0">{{ $item->name }}</p>
                    @if(request('account_type') == 'vendors' && $item->store()->exists())
                    <a class="small text-muted" href="{{route('stores.show',$item->store?->id)}}">
                        <i class="bi bi-shop"></i>
                        {{$item->store?->name}}
                    </a>
                    {{--<p class="status-tag accepted">@lang('main.stores.name')(<a href="{{route('stores.show',$item->store?->id)}}">{{$item->store?->name}}</a>)</p>--}}
                    @endif
                </td>
                
                @elseif ($field === 'storename')
                <td>{{ $item->store?->name ?? 'N/A' }}</td>
                @elseif ($field === 'stock')
                <td>{{ ($item->stock == 'on')? 'available':'not available' }}</td>
                @elseif ($field === 'childrens')

                <td><ul>
            @forelse($item->children as $child)
                <li>{{ $child }}</li>
                @empty
                -
            @endforelse
        </ul></td>
                @elseif ($field === 'comments')
                <td>{{ $item->comments?->count() ?? 'N/A' }}</td>
                @elseif ($field === 'mobile')
                <td><a href="tel:+0{{ $item->mobile }}">0{{ $item->mobile }}+</a></td>
                @elseif ($field === 'products')
                <td>{{ $item->products?->count() ?? 'N/A' }}</td>
                @elseif ($field === 'price')
                <td>{{ $item->price}} @lang('main.currency')</td>
                @elseif ($field === 'role')
                <td>@if ($item->roles->isNotEmpty() && request('account_type') != 'users')
                            {{ $item->roles->pluck('name')->join(', ') }}
                        @elseif(request('account_type') == 'users')
                        <span>@lang('main.user')</span>
                        @else
                            No Role
                        @endif</td>
                @elseif (($field === 'status' || $field === 'is_viewed') && request()->segment(2) != 'orders' && request()->segment(2) != 'pending_vendors'&& request()->segment(2) != 'locations')
                <td>
                    <form method="post" action="{{route($model.'.changeStatus',[$item->id, 'parent_id' => request('parent_id')])}}"> @csrf
                    <input type="checkbox" class="cm-toggle status-checkbox" data-url="{{route($model.'.changeStatus',$item->id)}}" data-id="{{ $item->id }}" id="customSwitch-{{$item->id}}" name="status" @if($item->status == 'show' || $item->is_viewed == 'yes') checked="" @endif>
                    {{--<label class="" for="customSwitch-{{$item->id}}"></label>--}}
                    </form>  
                </td>
                @elseif ($field === 'status' && request()->segment(2) == 'pending_vendors')
                <td>
                    {{ __('main.pending_vendors.'.$item->status)}}
                </td>
                @elseif($field === 'status')
                <td>
                    <div class="status-tag {{$item->status}}">
                        <i class="highlight"></i>
                        <p class="status-tag__txt">{{ __('main.orders.'.$item->status)}}</p>
                    </div>
                </td>
                @elseif ($field === $model.'_image')
                <td>
                    @if($item->getFirstMediaUrl($model.'_image','thumb'))
                    <img loading="lazy" class="cursor-img" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}"
                    id="image" src="{{$item->getFirstMediaUrl($model.'_image','thumb')}}" style="width:70px;"
                    alt="@lang('main.NoImageUploaded')">
                    @include('admin.components.modal_photo', [
                    'image' => $item->getFirstMediaUrl($model.'_image','thumb'),
                    'id' => $item->id,
                    ])
                    @else
                    <img loading="lazy" id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                    style=" width: 60px;">
                    @endif
                </td>

                @else
                <td>{{ $item[$field] }}</td>
                @endif
                @endforeach
                @if(request()->segment(3) != 'activity-logs')
                <td>
                    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center gap-1">

                        @php
                        $query = http_build_query($queryParameters);
                        $editUrl = route($model.'.edit', $item->id) . ($query ? '?' . $query : '');
                        $showUrl = route($model.'.show', $item->id) . ($query ? '?' . $query : '');
        
                        @endphp
                        @if( request()->segment(2) == 'products')
        
                        {!! Form::open(['method' => 'POST', 'route' => [$model.'.cloneProduct',$item->id],'style' => 'display:inline',]) !!}
                        <button type="submit" class="btn btn-outline-success btn-sm show_dupconfirm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.duplicate product')"><i class="fa fa-copy mr-0"></i></button>
                        {!! Form::close() !!}
        
                        {{--@can($model1.'-list')
                        @if($item->status == 'show')
                        <a class="btn btn-sm btn-outline-info" target="_blank" href="{{url('/'.$model.'/'.$item->slug)}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.products.preview')"><i class="fa-solid fa-box-open"></i></a>
                        @else
                        <a class="btn btn-sm btn-outline-info" target="_blank" href="{{url('/'.$model.'/'.encrypt(strtolower($item->slug)))}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.products.preview')"><i class="fa-solid fa-box-open"></i></a>
                        @endif
                        @endcan --}}
                        @endif
                        @if(request()->segment(2) == 'stores')
                        @can('products-list')
                        <a href="{{route('products.index', ['store_id' => $item->id]) }}" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.show all products')"><i class="fa-solid fa-boxes-stacked"></i></a>
                        @endcan
                        @endif
        
                        @if(request()->segment(2) != 'subscribers' && request()->segment(2) != 'settings'  && request()->segment(2) != 'categorys' && request()->segment(2) != 'brands' )
                            @php if(request('account_type')){ $model1 =  request('account_type'); } @endphp 
                        @can($model1.'-list')
                        <a href="{{$showUrl}}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.show')"><i class="fa fa-eye mr-0"></i></a>
                        @endcan
                        @endif
        
                        @if(request()->segment(2) == 'settings')
                        @can($model1.'-list')
                        <a href="{{route($model.'.show', $item->id) }}" class="btn btn-outline-primary btn-sm"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.show product details')"><i class="fa fa-eye mr-0"></i></a>
                        @endcan
        
                        @can($model1.'-delete')
                        {!! Form::open(['method' => 'POST', 'route' => [$model.'.restore',$item->id],'style' => 'display:inline',]) !!}
                        <button type="submit" class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.recycle')"><i class="fa fa-recycle mr-0"></i></button>
                        {!! Form::close() !!}
        
        
                        {!! Form::open(['method' => 'DELETE', 'route' => [$model.'.destroy',$item->id],'style' => 'display:inline',]) !!}
                        <button type="submit" class="btn btn-outline-danger btn-sm show_confirm"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.delete')"><i class="fa fa-trash mr-0"></i></button>
                        {!! Form::close() !!}
        
                        @endcan
                        @else
                        
                        @can($model1.'-edit')
                        <a href="{{ $editUrl }}" class="btn btn-outline-warning btn-sm"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.edit')"><i class="fa fa-edit mr-0"></i></a>
                        @endcan
                        @can($model1.'-delete')
                            @if(!(request()->segment(2) == 'users' && $item->id == 1)  && !(request()->segment(2) == 'roles' && ($item->id == 1 || $item->id == 3 || $item->id == 4)) )
                            @if(request('account_type'))
                            {!! Form::open(['method' => 'DELETE', 'route' => [$model.'.destroy',[$item->id,'account_type' => request('account_type')]],'style' => 'display:inline',]) !!}
                            @else
                            {!! Form::open(['method' => 'DELETE', 'route' => [$model.'.destroy',$item->id],'style' => 'display:inline',]) !!}
                            @endif

                            <button type="submit" class="btn btn-outline-danger btn-sm show_confirm"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.delete')"><i class="fa fa-trash mr-0"></i></button>
                            {!! Form::close() !!}
                            @endif
                        @endcan
                        @endif
                    </div>
                </td>
                @endif
            </tr>
            @empty
            <td class="text-center text-muted" style="font-size: 25px" colspan="10">
                <i class="fa-regular fa-trash-can" style="
        font-size: 100px;
        color: #d3d3d3;
        display: block;"></i>            
                <h5>{{ trans('main.noData') }}</h5>
            </td>
            @endforelse
        </tbody>
    </table>
</div>
@if(request('per_page') != 'all' )
{{ $result->withQueryString()->links() }}
@endif