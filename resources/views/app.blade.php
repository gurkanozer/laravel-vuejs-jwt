<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;600&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
    </script>
    <link rel="stylesheet" href="{{ mix('backend/css/app.css') }}" />

    <title>{{env('APP_NAME')}}</title>
    <script>
        (function(){
            window.Laravel = {
                csrf_token:'{{csrf_token()}}'
            }
        })();
    </script>
</head>
<body>
    <div id="app">
        <master />
    </div>

    <script src="{{ mix('backend/js/app.js') }}"></script>
</body>
</html>