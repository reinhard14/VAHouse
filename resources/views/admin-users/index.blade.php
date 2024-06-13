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
                        <li class="breadcrumb-item active"><a href="#">Users</a></li>
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

                <div class="card-body table-responsive">

                    @if ($users->isEmpty())
                        <div class="row">
                            <div class="col">
                                <div class="text-center p-5">
                                    <h3>No <span class="text-danger">Users</span> found.</h3>
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
                                    <div class="col">
                                        <div class="d-flex form-inline mb-3">
                                            <form method="GET" action="#">
                                                <input type="text" name="search" placeholder="Enter search here" class="form-control">
                                                <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-search mr-1"></i>Search</button>
                                                <a href="{{ route('admin.users.index') }}" type="submit" class="btn btn-outline-danger btn-sm" ><i class="bi bi-arrow-counterclockwise mr-1"></i>Clear</a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <div class="mr-1">
                                            <p> <strong> Current view - </strong></p>
                                        </div>
                                        @if ($sortByLastname || $sortByFirstname)
                                            <div>
                                                <p> Last: <strong> {{ $sortByLastname }}</strong> First: <strong>{{ $sortByFirstname }}</strong> </p>
                                            </div>
                                        @else
                                            <p>
                                                Default
                                            </p>
                                        @endif

                                    </div>
                                </div>
                                <div class="accordion" id="filters">
                                    <h2 class="accordion-header">
                                        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                            Show/Hide Filters
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#filters">
                                        <div class="accordion-body">
                                            <form method="GET" action="#">
                                                @csrf
                                                <div class="row">
                                                    @php
                                                        $fields = ['websites',
                                                                    'tools',
                                                                    'skills',
                                                                    'softskills',
                                                                    'experience',
                                                    ];
                                                        $count = 0;
                                                        $totalFields = count($fields);
                                                    @endphp
                                                    @foreach ($fields as $index => $field)
                                                        @if ($count % 2 == 0 && $count != 0)
                                                            </div>
                                                            <div class="row">
                                                        @endif
                                                        <div class="col-lg-6 mb-3">
                                                            <div class="form-group">
                                                                <label for="{{ $field }}">{{ ucfirst($field) }}:</label>
                                                                <select id="{{ $field }}" class="form-control select2"  name="{{ $field }}[]" multiple="multiple">
                                                                    {{-- @if($field == 'experience')
                                                                        <option value="2">Beginner</option>
                                                                        <option value="3">Intermediate</option>
                                                                        <option value="6">Seasoned</option>
                                                                    @else --}}
                                                                        @foreach (${"unique" . ucfirst($field)} as $item)
                                                                            <option value="{{ $item }}">{{ $item }}</option>
                                                                        @endforeach
                                                                    {{-- @endif --}}
                                                                </select>
                                                            </div>
                                                        </div>

                                                        @if ($index == $totalFields - 1)
                                                            <div class="col-md-6 mb-3 d-flex align-items-center justify-content-end">
                                                                <button type="submit" class="btn btn-primary btn-sm ml-3">
                                                                    <i class="bi bi-search"></i> Filter
                                                                </button>
                                                            </div>
                                                        @endif
                                                        @php $count++; @endphp
                                                    @endforeach

                                                </div>
                                            </form>

                                         </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    @if ($toggleSortLastname === 'desc')
                                                        <a href="{{ route('admin.users.index', ['sortByLastname' => 'asc']) }}" type="submit" class="btn text-primary"
                                                            data-toggle="tooltip" title="Click to ascend Last name."><strong>Last Name</strong> <i class="bi bi-sort-alpha-down-alt"></i> </a>
                                                    @else
                                                        <a href="{{ route('admin.users.index', ['sortByLastname' => 'desc']) }}" type="submit" class="btn text-primary"
                                                            data-toggle="tooltip" title="Click to descend Last name."><strong>Last Name</strong> <i class="bi bi-sort-alpha-up"></i> </a>
                                                    @endif
                                                </th>
                                                <th>
                                                    @if ($toggleSortFirstname === 'desc')
                                                        <a href="{{ route('admin.users.index', ['sortByFirstname' => 'asc']) }}" type="submit" class="btn text-primary"
                                                            data-toggle="tooltip" title="Click to ascend First name."><strong>First Name</strong> <i class="bi bi-sort-alpha-down-alt"></i> </a>
                                                    @else
                                                        <a href="{{ route('admin.users.index', ['sortByFirstname' => 'desc']) }}" type="submit" class="btn text-primary"
                                                            data-toggle="tooltip" title="Click to descend First name."><strong>First Name</strong> <i class="bi bi-sort-alpha-up"></i> </a>
                                                    @endif
                                                </th>
                                                <th class="text-center">Level</th>
                                                <th class="text-center">Skills</th>
                                                <th class="text-center">Actions</th>
                                                <th class="text-center">Form/s Submitted</th>
                                                <th class="text-center">Intro Vid</th>
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
                                                            {{ $user->scores->experience ?? 'NA' }}
                                                            {{-- @if ($user->scores->experience <= 2)
                                                                Beginner
                                                            @elseif ($user->scores->experience >= 3 && $user->scores->experience <= 5)
                                                                Intermediate
                                                            @else
                                                                Seasoned
                                                            @endif --}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{-- {{ \Illuminate\Support\Str::limit($user->scores->skill, 30) ?? 'N/A' }} --}}
                                                        {{ $user->scores->skill ?? 'N/A' }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a href="#edit-user-modal-{{ $user->id }}" data-bs-toggle="modal">
                                                                <i class="bi bi-person-gear"></i> Edit
                                                            </a>
                                                            <form method="post" action="{{ route('admin.users.destroy', $user->id) }}" class="deleteAdminForm">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn text-danger"> <i class="bi bi-person-x"></i> Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-info"><i class="bi bi-file-earmark-break"></i> View</a>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <a href={{ $user->scores->videolink ?? "#" }} target="_blank">Open Link</a>
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
<x-admin-user.create />

@foreach ($users as $user)
    <x-admin-user.edit :user="$user" />
@endforeach


<!-- Administrator JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/user-administrator.js') }}"></script>

{{-- container end --}}
@endsection


