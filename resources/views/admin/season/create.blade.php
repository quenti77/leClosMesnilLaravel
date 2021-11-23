@extends('layouts.app')
@section('title', '| Create Season')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Saisons') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.season.store') }} ">
                            @csrf
                            <div class="form-group row my-5">
                                <label
                                    for="stated_at"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Début de la saison') }}</label>
                                <div class="col-md-6">
                                    <input
                                        id="started_at"
                                        type="date"
                                        class="form-control @error('started_at') is-invalid @enderror"
                                        name="started_at"
                                        value="{{ old('started_at') }}"
                                        autofocus>
                                    @error('started_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row my-5">
                                <label
                                    for="finished_at"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Fin de la saison') }}</label>
                                <div class="col-md-6">
                                <input
                                    id="finished_at"
                                    type="date"
                                    class="form-control @error('finished_at') is-invalid @enderror"
                                    name="finished_at"
                                    autofocus>
                                    @error('finished_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row my-5">
                                <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Catégorie') }}</label>
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

@endsection
