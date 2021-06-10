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
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->category_id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{{ \Illuminate\Support\Str::words(strip_tags($post->content), 10, ' ...') }}</td>
                            <td>{{ $post->updated_at }}</td>
                            <td>
                                <a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-outline-primary">View</a>
                                <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-outline-warning">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
