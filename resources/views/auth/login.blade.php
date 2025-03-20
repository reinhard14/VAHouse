@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="row justify-content-center">

            <div class="col-md-4">
                <div class="row my-5">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <img src="{{ asset('dist/img/login-logo.png') }}">
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="">{{ __('Email') }}</label>
                                        <div class="col">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="">{{ __('Password') }}</label>
                                        <div class="col">
                                            <div class="input-group">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" data-toggle="password" required autocomplete="current-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col text-right">
                                            <a href="{{ route('password.request')}}" class="text-orange">Forgot Password?</a>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-login form-control">
                                                {{ __('Sign in') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col text-center">
                                            <small class="text-muted">or</small>
                                        </div>
                                    </div>

                                    <div class="row my-4">
                                        <div class="col text-center">
                                            <a href="{{ route('register.personal.information') }}" type="button" class="btn btn-orange form-control">
                                                {{ __('Apply as VA') }}
                                            </a>
                                        </div>
                                    </div>
                                </form>
                                <div class="row my-5">
                                    <div class="col text-center">
                                        <small class="text-muted">© 2025 VIRTUAL ASSITANT HOUSE CORP.</small>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
