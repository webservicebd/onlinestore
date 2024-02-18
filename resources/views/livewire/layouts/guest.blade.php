<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        <link rel="apple-touch-icon" href="{{ asset('public/assets/img/apple-icon.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/img/favicon.ico') }}">

        <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/css/templatemo.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/css/fontawesome.min.css') }}">

        <!-- Load map styles -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
        <!-- Load fonts style after rendering the layout styles -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">

    </head>
    <body>

      {{ $slot }}

      <script type="module" src="{{ asset('public/build/assets/guest-mwoR4_mG.js') }}"></script>
    </body>
</html>
