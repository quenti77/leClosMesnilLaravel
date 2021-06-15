@extends('layouts.app')
@section('title', '| Show Post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <th>id</th>
                        <th>post_id</th>
                        <th>author</th>
                        <th>content</th>
                        <th>created</th>
                        <th>updated_at</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                        @foreach($commentPosts as $commentPost)
                        <tr>
                            <td>{{ $commentPost->id }}</td>
                            <td>{{ $commentPost->post_id }}</td>
                            <td>{{ $commentPost->author }}</td>
                            <td>{{ $commentPost->content }}</td>
                            <td>{{ $commentPost->created_at }}</td>
                            <td>{{ $commentPost->updated_at }}</td>
                            <td>
                                <form method="POST" action="
                                    {{ route('admin.commentPost.destroy', [
                                        'commentPost' => $commentPost->id
                                        ])
                                    }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
