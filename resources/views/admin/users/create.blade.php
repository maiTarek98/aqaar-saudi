@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                @include('admin.partials.breadcrumb')
            </div><!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                @include('admin.layouts.alerts')
                <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                    @csrf
                    @include('admin.users.form')
                </form>
                @if (Cache::get('vendor_created')) 
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    new bootstrap.Modal(document.getElementById('storeCreatedModal')).show();
                                });
                            </script>
                            @endif

                            <!-- Modal HTML -->
                            <div class="modal fade" id="storeCreatedModal" tabindex="-1" aria-labelledby="storeCreatedModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="storeCreatedModalLabel">@lang('main.pending_vendors.account created')</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="m-0">@lang('main.pending_vendors.account created successfull,would you like to do next')</p>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('stores.create',['user_id' => session('vendor_id')]) }}" class="btn btn-secondary">@lang('main.pending_vendors.add store')</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </section>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@push('custom-js')
<script type="text/javascript">
   $(document).ready(function () {
             $(document).on('change','#category-dd',function(e){
                var idcategory = $(e.target).val();
                $("#gate-dd").html('');
                $.ajax({
                    url: "{{url('admin/user-fetch-gate')}}",
                    type: "POST",
                    data: {
                        category_id: idcategory,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (data) {
                        $(".gates").html('');
                        $(".gates").html(data.options);
                    }
                });
            });
    });
</script>
@endpush