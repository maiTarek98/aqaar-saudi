@extends('site.index')
@section('title', trans('site.user-'.request('q')) )
@section('content')
      @include('site.includes.breadcrumb-section',['title' => trans('site.user-'.request('q'))])
    <section class="profile py-5">
      <div class="container-fluid">
        <!-- profile nav-sm -->
        <div class="profile-nav-sm rounded-3">
          <p class="m-0">@lang('main.profile')</p>
          <button class="btn toggle-profile-nav p-0 border-0 bg-transparent" data-toggle=".profile-nav">
            <img
            src="{{url('site')}}/images/menu.png"
            alt="menu icon"
          />
          </button>
        </div>

        <div class="row d-flex justify-content-between align-items-start">
        @include('site.includes.profile-menu')
        <!-- profile data col -->
        <div class="profile-data col col-md-7 col-lg-8">
            <div class="profile-wrapper p-0 bg-transparent">
              <div class="estate-filter d-flex flex-md-row flex-column align-items-center justify-content-between">
                <form method="GET" action="{{ route('allProperties', auth('web')->user()->id) }}" class="d-flex flex-md-row flex-column align-items-center justify-content-between w-100 gap-2">
                    <input type="hidden" name="q" value="{{ request('q', 'properties') }}">
                    <select name="filter" class="form-control" onchange="this.form.submit()">
                        <option value="">@lang('site.property type')</option>
                        <option value="auction" {{ request('filter') == 'auction' ? 'selected' : '' }}>{{ __('main.products.auction') }}</option>
                        <option value="investment" {{ request('filter') == 'investment' ? 'selected' : '' }}>{{ __('main.products.investment') }}</option>
                        <option value="shared" {{ request('filter') == 'shared' ? 'selected' : '' }}>{{ __('main.products.shared') }}</option>
                    </select>
                    @if(request('q') == 'properties')
                    <div class="builder-option d-flex gap-2">
                        <input name="purpose" type="radio" class="btn-check" id="accepted" value="accepted"
                               autocomplete="off" onchange="this.form.submit()" {{ request('purpose', 'accepted') == 'accepted' ? 'checked' : '' }}>
                        <label class="btn" for="accepted">
                            <span>@lang('site.my propertys')</span>
                        </label>
                
                        <input name="purpose" type="radio" class="btn-check" id="pending" value="pending"
                               autocomplete="off" onchange="this.form.submit()" {{ request('purpose') == 'pending' ? 'checked' : '' }}>
                        <label class="btn" for="pending">
                            <span> @lang('site.my purposes')</span>
                        </label>
                    </div>
                    @endif
                </form>

              </div>

              <div class="our-estates">
                <div class="row gy-3 row-cols-1">
                  @forelse($properties as $property)
                    @include('site.includes.property-profile',['property' => $property])
                  @empty
                    <div class="col text-center m-auto">
                        <div class="py-5">
                          <p class="fw-bold fs-5">@lang('site.no data shown')</p>
                          <img class="w-100" src="{{ asset('images/empty-box.png') }}" >
                        </div>
                    </div>

                  @endforelse
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>            
                
@endsection
@push('custom-js')
@endpush