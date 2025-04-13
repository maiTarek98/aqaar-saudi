@extends('admin.index')
@push('custom-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
   
  </style>
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">

          <div id="reportrange" data-url="{{route('reports.'.request('type'),['vendor_id' => request('vendor_id'),'type'=>request('type'),'report_period' => 'between_dates','period' => 'between_dates'])}}" class="pull-left form-control" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
            <i class="fa fa-calendar"></i>
            <span></span> 
            <b class="caret"></b>
          </div>
          {{--@if(request('type'))
            <div class="header">
              
              <input type="text" id="date-range" data-url="{{route('reports.'.request('type'),['vendor_id' => request('vendor_id'),'type'=>request('type'),'report_period' => 'daily','period' => 'between_dates'])}}" @if(request('type') != 'users' &&  
              request('type') != 'products' &&  
              request('type') != 'stores')  class="d-none" @endif placeholder="اختر نطاق التاريخ" />
              @if(request('type') != 'users' && request('type') != 'stores')
              <select class="form-select" id="report-period">
                <option value="">تاريخ التقرير</option>
                <option value="{{route('reports.'.request('type'),['vendor_id' => request('vendor_id'),'type'=>request('type'),'report_period' => 'daily','period' => 'daily'])}}" @if(request('report_period') == 'daily') selected @endif>اليوم</option>
                <option value="{{route('reports.'.request('type'),['vendor_id' => request('vendor_id'),'type'=>request('type'),'report_period'=> 'yesterday','period' => 'yesterday'])}}" @if(request('report_period') == 'yesterday') selected @endif>بالأمس</option>
                <option value="{{route('reports.'.request('type'),['vendor_id' => request('vendor_id'),'type'=>request('type'),'report_period' => 'weekly','period' => 'weekly'])}}" @if(request('report_period') == 'weekly') selected @endif>الاسبوع الحالي</option>
                <option value="{{route('reports.'.request('type'),['vendor_id' => request('vendor_id'),'type'=>request('type'),'report_period' => 'last_week','period' => 'last_week'])}}" @if(request('report_period') == 'last_week') selected @endif>الاسبوع الماضي</option>
                <option value="{{route('reports.'.request('type'),['vendor_id' => request('vendor_id'),'type'=>request('type'),'report_period'=> 'last_month','period' => 'last_month'])}}" @if(request('report_period') == 'last_month') selected @endif>الشهر الماضي</option>
                <option value="{{route('reports.'.request('type'),['vendor_id' => request('vendor_id'),'type'=>request('type'),'report_period' => 'monthly','period' => 'monthly'])}}" @if(request('report_period') == 'monthly') selected @endif>هذا الشهر</option>
                <option value="{{route('reports.'.request('type'),['vendor_id' => request('vendor_id'),'type'=>request('type'),'report_period'=> 'yearly','period' => 'yearly'])}}" @if(request('report_period') == 'yearly') selected @endif>السنة الحالية</option>
                <option value="{{route('reports.'.request('type'),['vendor_id' => request('vendor_id'),'type'=>request('type'),'report_period'=> 'last_year','period' => 'last_year'])}}" @if(request('report_period') == 'last_year') selected @endif>السنة الماضية</option>
                <option value="{{route('reports.'.request('type'),['vendor_id' => request('vendor_id'),'type'=>request('type'),'report_period'=> 'between_dates','period' => 'between_dates'])}}" @if(request('report_period') == 'between_dates') selected @endif>تحديد الفتره</option>
              </select>
              @elseif(request('type') == 'stores')
              <select class="form-select" id="report-period">
                <option value="">تاريخ التقرير</option>
                <option value="{{route('reports.'.request('type'),['vendor_id' => request('vendor_id'),'type'=>request('type'),'report_period' => 'monthly','period' => 'monthly'])}}" @if(request('report_period') == 'monthly') selected @endif>هذا الشهر</option>
              </select>
              @endif
            </div>
          @endif--}}

          <div class="report-type">
              <div class="owl-carousel">
                <a href="{{route('reports.index',['type' => 'sales'])}}" class="info-box d-flex align-items-center gap-2 {{ request()->routeIs('reports.index') && request('type') === 'sales' ? 'active' : '' }}">
                  <span class="info-box-icon">
                    🛒
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text m-0">المبيعات</span>
                  </div>
                </a>

                <a href="{{route('reports.index',['type' => 'brands'])}}" class="info-box d-flex align-items-center gap-2 {{ request()->routeIs('reports.index') && request('type') === 'brands' ? 'active' : '' }}">
                  <span class="info-box-icon">
                    📎
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text m-0">البراندات</span>
                  </div>
                </a>

                <a href="{{route('reports.index',['type' => 'vendors'])}}" class="info-box d-flex align-items-center gap-2 {{ request()->routeIs('reports.index') && request('type') === 'vendors' ? 'active' : '' }}">
                  <span class="info-box-icon">
                    📎
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text m-0">التجار</span>
                  </div>
                </a>

                <a href="{{route('reports.index',['type' => 'products'])}}" class="info-box d-flex align-items-center gap-2 {{ request()->routeIs('reports.index') && request('type') === 'products' ? 'active' : '' }}">
                  <span class="info-box-icon">
                    👕  
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text m-0">المنتجات</span>
                  </div>
                </a>

                <a href="{{route('reports.index',['type' => 'users'])}}" class="info-box d-flex align-items-center gap-2 {{ request()->routeIs('reports.index') && request('type') === 'users' ? 'active' : '' }}">
                  <span class="info-box-icon">
                    👤  
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text m-0">العملاء</span>
                  </div>
                </a>

                <a href="{{route('reports.index',['type' => 'stores'])}}" class="info-box d-flex align-items-center gap-2 {{ request()->routeIs('reports.index') && request('type') === 'stores' ? 'active' : '' }}">
                  <span class="info-box-icon">
                    👤  
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text m-0">تحصيلات الشهرية </span>
                  </div>
                </a>
                
              </div>
          </div>

          <div class="sub-report" id="report-data"></div>
        </div>
    </div>
@endsection
@push('custom-js')
<script type="text/javascript">

  // $(document).ready(function () {
  //   $('#report-period').on('change', function () {
  //     var url = $(this).val(); 
  //     if (url) {
  //       $.ajax({
  //         url: url,
  //         type: 'GET',
  //         success: function (data) {
  //             $('#report-data').html(data); 
  //         },
  //         error: function (xhr, status, error) {
  //             console.error("There was an error:", error);
  //             $('#report-data').html("<p>حدث خطأ أثناء تحميل التقرير.</p>");
  //         }
  //       });
  //     }
  //   });
  //   if ($('#report-period').val()) {
  //       $('#report-period').trigger('change');
  //   }

  //   $('#date-range').on('apply.daterangepicker', function (ev, picker) {
  //     let startDate = picker.startDate.format('YYYY-MM-DD');
  //     let endDate = picker.endDate.format('YYYY-MM-DD');
  //     var url = $('#date-range').data('url'); 
  //     console.log(url)
  //     $.ajax({
  //         url: url,
  //         type: "GET",
  //         data: {
  //             start_date: startDate,
  //             end_date: endDate
  //         },
  //         success: function (response) {
  //             $('#report-data').html(response);
  //         },
  //         error: function (xhr, status, error) {
  //             console.error("Error occurred:", error);
  //         }
  //     });
  //   });
  // });

  $(document).ready(function () {
    $(function () {
      var lang = $('html').attr('lang') || 'en'; // تحديد لغة الموقع، الافتراضي "en"

      // تحديد نطاقات التواريخ حسب اللغة
      var ranges = lang === 'ar' ? {
        'اليوم': [moment(), moment()],
        'أمس': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'آخر 7 أيام': [moment().subtract(6, 'days'), moment()],
        'آخر 30 يومًا': [moment().subtract(29, 'days'), moment()],
        'هذا الشهر': [moment().startOf('month'), moment().endOf('month')],
        'الشهر الماضي': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      } : {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      };

      // إعدادات الترجمة بناءً على اللغة
      var localeSettings = lang === 'ar' ? {
        applyLabel: "تطبيق",
        cancelLabel: "إلغاء",
        fromLabel: "من",
        toLabel: "إلى",
        customRangeLabel: "مخصص",
        weekLabel: "أسبوع",
        daysOfWeek: ["أحد", "إثنين", "ثلاثاء", "أربعاء", "خميس", "جمعة", "سبت"],
        monthNames: ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"],
        firstDay: 6
      } : {
        applyLabel: "Apply",
        cancelLabel: "Cancel",
        fromLabel: "From",
        toLabel: "To",
        customRangeLabel: "Custom",
        weekLabel: "W",
        daysOfWeek: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
        monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        firstDay: 0
      };

      // تعيين تواريخ البداية والنهاية الافتراضية
      var start = moment().subtract(29, 'days');
      var end = moment();

      // وظيفة تحديث التاريخ في الواجهة
      function cb(start, end) {
        $('#reportrange span').html(start.locale(lang).format('MMMM D, YYYY') + ' - ' + end.locale(lang).format('MMMM D, YYYY'));

        // جلب رابط الطلب من `data-url`
        var url = $('#reportrange').data('url');

        if (url) {
          $.ajax({
            url: url,
            type: "GET",
            data: {
              start_date: start.format('YYYY-MM-DD'),
              end_date: end.format('YYYY-MM-DD')
            },
            success: function (response) {
              $('#report-data').html(response); // تحديث البيانات في الصفحة
            },
            error: function (xhr, status, error) {
              console.error("Error occurred:", error);
              $('#report-data').html("<p>حدث خطأ أثناء تحميل التقرير.</p>");
            }
          });
        }
      }

      // تهيئة Date Range Picker
      $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: ranges,
        locale: localeSettings
      }, cb);

      // تشغيل الوظيفة عند تحميل الصفحة لتحديث النص وجلب البيانات
      cb(start, end);
    });
  });
</script>



@endpush