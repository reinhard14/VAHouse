@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">Register Personal Information</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="role_id" value="3">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('Last name') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" required autocomplete="lastname">

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="middlename" class="col-md-4 col-form-label text-md-end">Middle Name:</label>

                            <div class="col-md-6">
                                <input type="text" id="middlename" name="middlename" class="form-control" value="{{ old('middlename') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="suffix" class="col-md-4 col-form-label text-md-end">Suffix:</label>

                            <div class="col-md-6">
                                <input type="text" id="suffix" name="suffix" class="form-control" placeholder="Leave suffix blank if none..">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="age" class="col-md-4 col-form-label text-md-end">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="number" name="age" class="form-control @error('age') is-invalid @enderror" min="18" value="{{ old('age') }}" required autocomplete="age">

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select name="gender" class="form-control">
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }} >Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }} >Female</option>
                                    <option value="Transgender" {{ old('gender') == 'Transgender' ? 'selected' : '' }} >Transgender</option>
                                    <option value="Non binary" {{ old('gender') == 'Non binary' ? 'selected' : '' }} >Non-Binary/Non-Conforming</option>
                                    <option value="Prefer not to respond" {{ old('gender') == 'Prefer not to respond' ? 'selected' : '' }} >Prefer not to respond</option>
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="education" class="col-md-4 col-form-label text-md-end">{{ __('Highest Educational Attainment') }}</label>

                            <div class="col-md-6">
                                <select name="education" class="form-control">
                                    <option value="High School" {{ old('education') == 'High School' ? 'selected' : '' }} >High School</option>
                                    <option value="Senior High School" {{ old('education') == 'Senior High School' ? 'selected' : '' }} >Senior High School</option>
                                    <option value="College Undergrad" {{ old('education') == 'College Undergrad' ? 'selected' : '' }} >College Undergrad</option>
                                    <option value="College Degree" {{ old('education') == 'College Degree' ? 'selected' : '' }} >College Degree</option>
                                    <option value="Master's Degree" {{ old('education') == 'Master\'s Degree' ? 'selected' : '' }} >Master's Degree</option>
                                    <option value="Professional Degree" {{ old('education') == 'Professional Degree' ? 'selected' : '' }} >Professional Degree</option>
                                    <option value="Doctorate Degree" {{ old('education') == 'Doctorate Degree' ? 'selected' : '' }} >Doctorate Degree</option>
                                    <option value="Vocational" {{ old('education') == 'Vocational' ? 'selected' : '' }} >Vocational</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="contactnumber" class="col-md-4 col-form-label text-md-end">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contactnumber" type="text" name="contactnumber" class="form-control @error('contactnumber') is-invalid @enderror" value="{{ old('contactnumber') }}" required autocomplete="contactnumber">

                                @error('contactnumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" name="password" class="form-control
                                    @error('password') is-invalid @enderror" required autocomplete="new-password" data-toggle="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" data-toggle="password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="captcha" class="col-md-4 col-form-label text-md-end">Captcha</label>

                            <div class="col-md-6 captcha d-flex justify-content-between mb-2">
                                <span id="captcha-img">{!! captcha_img() !!}</span>
                                <a href="javascript:void(0)" onclick="refreshCaptcha()" class="bi bi-arrow-clockwise">Refresh</a>
                            </div>

                            <label for="captcha" class="col-md-4 col-form-label text-md-end">Enter Captcha here</label>
                            <div class="col-md-6">
                                <input type="text" id="captcha" name="captcha" class="form-control" required>
                                @if ($errors->has('captcha'))
                                    <span class="text-danger">{{ $errors->first('captcha') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const guidelinesModal = new bootstrap.Modal(document.getElementById('guidelinesModal'));
        guidelinesModal.show();

        function refreshCaptcha() {
            $.ajax({
                url: '{{ route('refresh.captcha') }}',
                method: 'GET',
                success: function(response) {
                    $('#captcha-img').html(response.captcha);
                },
                error: function(xhr, status, error) {
                    console.error('Failed to refresh captcha:', xhr.responseText);
                    alert('Failed to refresh captcha: ' + error);
                }
            });
        }
    });
</script>

@endsection
