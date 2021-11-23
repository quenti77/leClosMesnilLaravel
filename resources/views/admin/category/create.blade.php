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
                        <form method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4 me-0">
                                <span class="text-danger">*Tous les champs sont obligatoires</span>
                            </div>
                            <div class="form-group row my-4">
                                <div class="col-md-12">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           placeholder="Nom de la catégorie"
                                           value="{{ old('name') }}" autofocus>
                                    @error('name')
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
