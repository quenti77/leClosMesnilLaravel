
@extends('layouts.app')
@section('content')
<h1>Blog</h1>
    @foreach($posts as $post)
        <h4>{{ $post->title }}</h4>
        <p>{{ $post->content }}</p>
        <img src="{{ $post->image_path }}">
    @endforeach
@endsection