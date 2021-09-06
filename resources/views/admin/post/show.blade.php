@extends('layouts.app')
@section('title', '| View Project')

@section('content')
    <h1>Categories {{ $post->category->name }}</h1>
    <div class="row">
        <div class="col-md-8">
            <p>{{ $post->title }}</p>
            <p>{!! nl2br($post->content) !!}</p>
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created At :</dt>
                    <dd><p>{{ $post->created_at }}</p></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Updated At:</dt>
                    <dd><p>{{ $post->updated_at }}</p></dd>
                </dl>
                <img src="{{ $post }}" alt="">
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                       <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-outline-success">edit</a>
                    </div>
                     <div class="col-sm-6">
                         <form method="POST" action="{{ route('admin.post.destroy', ['post' => $post->id]) }}">
                             @csrf
                             @method('DELETE')
                             <button type="submit" class="btn btn-outline-danger">delete</button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
