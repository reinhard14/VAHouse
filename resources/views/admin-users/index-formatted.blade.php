@extends('layouts.admin-master-layout')

@section('content')
<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="ml-2">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Users</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="d-none d-sm-block">List</h3>
                        <i class="bi bi-list-ol d-sm-none"></i>
                        <div class="form-inline">
                            <a href="#create-user-modal" class="btn btn-primary mr-1" data-bs-toggle="modal">
                                <i class="bi bi-person-add mr-1"></i>Add
                            </a>
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

                <!-- Card body -->
                <div class="card-body table-responsive">
                    @if ($users->isEmpty())
                        <div class="text-center p-5">
                            <h3>No <span class="text-danger">Users</span> yet.</h3>
                            <p>Click the <span class="text-info">"Add"</span> button to add a user.</p>
                        </div>
                    @else
                        <!-- Filter and Sort Section -->
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <form method="GET" action="#">
                                    <input type="text" name="search" placeholder="Enter search here" class="form-control">
                                    <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-search mr-1"></i>Search</button>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-arrow-counterclockwise mr-1"></i>Clear
                                    </a>
                                </form>
                            </div>
                            <div>
                                <strong>Current view - </strong>
                                @if ($sortByLastname || $sortByFirstname)
                                    Last: <strong>{{ $sortByLastname }}</strong> First: <strong>{{ $sortByFirstname }}</strong>
                                @else
                                    Default
                                @endif
                            </div>
                        </div>

                        <!-- Filters Accordion -->
                        <div class="accordion mb-3" id="filters">
                            <h2 class="accordion-header">
                                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    Show/Hide Filters
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <form method="GET" action="#">
                                        @csrf
                                        @foreach (['websites', 'applications', 'tools', 'skills', 'softskills'] as $field)
                                            <div class="form-group">
                                                <label for="{{ $field }}">{{ ucfirst($field) }}:</label>
                                                <select id="{{ $field }}" class="form-control select2" name="{{ $field }}[]" multiple="multiple">
                                                    @foreach (${"unique" . ucfirst($field)} as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                        <div class="form-group d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-search"></i> Filter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Users Table -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="{{ route('admin.users.index', ['sortByLastname' => $toggleSortLastname === 'desc' ? 'asc' : 'desc']) }}" class="btn text-primary">
                                            <strong>Last Name</strong> <i class="bi bi-sort-alpha-{{ $toggleSortLastname === 'desc' ? 'down-alt' : 'up' }}"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.users.index', ['sortByFirstname' => $toggleSortFirstname === 'desc' ? 'asc' : 'desc']) }}" class="btn text-primary">
                                            <strong>First Name</strong> <i class="bi bi-sort-alpha-{{ $toggleSortFirstname === 'desc' ? 'down-alt' : 'up' }}"></i>
                                        </a>
                                    </th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Form/s Submitted</th>
                                    <th class="text-right">
                                        <label for="deleteMasterCheckbox" class="form-check-label">Delete?</label>
                                        <input type="checkbox" id="deleteMasterCheckbox">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->lastname }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td class="text-center">
                                            <a href="#edit-user-modal-{{ $user->id }}" data-bs-toggle="modal"><i class="bi bi-person-gear"></i> Edit</a>
                                            <form method="post" action="{{ route('admin.users.destroy', $user->id) }}" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn text-danger"><i class="bi bi-person-x"></i> Delete</button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-info"><i class="bi bi-file-earmark-break"></i> View</a>
                                        </td>
                                        <td class="text-right">
                                            <input type="checkbox" class="deleteItemCheckboxes" data-admin-id="{{ $user->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="pagination justify-content-center mt-4">
                            {{ $users->appends(['sortByLastname' => $sortByLastname])->links() }}
                        </div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modals -->
<x-admin-user.create />
@foreach ($users as $user)
    <x-admin-user.edit :user="$user" />
@endforeach

<!-- Administrator JS -->
<script src="{{ asset('dist/js/pages/user-administrator.js') }}"></script>
@endsection
