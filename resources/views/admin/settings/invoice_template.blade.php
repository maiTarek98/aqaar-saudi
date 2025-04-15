@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    @include('admin.partials.breadcrumb')
                </div>
            </div>
        </div>
        <div class="content">
            <form action="{{route('invoices.storeTemplate')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="1">
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Template Name</label>
                            <input type="text" name="name" id="name" value="{{$template?$template->name:null}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="html_template">HTML Content</label>
                            <textarea name="html_template" id="html_template" class="form-control" dir="ltr" rows="10" required>{{$template?$template->html_template:null}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="css_styles">CSS Styles</label>
                            <textarea name="css_styles" id="css_styles" class="form-control" dir="ltr" rows="10">{{$template?$template->css_styles:null}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="preview">Live Preview</label>
                            <div id="preview" style="border: 1px solid #ccc; padding: 10px; background-color: #f8f8f8;"></div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Save Template</button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('custom-js')
<script>
    function updatePreview() {
        const htmlContent = document.getElementById("html_template").value;
        const cssStyles = document.getElementById("css_styles").value;
        const preview = document.getElementById("preview");

            // Create a style element to inject CSS
        const styleElement = document.createElement("style");
        styleElement.textContent = cssStyles;

            // Clear any previous content inside the preview and add the new content
        preview.innerHTML = '';

            // Append the style element and HTML content to the preview
        preview.appendChild(styleElement);
        preview.innerHTML += htmlContent;
    }

        // Add event listeners to the HTML and CSS input fields
    document.getElementById("html_template").addEventListener("input", updatePreview);
    document.getElementById("css_styles").addEventListener("input", updatePreview);

        // Initialize preview on page load
    updatePreview();
</script>
@endpush