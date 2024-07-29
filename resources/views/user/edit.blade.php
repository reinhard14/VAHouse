@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Edit Account Details:
                </div>

                <div class="card-body">
                    @include('includes.messages')

                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="row p-2">
                            <div class="col-md-3">First Name:</div>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" value="{{ $user->name}}">
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Last Name:</div>
                            <div class="col-md-9">
                                <input type="text" name="lastname" class="form-control" value="{{ $user->lastname}}">
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Middle Name:</div>
                            <div class="col-md-9">
                                <input type="text" name="middlename" class="form-control" value="{{ $user->middlename}}">
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Suffix:</div>
                            <div class="col-md-9">
                                <input type="text" name="suffix" class="form-control" value="{{ $user->suffix}}" placeholder="Leave suffix blank if none..">
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Age:</div>
                            <div class="col-md-9">
                                <input type="number" name="age" class="form-control" min="18" value="{{ $user->age}}">
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Gender:</div>

                            <div class="col-md-9">
                                <select name="gender" class="form-control">
                                    <option value="Male" {{ old('gender', $user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $user->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Transgender" {{ old('gender', $user->gender ?? '') == 'Transgender' ? 'selected' : '' }}>Transgender</option>
                                    <option value="Non binary" {{ old('gender', $user->gender ?? '') == 'Non binary' ? 'selected' : '' }}>Non-Binary/Non-Conforming</option>
                                    <option value="Prefer not to respond" {{ old('gender', $user->gender ?? '') == 'Prefer not to respond' ? 'selected' : '' }}>Prefer not to respond</option>
                                </select>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Highest Educational Attainment:</div>

                            <div class="col-md-9">
                                <select name="education" class="form-control">
                                    <option value="High School" {{ old('education', $user->education ?? '') == 'High School' ? 'selected' : '' }}>High School</option>
                                    <option value="Senior High School" {{ old('education', $user->education ?? '') == 'Senior High School' ? 'selected' : '' }}>Senior High School</option>
                                    <option value="College Undergrad" {{ old('education', $user->education ?? '') == 'College Undergrad' ? 'selected' : '' }}>College Undergrad</option>
                                    <option value="College Degree" {{ old('education', $user->education ?? '') == 'College Degree' ? 'selected' : '' }}>College Degree</option>
                                    <option value="Master's Degree" {{ old('education', $user->education ?? '') == 'Master\'s Degree' ? 'selected' : '' }}>Master's Degree</option>
                                    <option value="Professional Degree" {{ old('education', $user->education ?? '') == 'Professional Degree' ? 'selected' : '' }}>Professional Degree</option>
                                    <option value="Doctorate Degree" {{ old('education', $user->education ?? '') == 'Doctorate Degree' ? 'selected' : '' }}>Doctorate Degree</option>
                                    <option value="Vocational" {{ old('education', $user->education ?? '') == 'Vocational' ? 'selected' : '' }}>Vocational</option>
                                </select>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Contact Number:</div>
                            <div class="col-md-9">
                                <input type="text" name="contactnumber" class="form-control" value="{{ $user->contactnumber}}">
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Address:</div>
                            <div class="col-md-9">
                                <input type="text" name="address" class="form-control" value="{{ $user->address}}">
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Email:</div>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control" value="{{ $user->email}}">
                            </div>
                        </div>

                        <div class="row p-2 mb-5">
                            <div class="col-md-3">Password:</div>
                            <div class="col-md-9">
                                <input type="password" name="password" class="form-control" data-toggle="password" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mr-2"><i class="bi bi-save me-1"></i> Update</button>
                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-secondary"><i class="bi bi-arrow-return-right me-1"></i>Back</a>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <small>
                                @if (!isset($user->information->updated_at))

                                @else
                                    last updated last: {{ $user->information->updated_at->diffForHumans() }}
                                @endif
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
