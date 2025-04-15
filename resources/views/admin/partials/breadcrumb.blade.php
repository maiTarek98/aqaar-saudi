@php
    $routeName = Route::currentRouteName();
    $segments = request()->segments(); 
    $entity = $segments[1] ?? '';

    $name = match ($entity) {
        'areas' => request('parent_id') ? __('main.area') : __('main.city'),
        'users' => __('main.'.request('account_type').'.'.request('account_type')),
        'categories' => request('parent_id') ? __('main.subcategory') : __('main.categorys.categorys'),
        default => trans('main.'.$entity.'.'.$entity),
    };
    $breadcrumb = [];
    for ($i = 1; $i < count($segments); $i++) {
        $url = url(implode('/', array_slice($segments, 0, $i + 1)));
        if ($segments[$i] === 'users' && request('account_type')) {
            $b_name = ucfirst(request('account_type'));
            $breadcrumb[] = ['name' => $b_name, 'url' => $url];
        }else{
            $breadcrumb[] = ['name' => ucfirst($segments[$i]), 'url' => $url];
        }
    }

    $isEditOrCreate = str_contains($routeName, 'create') || str_contains($routeName, 'edit');
    $buttonText = $isEditOrCreate ? __('main.showAll') : __('main.addNew');
    if(request()->segment(2) == 'contacts'|| request()->segment(2) == 'settings'|| request()->segment(2) == 'pages'){
        $buttonRoute = null;
    }else{
        if(request('account_type')){
            $buttonRoute = $isEditOrCreate ? route("$entity.index",['account_type' => request('account_type')]) : route("$entity.create",['account_type' => request('account_type')]);
        }else{
            if(request()->segment(2) == 'orders' && $isEditOrCreate == false && auth('admin')->user()->account_type != 'admins'){
                $buttonRoute = null;
            }else{
                $buttonRoute = $isEditOrCreate ? route("$entity.index") : route("$entity.create");
            }
        }
    }
    
@endphp


<div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="fs-6 fw-bold">@lang('main.dashboard')</a></li>
            @foreach ($breadcrumb as $key => $item)
                <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                    @if (!$loop->last)
                        @if(request('account_type'))
                        <a href="{{ $item['url'].'?account_type='.request('account_type') }}" class="fs-6 fw-bold">
                            {{ $key == 0
                                ? __('main.'.lcfirst($item['name']).'.'.lcfirst($item['name'])) 
                                :$item['name'] 
                            }}
                        </a>
                        @else
                        <a href="{{ $item['url'] }}" class="fs-6 fw-bold">
                            {{ $key == 0
                                ? __('main.'.lcfirst($item['name']).'.'.lcfirst($item['name'])) 
                                : $item['name']
                            }}
                        </a>
                        @endif
                    @else
                    @php
                        $segmentCount = count($segments);
                        $itemName = lcfirst($item['name']);

                        if ($segmentCount == 2 || ($segmentCount == 4 && $segments[3] != 'edit')) {
                            $translatedName = __('main.'.$itemName.'.'.$itemName);
                        } elseif (($segmentCount == 3 && $segments[2] == 'create') || ($segmentCount == 4 && $segments[3] == 'edit')) {
                            $translatedName = __('main.'.$itemName);
                        } else {
                            $translatedName = $itemName;
                        }
                    @endphp
                        {{ $translatedName}}
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
    @if($buttonRoute)
    <a href="{{ $buttonRoute }}" class="btn btn-primary d-flex align-items-center gap-1 add-list">
        <i class="fa-solid fa-plus"></i>
        <span>{{ $buttonText }} {{ $name }}</span>
    </a>
    @endif
</div>

@php
    $segments = array_slice(request()->segments(), 1);
    $url = url(implode('/', array_slice(request()->segments(), 0, 1))); 
@endphp