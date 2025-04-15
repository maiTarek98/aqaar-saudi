<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{app(App\Models\GeneralSettings::class)->site_name()}}</title> 
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" sizes="65x65" />
    <link rel="stylesheet" href="{{url('site')}}/css/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="{{url('site')}}/css/style.css" />
    <style>
      body {
        background :#fff !important;
      }
      .table {
        border: 0;
        width: 100%;
      }
      .invoice {
        padding: 2rem 0;
        background :#fff;
      }
     
      .invoice .invoice_header{
        display: -webkit-box; /* wkhtmltopdf uses this one */
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: justify; /* wkhtmltopdf uses this one */
        -webkit-justify-content: space-between;
        justify-content: space-between;
        -webkit-align-items: center;
        align-items: center;
        gap: 30px;
      }
      .invoice_logo img {
        width: 180px;
      }
      .invoice_header .table tr * {
        text-align: start;
        color: #888888 !important;
      }
      .table-responsive {
        padding: 2rem 0;
        margin: 2rem 0;
        border-top: 28px solid #a0cccf;
        border-bottom: 28px solid #a0cccf;
      }
      .table thead tr th {
        background: #e9e9e9;
      }
      .table tr * {
        text-align: center;
        padding: 10px;
        border: 0px solid transparent;
        padding-inline-end: 25px;
      }
      .table tr td:first-child,
      .table tr th:first-child {
        border-radius: 0 8px 8px 0;
      }
      .table tr td:last-child,
      .table tr th:last-child {
        border-radius: 8px 0 0 8px;
        color: #56878b;
      }
      .table-responsive .table tbody tr:nth-child(even) td {
        background: #f5f5f5;
      }
      .prices{
          width:38%;
          margin-right: auto;
      }
      .prices tbody tr,
      .invoice_num tbody tr,
      .client_detail tbody tr {
        background: transparent !important;
      }
      .prices tbody tr td {
        color: #56878b;
      }
      .prices tbody tr:last-of-type td {
        background-color: #56878b;
        color: #fff !important;
        font-weight: bold;
      }
      @media (max-width: 600px) {
        .invoice_logo img {
          width: 125px;
        }
      }
    </style>
  </head>
  <body>
    <main class="invoice">
      <div class="container-lg">
        <div class="invoice_header">
          <div class="invoice_logo">
            @if($invoice?->store->getFirstMediaUrl('stores_image','thumb'))
            <img loading="lazy" class="avatar" id="image" src="{{$invoice->store?->getFirstMediaUrl('stores_image','thumb')}}" style="width:70px;">
            @endif
            اسم المتجر : {{$invoice->store?->name}}
          </div>
          <div class="client_detail">
            <table class="table">
              <tbody>
                <tr>
                  <th>الاسم<htd>
                  @if(! $invoice->user_id)
                  <td>: {{$invoice->user_address?->username}}</td>
                  @else
                  <td>: {{$invoice->user?->name}} </td>
                  @endif
                  <th>رقم الاوردر</th>
                  <td>: #{{$invoice->order_no}}</td>
                  <th>البريد الإلكتروني</th>
                  <td>: #{{$invoice->user?->email}}</td>

                </tr>
                <tr>
                  <th>رقم الجوال</th>
                  @if(! ($invoice->user_id))
                  <td>: +20{{$invoice->user_address?->mobile}}</td>
                  @else
                  <td>: +20{{$invoice->user?->mobile}} </td>
                  @endif
                  <th>التاريخ</th>
                  <td>: {{$invoice->order_date}}</td>
                  <th>حالة الفاتورة</th>
                  <td>: {{__('main.orders.'.$invoice->status)}}</td>

                  <th>طريقة الدفع</th>
                  <td>: {{__('main.orders.'.$invoice->payment_type)}}</td>

                </tr>
                <tr>
                  <th>العنوان</th>
                  <td colspan="3">: @lang('site.country_name'): {{$invoice->user_address?->country_name}} , @lang('site.city_name'): {{$invoice->user_address?->city_name}}
                    @lang('site.street_name'): {{$invoice->user_address?->street_name}}, @lang('site.building_no'): {{$invoice->user_address?->building_no}}, @lang('site.floor_no'): {{$invoice->user_address?->floor_no}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <div class="container-lg">
          <table class="table">
            <thead>
              <tr>
                <th>المنتج</th>
                <th>الكمية</th>
                <th>السعر</th>
                <th>الاجمالي</th>
              </tr>
            </thead>
            <tbody>
            @foreach($invoice->carts as $key => $value)
              <tr>
                <td>{{$value->product?->name}}</td>
                <td>{{$value->qty}}</td>
                <td>{{$value->price}} L.E</td>
                <td>{{$value->total_price}} L.E</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="container-lg">
        <div class="prices col-sm-5 col-md-3 ms-auto">
          <table class="table">
            <tbody>
                  @php  if($invoice->coupon_id){ $total = $invoice->applied_coupon; }else{ $total= $invoice->grand_total; }
                            if($invoice->user_address && $total < 450){
                                $shipping_price = $invoice->user_address?->shipping_price;
                            }else{
                                $shipping_price = 0;
                            }
                     
                      @endphp
              <tr>
                <td>المجموع</td>
                <td>{{$invoice->grand_total}} L.E</td>
              </tr>
              <tr>
                <td>الخصم</td>
                <td>@if($invoice->coupon_id) {{ $invoice->grand_total - $invoice->applied_coupon}} @else 0 @endif L.E</td>
              </tr>
              @if($invoice->coupon_id)
              <tr>
                <td>الكوبون المستخدم</td>
                <td>{{ $invoice->coupon?->coupon_code}}</td>
              </tr>
              @endif
              <tr>
                <td>التوصيل</td>
                <td>{{$shipping_price}} L.E</td>
              </tr>
              <tr>
                <td>الاجمالي</td>
                <td>@if($invoice->coupon_id) {{$invoice->applied_coupon + $shipping_price}} @else {{$invoice->grand_total + $shipping_price}} @endif L.E</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
    <footer>
        @if($invoice->notes)
        <p>ملاحظات الفاتورة: {{$invoice->notes}}</p>
        @endif
        @if($invoice->store?->orders_return_period > 0)
        <p>يمكنك إرجاع الطلب في خلال مدة {{$invoice->store?->orders_return_period}} @lang('main.days')  من تاريخ إصدار الفاتورة</p>
        @endif
    </footer>
    <!-- jQuery script -->
    <script src="{{url('site')}}/js/jquery-3.6.0.min.js"></script>
    <!-- bootstrap script -->
    <script src="{{url('site')}}/js/bootstrap.bundle.min.js"></script>
  </body>
</html>


