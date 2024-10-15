<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Acursio JUBEL Store</title>
        @vite('resources/css/app.css')
    </head>

    <body class=" min-h-screen">
        <div id="app"></div>
        @vite('resources/js/app.js')
    </body>
</html>