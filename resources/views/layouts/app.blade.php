<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}}</title>

    @yield('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->

</head>
<body>
@include('components.menu')
<div id="app">
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</div>
@include('components.footer')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('js')
</body>
</html>
