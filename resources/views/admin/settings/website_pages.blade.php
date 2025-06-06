@extends('admin.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="content-header">
        @include('admin.partials.breadcrumb')
    </div>
    <!-- Content Header (Page header) -->
    <div class="content">
      <div class="row g-3">
        <div class="col-md-3 col-sm-6 col-12">
          <a href="{{route('settings.websitePages.data',['control'=>'banner'])}}" class="info-box text-center">
            <span class="info-box-icon mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="48" height="" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path d="M501.333 213.333h-192c-5.896 0-10.667 4.771-10.667 10.667s4.771 10.667 10.667 10.667h192c5.896 0 10.667-4.771 10.667-10.667s-4.771-10.667-10.667-10.667zM501.333 320H10.667A10.66 10.66 0 0 0 0 330.667a10.66 10.66 0 0 0 10.667 10.667h490.667a10.66 10.66 0 0 0 10.667-10.667A10.662 10.662 0 0 0 501.333 320zM330.667 426.667h-320A10.66 10.66 0 0 0 0 437.333 10.66 10.66 0 0 0 10.667 448h320a10.66 10.66 0 0 0 10.667-10.667 10.661 10.661 0 0 0-10.667-10.666zM309.333 128h192A10.66 10.66 0 0 0 512 117.333a10.66 10.66 0 0 0-10.667-10.667h-192a10.66 10.66 0 0 0-10.667 10.667A10.662 10.662 0 0 0 309.333 128zM10.667 256h234.667a10.66 10.66 0 0 0 10.667-10.667V74.667A10.662 10.662 0 0 0 245.333 64H10.667A10.66 10.66 0 0 0 0 74.667v170.667A10.66 10.66 0 0 0 10.667 256zm224-21.333H25.75l48.917-48.917 35.125 35.125c4.167 4.167 10.917 4.167 15.083 0s4.167-10.917 0-15.083l-3.125-3.125 48.917-48.917 64 64v16.917zM21.333 85.333h213.333v102.25l-56.458-56.458c-4.167-4.167-10.917-4.167-15.083 0l-56.458 56.458-24.458-24.458c-4.167-4.167-10.917-4.167-15.083 0l-45.792 45.792V85.333z" fill="#000000" opacity="1" data-original="#000000"></path><path d="M106.667 149.333c11.76 0 21.333-9.573 21.333-21.333s-9.573-21.333-21.333-21.333c-11.76 0-21.333 9.573-21.333 21.333s9.572 21.333 21.333 21.333zM117.333 128h-10.656s-.01-.01-.01-.021l10.666.021z" fill="#000000" opacity="1" data-original="#000000"></path></g></svg>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('main.settings.control banner')</span>
            </div>
          </a>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <!-- cache -->
        <div class="col-md-3 col-sm-6 col-12">
          <a href="{{route('settings.websitePages.data',['control'=>'feature'])}}" class="info-box text-center">
            <span class="info-box-icon mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="48" height="" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="m171.6 44.918-29.234-4.233a4.692 4.692 0 0 1-3.515-2.554l-13.071-26.54c-7.558-15.354-29.446-15.374-37.024-.031L75.623 38.138a4.65 4.65 0 0 1-3.503 2.538l-29.25 4.241c-16.931 2.446-23.708 23.275-11.454 35.209l21.197 20.666a4.656 4.656 0 0 1 1.343 4.116l-4.999 29.101c-2.899 16.936 14.908 29.704 29.968 21.76l26.188-13.785a4.64 4.64 0 0 1 4.331 0l26.079 13.754c15.196 7.992 32.868-4.914 29.98-21.752l-4.991-29.078a4.645 4.645 0 0 1 1.343-4.116l21.193-20.666c12.263-11.931 5.482-32.762-11.448-35.208zm.285 23.759-21.193 20.658a20.646 20.646 0 0 0-5.944 18.276h.004l4.987 29.078c.659 3.816-3.34 6.698-6.752 4.897l-26.079-13.754a20.664 20.664 0 0 0-19.249 0l-26.184 13.785c-3.439 1.798-7.397-1.117-6.752-4.905l4.999-29.101a20.65 20.65 0 0 0-5.94-18.268L42.581 68.677c-2.763-2.705-1.245-7.381 2.581-7.935l29.246-4.233a20.65 20.65 0 0 0 15.554-11.286l13.133-26.579c1.708-3.45 6.627-3.447 8.338.008l13.071 26.547a20.647 20.647 0 0 0 15.566 11.309l29.242 4.233c3.832.557 5.331 5.242 2.573 7.936z" fill="#000000" opacity="1" data-original="#000000" class=""></path><path d="M119.177 66.677 99.534 86.32l-4.241-4.241c-3.124-3.124-8.185-3.124-11.309 0s-3.124 8.185 0 11.309l9.896 9.896a7.995 7.995 0 0 0 11.309 0l25.298-25.298a7.995 7.995 0 0 0 0-11.309 7.996 7.996 0 0 0-11.31 0zM228.897 34.718H478.84c4.417 0 7.998-3.577 7.998-7.998s-3.581-7.998-7.998-7.998H228.897c-4.417 0-7.998 3.577-7.998 7.998s3.581 7.998 7.998 7.998zM478.839 71.122H228.897c-4.417 0-7.998 3.577-7.998 7.998s3.581 7.998 7.998 7.998H478.84a7.996 7.996 0 0 0 7.998-7.998 7.997 7.997 0 0 0-7.999-7.998zM228.897 139.517h177.826c4.417 0 7.998-3.577 7.998-7.998s-3.581-7.998-7.998-7.998H228.897c-4.417 0-7.998 3.577-7.998 7.998s3.581 7.998 7.998 7.998zM171.6 221.791l-29.234-4.233a4.692 4.692 0 0 1-3.515-2.554l-13.071-26.54c-7.553-15.358-29.448-15.37-37.025-.031l-13.133 26.579a4.65 4.65 0 0 1-3.503 2.538l-29.25 4.241c-16.93 2.446-23.707 23.275-11.453 35.209l21.197 20.666a4.656 4.656 0 0 1 1.343 4.116l-4.999 29.101c-2.904 16.963 14.934 29.69 29.968 21.76l26.188-13.785a4.64 4.64 0 0 1 4.331 0l26.079 13.754c15.196 7.992 32.868-4.914 29.98-21.752l-4.991-29.078a4.645 4.645 0 0 1 1.343-4.116L183.05 257c12.261-11.932 5.48-32.763-11.45-35.209zm.285 23.759-21.193 20.658a20.646 20.646 0 0 0-5.944 18.276h.004l4.987 29.078c.656 3.8-3.318 6.699-6.752 4.897l-26.079-13.754a20.664 20.664 0 0 0-19.249 0L71.475 318.49c-3.427 1.792-7.399-1.091-6.752-4.905l4.999-29.101a20.65 20.65 0 0 0-5.94-18.268L42.581 245.55c-2.763-2.705-1.245-7.381 2.581-7.935l29.246-4.233a20.65 20.65 0 0 0 15.554-11.286l13.133-26.571c1.703-3.452 6.629-3.463 8.338 0l13.071 26.547a20.647 20.647 0 0 0 15.566 11.309l29.242 4.233c3.832.557 5.331 5.242 2.573 7.936z" fill="#000000" opacity="1" data-original="#000000" class=""></path><path d="m119.177 243.558-19.639 19.643-4.241-4.249a8 8 0 0 0-11.313 0c-3.124 3.116-3.124 8.185-.004 11.309l9.896 9.904c3.112 3.112 8.178 3.135 11.313 0l25.298-25.298a7.995 7.995 0 0 0 0-11.309 7.996 7.996 0 0 0-11.31 0zM478.839 195.595H228.897c-4.417 0-7.998 3.577-7.998 7.998s3.581 7.998 7.998 7.998H478.84c4.417 0 7.998-3.577 7.998-7.998s-3.582-7.998-7.999-7.998zM478.839 247.995H228.897c-4.417 0-7.998 3.577-7.998 7.998s3.581 7.998 7.998 7.998H478.84c4.417 0 7.998-3.577 7.998-7.998s-3.582-7.998-7.999-7.998zM228.897 316.39h177.826c4.417 0 7.998-3.577 7.998-7.998s-3.581-7.998-7.998-7.998H228.897c-4.417 0-7.998 3.577-7.998 7.998s3.581 7.998 7.998 7.998zM171.6 398.664l-29.234-4.233a4.695 4.695 0 0 1-3.515-2.546l-13.071-26.547c-7.553-15.358-29.448-15.37-37.025-.031l-13.133 26.579a4.692 4.692 0 0 1-3.499 2.546l-29.254 4.233c-16.931 2.446-23.708 23.275-11.454 35.209l21.197 20.666a4.656 4.656 0 0 1 1.343 4.116l-4.999 29.101c-2.899 16.936 14.9 29.709 29.968 21.76l26.188-13.785a4.618 4.618 0 0 1 4.331.008l26.083 13.754c15.125 7.984 32.868-4.88 29.98-21.752l-4.991-29.086h-.004a4.645 4.645 0 0 1 1.343-4.116l21.193-20.666c12.264-11.933 5.483-32.764-11.447-35.21zm.285 23.759-21.193 20.658a20.646 20.646 0 0 0-5.944 18.276l4.995 29.086c.652 3.829-3.376 6.691-6.756 4.897l-26.079-13.754a20.618 20.618 0 0 0-19.249-.008l-26.184 13.785c-3.401 1.778-7.403-1.068-6.752-4.905l4.999-29.101a20.65 20.65 0 0 0-5.94-18.268l-21.201-20.666c-2.758-2.7-1.248-7.38 2.577-7.935l29.265-4.233a20.645 20.645 0 0 0 15.539-11.286l13.133-26.571c1.703-3.452 6.629-3.463 8.338 0l13.075 26.555a20.64 20.64 0 0 0 15.562 11.302l29.242 4.233c3.832.556 5.331 5.241 2.573 7.935z" fill="#000000" opacity="1" data-original="#000000" class=""></path><path d="m119.177 420.431-19.639 19.643-4.241-4.249a8 8 0 0 0-11.313 0c-3.124 3.116-3.124 8.185-.004 11.309l9.896 9.904c3.112 3.112 8.178 3.135 11.313 0l25.298-25.298a7.995 7.995 0 0 0 0-11.309 7.996 7.996 0 0 0-11.31 0zM478.839 372.468H228.897c-4.417 0-7.998 3.577-7.998 7.998s3.581 7.998 7.998 7.998H478.84c4.417 0 7.998-3.577 7.998-7.998s-3.582-7.998-7.999-7.998zM478.839 424.868H228.897c-4.417 0-7.998 3.577-7.998 7.998s3.581 7.998 7.998 7.998H478.84c4.417 0 7.998-3.577 7.998-7.998s-3.582-7.998-7.999-7.998zM406.723 477.267H228.897c-4.417 0-7.998 3.577-7.998 7.998s3.581 7.998 7.998 7.998h177.826c4.417 0 7.998-3.577 7.998-7.998s-3.582-7.998-7.998-7.998z" fill="#000000" opacity="1" data-original="#000000" class=""></path></g></svg>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('main.settings.control feature')</span>
            </div>
            <!-- /.info-box-content -->
          </a>
          <!-- /.info-box -->
        </div>


        <div class="col-md-3 col-sm-6 col-12">
          <a href="{{route('settings.websitePages.data',['control'=>'about'])}}" class="info-box text-center">
            <span class="info-box-icon mb-2">
                <svg class="stroke" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="48" height="" x="0" y="0" viewBox="0 0 512.002 512.002" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path d="M116.626 347.001h-36.5m-1.625 30.001v-60c0-11 9-20 20-20h0c11 0 20 9 20 20v60M416.001 300.065v76.937M398.501 297.002h35M258.501 297.002h0c11 0 20 9 20 20v40.001c0 11-9 20-20 20h0c-11 0-20-9-20-20v-40.001c0-11 9-20 20-20zM158.501 297.002h20c11 0 20 8.999 20 20h0c0 11-8.999 20-20 20 11 0 20 9 20 20h0c0 11-8.999 20-20 20h-20v-80zM163.251 337.002h15.25M358.501 297.002v60c0 11-9 20-20 20s-20-9-20-20v-60M310.896 425.692l-5.317-2.202c-9.986-4.135-21.539.649-25.674 10.635-4.136 9.985.649 21.538 10.634 25.674l5.317 2.202 5.318 2.202c9.984 4.136 14.77 15.689 10.634 25.674-4.135 9.986-15.689 14.771-25.674 10.635l-5.317-2.202M238.706 422.002v60c0 11-9 20-20 20s-20-9-20-20v-60M96.001 10h320v180h-115l-45 45-45-45h-115zM195.998 100h.007M255.997 100h.008M315.997 100h.008" style="fill-rule: evenodd; clip-rule: evenodd; stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 22.9256;" fill-rule="evenodd" clip-rule="evenodd" fill="none" stroke="#000000" stroke-width="20.0001px" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="22.9256" data-original="#000000"></path></g></svg>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('main.settings.control aboutus')</span>
            </div>
            <!-- /.info-box-content -->
          </a>
          <!-- /.info-box -->
        </div>
        
        
        <div class="col-md-3 col-sm-6 col-12">
          <a href="{{route('settings.websitePages.data',['control'=>'beneficiaries'])}}" class="info-box text-center">
            <span class="info-box-icon mb-2">
                <svg class="stroke" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="48" height="" x="0" y="0" viewBox="0 0 512.002 512.002" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path d="M116.626 347.001h-36.5m-1.625 30.001v-60c0-11 9-20 20-20h0c11 0 20 9 20 20v60M416.001 300.065v76.937M398.501 297.002h35M258.501 297.002h0c11 0 20 9 20 20v40.001c0 11-9 20-20 20h0c-11 0-20-9-20-20v-40.001c0-11 9-20 20-20zM158.501 297.002h20c11 0 20 8.999 20 20h0c0 11-8.999 20-20 20 11 0 20 9 20 20h0c0 11-8.999 20-20 20h-20v-80zM163.251 337.002h15.25M358.501 297.002v60c0 11-9 20-20 20s-20-9-20-20v-60M310.896 425.692l-5.317-2.202c-9.986-4.135-21.539.649-25.674 10.635-4.136 9.985.649 21.538 10.634 25.674l5.317 2.202 5.318 2.202c9.984 4.136 14.77 15.689 10.634 25.674-4.135 9.986-15.689 14.771-25.674 10.635l-5.317-2.202M238.706 422.002v60c0 11-9 20-20 20s-20-9-20-20v-60M96.001 10h320v180h-115l-45 45-45-45h-115zM195.998 100h.007M255.997 100h.008M315.997 100h.008" style="fill-rule: evenodd; clip-rule: evenodd; stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 22.9256;" fill-rule="evenodd" clip-rule="evenodd" fill="none" stroke="#000000" stroke-width="20.0001px" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="22.9256" data-original="#000000"></path></g></svg>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('main.settings.control beneficiaries')</span>
            </div>
            <!-- /.info-box-content -->
          </a>
          <!-- /.info-box -->
        </div>
      </div>
    </div><!-- /.content -->
  </div><!-- /.container-fluid -->
</div>
@endsection
@push('custom-js')

</script>
@endpush