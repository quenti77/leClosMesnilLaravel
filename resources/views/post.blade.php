
@extends('layouts.app')
@section('content')
<h1>Suivez l'actualité du Clos Mesnil et de ses alentours</h1>
<section class='section-blog'>
    @foreach($posts as $post)
    <div class='d-flex'>    
        <img src="{{ $post->image_path }}">
    </div>
    <div>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
    </div>    
    @endforeach
</section>
@endsection