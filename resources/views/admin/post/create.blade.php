@extends('layouts.app')
@section('title', '| Create Post')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Article') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.post.store') }} ">
                        @csrf
                        <div class="form-group row my-5">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Titre') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"  autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row my-5">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Contenu') }}</label>
                            <div class="col-md-6">
                                <textarea id="content" type="textarea" class="form-control @error('content') is-invalid @enderror" name="content"  autofocus>
                                </textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row my-5">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Catégorie') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="category_id">
                                    <option>Select Item</option>
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
                        <div class="form-group row my-5">
                            <label for="image_path" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path" value="{{ old('image_path') }}"  autofocus>
                                @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row my-5 mb-0">
                            <div class="col-md-6 offset-md-9">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
