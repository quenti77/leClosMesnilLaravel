@extends('layouts.app')
@section('title', '| Create Post')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4">
                    <div class="card-header">
                        {{ __('Article') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4 me-0">
                                <span class="text-danger">*Tous les champs sont obligatoires</span>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="col-md-12">
                                    <select class="form-control @error('content') is-invalid @enderror"
                                            name="category_id">
                                        <option disabled selected>Choisissez la catégorie...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row my-4">
                                <div class="col-md-12">
                                    <label class="mb-1">Image de présentation:</label>
                                    <input id="image_path" type="file"
                                           class="form-control @error('image_path') is-invalid @enderror"
                                           name="image_path"
                                           value="{{ old('image_path') }}" autofocus>
                                    @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row my-4">
                                <div class="col-md-12">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           placeholder="Titre de l'article"
                                           value="{{ old('title') }}" autofocus>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row my-4">
                                <div class="col-md-12">
                                <textarea id="content"
                                          class="form-control @error('content') is-invalid @enderror" name="content"
                                          autofocus>
                                </textarea>
                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end my-4 me-0">
                                <button class="btn-secondary-action col-4 col-lg-2" type="reset">Annuler</button>
                                <button class="btn-primary-action col-4 col-lg-2" type="submit">Poster</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
