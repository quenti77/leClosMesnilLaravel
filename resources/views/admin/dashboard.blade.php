<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>Administration de LeClosMesnil</title>

    <meta name="description" content="Panneau d'administration du site LeClosMesnil">
    <meta name="author" content="Farcy Corentin">
    <meta name="robots" content="noindex, nofollow">

    @yield('css_before')

    <!-- Plugins -->
    <link rel="stylesheet" href="/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ mix('/css/codebase.css') }}">
    <link rel="stylesheet" id="css-admin" href="{{ mix('/css/admin.css') }}">

    @yield('css_after')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        String.prototype.ucwords = function () {
            str = this.toLowerCase()

            return str.replace(
                /(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
                function (s) { return s.toUpperCase() }
            )
        }
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token(), 'user' => auth()->user()]) !!};
    </script>

    <!-- Codebase Core JS -->
    <script src="{{ mix('js/codebase.app.js') }}" defer></script>

    <!-- Laravel Scaffolding JS -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/admin.js') }}" defer></script>

    @yield('js_after')
</head>

<body>
    <?php
    $classes = [
        'sidebar-o',
        'enable-page-overlay',
        'side-scroll',
        'page-header-modern',
        'main-content-boxed',
        'sidebar-dark',
        'page-header-dark',
        'dark-mode',
        'side-trans-enabled'
    ];
    ?>
    <div id="page-container" class="{{ implode(' ', $classes) }}"></div>
</body>

</html>
