@extends('layouts.app')
@section('title', '| Create Post')
@section('scripts')
    <script src="{{ asset('js/datePicker.js') }}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4">
                    <div class="card-header">
                        {{ __('Booking') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.booking.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4 me-0">
                                <span class="text-danger fw-bold">*Tous les champs sont obligatoires</span>
                            </div>
                            <div id="range" class="my-1">
                                <div class="row">
                                    <div class="col-6">
                                        <input id="start" type="text"
                                               class="form-control @error('started_at') is-invalid @enderror"
                                               name="started_at"
                                               placeholder="Arrivée?"
                                               value="{{ old('started_at') }}" autofocus autocomplete="off">
                                        @error('started_at')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <input id="end" type="text"
                                               class="form-control @error('finished_at') is-invalid @enderror"
                                               name="finished_at"
                                               placeholder="Départ?"
                                               value="{{ old('finished_at') }}" autofocus autocomplete="off">
                                        @error('finished_at')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <input id="nb_adult" type="number"
                                           class="form-control @error('nb_adult') is-invalid @enderror" name="nb_adult"
                                           placeholder="Adulte(s)?"
                                           value="{{ old('nb_adult') }}" autofocus>
                                    @error('nb_adult')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <input id="nb_children" type="number"
                                           class="form-control @error('nb_children') is-invalid @enderror"
                                           name="nb_children"
                                           placeholder="Enfant(s)?"
                                           value="{{ old('nb_children') }}" autofocus>
                                    @error('nb_children')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <input class="" id="price" type="text" value="" readonly>
                                </div>
                            </div>
                            <div class="row justify-content-end my-4 me-0">
                                <button class="btn-secondary-action col-4 col-lg-2" type="reset">Annuler</button>
                                <button class="btn-primary-action col-4 col-lg-2" type="submit">Réserver</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
