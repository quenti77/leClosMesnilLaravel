@extends('layouts.app')
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/datePicker.js') }}" defer></script>
@endsection
@section('content')
    <div class="container mb-5">
        <div class="row imageGrid gridImgRounded mb-4">
            <div class="col-6 pe-0">
                <div class="big-image">
                    <img
                        src="https://images.pexels.com/photos/4507715/pexels-photo-4507715.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                        class="imgRoundedTopBottomRight" alt="">
                </div>
            </div>
            <div class="col-3 pe-0">
                <div class="row g-0">
                    <div class="small-image mb-2">
                        <img
                            src="https://images.pexels.com/photos/4507715/pexels-photo-4507715.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                            alt="">
                    </div>
                    <div class="small-image">
                        <img
                            src="https://images.pexels.com/photos/4507715/pexels-photo-4507715.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="row g-0">
                    <div class="small-image mb-2">
                        <img
                            src="https://images.pexels.com/photos/4507715/pexels-photo-4507715.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                            class="imgRoundedTopRight" alt="">
                    </div>
                    <div class="small-image">
                        <img
                            src="https://images.pexels.com/photos/4507715/pexels-photo-4507715.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                            class="imgRoundedBottomRight" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row g-0">
                <div class="col-12 col-sm-12 col-md-7 col-xl-8">
                    <h2>Titre</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aut commodi, cumque doloribus
                        id iusto laboriosam minima molestiae nam nesciunt officia quaerat qui, quo rem repellat,
                        sint
                        tempore
                        voluptatem voluptates!
                    </p>
                    <h2>Equipement</h2>
                </div>
                <div class="col-12 col-sm-12 col-md-5 col-xl-4 bookingForm">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <span class="price">80€ </span>
                            <span>
                                /nuit
                            </span>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 text-lg-end text-xl-end pt-1">
                            <i class="fas fa-star"></i>
                            <span class="rating">5</span>
                            <span class="nbComment">(18 commentaires)</span>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('booking.store') }}" enctype="multipart/form-data">
                        @csrf
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
                        <div class="row g-0">
                            <div class="col-12 pe-0">
                                <button class="btn-primary-action col-12 m-0 mb-4" type="submit">
                                    Vérifier la disponibilité
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
