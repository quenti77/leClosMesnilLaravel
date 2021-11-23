@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-4">
                <div class="card">
                    <div class="card-header"><h1 class="fw-bold">{{ __('Login') }}</h1></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" autocomplete="on">
                            @csrf
                            <div class="form-group my-3 row justify-content-center">
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control" name="email"
                                           value="{{ old('email') }}" placeholder="exemple@gmail.com"
                                           autocomplete="email" autofocus>
                                </div>
                            </div>
                            <div class="form-group my-1 row justify-content-center">
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           placeholder="mot de passe" autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mr-2 justify-content-center row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Se souvenir de moi!') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center me-0">
                                <button class="btn-primary-action col-6 col-lg-4"
                                        type="submit">{{ __('Se connecter') }}</button>
                            </div>
                            <div class="row justify-content-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
