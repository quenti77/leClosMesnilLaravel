@extends('layouts.app')
@section('scripts')
    <script src="/js/infiniteScroll.js" defer></script>
@endsection
@section('content')
    <div class="sticky-top">
        <ul id="categoryNav" class="nav justify-content-center sticky-top bg-white mb-1 d-xl-none">
            @isset($category)
                <li class="nav-item"><a class="nav-link" href="{{ route("index") }}">Tous les posts</a>
                </li>
            @endisset
            @forelse ($categories as $c)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.show', [$c->slug]) }}">{{ $c->name }}</a>
                </li>
            @empty
                Aucune catégorie
            @endforelse
        </ul>
    </div>
    <section class='section-blog col-12 mt-xl-4 mt-2'>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-xl-10">
                    <article id="templatePost" data-category="{{ isset($category)?$category->id:'' }}"
                             data-next-available="{{ $nextAvailable }}"
                             class="mb-4 pr-5 col-12 col-md-6 col-xl-4 invisible">
                        <div class="article-header">
                            <img id="thumbnails" src="[IMAGE]"
                                 class="postList pb-1"
                                 alt="">
                            <div class="row align-items-baseline mb-1">
                                <div class="col-4">
                                    <span id="category" class="badge bg-badge text-dark">[CATEGORY]</span>
                                </div>
                                <span id="createdAt" class="created-at col-8 fst-italic fw-bold text-end">
                                [CREATED_AT]
                            </span>
                            </div>
                            <h2 id="title" class="h-3 pb-1 m-0">[TITLE]</h2>
                        </div>
                        <div class="text-end my-1 commentBtn">
                            <a href="[COMMENT_LINK]" class="fw-bold"><i class="far fa-comment me-1"></i>[COMMENT_COUNT]
                                Comments</a>
                        </div>
                        <div class="text-center">
                            <a href="[SLUG]" id="slug">Voir l'article</a>
                        </div>
                    </article>
                    <div class="row" id="data-wrapper">
                        @forelse($posts as $post)
                            <article class="mb-4 pr-5 col-12 col-md-6 col-xl-4">
                                <div class="article-header">
                                    <img src="{{ asset('storage/img/'.$post->image_path) }}"
                                         class="postList pb-1"
                                         alt="">
                                    <div class="row align-items-baseline mb-1">
                                        <div class="col-4">
                                            <span class="badge bg-badge text-dark">{{ $post->category->name }}</span>
                                        </div>
                                        <span class="created-at col-8 fst-italic fw-bold text-end">
                                        {{ $post->created_at->format('d/m/Y') }}
                                    </span>
                                    </div>
                                    <h2 class="h-3 pb-1 m-0">{{ $post->title }}</h2>
                                </div>
                                <div class="text-end my-1 commentBtn">
                                    <a href="{{ route("post.comment", [$post->slug]) }}" class="fw-bold"><i
                                            class="far fa-comment me-1"></i>{{ $post->comment_count }} Comments</a>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route("post.show", [$post->slug]) }}" class="">Voir l'article</a>
                                </div>
                            </article>
                        @empty
                            <p>Aucun article</p>
                        @endforelse
                    </div>
                    <div class="text-center">
                        <button id="buttonLoad" class="btn-cta py-1 px-2">Load more</button>
                    </div>
                </div>
                <aside class="col-xl-2 sticky-top d-none d-xl-block">
                    <div class="sticky-top">
                        <h3 class="h4">Articles récents</h3>
                        <ul class="navbar-nav">
                            @forelse($lastPosts as $p)
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route("post.show", [$p->slug]) }}">
                                        {{ $p->title }}
                                    </a>
                                </li>
                            @empty
                                <p>Aucun article publié récemment</p>
                            @endforelse
                        </ul>
                        <h3 class="h4">Catégories</h3>
                        <ul class="navbar-nav">
                            @isset($category)
                                <li class="nav-item"><a class="nav-link" href="{{ route("index") }}">Tous les posts</a>
                                </li>
                            @endisset
                            @forelse ($categories as $c)
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="{{ route('category.show', [$c->slug]) }}">{{ $c->name }}
                                    </a>
                                </li>
                            @empty
                                Aucune catégorie
                            @endforelse
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>
    </div>
@endsection
