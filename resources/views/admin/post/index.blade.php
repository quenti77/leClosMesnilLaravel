@extends('layouts.app')
@section('title', '| Show Post')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <th>id</th>
                    <th>category_id</th>
                    <th>title</th>
                    <th>slug</th>
                    <th>content</th>
                    <th>updated_at</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <th>{{ $post->id }}</th>
                        <th>{{ $post->category_id }}</th>
                        <th>{{ $post->title }}</th>
                        <th>{{ $post->slug }}</th>
                        <th>{{ $post->content }}</th>
                        <th>{{ $post->updated_at }}</th>
                        <th>
                            <a href="" class="btn btn-outline-primary">View</a>
                            <a href="" class="btn btn-outline-danger">edit</a></th>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
