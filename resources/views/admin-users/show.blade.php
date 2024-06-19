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
                            <label>Contact Number</label>
                            <p> {{ $user->contactnumber }} </p>
                        </div>
                        <div class="col">
                            <label>Years Experience</label>
                            <p> {{ $user->scores->experience ?? 'N/A'}} </p>
                        </div>
                        <div class="col">
                            <label>Registered</label>
                            <p> <span class="p-1 bg-success text-white">{{ $user->created_at }} </span> </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Happy rate</label>
                            <p> {{ $user->scores->rate ?? 'N/A' }} </p>
                        </div>
                        <div class="col">
                            <label>Portfolio</label>
                            <p>
                                @if(!isset($user->scores->portfolio))
                                    N/A
                                @else
                                    <a href="{{ $user->scores->portfolio }}" target="_blank">{{ \Illuminate\Support\Str::limit($user->scores->portfolio, 30) }}</a>
                                @endif
                            </p>
                        </div>
                        <div class="col">
                            <label>Resume Attachment</label>
                            <p>
                                @if (!isset($user->scores->resume))
                                    N/A
                                @else
                                    <a href="{{ route('view.pdf', $user->scores->resume) }}" target="_blank">Click here</a>
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

<!-- Administrator JS -->
<script src="{{ asset('dist/js/pages/administrator/show.js') }}"></script>

{{-- container end --}}
@endsection
