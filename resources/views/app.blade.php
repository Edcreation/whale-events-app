<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Whale Tickets</title>
        @vite('resources/css/app.css')
        @vite('resources/css/tailwind.css')
    </head>
    <body>
        <div id="eddy"></div>
        @vite('resources/js/app.js')
    </body>
</html>