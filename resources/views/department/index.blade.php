@extends('layouts.admin-master-layout')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="ml-2">Department</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('department.index') }}">Department</a></li>
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
                        <div>
                            <h3>List</h3>
                        </div>
                        <div class="form-inline">
                            <button type="button" class="btn btn-primary mr-1" data-bs-toggle="modal" data-bs-target="#create-department-modal">
                                <i class="bi bi-clipboard-plus mr-1"></i>Add
                            </button>
                            <form method="post" action="{{ route('department.deleteSelected') }}" id="deleteForm">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="selectedDepartmentIds" id="selectedDepartmentIds" value="">
                                <button type="submit" class="btn btn-danger" id="checkboxDeleteButton" disabled>
                                    <i class="bi bi-trash mr-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @if ($departments->isEmpty())
                    <div class="text-center p-5">
                        <h3>No <span class="text-danger">Departments</span> Available.</h3>
                        <p>Click the <span class="text-info">"Add"</span> button to create a new department.</p>
                    </div>
                @else
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-right">
                                        <label class="form-check-label" for="deleteMasterCheckbox">Delete?</label>
                                        <input type="checkbox" id="deleteMasterCheckbox">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>{{ $department->code }}</td>
                                        <td>
                                            <p>{{ $department->name }}</p>
                                        </td>
                                        <td>{{ $department->description }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="#edit-department-modal{{ $department->id }}" class="btn text-primary"
                                                data-bs-toggle="modal">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>

                                            <form method="post" action="{{ route('department.destroy', $department->id) }}" class="deleteDepartmentForm">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn text-danger"> <i class="bi bi-x-square"></i> Delete</button>
                                            </form>
                                        </td>
                                        <td class="text-right">
                                            <input type="checkbox" class="deleteItemCheckboxes" data-department-id="{{ $department->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center mt-4">{{ $departments->links() }} </div>
                    </div>
                @endif
            </div>
            <!-- /. card -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
{{-- container end --}}



<x-department.create-modal />

@foreach ($departments as $department)
    <x-department.edit-modal :dept="$department" />
@endforeach

<!-- Department JS -->
<script src="{{ asset('dist/js/pages/department.js') }}"></script>

@endsection
