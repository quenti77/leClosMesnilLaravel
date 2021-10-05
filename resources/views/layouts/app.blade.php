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
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/85260khgyt3z8u1tbp3820vnlqz4mcbhcz6xw0e5govencm7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#content',
            height: '800px',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help'
            ],
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | print preview media fullpage | ' +
                'forecolor backcolor emoticons | help',
            menu: {
                favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
            },
            menubar: 'favs file edit view insert format tools table help',
            content_css: 'css/content.css'
        });
    </script>
    <script type="text/javascript" src="{{ asset('js/updateEditComment.js') }}" defer></script>
</head>
<body>
<header class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @guest
                        @if (Route::has('login'))
                            <li class="me-0 mt-2 col-6">
                                <a type="button"
                                   class="btn-secondary-action col-12"
                                   href="{{ route('login') }}">Se connecter</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="me-0 mt-2 col-8">
                                <a type="button"
                                   class="btn-primary-action editLink text-decoration-none text-center col-10"
                                   href="{{ route('register') }}">Nous rejoindre!</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Déconnexion') }}
                                </a>
                                @if(auth()->user()->is_admin == 1)
                                <a class="dropdown-item" href="{{ route('admin.post.index') }}">Liste des posts</a>
                                <a class="dropdown-item" href="{{ route('admin.post.create') }}">Ecrire un article </a>
                                    <a class="dropdown-item"
                                       href="{{ route('admin.category.index') }}">Liste des catégories</a>
                                    <a class="dropdown-item"
                                       href="{{ route('admin.category.create') }}">Créer une catégorie</a>
                                @endif
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
<main class="container">
        @include('partials.flashMessage')
        @yield('content')
</main>
<footer class="mt-auto bg-primary text-white text-center text-lg-start">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Footer Content</h5>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                    molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
                    voluptatem veniam, est atque cumque eum delectus sint!
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Links</h5>
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#" class="text-white">Link 1</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Link 2</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Link 3</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Link 4</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-0">Links</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="#" class="text-white">Link 1</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Link 2</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Link 3</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Link 4</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
</footer>
</body>
</html>
