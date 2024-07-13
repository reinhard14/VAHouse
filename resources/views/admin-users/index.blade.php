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
                        <li class="breadcrumb-item active"><a href="#">Applicants</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-none d-sm-block">
                            <h3>List </h3>
                        </div>
                        <div class="d-sm-none">
                            <i class="bi bi-list-ol"></i>
                        </div>
                        <div class="form-inline">
                            <a href="#create-user-modal" class="btn btn-primary mr-1" data-bs-toggle="modal"><i class="bi bi-person-add mr-1"></i></ion-icon>Add</a>
                            <form method="post" action="#" id="deleteForm">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="selectedUserIds" id="selectedUserIds" value="">
                                <button type="submit" class="btn btn-danger" id="checkboxDeleteButton" disabled>
                                    <i class="bi bi-trash mr-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if ($users->isEmpty())
                        <div class="row">
                            <div class="col">
                                <div class="text-center p-5">
                                    <h3>No <span class="text-danger">applicants</span> found.</h3>
                                    <div> <strong>Tips:</strong> Try reducing the <span class="text-primary">tags</span> used to expect better results,</div>
                                    <div class="mb-5"> or filter using a specific skillset.</div>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary" role="button"><i class="bi bi-arrow-return-right mr-1"></i>Back</a>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="row">
                            <div class="col">
                                <div class="row mb-1 d-flex justify-content-around">
                                    <div class="col" id="search_col">
                                        <form method="GET" action="#" class="form-inline row">
                                            <div class="col-md-8">
                                                <input type="text" name="search" placeholder="Enter search here" class="form-control w-100">
                                            </div>
                                            <div class="col-md-4 text-right p-1">
                                                <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-search mr-1"></i>Search</button>
                                                <a href="{{ route('admin.users.index') }}" type="submit" class="btn btn-outline-danger btn-sm" ><i class="bi bi-arrow-counterclockwise mr-1"></i>Clear</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col d-flex justify-content-end" id="view_col">
                                        <div class="mr-1">
                                            <p> <strong> Current view - </strong></p>
                                        </div>
                                        @if ($sortByLastname)
                                            <div>
                                                <p> Last: <strong> {{ $sortByLastname }}</strong> </p>
                                            </div>
                                        @elseif ($sortByFirstname)
                                            <div>
                                                <p> First: <strong>{{ $sortByFirstname }}</strong> </p>
                                            </div>
                                        @elseif ($sortByDateSubmitted)
                                            <div>
                                                <p> Date Order:<strong> {{ $sortByDateSubmitted }} </strong></p>
                                            </div>
                                        @else
                                            <p>
                                                Default
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="accordion">
                                    <h2 class="accordion-header">
                                        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                            Show/Hide Filters
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="collapse show">
                                        <div class="accordion-body">
                                            <form method="GET" action="#">
                                                @csrf
                                                <div class="form-row">
                                                    @php
                                                        $fields = ['websites',
                                                                    'tools',
                                                                    'skills',
                                                                    'softskills',
                                                                    'experiences',
                                                                    'statuses',
                                                    ];
                                                        $count = 0;
                                                    @endphp

                                                    @foreach ($fields as $index => $field)
                                                        @if ($count % 2 == 0 && $count != 0)
                                                            </div>
                                                            <div class="form-row">
                                                        @endif

                                                        <div class="form-group col-md-4 mb-3">
                                                            @if ($field=='experience')
                                                                <label for="{{ $field }}" class="d-block">Years of {{ ucfirst($field) }}s:</label>
                                                            @else
                                                                <label for="{{ $field }}" class="d-block">{{ ucfirst($field) }}:</label>
                                                            @endif

                                                            <select id="{{ $field }}" class="form-control select2"  name="{{ $field }}[]" multiple="multiple">
                                                                @foreach (${"unique" . ucfirst($field)} as $item)
                                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endforeach

                                                    @php $count++; @endphp

                                                    <div class="form-group col-md-12 mb-3 d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary btn-sm px-5">
                                                            <i class="bi bi-search"></i> Filter
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    @if ($toggleSortLastname === 'desc')
                                                        <a href="{{ route('admin.users.index', ['sortByLastname' => 'asc']) }}" type="submit" class="btn text-primary"
                                                            data-toggle="tooltip" title="Click to ascend last name."><strong>Last Name</strong> <i class="bi bi-sort-alpha-down-alt"></i> </a>
                                                    @else
                                                        <a href="{{ route('admin.users.index', ['sortByLastname' => 'desc']) }}" type="submit" class="btn text-primary"
                                                            data-toggle="tooltip" title="Click to descend last name."><strong>Last Name</strong> <i class="bi bi-sort-alpha-up"></i> </a>
                                                    @endif
                                                </th>
                                                <th>
                                                    @if ($toggleSortFirstname === 'desc')
                                                        <a href="{{ route('admin.users.index', ['sortByFirstname' => 'asc']) }}" type="submit" class="btn text-primary"
                                                            data-toggle="tooltip" title="Click to ascend first name."><strong>First Name</strong> <i class="bi bi-sort-alpha-down-alt"></i> </a>
                                                    @else
                                                        <a href="{{ route('admin.users.index', ['sortByFirstname' => 'desc']) }}" type="submit" class="btn text-primary"
                                                            data-toggle="tooltip" title="Click to descend first name."><strong>First Name</strong> <i class="bi bi-sort-alpha-up"></i> </a>
                                                    @endif
                                                </th>
                                                <th class="text-center">Level</th>
                                                <th class="text-center">Skills</th>
                                                <th class="text-center">Actions</th>
                                                <th class="text-center">Information</th>
                                                <th class="text-center">Intro Vid</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Tier</th>
                                                <th>
                                                    @if ($sortByDateSubmitted === 'desc')
                                                        <a href="{{ route('admin.users.index', ['sortByDateSubmitted' => 'asc']) }}" type="submit" class="btn text-primary"
                                                            data-toggle="tooltip" title="Click to descend submitted date."><strong>Submitted</strong> <i class="bi bi-sort-numeric-up"></i> </a>
                                                    @else
                                                        <a href="{{ route('admin.users.index', ['sortByDateSubmitted' => 'desc']) }}" type="submit" class="btn text-primary"
                                                            data-toggle="tooltip" title="Click to ascend submitted date."><strong>Submitted</strong> <i class="bi bi-sort-numeric-down-alt"></i> </a>
                                                    @endif
                                                </th>
                                                <th class="text-right">
                                                    <label class="form-check-label" for="deleteMasterCheckbox">Delete?</label>
                                                    <input type="checkbox" id="deleteMasterCheckbox">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->lastname }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>
                                                        <div>
                                                            @if(isset($user->information->experience) && !empty($user->information->experience))
                                                                @if ($user->information->experience <= 2)
                                                                    Beginner
                                                                @elseif ($user->information->experience >= 3 && $user->information->experience <= 5)
                                                                    Intermediate
                                                                @else
                                                                    Seasoned
                                                                @endif
                                                            @else
                                                                N/A
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <td class="text-left">
                                                        @php
                                                            $skills = [];

                                                            if (isset($user->skillsets->skill) && !is_null($user->skillsets->skill)) {
                                                                $skills = json_decode($user->skillsets->skill, true);
                                                            }
                                                        @endphp

                                                        @if (!empty($skills) && is_array($skills))
                                                            <ul>
                                                                @foreach ($skills as $skill)
                                                                    <li>{{ $skill }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p>No skills available.</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a href="#add-notes-modal-{{ $user->id }}" data-bs-toggle="modal" class="px-2">
                                                                <i class="bi bi-chat-right-text"></i> Notes
                                                            </a>
                                                            <a href="#update-status-{{ $user->id }}" data-bs-toggle="modal" class="px-2">
                                                                <i class="bi bi-person-exclamation"></i> Status
                                                            </a>
                                                            <a href="#edit-user-modal-{{ $user->id }}" data-bs-toggle="modal" class="px-2">
                                                                <i class="bi bi-person-gear"></i> Edit
                                                            </a>
                                                            <form method="post" action="{{ route('admin.users.destroy', $user->id) }}" class="deleteAdminForm">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn text-danger"> <i class="bi bi-person-x"></i> Delete </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-info" target="_blank"><i class="bi bi-file-earmark-break"></i> View</a>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            @if (!isset($user->information->videolink))
                                                                N/A
                                                            @else
                                                                <a href="{{ route('view.pdf', $user->information->videolink) }}" target="_blank">Open</a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            @if(!isset($user->status->status))
                                                                N/A
                                                            @else
                                                                @php
                                                                    $statusClasses = [
                                                                        'New' => 'badge-success',
                                                                        'Initial-Failed' => 'badge-danger',
                                                                        'Initial-Passed' => 'badge-secondary',
                                                                        'Incomplete' => 'badge-warning',
                                                                        'Final-Failed' => 'badge-danger',
                                                                        'For Review' => 'badge-secondary',
                                                                        'Ready for shortlisting' => 'badge-info',
                                                                        'Onboarded' => 'badge-info',
                                                                        'Hired' => 'badge-primary',
                                                                        'Floating' => 'badge-warning',
                                                                        'Terminated' => 'badge-danger'
                                                                    ];

                                                                    $status = $user->status->status;
                                                                    $badgeClass = $statusClasses[$status] ?? 'badge-default';
                                                                @endphp

                                                                @if (isset($status))
                                                                    <span class="badge {{ $badgeClass }}" data-toggle="tooltip"
                                                                        title="Last updated by: {{ $user->status->updated_by ?? 'N/A' }}
                                                                        Updated on: {{ $user->status->updated_at->diffForHumans(['parts'=>1]) ?? 'N/A' }}">
                                                                        {{ $status }}
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            @if(!isset($user->tier->tier))
                                                                N/A
                                                            @else
                                                                @php
                                                                    $tierClasses = [
                                                                        'Tier 1' => 'badge-secondary',
                                                                        'Tier 2' => 'badge-warning',
                                                                        'Tier 3' => 'badge-info',
                                                                        'Master VA' => 'badge-primary',
                                                                        'Super VA' => 'badge-success',
                                                                    ];

                                                                    $tier = $user->tier->tier;
                                                                    $badgeClass = $tierClasses[$tier] ?? 'badge-default';
                                                                @endphp

                                                                @if (isset($tier))
                                                                    <span class="badge {{ $badgeClass }}" data-toggle="tooltip"
                                                                        title="Updated on: {{ $user->tier->updated_at->diffForHumans(['parts'=>1]) ?? 'N/A' }}">
                                                                        {{ $tier }}
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            {{ $user->created_at->diffForHumans(['parts' => 1]) }}
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <input type="checkbox" class="deleteItemCheckboxes" data-admin-id="{{ $user->id }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination justify-content-center mt-4">{{ $users->appends(['sortByLastname' => $sortByLastname])->links() }} </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /. card -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>

{{--* Modal components here --}}
<x-administrator-applicant.create />

@foreach ($users as $user)
    <x-administrator-applicant.edit :user="$user" />
    <x-administrator-applicant.add-notes :user="$user" />
    <x-administrator-applicant.update-status :user="$user" />
@endforeach


<!-- Administrator JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/applicants/index.js') }}"></script>


{{-- container end --}}
@endsection


