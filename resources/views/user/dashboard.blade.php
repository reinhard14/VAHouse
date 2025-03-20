@extends('layouts.va.va-layout')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 offset-md-1 mb-5 pb-5">
            <div class="row my-4">
                <div class="col">
                    <h3>Dashboard</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            @include('includes.messages')

                            <div class="row">
                                <div class="col-md-4 border-right">
                                    <p class="py-3">
                                        Completing your profile will allow us to better understand your qualifications and ensure a smooth evaluation
                                        of your application. This is an essential step before we can consider you for any opportunities.
                                    </p>
                                </div>

                                <div class="col py-3">
                                    <div class="row">
                                        <div class="col">
                                            <span class="text-success"> <i class="bi bi-check-circle-fill large-icon"></i></span>
                                            <span class="pl-3 font-weight-bolder">Sign up to a VA House Applicant System</span>
                                        </div>
                                        <div class="col-4 text-right align-content-center">
                                            <a href="#" class="text-muted btn-link disabled">Completed <i class="bi bi-arrow-right-circle"></i></a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col ">
                                            <span class="text-success"> <i class="bi bi-check-circle-fill large-icon"></i></span>
                                            <span class="pl-3 font-weight-bolder">Email Verification</span>
                                        </div>
                                        <div class="col-4 text-right align-content-center">
                                            <a href="#" class="text-muted btn-link disabled">Completed <i class="bi bi-arrow-right-circle"></i></a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <span class="text-secondary"><i class="bi bi-check-circle-fill large-icon"></i></span>
                                            <span class="pl-3 font-weight-bolder">Complete Profile</span>
                                        </div>
                                        <div class="col-4 text-right align-content-center">
                                            <a href="{{ route('user.edit', $user->id) }}" class="text-muted"><span class="text-orange pl-3"> Proceed <i class="bi bi-arrow-right-circle"></i></span></a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <span class="text-secondary"><i class="bi bi-check-circle-fill large-icon"></i></span>
                                            <span class="pl-3 font-weight-bolder">HR Verification</span>
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

    <div class="row pb-5">
    </div>

    <div class="row pb-5">
    </div>

    <div class="row pb-5">
    </div>

    <div class="row pb-5">
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/user-end/index.js') }}"></script>

@endsection
