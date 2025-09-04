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

                            @if(!isset($user->information->videolink) || $user->information->videolink == null)
                                <div class="row">
                                    <div class="col-md-4 border-right">
                                        <p class="py-3">
                                            Completing your profile will allow us to better understand your qualifications and ensure a smooth evaluation
                                            of your application. This is an essential step before we can consider you for any opportunities.
                                        </p>
                                        <p class="font-italic text-orange">
                                            Note: Your profile is still incomplete. Please complete your profile to proceed with the application process.
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
                            @else
                                <div class="row border-bottom mb-3">
                                    <div class="col text-center mb-3">
                                        @if (!isset($user->information->photo_formal) || is_null($user->information->photo_formal))
                                            <img src="{{ asset('dist/img/user_default.png') }}" alt="va-avatar" class="overlap-image-dashboard">
                                        @else
                                            <img src="{{ asset('storage/' . $user->information->photo_formal) }}" alt="va-photo" class="overlap-image-dashboard">
                                        @endif
                                        <p>
                                            <span class=" badge badge-pill badge-success span-normal-text"> {{ $user->status->status ?? '' }}</span>
                                        </p>

                                        <span class="text-orange"><i class="bi bi-patch-check-fill"></i> </span> <small class=""> @if(isset($user->tier->tier)){{ $user->tier->tier }} @else Tier not set for this @endif </small>
                                        <span class="text-orange pl-3">
                                            <i @class([
                                                'bi bi-shield-fill-check' => isset($user->status->updated_by),
                                                'bi-x-circle' => !isset($user->status->updated_by)
                                            ])></i>
                                        </span>
                                        <small> @if(isset($user->status->updated_by)){{ $user->status->status }} @else HR Unverified @endif </small>
                                    </div>
                                    <div class="col">
                                        <small>
                                            Service Provider Name
                                        </small>
                                        <p class="font-weight-bold">{{ $user->name }} {{ $user->middlename }} {{ $user->lastname }} {{ $user->suffix }}</p>

                                        <small>
                                            Date Hired
                                        </small>
                                        <p class="font-weight-bold">NA</p>

                                        <small>
                                            Department/Client
                                        </small>
                                        <p class="font-weight-bold">NA</p>
                                    </div>
                                    <div class="col">
                                        <small>
                                            Designation
                                        </small>
                                        <p class="font-weight-bold">Virtual Assistant</p>

                                        <small>
                                            Shift
                                        </small>
                                        <p class="font-weight-bold">
                                            @if(gettype($user->references->work_status) == 'string')
                                                {{ $user->references->work_status ?? ''}}
                                            @else
                                                {{ implode(', ', json_decode($user->references->work_status)) }}
                                            @endif
                                        / 40 hours per week
                                        </p>

                                        <small>
                                            Team Leader
                                        </small>
                                        <p class="font-weight-bold">
                                            {{ $user->references->team_leader ?? '' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="row border-bottom mb-3 px-4">
                                    <div class="col-md-8">
                                        <small>
                                            Services Offered
                                        </small>
                                        <p class="font-weight-bold">
                                            {{ implode(', ', json_decode($user->information->positions)) }}
                                        </p>
                                    </div>
                                    <div class="col">
                                        <small>
                                            Rate in Peso
                                        </small>
                                        <p class="font-weight-bold">
                                            @if(gettype($user->references->work_status) == 'string')
                                                @if (strcasecmp($user->references->work_status, 'part-time') == 0)
                                                    {{ ((($user->information->rate)/11)/8) ?? '' }}
                                                @else
                                                    {{ ((($user->information->rate)/21)/8) ?? '' }}
                                                @endif
                                            @else
                                                @if (in_array('part-time', array_map('strtolower', json_decode($user->references->work_status))) &&
                                                    in_array('full-time', array_map('strtolower', json_decode($user->references->work_status))))
                                                    {{ ((($user->information->rate)/21)/8) ?? '' }}
                                                @elseif ((in_array('part-time', array_map('strtolower', json_decode($user->references->work_status)))))
                                                    {{ ((($user->information->rate)/11)/8) ?? '' }}
                                                @elseif (in_array('full-time', array_map('strtolower', json_decode($user->references->work_status))))
                                                    {{ ((($user->information->rate)/21)/8) ?? '' }}
                                                @else
                                                    ---
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="row px-4">
                                    <div class="col-md-8">
                                        <small>
                                            Mobile Number
                                        </small>
                                        <p class="font-weight-bold"> {{ $user->contactnumber ?? '' }} </p>
                                    </div>
                                    <div class="col">
                                        <small>
                                            Email
                                        </small>
                                        <p class="font-weight-bold"> {{ $user->email ?? '' }} </p>
                                    </div>
                                </div>
                            @endif

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
