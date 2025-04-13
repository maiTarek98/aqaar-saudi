{{-- <button class="btn btn-secondary buttons-print" type="button" onClick="window.print()">
    <span><i class="fa fa-print"></i> @lang('طبع')</span>
</button>
<button class="btn btn-success buttons-excel" type="button">
    <span><i class="fa fa-file-excel"> </i> @lang('تصدير Excel')</span>
</button>
<button class="btn btn-primary buttons-pdf" type="button">
    <span><i class="fa fa-file-pdf"> </i> @lang('تصدير PDF')</span>
</button>
<button class="btn btn-success buttons-csv" type="button">
    <span><i class="fa fa-file-csv"> </i> @lang('تصدير CSV')</span>
</button> --}}
<button class="btn btn-sm btn-outline-danger deleteBtn delete_all" type="button" data-url="{{ $url }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="حذف الكل">
    <i class="fa fa-trash"></i>
    <span> @lang('main.delete') </span>
</button>
