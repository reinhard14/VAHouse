@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card my-5">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row text-center mb-3">
                        <div class="col mb-3">
                            <img src="{{asset('dist/img/nav-logo.png')}}" width="150px" height="60px">
                        </div>

                        <h3>Create an Account</h3>
                        <p class="text-muted">1 of 2: Personal Information</p>
                    </div>

                    <form method="POST" action="{{ route('register.personal.information') }}">
                        @csrf

                        <div class="row mb-2">
                            <div class="col">
                                <label for="name">First Name <span class="text-danger">*</span> </label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label for="middlename">Middle Name <span class="text-danger">*</span> </label>

                                <input id="middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ old('middlename') }}" required autocomplete="middlename" autofocus>

                                @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label for="lastname">Last Name <span class="text-danger">*</span> </label>

                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label for="suffix">Suffix Name </label>

                                <input id="suffix" type="text" class="form-control @error('suffix') is-invalid @enderror" name="suffix" value="{{ old('suffix') }}" autocomplete="suffix" autofocus>

                                @error('suffix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col">
                                <label for="gender">Gender </label>

                                <select name="gender" class="form-control">
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }} >Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }} >Female</option>
                                    <option value="Transgender" {{ old('gender') == 'Transgender' ? 'selected' : '' }} >Transgender</option>
                                    <option value="Non binary" {{ old('gender') == 'Non binary' ? 'selected' : '' }} >Non-Binary/Non-Conforming</option>
                                    <option value="Prefer not to respond" {{ old('gender') == 'Prefer not to respond' ? 'selected' : '' }} >Prefer not to respond</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <button type="submit" class="btn btn-orange form-control">
                                    {{ __('Next') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row text-center">
                        <div class="col">
                            <p class="text-muted">Already have an account? <a href="{{ route('login') }}" class="text-orange">Log in</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
