@extends('layouts.admin-master-layout')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="ml-2">Applicants</h1>
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

    <!-- general form elements disabled -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Applicant's Information</h3>
                    <h5 class="card-tools">Status: @if(!isset($user->status->status)) N/A @else {{ $user->status->status }} @endif</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label>First Name</label>
                            <p> {{ $user->name }} </p>
                        </div>
                        <div class="col">
                            <label>Middle Name</label>
                            <p> {{ $user->middlename ?? ''}} </p>
                        </div>
                        <div class="col">
                            <label>Last Name</label>
                            <p> {{ $user->lastname }} </p>
                        </div>
                        <div class="col">
                            <label>Suffix</label>
                            <p> {{ $user->suffix ?? 'n/a'}} </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Age -</label> <label>Gender</label>
                            <p> {{ $user->age }} - {{ $user->gender }}</p>
                        </div>
                        <div class="col">
                            <label>Contact Number</label>
                            <p> {{ $user->contactnumber }} </p>
                        </div>
                        <div class="col">
                            <label>Email</label>
                            <p> {{ $user->email }} </p>
                        </div>
                        <div class="col">
                            <label>Address</label>
                            <p> {{ $user->address }} </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Union Bank</label>
                            <p> {{ $user->information->ub_account ?? 'N/A'}} - {{ $user->information->ub_number ?? 'N/A'}} </p>
                        </div>
                        <div class="col">
                            <label>Years Experience</label>
                            <p> {{ $user->information->experience ?? 'N/A'}} </p>
                        </div>
                        <div class="col">
                            <label>Happy rate</label>
                            <p> {{ $user->information->rate ?? 'N/A' }} </p>
                        </div>
                        <div class="col">
                            <label>Registered</label>
                            <p> <span class="badge badge-pill badge-success">{{ $user->created_at->diffForHumans(['parts' => 2]) }} </span> </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Highest Educational Attainment</label>
                            <p> {{ $user->education }} </p>
                        </div>
                        <div class="col">
                            <label>Niche</label>
                            <p> {{ $user->information->niche ?? 'N/A'}} </p>
                        </div>
                        <div class="col">
                            <label>Skype</label>
                            <p> {{ $user->information->skype ?? 'N/A' }} </p>
                        </div>
                        <div class="col">
                            <label>LMS Status</label>
                            <p>
                                @if(!isset($user->status->lesson))
                                    <span class="badge badge-default">N/A</span>
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
                                            title="Last updated by: {{ $user->status->updated_by ?? 'N/A' }}
                                            Updated on: {{ $user->status->updated_at->diffForHumans(['parts'=>1]) ?? 'N/A' }}">
                                            {{ $lessonStatus }}
                                        </span>
                                    @endif
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Portfolio</label>
                            <p>
                                @if(!isset($user->information->portfolio) || is_null($user->information->portfolio))
                                    N/A
                                @else
                                    <a href="{{ route('view.pdf', $user->information->portfolio) }}" target="_blank">Open</a>
                                @endif
                            </p>
                        </div>
                        <div class="col">
                            <label>Resume Attachment</label>
                            <p>
                                @if (!isset($user->information->resume) || is_null($user->information->resume))
                                    N/A
                                @else
                                    <a href="{{ route('view.pdf', $user->information->resume) }}" target="_blank">Open</a>
                                @endif
                            </p>
                        </div>
                        <div class="col">
                            <label>ID Attachments</label>
                            <p>
                                @if(!isset($user->information->photo_id) || is_null($user->information->photo_id))
                                    N/A
                                @else
                                    <a href="{{ route('view.pdf', $user->information->photo_id) }}" target="_blank">Open</a>
                                @endif
                            </p>
                        </div>
                        <div class="col">
                            <label>Formal Photo</label>
                            <p>
                                @if(!isset($user->information->photo_formal) || is_null($user->information->photo_formal))
                                    N/A
                                @else
                                    <a href="{{ route('view.pdf', $user->information->photo_formal) }}" target="_blank">Open</a>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>DISC Results</label>
                            <p>
                                @if(!isset($user->information->disc_results) || is_null($user->information->disc_results))
                                    N/A
                                @else
                                    <a href="{{ route('view.pdf', $user->information->disc_results) }}" target="_blank">Open</a>
                                @endif
                            </p>
                        </div>
                        @if (!isset($user->mockcalls) || is_null($user->mockcalls))
                            <div class="col-md-3">
                                <h5>No Mock Call files available.</h5>
                            </div>
                        @else
                            @php
                                $inboundCall = isset($user->mockcalls->inbound_call) ? $user->mockcalls->inbound_call : null;
                                $outboundCall = isset($user->mockcalls->outbound_call) ? $user->mockcalls->outbound_call : null;
                            @endphp

                            @if (!is_null($inboundCall) || !is_null($outboundCall))
                                <div class="col-md-3">
                                    <label>Mock Calls</label>
                                </div>
                                <div class="col-md-3">
                                    @if (is_null($inboundCall))
                                        <h6>Inbound file not available.</h6>
                                    @elseif (!is_null($inboundCall))
                                        <p>Inbound: <a href="{{ route('view.pdf', $inboundCall) }}" target="_blank">Open</a></p>
                                    @endif

                                    @if (is_null($outboundCall))
                                        <h6>Outbound file not available.</h6>
                                    @elseif (!is_null($outboundCall))
                                        <p>Outbound: <a href="{{ route('view.pdf', $outboundCall) }}" target="_blank">Open</a></p>
                                    @endif
                                </div>
                            @else
                                <div class="col-md-3">
                                    <h5>No Mock Call files available.</h5>
                                </div>
                            @endif
                        @endif
                    </div>

                    <hr>

                    <div class="row my-4">
                        <div class="col-md-3">Applied positions: </div>
                        <div class="col-md-9">
                            @php
                                $positions = [];

                                if (isset($user->information->positions) && !is_null($user->information->positions)) {
                                    $positions = json_decode($user->information->positions, true);
                                }
                            @endphp

                            @if (!empty($positions) && is_array($positions))
                                <ul>
                                    @foreach ($positions as $position)
                                        <li>{{ $position }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No positions selected by the applicant.</p>
                            @endif
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-md-3">Websites: </div>
                        <div class="col-md-9">
                            @php
                                $websites = [];

                                if (isset($skillset->website) && !is_null($skillset->website)) {
                                    $websites = json_decode($skillset->website, true);
                                }
                            @endphp

                            @if (!empty($websites) && is_array($websites))
                                <ul>
                                    @foreach ($websites as $website)
                                        <li>{{ $website }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No websites selected by the applicant.</p>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">Tools: </div>
                        <div class="col-md-9">
                            @php
                                $tools = [];

                                if (isset($skillset->tool) && !is_null($skillset->tool)) {
                                    $tools = json_decode($skillset->tool, true);
                                }
                            @endphp

                            @if (!empty($tools) && is_array($tools))
                                <ul>
                                    @foreach ($tools as $tool)
                                        <li>{{ $tool }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No tools selected by the applicant.</p>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">Skills: </div>
                        <div class="col-md-9">
                            @php
                                $skills = [];

                                if (isset($skillset->skill) && !is_null($skillset->skill)) {
                                    $skills = json_decode($skillset->skill, true);
                                }
                            @endphp

                            @if (!empty($skills) && is_array($skills))
                                <ul>
                                    @foreach ($skills as $skill)
                                        <li>{{ $skill }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No skills selected by the applicant.</p>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-3">Soft skills: </div>
                        <div class="col-md-9">
                            @php
                                $softskills = [];

                                if (isset($skillset->softskill) && !is_null($skillset->softskill)) {
                                    $softskills = json_decode($skillset->softskill, true);
                                }
                            @endphp

                            @if (!empty($softskills) && is_array($softskills))
                                <ul>
                                    @foreach ($softskills as $softskill)
                                        <li>{{ $softskill }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No softskills selected by the applicant.</p>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row my-4">
                        <div class="col-md-3"><strong>Notes:</strong> </div>
                        <div class="col-md-6">{{ $user->review->notes ?? 'N/A'  }} </div>
                        <div class="col-md-3">
                            @isset($user->review->updated_at)
                                <strong>Updated on:</strong> {{ $user->review->updated_at->diffForHumans() }}
                            @endisset
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-3"><strong>Reviewed by:</strong> </div>
                        <div class="col-md-6">{{ $user->review->reviewed_by ?? 'N/A'  }} </div>
                        <div class="col-md-3"><strong>Reviewed on:</strong>
                            @if(!isset($user->review->created_at))
                                N/A
                            @else
                                {{ $user->review->created_at->diffForHumans() }}
                            @endif
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col d-flex justify-content-center">
                            <div class="p-2">
                                <a href="#formatted-form-modal-{{ $user->id }}" class="btn btn-primary" data-bs-toggle="modal"><i class="bi bi-file-richtext mr-1"></i>Generate Form</a>
                            </div>
                            <div class="p-2">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary" role="button"><i class="bi bi-arrow-return-right mr-1"></i>Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>

</div>

{{--* Modal components here --}}
<x-administrator-applicant.formatted-form :user="$user" />

{{-- container end --}}
@endsection
