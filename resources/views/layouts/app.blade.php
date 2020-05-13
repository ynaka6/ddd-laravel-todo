<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">
        @yield('content')
    </div>
    <div
        x-data="
            {
                open: {{ Session::has('success') || Session::has('fail') ? 'true' : 'false' }},
                message: '{{ Session::get('success') ?? Session::get('fail') ?? '' }}'
            }
        "
        x-init="
            setTimeout(function() {
                open = false;
            }, 5000);
        "
        class="absolute bottom-0 w-full mb-16"
    >
        <div
            x-show="open && message.length > 0"
            x-text="message"
            class="max-w-md mx-auto bg-orange-500 shadow text-white rounded-md p-4"
            @click.away="open = false"
        ></div>
    </div>
</body>
</html>
