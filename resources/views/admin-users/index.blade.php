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
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Applicants</a></li>
                    </ol>
                </div>
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
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary" role="button"><i class="bi bi-arrow-return-right mr-1"></i>Back</a>
                                </div>
                            </div>
                        </div>

                    @else
                        {{-- SEARCH ROW--}}
                        <div class="row mb-4">
                            <div class="col-md-6" id="search_col">
                                <form method="GET" action="#" class="form-inline row">
                                    <input type="hidden" id="display" name="display" value="{{ request('display') }}">
                                    <div class="col-md-8">
                                        <input type="text" name="search" placeholder="Search name, previous jobs, skills, tools, websites here.." class="form-control w-100">
                                    </div>
                                    <div class="col-md-4 text-right p-1">
                                        <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-search mr-1"></i>Search</button>
                                        <a href="{{ route('admin.users.index') }}" type="submit" class="btn btn-outline-danger btn-sm" ><i class="bi bi-arrow-counterclockwise mr-1"></i>Clear</a>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" id="filterButton" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    Show/Hide Filters
                                </button>
                            </div>
                        </div>

                        {{-- FILTERS ROW --}}
                        <div class="row">
                            <div class="col">
                                <div class="accordion">
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
                                                                    'tiers',
                                                                    'LMS',
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

                                                            <select id="{{ $field }}" name="{{ $field }}[]" class="form-control select2" data-placeholder="Select {{ $field }}" multiple="multiple">
                                                                @foreach (${"unique" . ucfirst($field)} as $item)
                                                                    <option value="{{ $item }}" {{ in_array($item, request()->query($field, [])) ? 'selected' : '' }}>
                                                                        {{ $item }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endforeach

                                                    @php $count++; @endphp

                                                    <div class="form-group col-md-12 d-flex justify-content-around">
                                                        <div class="col-md-4">
                                                            <h6>Display:</h6>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="display" id="flexRadioDefault2" value="" {{ request('display') == '' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    Complete Forms Only
                                                                </label>
                                                              </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="display" id="flexRadioDefault1" value="optionIncomplete" {{ request('display') == 'optionIncomplete' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    Incomplete Forms Only
                                                                </label>
                                                              </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="display" id="incompleteRadio" value="optionMixed" {{ request('display') == 'optionMixed' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="incompleteRadio">
                                                                    All Forms
                                                                </label>
                                                              </div>
                                                        </div>

                                                        <div class="col-md-4" id="view_col">
                                                            <p> <label> Current view - </label>
                                                                @if ($sortByLastname)
                                                                    Last Name: <span class="badge badge-info"> {{ $sortByLastname }}</span>
                                                                @elseif ($sortByFirstname)
                                                                    First Name: <span class="badge badge-info">{{ $sortByFirstname }}</span>
                                                                @elseif ($sortByDateSubmitted)
                                                                    Date Submitted: <span class="badge badge-info"> {{ $sortByDateSubmitted }}</span>
                                                                @else
                                                                    Default
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-md-4 text-right">
                                                            <button type="submit" class="btn btn-primary btn-sm px-5">
                                                                <i class="bi bi-search"></i> Filter
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- TALLY ROW --}}
                        {{--
                        <div class="row mb-4">
                            <div class="col-md-12 text-right">
                                <button type="button" id="filterButton" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseServicesOffered">
                                    Show/Hide Tally
                                </button>
                            </div>
                        </div>
                        --}}

                        <div class="row">
                            <div class="col">
                                <div class="accordion">
                                    <div id="collapseServicesOffered" class="collapse">
                                        <div class="accordion-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        @php
                                                            // Initialize an empty array to store all services
                                                            $allServices = [];

                                                            // Loop through each user job
                                                            foreach ($userJobs as $userJob) {
                                                                // echo $userJob->positions . " ";
                                                                // Check if services_offered is set and not null
                                                                if (isset($userJob->positions)) {
                                                                    // Remove brackets and convert to array
                                                                    $cleanedServices = str_replace(['[', ']', '"'], '', $userJob->positions);
                                                                    $arrayServices = explode(',', $cleanedServices);

                                                                    // Trim and remove empty values
                                                                    $arrayServices = array_map('trim', $arrayServices);
                                                                    $arrayServices = array_filter($arrayServices);

                                                                    // Merge with the main array
                                                                    $allServices = array_merge($allServices, $arrayServices);
                                                                }
                                                            }

                                                            $serviceCounts = array_count_values($allServices);
                                                        @endphp

                                                        <table class="table table-hover table-borderless table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Positions Applied</th>
                                                                    <th>Count</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($serviceCounts as $service => $count)
                                                                    <tr>
                                                                        <td>{{ $service }}</td>
                                                                        <td>{{ $count }}</td>
                                                                    </tr>
                                                                @endforeach

                                                                <tr class="border-top">
                                                                    <td><strong>Total VA results</strong></td>
                                                                    <td><strong>{{ $userCount }}</strong></td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END TALLY ROW HERE --}}

                        {{-- Details ROW --}}
                        <div class="row mb-4">
                            <div class="col-md-12 text-right">
                                <button type="button" id="filterButton" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseTitles">
                                    Show/Hide VA Jobs Details
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="accordion">
                                    <div id="collapseTitles" class="collapse show">
                                        <div class="accordion-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-borderless table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>VA Name</th>
                                                                    <th>Previous Job Title</th>
                                                                    <th>Services Offered</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($userJobs as $userJob)
                                                                    {{-- @dump($userJob) --}}
                                                                    <tr>
                                                                        @if(isset($userJob))
                                                                            <td>
                                                                                {{ $userJob->name }} {{ $userJob->lastname }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $userJob->experiences }}
                                                                            </td>
                                                                               <td>
                                                                                    {{ str_replace(['[', ']', '"'], ' ', $userJob->positions) }}
                                                                                </td>
                                                                        @endif
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END TALLY ROW HERE --}}

                        {{-- DISPLAYING ROW --}}
                        <div class="row">
                            <div class="col-md-12">
                                {{-- <ul>
                                    @foreach ($users as $user)
                                        <li>{{ $user->name }} -> {{ $user->skillsets->skill ?? 'na' }}</li>
                                    @endforeach
                                </ul> --}}
                                {{-- {{ $page }} --}}
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    @if ($toggleSortLastname === 'desc')
                                                        <a href="{{ route('admin.users.index', ['sortByLastname' => 'asc',
                                                                                                'sortByFirstname' => $sortByFirstname, 'display' => $displayIncompleteApplicants, 'searchResult' => $search ?? '']) }}"
                                                            type="submit" class="btn text-primary" data-toggle="tooltip" title="Click to ascend last name.">
                                                            <strong>Last Name</strong> <i class="bi bi-sort-alpha-down-alt"></i> </a>
                                                    @else
                                                        <a href="{{ route('admin.users.index', ['sortByLastname' => 'desc',
                                                                                                'sortByFirstname' => $sortByFirstname, 'display' => $displayIncompleteApplicants, 'searchResult' => $search ?? '']) }}"
                                                            type="submit" class="btn text-primary" data-toggle="tooltip" title="Click to descend last name.">
                                                            <strong>Last Name</strong> <i class="bi bi-sort-alpha-up"></i> </a>
                                                    @endif
                                                </th>
                                                <th>
                                                    @if ($toggleSortFirstname === 'desc')
                                                        <a href="{{ route('admin.users.index', ['sortByLastname' => $sortByLastname,
                                                                                                'sortByFirstname' => 'asc', 'display' => $displayIncompleteApplicants, 'searchResult' => $search ?? '']) }}" type="submit" class="btn text-primary"
                                                            data-toggle="tooltip" title="Click to ascend first name."><strong>First Name</strong> <i class="bi bi-sort-alpha-down-alt"></i> </a>
                                                    @else
                                                        <a href="{{ route('admin.users.index', ['sortByLastname' => $sortByLastname,
                                                                                                'sortByFirstname' => 'desc', 'display' => $displayIncompleteApplicants, 'searchResult' => $search ?? '']) }}" type="submit" class="btn text-primary"
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
                                                    @if ($toggleSortByDateSubmitted === 'desc')
                                                        <a href="{{ route('admin.users.index', ['sortByDateSubmitted' => 'asc', 'sortByLastname' => $sortByLastname,
                                                                                                'sortByFirstname' => $sortByFirstname, 'display' => $displayIncompleteApplicants, 'searchResult' => $search ?? '']) }}"
                                                            type="submit" class="btn text-primary" data-toggle="tooltip" title="Click to descend submitted date.">
                                                            <strong>Submitted</strong> <i class="bi bi-sort-numeric-up"></i> </a>
                                                    @else
                                                        <a href="{{ route('admin.users.index', ['sortByDateSubmitted' => 'desc', 'sortByLastname' => $sortByLastname,
                                                                                                'sortByFirstname' => $sortByFirstname, 'display' => $displayIncompleteApplicants, 'searchResult' => $search ?? '']) }}"
                                                            type="submit" class="btn text-primary" data-toggle="tooltip" title="Click to ascend submitted date.">
                                                            <strong>Submitted</strong> <i class="bi bi-sort-numeric-down-alt"></i> </a>
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
                                                        @if(isset($user->information->experience) && !empty($user->information->experience))
                                                            @if ($user->information->experience <= 2)
                                                                <span class="badge badge-success"> Beginner </span>
                                                            @elseif ($user->information->experience >= 3 && $user->information->experience <= 5)
                                                                <span class="badge badge-info"> Intermediate </span>
                                                            @else
                                                                <span class="badge badge-primary"> Seasoned </span>
                                                            @endif
                                                        @else
                                                            <span class="badge badge-warning"> Not available </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $skills = [];

                                                            if (isset($user->skillsets->skill) && !is_null($user->skillsets->skill)) {
                                                                $skills = json_decode($user->skillsets->skill, true);
                                                            }
                                                        @endphp

                                                        @if (!empty($skills) && is_array($skills))
                                                            <ul>
                                                                @foreach ($user->experiences as $experience)
                                                                    <li>{{ $experience->title }}</li>
                                                                @endforeach
                                                                @foreach ($skills as $skill)
                                                                    <li>{{ $skill }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p class="text-center">
                                                                <span class="badge badge-warning">Did Not Finish</span>
                                                            </p>
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
                                                            <form method="post" action="{{ route('admin.users.destroy', [
                                                                                'user' => $user->id,
                                                                                'sortByDateSubmitted' => $sortByDateSubmitted,
                                                                                'sortByLastname' => $sortByLastname,
                                                                                'sortByFirstname' => $sortByFirstname,
                                                                                'display' => $displayIncompleteApplicants,
                                                                                'page' => request()->query('page') ?? 1,
                                                                                'search' => $search ?? ''
                                                                                ]) }}" class="deleteItemPrompt">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn text-danger"> <i class="bi bi-person-x"></i> Delete </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center d-flex align-items-center">
                                                            <div class="pt-2">
                                                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-info btn-sm" target="_blank"><i class="bi bi-file-earmark-break"></i> View</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            @if (is_null($user->information) || is_null($user->information->videolink) || $user->information->videolink === '')
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
                                                                        'For Initial Interview' => 'badge-secondary',
                                                                        'Initial-Failed' => 'badge-danger',
                                                                        'Initial-Passed' => 'badge-secondary',
                                                                        'Incomplete' => 'badge-warning',
                                                                        'Final-Failed' => 'badge-danger',
                                                                        'For Review' => 'badge-secondary',
                                                                        'Not Qualified' => 'badge-danger',
                                                                        'Ready for shortlisting' => 'badge-info',
                                                                        'Onboarded' => 'badge-info',
                                                                        'Inactive' => 'badge-warning',
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
                                                            <p>
                                                                {{ $user->created_at->diffForHumans(['parts' => 1]) }}
                                                            </p>
                                                            <span class="badge badge-light">
                                                                {{ $user->created_at->format('h:i A') }}
                                                            </span>
                                                            <p>
                                                                <span class="badge badge-light">
                                                                    {{ $user->created_at->format('d-m-Y') }}
                                                                </span>
                                                            </p>
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
                </div><!-- /.card-body -->
            </div> <!-- /. card -->
        </div> <!-- /.container-fluid -->
    </section>
</div>

{{--* Modal components here --}}
<x-administrator-applicant.create />


@foreach ($users as $user)
    <x-administrator-applicant.edit :user="$user" :skills="$uniqueSkills" :websites="$uniqueWebsites" :tools="$uniqueTools" :softskills="$uniqueSoftskills" />
    <x-administrator-applicant.add-notes :user="$user" />
    <x-administrator-applicant.update-status :user="$user" />
@endforeach


<!-- Administrator JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/applicants/index.js') }}"></script>
<script src="{{ asset('dist/js/pages/applicants/add-notes.js') }}"></script>
<script src="{{ asset('dist/js/pages/applicants/update-status.js') }}"></script>
<script src="{{ asset('dist/js/pages/applicants/edit.js') }}"></script>
<script src="{{ asset('dist/js/pages/applicants/edit-profile.js') }}"></script>
<script src="{{ asset('dist/js/pages/applicants/edit-experience.js') }}"></script>
<script src="{{ asset('dist/js/pages/applicants/edit-files.js') }}"></script>
<script src="{{ asset('dist/js/pages/applicants/edit-password.js') }}"></script>
<script src="{{ asset('dist/js/pages/applicants/edit-references.js') }}"></script>
<script src="{{ asset('dist/js/pages/applicants/edit-skillset.js') }}"></script>


{{-- container end --}}
@endsection


