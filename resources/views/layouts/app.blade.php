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
    <script src="https://cdn.tiny.cloud/1/85260khgyt3z8u1tbp3820vnlqz4mcbhcz6xw0e5govencm7/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
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
    <script type="text/javascript" src="{{ asset('js/passwordChecker.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/counterButton.js') }}" defer></script>
    @yield("scripts")
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
                            <li class="me-0 mt-2 col-4 col-lg-6">
                                <a type="button"
                                   class="btn-secondary-action col-12"
                                   href="{{ route('login') }}">Se connecter</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="me-0 mt-2 col-6 col-lg-8">
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
                                    <a class="dropdown-item" href="{{ route('admin.post.create') }}">Ecrire un
                                        article </a>
                                    <a class="dropdown-item"
                                       href="{{ route('admin.category.index') }}">Liste des catégories</a>
                                    <a class="dropdown-item"
                                       href="{{ route('admin.category.create') }}">Créer une catégorie</a>

                                    <a class="dropdown-item" href="{{ route('admin.season.index') }}">
                                        Liste des saisons
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.season.create') }}">
                                        Creation saison
                                    </a>
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
<main class="container-fluid">
    @include('partials.flashMessage')
    @yield('content')
</main>
<footer class="mt-auto bg-primary text-white text-center text-lg-start">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h3 class="fw-bold">Le Clos Mesnil</h3>
                <p class="text-start">
                    Fatigué du stresse de la ville, vous avez besoin d'un endroit calme et clos où vous relaxer,
                    le Clos Mesnil est l'endroit idéal pour vous détendre, le calme de la campagne vous apaisera et
                    vous pourrez profiter de la plage du Tréport pour faire une petite baignade ou vous baladez dans la
                    forêt d'Eu pour respirer l'air frais et écouter le gazouillis des oiseaux. Mais ce n'est pas tout,
                    l'hiver, vous pourrez trouver le réconfort et la chaleur de la cheminée mise à votre disposition
                    pour un moment cocooning en famille. Le gîte se trouve à 2h de Paris.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0 text-start">
                <h3>Catégories</h3>
                <ul class="navbar-nav">
                    @isset($category)
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route("post.index") }}">Tous les
                                posts</a>
                        </li>
                    @endisset
                    @forelse ($categories as $c)
                        <li class="nav-item"><a class="nav-link text-white"
                                                href="{{ route('category.show', [$c->slug]) }}">{{ $c->name }}</a>
                        </li>
                    @empty
                        Aucune catégorie
                    @endforelse
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0 mr-1 text-start">
                <h3>Contact</h3>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white">
                            <i class="fas fa-phone-alt text-white"></i>06000000</a>
                    </li>
                    <li class="nav-item">
                        <a href="mailto:corentinfarcy1@gmail.com" class="nav-link text-white">
                            <i class="fas fa-envelope text-white"></i>corentinfarcy1@gmail.com</a>
                    </li>
                    <li class="nav-item">
                        <p><i class="fas fa-map-marker-alt text-white"></i>4 Rue des Chasse-Marée, 76260 Le Mesnil-Réaume</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright:
        <a class="text-white" href="https://github.com/Farcy-Corentin">Corentin Farcy</a>
    </div>
</footer>
</body>
</html>
