<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <style>
        .row{
            padding: 2rem;
        }
        .count, .count-null{
            background: #c8e6c9;
            color: #263238;
            text-align: center;
            padding-top: 0.3rem;
            font-size:  0.7875rem;
            width: 1.8rem;
            height: 1.8rem;
        }
        .count-null{
            background: #e0e0e0;
        }
        table tbody tr td{
            font-size:  0.7875rem;
        }
        button{
            color: white !important;
        }
    </style>
</head>
<body>

    <main id="app">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
