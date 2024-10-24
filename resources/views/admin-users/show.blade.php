@extends('layouts.admin-master-layout')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="ml-2">Applicant</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Applicants</a></li>
                        <li class="breadcrumb-item active"><a href="#">View</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if (!isset($user->information->photo_id) || is_null($user->information->photo_id))
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('dist/img/user_default.png') }}" alt="default photo" style="height: 225px; width: 225px;">
                                @else
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/' . $user->information->photo_formal) }}" alt="formal photo" style="height: auto; width: 225px;">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }} {{ $user->middlename }} {{ $user->lastname }} {{ $user->suffix ?? ''}} </h3>

                            <p class="text-muted text-center">{{ $user->experiences->last()->title ?? 'unavailable'}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">
                                            <strong><i class="fas fa-book mr-1"></i> Niche</strong>
                                            <p class="text-muted">
                                                {{ $user->information->niche ?? 'unavailable'}}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">
                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Reviews</strong>
                                            <p class="text-muted">{{ $user->reviews->last()->notes ?? 'unavailable' }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">
                                            <strong><i class="far fa-file-alt mr-1"></i> Reviewed by:</strong>
                                            <p class="text-muted">{{ $user->reviews->last()->reviewed_by ?? 'unavailable'  }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <strong>Reviewed on:</strong>
                                            @if(!isset($user->reviews->last()->created_at))
                                                <p class="text-muted">unavailable</p>
                                            @else
                                                <p class="text-muted">{{ $user->reviews->last()->created_at->format('M. d, Y') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            @php
                                $statusClasses = [
                                    'New' => 'btn-success',
                                    'For Initial Interview' => 'btn-secondary',
                                    'Initial-Failed' => 'btn-danger',
                                    'Initial-Passed' => 'btn-secondary',
                                    'Incomplete' => 'btn-warning',
                                    'Final-Failed' => 'btn-danger',
                                    'For Review' => 'btn-secondary',
                                    'Not Qualified' => 'btn-danger',
                                    'Ready for shortlisting' => 'btn-info',
                                    'Onboarded' => 'btn-info',
                                    'Inactive' => 'btn-warning',
                                    'Hired' => 'btn-primary',
                                    'Floating' => 'btn-warning',
                                    'Terminated' => 'btn-danger'
                                ];

                                $status = $user->status->status;
                                $buttonClass = $statusClasses[$status] ?? 'badge-default';
                            @endphp

                            <a href="#" class="btn {{ $buttonClass }} btn-block disabled"><b>{{ $user->status->status }}</b></a>

                            <div class="row mt-2">
                                <div class="col text-center">
                                    <strong><i class="far fa-file-alt mr-1"></i> Status set by: </strong>
                                    <p class="text-muted">{{ $user->status->updated_by ?? 'unavailable' }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#information" data-toggle="tab">Information</a></li>
                            <li class="nav-item"><a class="nav-link" href="#skillset" data-toggle="tab">Skillset</a></li>
                            <li class="nav-item"><a class="nav-link" href="#attachments" data-toggle="tab">Attachments</a></li>
                        </ul>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="information">
                                <div class="row">
                                    <b class="col-sm-4">Age</b>
                                    <div class="col-sm-8">
                                        <p> {{ $user->age ?? 'unavailable' }} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-sm-4">Gender</b>
                                    <div class="col-sm-8">
                                        <p> {{ $user->gender ?? 'unavailable' }} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-sm-4">Email</b>
                                    <div class="col-sm-8">
                                        <p> {{ $user->email ?? 'unavailable' }} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-sm-4">Contact Number</b>
                                    <div class="col-sm-8">
                                        <p> {{ $user->contactnumber ?? 'unavailable' }} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-sm-4">Skype</b>
                                    <div class="col-sm-8">
                                        <p> {{ $user->information->skype ?? 'unavailable' }} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-sm-4">Highest Educational Attainment</b>
                                    <div class="col-sm-8">
                                        <p> {{ $user->education ?? 'unavailable' }} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-sm-4">Location</b>
                                    <div class="col-sm-8">
                                        <p> {{ $user->address ?? 'unavailable' }} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-sm-4">Happy rate</b>
                                    <div class="col-sm-8">
                                        <p> {{ $user->information->rate ?? 'unavailable' }} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-sm-4">Registered</b>
                                    <div class="col-sm-8">
                                        <p> {{ $user->created_at->format('M. d, Y') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-sm-4">Union Bank Details</b>
                                    <div class="col-sm-8">
                                        <p> {{ $user->information->ub_account ?? 'unavailable'}} - {{ $user->information->ub_number ?? 'unavailable'}} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-sm-4">VA experience</b>
                                    <div class="col-sm-8">
                                        <p> {{ $user->information->experience ?? 'unavailable'}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-sm-4">Registered</b>
                                    <div class="col-sm-8">
                                        <p> {{ $user->created_at->format('M. d, Y') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-sm-4"> LMS Status </b>
                                    <div class="col-sm-8">
                                        <p>
                                            @if(!isset($user->status->lesson))
                                                <span class="badge badge-default">unavailable</span>
                                            @else
                                                @php
                                                    $statusClasses = [
                                                        'Incomplete' => 'badge-danger',
                                                        'In Progress' => 'badge-warning',
                                                        'Completed' => 'badge-success',
                                                    ];

                                                    $lessonStatus = $user->status->lesson;
                                                    $badgeClass = $statusClasses[$lessonStatus] ?? 'badge-default';
                                                @endphp

                                                @if (isset($lessonStatus))
                                                    <span class="badge {{ $badgeClass }}" data-toggle="tooltip"
                                                        title="Last updated by: {{ $user->status->updated_by ?? 'unavailable' }}
                                                        Updated on: {{ $user->status->updated_at->diffForHumans(['parts'=>1]) ?? 'unavailable' }}">
                                                        {{ $lessonStatus }}
                                                    </span>
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center mt-5">
                                    <div>
                                        <a href="#formatted-form-modal-{{ $user->id }}" class="btn btn-primary" data-bs-toggle="modal"><i class="bi bi-file-richtext mr-1"></i>Generate Form</a>
                                    </div>
                                    <div class="ml-3">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary" role="button"><i class="bi bi-arrow-return-right mr-1"></i>Back</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="skillset">
                                <div class="row mb-2">
                                    <div class="col-sm-4">
                                        <b>Positions Applied</b>
                                    </div>

                                    <div class="col-sm-8">
                                        @php
                                            $positions = [];

                                            if (isset($user->information->positions) && !is_null($user->information->positions)) {
                                                $positions = json_decode($user->information->positions, true);
                                            }
                                        @endphp

                                        @if (!empty($positions) && is_array($positions))
                                            @foreach ($positions as $position)
                                                {{ $position }},
                                            @endforeach
                                        @else
                                            <p>No positions available.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <b class="col-sm-4">Skills</b>
                                    <div class="col-sm-8">
                                        @php
                                            $skills = [];

                                            if (isset($skillset->skill) && !is_null($skillset->skill)) {
                                                $skills = json_decode($skillset->skill, true);
                                            }
                                        @endphp

                                        @if (!empty($skills) && is_array($skills))
                                            @foreach ($skills as $skill)
                                                {{ $skill }},
                                            @endforeach
                                        @else
                                            <p>No skills available.</p>
                                        @endif

                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <b class="col-sm-4">Websites</b>
                                    <div class="col-sm-8">
                                        @php
                                            $websites = [];

                                            if (isset($skillset->website) && !is_null($skillset->website)) {
                                                $websites = json_decode($skillset->website, true);
                                            }
                                        @endphp

                                        @if (!empty($websites) && is_array($websites))
                                            @foreach ($websites as $website)
                                                {{ $website }},
                                            @endforeach
                                        @else
                                            <p>No websites available.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <b class="col-sm-4">Tools</b>
                                    <div class="col-sm-8">
                                        @php
                                            $tools = [];

                                            if (isset($skillset->tool) && !is_null($skillset->tool)) {
                                                $tools = json_decode($skillset->tool, true);
                                            }
                                        @endphp

                                        @if (!empty($tools) && is_array($tools))
                                            @foreach ($tools as $tool)
                                               {{ $tool }},
                                            @endforeach
                                        @else
                                            <p>No tools available.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <b class="col-sm-4">Softskills</b>
                                    <div class="col-sm-8">
                                        @php
                                            $softskills = [];

                                            if (isset($skillset->softskill) && !is_null($skillset->softskill)) {
                                                $softskills = json_decode($skillset->softskill, true);
                                            }
                                        @endphp

                                        @if (!empty($softskills) && is_array($softskills))

                                            @foreach ($softskills as $softskill)
                                                {{ $softskill }},
                                            @endforeach

                                        @else
                                            <p>No softskills available.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col d-flex justify-content-center mt-5">
                                    <div>
                                        <a href="#formatted-form-modal-{{ $user->id }}" class="btn btn-primary" data-bs-toggle="modal"><i class="bi bi-file-richtext mr-1"></i>Generate Form</a>
                                    </div>
                                    <div class="ml-3">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary" role="button"><i class="bi bi-arrow-return-right mr-1"></i>Back</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane attachments-->

                            <div class="tab-pane" id="attachments">
                                <div class="row mb-2">
                                    <b class="col-sm-4">Portfolio</b>
                                    <div class="col-sm-8">
                                        @if(!isset($user->information->portfolio) || is_null($user->information->portfolio))
                                            <p>unavailable</p>
                                        @else
                                            <a href="{{ route('view.pdf', $user->information->portfolio) }}" target="_blank">Open</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <b class="col-sm-4">Resume Attachment</b>
                                    <div class="col-sm-8">
                                        @if(!isset($user->information->resume) || is_null($user->information->resume))
                                            <p>unavailable</p>
                                        @else
                                            <a href="{{ route('view.pdf', $user->information->resume) }}" target="_blank">Open</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <b class="col-sm-4">ID Attachments</b>
                                    <div class="col-sm-8">
                                        @if(!isset($user->information->photo_id) || is_null($user->information->photo_id))
                                            <p>unavailable</p>
                                        @else
                                            <a href="{{ route('view.pdf', $user->information->photo_id) }}" target="_blank">Open</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <b class="col-sm-4">Formal Photo</b>
                                    <div class="col-sm-8">
                                        @if(!isset($user->information->photo_formal) || is_null($user->information->photo_formal))
                                            <p>unavailable</p>
                                        @else
                                            <a href="{{ route('view.pdf', $user->information->photo_formal) }}" target="_blank">Open</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <b class="col-sm-4">DISC Results</b>
                                    <div class="col-sm-8">
                                        @if(!isset($user->information->disc_results) || is_null($user->information->disc_results))
                                            <p>unavailable</p>
                                        @else
                                            <a href="{{ route('view.pdf', $user->information->disc_results) }}" target="_blank">Open</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    @if (!isset($user->mockcalls) || is_null($user->mockcalls))
                                        <div class="col-md-3">
                                            <b>Mock call files unavailable.</b>
                                        </div>
                                    @else
                                        @php
                                            $inboundCall = isset($user->mockcalls->inbound_call) ? $user->mockcalls->inbound_call : null;
                                            $outboundCall = isset($user->mockcalls->outbound_call) ? $user->mockcalls->outbound_call : null;
                                        @endphp

                                        @if (!is_null($inboundCall) || !is_null($outboundCall))
                                            <div class="col-sm-4">
                                                <b>Mock Calls</b>
                                            </div>
                                            <div class="col-sm-8">
                                                @if (is_null($inboundCall))
                                                    <p>Inbound file not available.</p>
                                                @elseif (!is_null($inboundCall))
                                                    <p>Inbound: <a href="{{ route('view.pdf', $inboundCall) }}" target="_blank">Open</a></p>
                                                @endif

                                                @if (is_null($outboundCall))
                                                    <p>Outbound file not available.</p>
                                                @elseif (!is_null($outboundCall))
                                                    <p>Outbound: <a href="{{ route('view.pdf', $outboundCall) }}" target="_blank">Open</a></p>
                                                @endif
                                            </div>
                                        @else
                                            <div class="col-sm-4">
                                                <h5>No Mock Call files available.</h5>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="col d-flex justify-content-center mt-5">
                                    {{-- <div>
                                        <a href="#formatted-form-modal-{{ $user->id }}" class="btn btn-primary" data-bs-toggle="modal"><i class="bi bi-file-richtext mr-1"></i>Generate Form</a>
                                    </div> --}}
                                    <div class="ml-3">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary" role="button"><i class="bi bi-arrow-return-right mr-1"></i>Back</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane skillset-->
                        </div>
                    <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
      <!-- /.content -->
</div>
{{-- container end --}}

{{--* Modal components here --}}
<x-administrator-applicant.formatted-form :user="$user" />

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('dist/js/pages/applicants/show.js') }}"></script>

@endsection
