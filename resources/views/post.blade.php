@extends('layouts.app')
@section('content')
    <section class='section-blog col-12'>
        <div class="row">
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
                        <img src="{{ asset('storage/img/'.$post->image_path) }}" class="w-100 h-auto pb-1" alt="">
                    </div>
                    <p class="">{!! mb_substr(nl2br($post->content),0, 500) !!} . . .</p>
                    <div class="text-center">
                        <a href="{{ url('post/' . $post->slug) }}" class="">Voir l'article</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
