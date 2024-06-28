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
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label>First Name</label>
                            <p> {{ $user->name }} </p>
                        </div>
                        <div class="col">
                            <label>Last Name</label>
                            <p> {{ $user->lastname }} </p>
                        </div>
                        <div class="col">
                            <label>Email</label>
                            <p> {{ $user->email }} </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="mr-1">Age</label> <label>Gender</label>
                            <p> {{ $user->age }} - {{ $user->gender }}</p>
                        </div>
                        <div class="col">
                            <label>Highest Educational Attainment</label>
                            <p> {{ $user->education }} </p>
                        </div>
                        <div class="col">
                            <label>Address</label>
                            <p> {{ $user->address }} </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Contact Number</label>
                            <p> {{ $user->contactnumber }} </p>
                        </div>
                        <div class="col">
                            <label>Years Experience</label>
                            <p> {{ $user->information->experience ?? 'N/A'}} </p>
                        </div>
                        <div class="col">
                            <label>Registered</label>
                            <p> <span class="badge badge-pill badge-success">{{ $user->created_at->diffForHumans(['parts' => 2]) }} </span> </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Happy rate</label>
                            <p> {{ $user->information->rate ?? 'N/A' }} </p>
                        </div>
                        <div class="col">
                            <label>Niche</label>
                            <p> {{ $user->information->niche ?? 'N/A'}} </p>
                        </div>
                        <div class="col">
                            <label>Skype</label>
                            <p> {{ $user->information->skype ?? 'N/A' }} </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Union Bank</label>
                            <p> {{ $user->information->ub_account ?? 'N/A'}} - {{ $user->information->ub_number ?? 'N/A'}} </p>
                        </div>
                        <div class="col">
                            <label>Portfolio</label>
                            <p>
                                @if(!isset($user->information->portfolio))
                                    N/A
                                @else
                                    <a href="{{ $user->information->portfolio }}" target="_blank" class="badge badge-primary">{{ \Illuminate\Support\Str::limit($user->information->portfolio, 30) }}</a>
                                @endif
                            </p>
                        </div>
                        <div class="col">
                            <label>Resume Attachment</label>
                            <p>
                                @if (!isset($user->information->resume))
                                    N/A
                                @else
                                    <a href="{{ route('view.pdf', $user->information->resume) }}" target="_blank" class="badge badge-primary">Click here</a>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>ID Attachments</label>
                            <p>
                                @if(!isset($user->information->photo_id))
                                    N/A
                                @else
                                    <a href="{{ route('view.pdf', $user->information->photo_id) }}" target="_blank" class="badge badge-primary">Click here</a>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label>Formal Photo</label>
                            <p>
                                @if(!isset($user->information->photo_formal))
                                    N/A
                                @else
                                    <a href="{{ route('view.pdf', $user->information->photo_formal) }}" target="_blank" class="badge badge-primary">Click here</a>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label>DISC Results</label>
                            <p>
                                @if(!isset($user->information->disc_results))
                                    N/A
                                @else
                                    <a href="{{ route('view.pdf', $user->information->disc_results) }}" target="_blank" class="badge badge-primary">Click here</a>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">Websites: </div>
                        <div class="col-md-9">{{ $skillset->website ?? 'N/A'  }} </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">Tools: </div>
                        <div class="col-md-9">{{ $skillset->tool ?? 'N/A'  }} </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">Skills: </div>
                        <div class="col-md-9">{{ $skillset->skill ?? 'N/A'  }} </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-3">Soft skills: </div>
                        <div class="col-md-9">{{ $skillset->softskill ?? 'N/A'  }} </div>
                    </div>

                    <div class="row mb-2">
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
                            {{-- <div class="p-2">
                                <a href="#" class="btn btn-primary" id="generateApplicantsForm">Generate Form</a>
                            </div> --}}
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


{{-- container end --}}
@endsection
