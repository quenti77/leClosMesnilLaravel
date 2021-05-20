
@extends('layouts.app')
@section('content')
<section class='section-blog container'>
<h1>Suivez l'actualité du Clos Mesnil et de ses alentours</h1>
    @foreach($posts as $post)
        <div>       
            <h2>{{ $post->category->name }}</h2>
            <hr>
            <h3>{{ $post->title }}</h3>
            <img src="{{ $post->image_path }}">
            <p>{{ $post->content }}</p>
            <a href="#" class="btn btn-outline-dark stretched-link">LIRE PLUS</a>
        </div>    
    @endforeach
</section>
@endsection