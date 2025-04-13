@extends('admin.index')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid add-form-list">
            <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>
            <div class="content">
                @include('admin.layouts.alerts')
                <!-- <div class="card-body"> -->
                    <form data-toggle="validator" class="from-prevent-multiple-submits" method="post" action="{{ route('products.update',[$product->id,'parent_id' => request('parent_id')]) }}"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        @include('admin.products.form')
                    </form>
                <!-- </div> -->
            </div>
        <!-- Page end  -->
        </div>
    </div>
@endsection
@push('custom-js')
<script>
$(document).ready(function() {
    $('.upload__img-wrap').on('click', '.upload__img-close', function() {
        let $imgBox = $(this).closest('.col');
        let fileName = $imgBox.find('.img-bg').data('file');
        let productId = "{{ $product->id }}";
        if (confirm("Are you sure you want to delete this image?")) {
            $.ajax({
                url: "{{ route('product.image.delete') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    file_name: fileName
                },
                success: function(response) {
                    if (response.success) {
                        $imgBox.remove(); // Remove image from UI
                        alert("Image deleted successfully.");
                    } else {
                        alert("Failed to delete image.");
                    }
                },
                error: function() {
                    alert("Error deleting the image.");
                }
            });
        }
    });
});
</script>
@endpush