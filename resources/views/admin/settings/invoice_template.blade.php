@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        </div>
        <div class="content">

            <h1>Create Invoice Template</h1>

            <form action="{{route('invoices.storeTemplate')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="1">
                <div class="form-group">
                    <label for="name">Template Name</label>
                    <input type="text" name="name" id="name" value="{{$template?$template->name:null}}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="html_template">HTML Content</label>
                    <textarea name="html_template" id="html_template" class="form-control" rows="10" required>{{$template?$template->html_template:null}}</textarea>
                </div>

                <div class="form-group">
                    <label for="css_styles">CSS Styles</label>
                    <textarea name="css_styles" id="css_styles" class="form-control" rows="5">{{$template?$template->css_styles:null}}</textarea>
                </div>

                <div class="form-group">
                    <label for="preview">Live Preview</label>
                    <div id="preview" style="border: 1px solid #ccc; padding: 10px; background-color: #f8f8f8;"></div>
                </div>

                <button type="submit" class="btn btn-primary">Save Template</button>
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