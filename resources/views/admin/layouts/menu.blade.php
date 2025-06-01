<!-- Main Sidebar Container -->
<aside class="main-sidebar">
    <!-- Brand Logo -->
    <!-- <a href="{{ url('/admin/dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">{{ app(App\Models\GeneralSettings::class)->site_name() }}</span>
    </a> -->

    <div style="padding: 0px 8px;">
        <a href="{{ url('/admin/dashboard') }}" class="brand-link">
            <img src="{{ url('/storage/' . app(App\Models\GeneralSettings::class)->favicon) }}" class="" style="
        width: 2.5rem !important;
        height: 2.5rem !important;
        filter: brightness(0) invert(1);
    ">
        <span class="brand-text font-weight-light">{{ app(App\Models\GeneralSettings::class)->site_name() }}</span></a>
        
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel d-flex align-items-center">
            @if(auth('admin')->user()->getFirstMediaUrl('photo_profile','thumb'))
            <img class="avatar" src="{{auth('admin')->user()->getFirstMediaUrl('photo_profile','thumb')}}" alt="admin image">
            @else
            <img class="avatar" src="{{ url('/dashboard') }}/dist/img/avatar5.png" alt="admin image">
            @endif
            <div class="info">
                @if(auth('admin')->user()->id == 1 )
                <a style="line-height: 45px;" href="{{ url('/admin/users/' . Auth::guard('admin')->user()->id.'/edit?account_type=admins') }}"
                class="d-block welcome">@lang('main.hello') / {{ Auth::guard('admin')->user()->name }}</a>
                @else
                <a style="line-height: 45px;" href="{{ url('/admin/users/' . Auth::guard('admin')->user()->id.'/edit/?account_type='.auth('admin')->user()->account_type) }}"
                class="d-block welcome">@lang('main.hello') / {{ Auth::guard('admin')->user()->name }}</a>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- الصفحة الرئيسيه --}}
                <li class="nav-item">
                    <a href="{{ url('/admin/dashboard') }}"
                        class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-house"></i>
                        <p>
                            @lang('main.dashboard')
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/dynamic_features') }}"
                        class="nav-link {{ request()->is('admin/dynamic_features') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-house"></i>
                        <p>
                            @lang('main.dynamic_features.dynamic_features')
                        </p>
                    </a>
                </li>
                @foreach(iconMenuLoop() as $value => $key)
                    @if(in_array($value, ['settings','pending_vendors','pages'])  && (Auth::guard('admin')->user()->can($value . '-create') || Auth::guard('admin')->user()->can($value . '-list')))
                        <li class="nav-item">
                            <a href="{{ url('/admin/' . $value) }}"
                                class="nav-link {{ request()->is('admin/'. $value . '*') ? 'active' : '' }}">

                                <i class="nav-icon {{$key}}"></i>
                                <p>
                                    {{__('main.'.$value.'.'.$value)}}
                                </p>
                            </a>
                        </li>
                    @else
                        @if (Auth::guard('admin')->user()->can($value . '-create') || Auth::guard('admin')->user()->can($value . '-list'))
                            <li class="nav-item has-treeview 
                                {{ (request()->is('admin/users*') && request()->query('account_type') === $value) || request()->is('admin/'.$value.'*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link 
                                    {{ (request()->is('admin/users*') && request()->query('account_type') === $value) || request()->is('admin/'.$value.'*') ? 'active' : '' }}">
                                    <i class="nav-icon {{$key}}"></i>
                                    <p>
                                        {{ __('main.'.$value.'.'.$value) }}
                                        <i class="fas fa-angle-down left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                   @can($value . '-list')
                                    @if(in_array($value, ['users', 'admins', 'vendors', 'subadmins']))
                                        <li class="nav-item">
                                            <a href="{{ url('/admin/users?account_type='.$value) }}" 
                                                class="nav-link 
                                                {{ request()->is('admin/users') && request()->query('account_type') === $value ? 'sub_active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('main.showAllData') }}</p>
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="{{ $value == 'products' 
                                                        ? url('/admin/products?form_type=add_property') 
                                                        : url('/admin/' . $value) }}" 
                                                class="nav-link 
                                                {{ 
                                                    ($value == 'products' && request()->is('admin/products') && request()->query('form_type') == 'add_property') ||
                                                    ($value != 'products' && request()->is('admin/'.$value.'*') && !request()->is('admin/'.$value.'/create')) 
                                                    ? 'sub_active' 
                                                    : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('main.showAllData') }}</p>
                                            </a>
                                        </li>
                                    @endif
                                @endcan


                                    @can($value . '-create')
                                        @if(in_array($value, ['users', 'admins', 'vendors', 'subadmins']))
                                            <li class="nav-item">
                                                <a href="{{ url('/admin/users/create?account_type='.$value) }}"
                                                    class="nav-link 
                                                    {{ request()->is('admin/users/create') && request()->query('account_type') === $value ? 'sub_active' : '' }}">
                                                    <i class="fas fa-plus nav-icon"></i>
                                                    <p>{{ __('main.addNew') }}</p>
                                                </a>
                                            </li>
                                        @else
                                            <li class="nav-item">
                                                <a href="{{ $value == 'products' 
                                                            ? url('/admin/products?form_type=add_property') 
                                                            : url('/admin/'.$value.'/create') }}"
                                                    class="nav-link 
                                                    {{ 
                                                        ($value == 'products' && request()->is('admin/products') && request()->query('form_type') == 'add_property') || 
                                                        ($value != 'products' && request()->is('admin/'.$value.'/create')) 
                                                        ? 'sub_active' 
                                                        : '' 
                                                    }}">
                                                    <i class="fas fa-plus nav-icon"></i>
                                                    <p>{{ __('main.addNew') }}</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endcan
                                </ul>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <div style="padding: 0px 8px;">
        <a href="{{ url('/admin/adminLogout') }}" class="brand-link logout py-0 border-0">
            <span class="brand-text w-100 font-weight-light">
                <i class="nav-icon bi bi-door-open-fill"></i>
                @lang('main.logout')
            </span>
        </a>
    </div>
    
</aside>

