<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Marktplaats - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('partials.nav')
    <div class="content px-20">
        @yield('content')
    </div>
</body>


</html>