<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>404</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1">

      @if (App::getLocale() == 'ar')
        <link rel="stylesheet" href="{{ url('/dashboard') }}/dist/css/bootstrap.rtl.min.css">
        @else
        <link rel="stylesheet" href="{{ url('/dashboard') }}/dist/css/bootstrap.min.css">
        @endif
    
        <!-- Font Awesome -->
        <link rel="icon" type="image/x-icon"
        href="{{ url('/storage/' . app(App\Models\GeneralSettings::class)->favicon) }}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('/dashboard') }}/dist/css/admin.css">
        <link rel="stylesheet" href="{{ url('/dashboard') }}/dist/css/custom.css">
        <style type="text/css">
            /*======================
                404 page
            =======================*/
            
            .page_404 {
                width: 60%;
                height: 100vh;
                margin: auto;
                text-align: center;
                background: #fff;
                font-family: "Arvo", serif;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .page_404 img {
                width: 100%;
            }

            .four_zero_four_bg {
                background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
                height: 60vh;
                background-position: center;
            }

            .four_zero_four_bg h1 {
                font-size: 100px;
            }

            .four_zero_four_bg h3 {
                font-size: 80px;
            }

            .contant_box_404 {
                margin-top: -70px;
            }
            .contant_box_404 h2{
                font-size: 3.5rem;
            }
            
            
            
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <section class="page_404">
                <div class="w-100">
                    <div class="four_zero_four_bg">
                        <h1 class="text-center ">404</h1>
                    </div>
                    
                    <div class="contant_box_404">
                        <h2>
                            Look like you're lost
                        </h2>
                    
                        <p class="fs-4 text-muted">the page you are looking for not avaible!</p>
                    
                        <a href="{{ url()->previous() }}" class="btn btn-primary fs-5 px-4">@lang('main.back')</a>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>