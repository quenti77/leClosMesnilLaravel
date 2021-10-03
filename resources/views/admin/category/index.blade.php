@extends('layouts.app')
@section('title', '| Show Post')

@section('content')
    @foreach($categories as $category)
        <div class="container py-4">
            <h2><a href="{{ route("admin.category.show", $category->slug) }}">{{ $category->name }}:</a></h2>
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Titre</th>
                            <th class="col-3">Créer le</th>
                            <th class="col-3">Editer le</th>
                            <th class="col-3">Lien</th>
                        </tr>
                        @foreach($posts as $post)
                            @if($category->id === $post->category_id)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->created_at->format("d-m-Y H:m:s") }}</td>
                                    @if($post->update_at)
                                    <td>{{ $post->update_at->format("d-m-Y H:m:s") }}</td>
                                    @else
                                        <td>Aucune mise à jour</td>
                                    @endif
                                    <td><a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-outline-primary">View</a></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                    <div class="row justify-content-end me-0">
                        <div class="col-4 col-lg-2">
                            <form method="POST" action="{{ route('admin.category.destroy', ['category' => $category->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-secondary-action col-4 col-lg-12">Supprimer</button>
                            </form>
                        </div>
                        <div class="col-4 col-lg-2">
                            <a type="button" href="{{ route('admin.category.edit', $category->id) }}"
                               class="btn-primary-action editLink text-decoration-none text-center col-12 col-lg-10">
                                Editer
                            </a>
                        </div>
                    </div>
            </div>
                @endforeach
            </div>
        </div>
@endsection
