@extends('layouts.app')
@section('content')
    <section class='section-blog col-12'>
        <div class="row">
            <div class="col-12 col-sm-10">
                <div class="row">
                    @isset($category)
                        <h2>{{ $category->name }}</h2>
                    @endisset
                    @forelse($posts as $post)
                        <article class="mb-3 col-12 col-md-6 col-xl-4">
                            <div class="article-header">
                                <div class="row align-items-baseline mb-1">
                                    <div class="col-4">
                                        <span class="badge bg-badge text-dark">{{ $post->category->name }}</span>
                                    </div>
                                    <span class="created-at col-8 fst-italic text-end">
                                {{ $post->created_at->format('d-m-Y') }}
                            </span>
                                </div>
                                <h2 class="pb-1 m-0">{{ $post->title }}</h2>
                                <img src="{{ asset('storage/img/'.$post->image_path) }}" class="w-100 h-auto pb-1"
                                     alt="">
                            </div>
                            <p>{!! mb_substr(nl2br($post->content),0, 500) !!} . . .</p>
                            <div class="text-center">
                                <a href="{{ route("post.show", [$post->slug]) }}" class="">Voir l'article</a>
                            </div>
                        </article>
                        @empty
                        <p>Aucun article</p>
                    @endforelse

                    <div class="row justify-content-center my-1 mr-0">
                        <div class="col-lg-4">{!! $posts->links() !!}</div>
                    </div>
                </div>
            </div>
            <aside class="col-sm-2 d-none d-sm-block">
                <div>
                    <h3>Articles récents</h3>
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
                    <h3>Catégories</h3>
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
    </section>
@endsection
