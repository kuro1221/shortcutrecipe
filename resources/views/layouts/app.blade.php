<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.8.95/css/materialdesignicons.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SGZ0S9D627"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-SGZ0S9D627');
    </script>
</head>

<body>
    <div id="app">
        <v-app color="#BFDCFA">
            @guest
            <guest-header-component></guest-header-component>
            @else
            <auth-header-component :auth_user="{{ $auth_user }}"></auth-header-component>
            @endguest
            @if (session('flash_message'))
            <div class="flash js-flash" role="alert">
                {{ session('flash_message') }}
            </div>
            @endif
            <v-content>
                <v-container>
                    @yield('content')
                </v-container>
            </v-content>
        </v-app>
    </div>
</body>

</html>