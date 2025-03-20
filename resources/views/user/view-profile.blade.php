@extends('layouts.va.va-layout')

@section('content')

<div class="container-fluid">
    <div class="row profile-header">
        <div class="col m-4 p-3"></div>
    </div>
    <div class="row border-bottom justify-content-center text-center">
        <div class="col-md-6">
            @if (!isset($user->information->photo_formal) || is_null($user->information->photo_formal))
                <img src="{{ asset('dist/img/user_default.png') }}" alt="va-avatar" class="overlap-image">
            @else
                <img src="{{ asset('storage/' . $user->information->photo_formal) }}" alt="va-photo" class="overlap-image">
            @endif
        </div>
    </div>
    <div class="row border-bottom justify-content-center text-center pt-5" style="background-color: white;">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-1 offset-md-11">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-orange-flat form-control">Edit</a>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <span class="d-block mt-5 pt-5">{{ $user->suffix }} {{ $user->name }} {{ $user->middlename }} {{ $user->lastname }} </span>
                    <span class="badge badge-pill badge-success span-normal-text">Active</span>
                    <h5> {{ $workList }} </h5>
                    <span class="text-orange"><i class="bi bi-patch-check-fill"></i> </span> <small class=""> Tier 1 VA </small>
                    <span class="text-orange pl-3"><i class="bi bi-shield-fill-check"></i></span><small> HR Unverified</small>
                </div>
            </div>
        </div>
    </div>

    <!--MAIN ROW START HERE -->
    <div class="row mt-4">
        <div class="col-md-5 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted mb-4">Overview</h5>
                    <div class="row mb-2">
                        <div class="col-md-1">
                            <span class="badge badge-pill medium-icon p-2"><i class="bi bi-briefcase"></i></span>
                        </div>
                        <div class="col text-muted">
                            Looking for <strong> {{ str_replace(['[', ']'], '', $user->references->work_status ?? '') }}</strong> for <strong>40 hours</strong> per week. <strong>{{ $user->information->rate ?? '' }}</strong> Pesos monthly salary.
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-1">
                            <span class="badge badge-pill medium-icon p-2"><i class="bi bi-mortarboard"></i></span>
                        </div>
                        <div class="col text-muted">
                            <strong>
                                {{ $user->degree }}
                            </strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-1">
                            <span class="badge badge-pill medium-icon p-2"><i class="bi bi-person"></i></span>
                        </div>
                        <div class="col text-muted">
                            <small class="d-block font-weight-bold d-flex align-end">
                                Profile Created
                            </small>
                            <small class="d-flex align-start">
                                {{ $user->created_at->format('F d, Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted mb-4">Profile Description</h5>

                    <p class="">
                        {{ $user->references->services_offered ?? ''}}
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Technical Skills</h5>

                    @php
                        $skills = !empty($user->skillsets) ? json_decode($user->skillsets->skill, true) ?? [] : [];
                        $otherSkills = !empty($user->skillsets) ? json_decode($user->skillsets->softskill, true) ?? [] : [];
                        $tools = !empty($user->skillsets) ? json_decode($user->skillsets->tool, true) ?? [] : [];
                    @endphp

                    <div class="mb-3">
                        @forelse ($skills as $skill)
                            <span class="badge badge-pill badge span-orange">
                                {{ $skill }}
                            </span>
                        @empty
                            No skills available.
                        @endforelse
                    </div>

                    <h5 class="text-muted">Other Skills</h5>

                    <div class="mb-3">
                        @forelse ($otherSkills as $otherSkill)
                            <span class="badge badge-pill badge span-orange">
                                {{ $otherSkill }}
                            </span>
                        @empty
                            No soft skills available.
                        @endforelse
                    </div>

                    <h5 class="text-muted">Tools, Websites, and Apps Used</h5>

                    <div class="mb-3">
                        @forelse ($tools as $tool)
                            <span class="badge badge-pill badge span-orange">
                                {{ $tool }}
                            </span>
                        @empty
                            No tools available.
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted mb-3">Employment History</h5>

                    @forelse ($user->employment as $employment)
                        <div class="card p-4">
                            <small class="text-muted">
                                {{ $employment->date_started ?? 'na' }} - {{ $employment->date_ended ?? 'na' }}
                            </small>
                            <h6 class="text-muted">
                                {{ $employment->job_position ?? 'na' }}
                            </h6>
                            <p class="text-muted">
                                {{ $employment->company_details ?? 'na' }}
                            </p>
                            <p class="text-muted">
                                {{ $employment->job_details ?? 'na' }}
                            </p>
                        </div>
                    @empty
                        <div class="card p-4">
                            <h6 class="text-muted text-center">
                                No Employment History added yet.
                            </h6>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted mb-3">VA Information</h5>
                    <small class="text-muted">Age</small>
                    <p class="text-muted font-weight-bold">
                        {{ $ageNow ? $ageNow->diffForHumans(null, true) : '' }}
                    </p>

                    <small class="text-muted">Gender</small>
                    <p class="text-muted font-weight-bold">
                        {{ $user->gender ?? '' }}
                    </p>

                    <small class="text-muted">Address</small>
                    <p class="text-muted font-weight-bold">
                        {{ $user->address ?? '' }}
                    </p>

                    <div class="row mb-3">
                        <div class="col">
                            <small class="text-muted d-block">Files:</small>
                            <span class="d-block text-muted font-weight-bold">Portfolio</span>
                            <small class="font-weight-bold text-orange">
                                @if(isset($user->information) && $user->information->portfolio)
                                    <a href="{{ route('view.file', $user->information->portfolio) }}" target="_blank"
                                        class="font-weight-bold text-orange">Open
                                    </a>
                                @else
                                    No file yet.
                                @endif
                            </small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <span class="d-block text-muted font-weight-bold">Resume</span>
                            <small class="font-weight-bold text-orange">
                                @if(isset($user->information->resume) && $user->information->resume)
                                    <a href="{{ route('view.file', $user->information->resume) }}" target="_blank"
                                        class="font-weight-bold text-orange">Open
                                    </a>
                                @else
                                    No file yet.
                                @endif
                            </small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <span class="d-block text-muted font-weight-bold">DISC</span>
                            <small class="font-weight-bold text-orange">
                                @if(isset($user->information->disc_results) && $user->information->resume)
                                    <a href="{{ route('view.file', $user->information->disc_results) }}" target="_blank"
                                        class="font-weight-bold text-orange">Open
                                    </a>
                                @else
                                    No file yet.
                                @endif
                            </small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <span class="d-block text-muted font-weight-bold">Intro Video</span>
                            <small class="font-weight-bold text-orange">
                                @if(isset($user->information->videolink) && $user->information->videolink)
                                    <a href="{{ route('view.file', $user->information->videolink) }}" target="_blank"
                                        class="font-weight-bold text-orange">Open
                                    </a>
                                @else
                                    No file yet.
                                @endif
                            </small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <span class="d-block text-muted font-weight-bold">Mock Call</span>
                            <small class="font-weight-bold text-orange">
                                @if(isset($user->mockcalls->inbound_call) && $user->mockcalls->inbound_call)
                                    <a href="{{ route('view.file', $user->mockcalls->inbound_call) }}" target="_blank"
                                        class="font-weight-bold text-orange">Inbound
                                    </a>
                                @else
                                    No Inbould yet.
                                @endif
                            </small>
                            <small class="font-weight-bold text-orange">
                                @if(isset($user->mockcalls->outbound_call) && $user->mockcalls->outbound_call)
                                    <a href="{{ route('view.file', $user->mockcalls->outbound_call) }}" target="_blank"
                                        class="font-weight-bold text-orange">Outbound
                                    </a>
                                @else
                                    No Outbound yet.
                                @endif
                            </small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <span class="d-block text-muted font-weight-bold">Valid ID</span>
                            <small>
                                @if(isset($user->information->photo_id) && $user->information->photo_id)
                                    <a href="{{ route('view.file', $user->information->photo_id) }}" target="_blank"
                                        class="font-weight-bold text-orange">Open
                                    </a>
                                @else
                                    No file yet.
                                @endif
                            </small>
                        </div>
                    </div>

                    <small class="text-muted">Contacts</small>
                    <span class="d-block text-muted font-weight-bold">
                        Skype
                    </span>
                    <small class="text-muted">{{ $user->information->skype ?? '' }}</small>

                    <span class="d-block text-muted font-weight-bold">
                        Email
                    </span>
                    <small class="text-muted">{{ $user->email ?? '' }}</small>

                    <span class="d-block text-muted font-weight-bold">
                        Phone Number
                    </span>
                    <small class="text-muted">{{ $user->contactnumber ?? '' }}</small>

                    <small class="d-block text-muted mt-4">Bank Account</small>
                    <span class="d-block text-muted font-weight-bold">
                        {{ $user->information->ub_account ?? '' }}
                    </span>
                    <small class="text-muted">{{ $user->information->ub_number ?? '' }}</small>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Emergency Contact Information</h5>

                    <small class="text-muted d-block">
                        Incase of Emergency
                    </small>
                    <p class="text-muted font-weight-bold">
                        {{ $user->references->emergency_person ?? '' }}
                    </p>
                    <small class="text-muted d-block font-weight-bold">
                        {{ $user->references->emergency_relationship ?? '' }}
                    </small>
                    <small class="text-muted d-block font-weight-bold">
                        {{ $user->references->emergency_number ?? '' }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/user-end/edit-profile.js') }}"></script>

@endsection
