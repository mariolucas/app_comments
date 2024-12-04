<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
</head>
<body>

    <div class="container">
        @include('components.NavBar')
        @yield('content')
    </div>

    @authJwtWeb
        @include('components.FormComentario')
    @endauthJwtWeb

    <!-- <footer class="text-center"></footer> -->

    <script src="{{ asset('js/app.js') }}"></script>
</body>

@yield('script')

</html>