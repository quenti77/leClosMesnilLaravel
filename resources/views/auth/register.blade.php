@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-4">
                <div class="card-header"><h1 class="fw-bold">{{ __('Créer un compte') }}</h1></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" autocomplete="on">
                        @csrf
                        <div class="row justify-content-center mb-3">
                            <div class="col-6 col-md-3">
                                <input id="name"
                                       type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Prénom"
                                       value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                <div class="col-6 col-md-3">
                                    <input id="last_name"
                                           type="text"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name"
                                           placeholder="Nom"
                                           value="{{ old('name') }}" autocomplete="last_name" autofocus>
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-6">
                                <input id="phone"
                                       type="tel"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       name="phone"
                                       placeholder="Numéro de téléphone"
                                       value="{{ old('phone') }}" autocomplete="name" autofocus>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-6">
                                <input id="email"
                                       type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       placeholder="exemple@gmail.com"
                                       value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-6">
                                <input id="password"
                                       type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password"
                                       placeholder="Mot de passe"
                                       autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-6">
                                <input id="password-confirm"
                                       type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       placeholder="Confirmation du mot de passe" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn-primary-action col-6 col-lg-4">
                                    {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

