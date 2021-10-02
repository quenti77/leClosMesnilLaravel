@extends('layouts.app')
@section('content')
    <section class='section-blog col-12'>
        <div class="row">
            <div class="col-12 col-sm-10">
                <div class="row">
                    @isset($category)
                        <h2>{{ $category->name }}</h2>
                    @endisset
                    @foreach($posts as $post)
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
                                <a href="{{ url('post/' . $post->slug) }}" class="">Voir l'article</a>
                            </div>
                        </article>
                    @endforeach
                    <div class="row justify-content-center my-1 mr-0">
                        <div class="col-lg-4">{!! $posts->links() !!}</div>
                    </div>
                </div>
            </div>
            <aside class="col-sm-2 d-none d-sm-block">
                <div>
                    @isset($category)
                        <a href="{{ route("post.index") }}">Tous les posts</a>
                    @endisset
                    @foreach ($categories as $c)
                        <a href="{{ route('category.show', [$c->slug]) }}">{{ $c->name }}</a>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>
@endsection
