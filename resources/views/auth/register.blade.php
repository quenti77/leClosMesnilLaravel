@extends('layouts.app')
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/intlTelInput.js') }}" defer></script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4">
                    <div class="card-header"><h1 class="fw-bold">{{ __('Créer un compte') }}</h1></div>
                    <div class="card-body justify-content-center">
                        <form method="POST" action="{{ route('register') }}" autocomplete="on">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="form-group col-sm-6 col-xs-12 form-error">
                                    <label class="input-block">
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
                                    </label>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-sm-6 col-xs-12 form-error">
                                    <label class="input-block">
                                        <input id="last_name"
                                               type="text"
                                               class="form-control @error('last_name') is-invalid @enderror"
                                               name="last_name"
                                               placeholder="Nom"
                                               value="{{ old('last_name') }}" autocomplete="last_name" autofocus>
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-sm-6 col-xs-12 form-error">
                                    <label class="input-block">
                                        <input id="phone"
                                               type="tel"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               name="phone"
                                               placeholder="Numéro de téléphone"
                                               value="" autocomplete="phone" autofocus>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="hidden" id="hidden" value="">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-sm-6 col-xs-12 form-error">
                                    <label class="input-block">
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
                                    </label>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-sm-6 col-xs-12 form-error">
                                    <label class="input-block">
                                        <div>
                                            <div class="input-password">
                                                <input type="password"
                                                       id="password"
                                                       name="password"
                                                       placeholder="Votre mot de passe"
                                                       class="form-control">
                                                <div class="password-show-button">
                                                    <i class="fas fa-eye fa-2x"></i>
                                                </div>
                                                <div class="mt-1 progress">
                                                    <div class="progress-bar w-0"
                                                         role="progressbar"
                                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="30"></div>
                                                </div>
                                                <small class="password-info">
                                                    Le mot de passe doit comporter au minimum 8 caractères et doit
                                                    comporter au moins une Majuscule et un Chiffre
                                                </small>
                                                <span class="d-none msg">Le mot de passe est requis</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn-primary-action col-8 col-lg-6">
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

