
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
  </head>
  <body>
    <main>
Hi, {{ $contact->email }}
<hr>

Reply to your message : {{ $contact->message }} 
<br>
our team reply : {!! $body !!}

<hr>
team  {{app(App\Models\GeneralSettings::class)->site_name()}} 
    </main>
  </body>
</html>