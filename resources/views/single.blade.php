@extends('layouts.app')
@section('content')
    <section class='section-blog col-12 mb-2 mt-2'>
        <ul id="categoryNav" class="nav sticky-top justify-content-center bg-white mb-3">
            <li class="nav-item"><a class="nav-link" href="{{ route("post.index") }}">accueil</a>
            </li>
            @forelse ($categories as $c)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.show', [$c->slug]) }}">{{ $c->name }}</a>
                </li>
            @empty
                Aucune catégorie
            @endforelse
        </ul>
        <div class="container">
            <article class="mb-3">
                <div class="article-header">
                    <div class="image-container row mb-2">
                        <img src="{{ asset('storage/img/'.$post->image_path) }}" class="singlePost pb-1" alt="">
                    </div>
                    <div class="row align-items-baseline mb-1">
                        <div class="col-4"><span class="badge bg-badge text-dark">{{ $post->category->name }}</span>
                        </div>
                        <span
                            class="created-at col-8 fst-italic fw-bold text-end">
                            {{ $post->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                    <h2 class="pb-1 m-0">{{ $post->title }}</h2>
                </div>
                <p id="visible" class="pb-1">{!! nl2br($post->content) !!}</p>
            </article>
            @auth
                <form action="{{ route('comment.store', $post) }}" method="POST" class="my-4">
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
                @foreach ($comments as $comment)
                    <div class="comment row mb-4" data-comment="{{ $comment->id }}">
                        <div class="comment-header">
                            <div class="row align-items-baseline mb-1">
                                <div class="col-4">
                                    <span class="text-dark fw-bolder">{{ $comment->user->name }}</span>
                                </div>
                                <span class="created-at col-8 fst-italic fw-bold text-end">
                                    {{ $comment->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                        <p class="contentInitial">{!! nl2br($comment->content) !!}</p>
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
                                    <!-- Modal -->
                                        <div class="modal fade"
                                             id="exampleModal"
                                             tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger" id="exampleModalLabel">
                                                            Supprimer votre commentaire
                                                        </h5>
                                                        <button type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close">

                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                                        <span class="text-warning">
                                                            cette opération ne peut pas être annulée
                                                        </span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                                class="btn"
                                                                data-bs-dismiss="modal">Annuler
                                                        </button>
                                                        @method('DELETE')
                                                        <button class="btn btn-danger text-white"
                                                                type="submit"
                                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            Oui supprimer le commentaire
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="row justify-content-end">
                                                <i class="col-1 hoverTrash far fa-trash-alt"
                                                   data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                </i>
                                                <i class="col-1 far hoverEdit fa-edit comment update"
                                                   data-comment="{{ $comment->id }}">
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @else
            <div class="alert alert-info">
                <a href="{{ route('login')}}"> Connectez-vous</a> pour commenter
            </div>
    </section>
        @endauth
    </div>
    @endsection
    </div>
    </div>
