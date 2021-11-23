@extends('layouts.app')
@section('content')
    <div class="sticky-top">
        <ul id="categoryNav" class="nav justify-content-center sticky-top bg-white mb-1 d-xl-none">
            @isset($category)
                <li class="nav-item"><a class="nav-link" href="{{ route("post.index") }}">Tous les posts</a>
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
    <section class='section-blog col-12 mb-4 mt-xl-4 mt-2'>
        <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-xl-10">
                <div class="row">
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
                            <p>{!! mb_substr(nl2br($post->content),0, 300) !!} . . .</p>
                            <div class="text-center">
                                <a href="{{ route("post.show", [$post->slug]) }}" class="">Voir l'article</a>
                            </div>
                        </article>
                    @empty
                        <p>Aucun article</p>
                    @endforelse
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item {{ 1 === $posts->currentPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $currentPath }}?page={{ $posts->currentPage() - 1 }}"
                                   aria-label="Previous">
                                    <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                                </a>
                            </li>
                            @for($i = 1; $i<=$posts->lastPage(); $i++)
                                <li class="page-item d-none d-sm-block {{ $i === $posts->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" aria-current="page" href="{{ $currentPath }}?page={{ $i }}">
                                        {{ $i }}
                                    </a>
                                </li>
                            @endfor
                            <li class="page-item {{ $posts->lastPage() === $posts->currentPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $currentPath }}?page={{ $posts->currentPage() + 1 }}"
                                   aria-label="Next">
                                    <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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
                            <li class="nav-item"><a class="nav-link" href="{{ route("post.index") }}">Tous les posts</a>
                            </li>
                        @endisset
                        @forelse ($categories as $c)
                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('category.show', [$c->slug]) }}">{{ $c->name }}</a>
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
