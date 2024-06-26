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
                            <div class="col-md-3">Name:</div>
                            <div class="col-md-9">
                                <input name="name" type="text" value="{{ $user->name}}" class="form-control">
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Last Name:</div>
                            <div class="col-md-9">
                                <input name="lastname" type="text" value="{{ $user->lastname}}" class="form-control">
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Age:</div>
                            <div class="col-md-9">
                                <input name="age" type="number" value="{{ $user->age}}" class="form-control">
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Gender:</div>
                            <div class="col-md-9">
                                <input name="gender" type="text" value="{{ $user->gender}}" class="form-control">
                            </div>
                        </div>

                        <div class="row p-2">
                            <label for="education" class="col-md-3">Highest Educational Attainment:</label>

                            <div class="col-md-9">
                                <select name="education" class="form-control">
                                    <option value="High School">High School</option>
                                    <option value="Senior High School">Senior High School</option>
                                    <option value="College Undergrad">College Undergrad</option>
                                    <option value="College Degree">College Degree</option>
                                    <option value="Master's Degree">Master's Degree</option>
                                    <option value="Professional Degree">Professional Degree</option>
                                    <option value="Doctorate Degree">Doctorate Degree</option>
                                    <option value="Vocational">Vocational</option>
                                </select>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Contact Number:</div>
                            <div class="col-md-9">
                                <input name="contactnumber" type="text" value="{{ $user->contactnumber}}" class="form-control">
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Address:</div>
                            <div class="col-md-9">
                                <input name="address" type="text" value="{{ $user->address}}" class="form-control">
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">Email:</div>
                            <div class="col-md-9">
                                <input name="email" type="text" value="{{ $user->email}}" class="form-control">
                            </div>
                        </div>

                        <div class="row p-2 mb-5">
                            <div class="col-md-3">Password:</div>
                            <div class="col-md-9">
                                <input name="password" type="password" class="form-control" data-toggle="password" >
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
