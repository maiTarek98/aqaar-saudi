<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Simple Transactional Email</title>
    <style>
      /* All the styling goes here */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%;
      }
      * {
        box-sizing: border-box;
        text-align: right;
      }
      body {
        background: #f3f3f3 !important;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 20px;
        text-align: right;
        direction: rtl;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }

      table {
        background: #fff !important;
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        min-width: 100%;
        margin: auto;
        text-align: right;
        direction: rtl;
      }

      table th {
        background-color: #ff9d4d;
        color: #fff;
        padding: 10px;
      }
      table tr .s_br {
        border-radius: 0 5px 5px 0;
      }
      table tr .e_br {
        border-radius: 5px 0 0 5px;
      }
      table td {
        font-family: sans-serif;
        font-size: 14px;
        vertical-align: middle;
        padding: 10px;
        border-bottom: 1px solid #ddd;
      }
      table td.title {
        font-weight: bold;
        color: #ff9d4d;
      }
      table tr.br_0 td {
        border-color: transparent;
      }

      table.Summary tr.total {
        background: #ff9d4d3b;
      }

      table td * {
        font-size: 14px;
        color: #020202;
        
      }
      table h5 {
        color: #ff9d4d;
        margin: 0 0 6px 0;
      }
      table p {
        margin-bottom: 5px;
      }
      table p:last-child {
        margin-bottom: 0;
      }

      /* Body & Container */
      .body {
        background-color: #fff !important;
        min-width: 100%;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 0 4px #ffffff60;
      }

      .container {
        display: block;
        margin: 0 auto !important;
        max-width: 580px;
        padding: 10px;
        width: 580px;
      }

      .content {
        box-sizing: border-box;
        display: block;
        margin: 0 auto;
        max-width: 580px;
        padding: 10px;
      }

      /* Header, Footer, Main */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%;
      }

      .wrapper {
        box-sizing: border-box;
        padding: 20px;
      }

      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }

      .footer {
        clear: both;
        margin-top: 10px;
        text-align: center;
        width: 100%;
      }
      .footer td,
      .footer p,
      .footer span,
      .footer a {
        color: #999999;
        font-size: 12px;
        text-align: center;
      }
      .footer .body {
        padding: 0rem;
        margin-top: 0.5rem;
      }
      /*.center img , .center h3{*/
      /*    text-align: center*/
      /*}*/
      .center{
        display: -webkit-box; /* wkhtmltopdf uses this one */
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: justify; /* wkhtmltopdf uses this one */
        -webkit-justify-content: space-between;
        justify-content: space-between;
        -webkit-align-items: center;
        align-items: center;
        gap: 8px;
        direction : rtl;
      }
      .h_logo{
         width: 50px; 
         margin-left: 8px;
      }
      .footer img{
          width: 50px;
      }

      /* Typography */
      h1,
      h2,
      h3,
      h4 {
        color: #000;
        font-weight: bold;
        font-family: sans-serif;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 30px;
      }
      h3 {
        color: #ff9d4d;
        margin: 16px 0;
        padding: 5px 0;
        border-bottom: 2px dashed #ff9d4d;
      }
      h3.brd-0{
          border: unset;
      }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize;
      }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        margin-bottom: 15px;
      }
      p li,
      ul li,
      ol li {
        list-style-position: inside;
        margin-right: 5px;
      }

      a {
        color: #3498db;
        text-decoration: underline;
      }

      /* Buttons */
      .btn {
        box-sizing: border-box;
        width: 100%;
      }
      .btn > tbody > tr > td {
        padding-bottom: 15px;
      }
      .btn table {
        width: auto;
      }
      .btn table td {
        background-color: #ffffff;
        border-radius: 5px;
        text-align: center;
      }
      .btn a {
        background-color: #ffffff;
        border: solid 1px #3498db;
        border-radius: 5px;
        box-sizing: border-box;
        color: #3498db;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        font-weight: bold;
        margin: 0;
        padding: 12px 25px;
        text-decoration: none;
        text-transform: capitalize;
      }

      .btn-primary table td {
        background-color: #3498db;
      }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff;
      }

      /* Responsive and Mobile Friendly Styles */
      @media only screen and (max-width: 620px) {
        table.body h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important;
        }
        table.body p,
        table.body ul,
        table.body ol,
        table.body td,
        table.body span,
        table.body a {
          font-size: 16px !important;
        }
        table.body .wrapper,
        table.body .article {
          padding: 10px !important;
        }
        table.body .content {
          padding: 0 !important;
        }
        table.body .container {
          padding: 0 !important;
          width: 100% !important;
        }
        table.body .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important;
        }
        table.body .btn table {
          width: 100% !important;
        }
        table.body .btn a {
          width: 100% !important;
        }
        table.body .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important;
        }
      }

      /* Preserve these styles in the head */
      @media all {
        .ExternalClass {
          width: 100%;
        }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%;
        }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important;
        }
        #MessageViewBody a {
          color: inherit;
          text-decoration: none;
          font-size: inherit;
          font-family: inherit;
          font-weight: inherit;
          line-height: inherit;
        }
        .btn-primary table td:hover {
          background-color: #34495e !important;
        }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important;
        }
      }
    </style>
  </head>
  <body>
    <!-- <span class="preheader">Your order has been confirmed</span> -->
    @php
        $settings = app(App\Models\GeneralSettings::class);
        $logoUrl = asset('storage'.$settings->logo);
        $siteName = $settings->site_name;
    @endphp
    
    <h3 class="center">
        <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h_logo"/>
        <p>
           طلب رقم
           <br>
           #{{$cart->order_no}}
        </p>
    </h3>
    
    <div role="presentation" class="body" cellspacing="0" cellpadding="0">
        <p> تم استلام طلب بيع سيارة من 
        </p>
        <ul>
            <li>صاحب السيارة : {{$cart->name}}</li>
            <li>رقم صاحب السيارة : {{$cart->mobile}}</li>
            <li>مكان فحص السيارة : {{$cart->city?->city_name}}</li>
            <li>ماركة السيارة : {{$cart->car_brand?->brand_name}}</li>
            <li>موديل السيارة : {{$cart->car_model?->model_name}}</li>
            <li>فئة السيارة : {{$cart->car_category?->model_name}}</li>
            <li>تاريخ موعد فحص السيارة : {{$cart->inspection_date}}</li>

        </ul>
    </div>
    

    @php
        $settings = app(App\Models\GeneralSettings::class);
        $logoUrl = asset('storage'.$settings->logo);
        $siteName = $settings->site_name;
    @endphp
    
    <div class="footer">
        <img src="{{ $logoUrl }}" alt="{{ $siteName }}" />
        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td class="content-block powered-by">
              Powered by <a href="{{ url('/') }}">{{$siteName}} Team</a>.
            </td>
          </tr>
        </table>
    </div>

  </body>
</html>
