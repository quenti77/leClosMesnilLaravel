@extends('layouts.app')
@section('scripts')
<script>
    window.seasons = {!! json_encode($seasons->toArray()) !!};
</script>
<script type="text/javascript" src="{{ asset('js/datePicker.js') }}" defer></script>
@endsection
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
                            <div id="range" class="my-1">

                            <div class="form-group row my-5">
                                <label
                                    for="started_at"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Début de la saison') }}</label>
                                <div class="col-md-6">
                                    <input
                                        id="start"
                                        type="text"
                                        class="form-control @error('started_at') is-invalid @enderror"
                                        name="started_at"
                                        placeholder="Début de la saison ?"
                                        value="{{ old('started_at') }}"
                                        autofocus autocomplete="off">
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
                                    <input id="end" type="text"
                                           class="form-control @error('finished_at') is-invalid @enderror"
                                           name="finished_at"
                                           placeholder="Arrivée?"
                                           value="{{ old('finished_at') }}" autofocus autocomplete="off">
                                    @error('finished_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                            <div class="form-group row my-5">
                                <label
                                    for="price"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Prix Saison') }}</label>
                                <div class="col-md-6">
                                    <input
                                        id="price"
                                        type="text"
                                        class="form-control @error('price') is-invalid @enderror"
                                        name="price"
                                        value="{{ old('price') }}"
                                        autofocus>
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-12 pe-0">
                                    <button class="btn-primary-action col-12 m-0" type="submit">Valider</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

