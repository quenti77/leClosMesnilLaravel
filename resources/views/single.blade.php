@extends('layouts.app')
@section('content')
    <section class='section-blog col-12'>
        <article class="mb-3">
            <div class="article-header">
                <div class="row align-items-baseline mb-1">
                    <div class="col-4"><span class="badge bg-badge text-dark">{{ $post->category->name }}</span>
                    </div>
                    <span class="created-at col-8 fst-italic fw-bold text-end">{{ $post->created_at->format('d-m-Y') }}</span>
                </div>
                <h2 class="pb-1 m-0">{{ $post->title }}</h2>
                <div class="image-container row mb-2">
                    <img src="{{ asset('storage/img/'.$post->image_path) }}" class="w-100 h-auto pb-1" alt="">
                </div>
            </div>
            <p id="visible" class="pb-1">{!! nl2br($post->content) !!}</p>
        </article>
        @foreach ($comments as $comment)
            <div class="comment row" data-comment="{{ $comment->id }}">
                <div class="comment-header">
                    <div class="row align-items-baseline mb-1">
                        <div class="col-4"><span class="text-dark fw-bolder">{{ $comment->user->name }}</span>
                        </div>
                        <span class="created-at col-8 fst-italic fw-bold text-end">{{ $comment->created_at->format('d-m-Y') }}</span>
                    </div>
                </div>
                <p class="contentInitial">{{ $comment->content }}</p>
                @if (auth()->user() && auth()->user()->id === $comment->author)
                    <form class="commentForm mt-3 d-none" action="{{ route('comment.update', $comment->id) }}"
                          method="POST">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label>Editez votre commentaire:</label>
                            <textarea class="form-control contentUpdate @error('content') is-invalid @enderror"
                                      name="content" aria-label="content"
                                      rows="5">{{ $comment->content }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">
                                {{ $errors->first('content') }}
                            </div>
                            @enderror
                        </div>
                        <div class="row justify-content-end">
                            <div class="btn-secondary-action col-4 col-lg-2 text-center">
                                <a
                                   class="cancelUpdate text-decoration-none"
                                   data-comment="{{ $comment->id }}">Annuler</a>
                            </div>
                            <button type="submit" class="btn-primary-action col-4 col-lg-2">Editer</button>
                        </div>
                    </form>
                @endif
                @if (auth()->user() && auth()->user()->id === $comment->author)
                    <div class="col-12 action">
                        <form action="{{ route('comment.destroy', $comment) }}" method="POST">
                            <div class="row justify-content-end me-0">
                            @csrf
                            @method('DELETE')
                            <button class="btn-secondary-action col-4 col-lg-2" type="submit">
                                Supprimer
                            </button>
                            <button class="comment btn-primary-action col-4 col-lg-2 update" type="button"
                                    data-comment="{{ $comment->id }}">
                                Editer
                            </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
            </div>
            @endforeach
            </div>
            </div>
            @auth
                <form action="{{ route('comment.store', $post) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="form-group">
                        <label for="content" class="mb-1">Commentaire(s) ({{ $post->comment_count }})</label>
                        <textarea name="content"
                                  class="mb-2 form-control @error('content') is-invalid @enderror" id="textarea"
                                  rows="5"></textarea>
                        @error('content')
                        <div class="invalid-feedback">
                            {{ $errors->first('content') }}
                        </div>
                        @enderror
                    </div>
                    <div class="row justify-content-end me-0">
                        <button class="btn-secondary-action col-4 col-lg-2" type="reset">Annuler</button>
                        <button class="btn-primary-action col-4 col-lg-2" type="submit">Commenter</button>
                    </div>
                    </form>
                </form>
            @else
                <div class="alert alert-info">
                    <a href="{{ route('login')}}"> Connectez-vous</a> pour commenter
                </div>
    </section>
    @endauth
    @endsection
    </div>
    </div>
