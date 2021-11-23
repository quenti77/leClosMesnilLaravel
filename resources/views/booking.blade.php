@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Article') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('booking.store') }} ">
                            @csrf
                            <div class="form-group row my-5">
                                <label
                                    for="started_at"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Arrivée') }}</label>
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
                                <label for="finished_at" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Départ') }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        id="finished_at"
                                        type="date"
                                        class="form-control @error('finished_at') is-invalid @enderror"
                                        name="finished_at"
                                        value="{{ old('finished_at') }}"
                                        autofocus>
                                    @error('finished_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row my-5">
                                <label for="nb_adult" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Nombres d\'adult') }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        id="nb_adult"
                                        type="text"
                                        class="form-control @error('nbNight') is-invalid @enderror"
                                        name="nb_adult"
                                        autofocus>
                                    @error('nbAdult')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row my-5">
                                <label for="nb_children" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Nombres d\'enfant') }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        id="nb_children"
                                        type="text"
                                        class="form-control @error('nb_children') is-invalid @enderror"
                                        name="nb_children"
                                        autofocus>
                                    @error('nb_children')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row my-5">
                                <label for="price" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Prix') }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        id="price"
                                        type="hidden"
                                        class="form-control @error('image_path') is-invalid @enderror"
                                        name="price"
                                        value="{{ old('price') }}"
                                        autofocus>
                                    @error('price')
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
