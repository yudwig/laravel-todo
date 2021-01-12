<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Todo</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
            html, body, a, input {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-size: 13px;
                font-weight: 600;
                word-break: break-all;
                line-height: 2.0;
                padding: 0 25px;
            }
        </style>
    </head>
    <body class="h-full">
        <div class="flex justify-center items-center text-center min-h-full py-32">
            <div>
                @if ($errors->has('title'))
                    <h3 class="text-red-400 text-2xl pb-4">{{ $errors->first('title') }}</h3>
                @endif
                @yield('content')
            </div>
        </div>
    </body>
</html>
