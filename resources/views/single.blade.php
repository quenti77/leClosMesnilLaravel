@extends('layouts.app')
<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title', "$titleTag");

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
        <h2>{{ $post->comment_count }} commentaire(s)</h2>
        <hr>
        @foreach ($comments as $comment)
        <div class="card">
            <div class="comment card-body" data-comment="{{ $comment->id }}">

                <h4 class="card-title text-info">{{ $comment->user->name }}</h4>
                <p class="contentInitial">{{ $comment->content }}</p>
                @if (auth()->user() && auth()->user()->id === $comment->author)
                <form class="commentForm mt-3 d-none" action="{{ route('comment.update', $comment->id) }}"
                    method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label>Votre commentaire</label>

                        <textarea class="form-control contentUpdate @error('content') is-invalid @enderror"
                            name="content" aria-label="content" rows="5">{{ $comment->content }}</textarea>
                        @error('content')
                        <div class="invlaid-feedback">
                            {{ $errors->first('content') }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Editer mon commentaire</button>
                        <a href="#" class="cancelUpdate" data-comment="{{ $comment->id }}">Annuler</a>
                    </div>
                </form>
                @endif

                <div class="d-flex flex-column">
                    <small>
                        Posté le {{ $comment->created_at->format('d/m/Y') }} par
                        <strong class="text-success">{{ $comment->user->name }}</strong>
                    </small>
                </div>

                @if (auth()->user() && auth()->user()->id === $comment->author)
                <div class="col-sm-6 action">
                    <form action="{{ route('comment.destroy', $comment) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-custon-four btn-danger" type="submit">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                        <button class="btn btn-custon-four btn-success update" type="button"
                            data-comment="{{ $comment->id }}">
                            Editer
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@auth
<form action="{{ route('commentsstore', $post) }}" method="POST" class="mt-3">
    @csrf
    <div class="form-group">
        <label for="content">Votre commentaire</label>

        <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="post" rows="5">
        </textarea>

        @error('content')
        <div class="invalid-feedback">
            {{ $errors->first('content') }}
        </div>
        @enderror

    </div>
    <button type="submit" class="btn btn-primary">Soumettre mon commentaire</button>
</form>
@else
<div class="alert alert-info">
    <a href="{{ route('login')}}"> Connectez-vous</a> pour commenter
</div>
@endauth
@endsection
</div>
</div>

@section('scripts')
<script type="text/javascript" src="{{ asset('js/updateEditComment.js') }}" defer></script>
@endsection
