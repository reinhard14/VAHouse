@extends('layouts.admin-master-layout')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="ml-2">Administrators</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('administrator.index') }}">Administrators</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <!-- /.content-header -->

    <section class="content" >
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-none d-sm-block">
                            <h3>List</h3>
                        </div>
                        <div class="d-sm-none">
                            <i class="bi bi-list-ol"></i>
                        </div>

                        <div class="form-inline">
                            <a href="{{ route('administrator.create') }}" class="btn btn-primary mr-1"><i class="bi bi-person-add mr-1"></i>Add</a>
                            <form method="post" action="{{ route('administrator.deleteSelected') }}" id="deleteForm">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="selectedAdminIds" id="selectedAdminIds" value="">
                                <button type="submit" class="btn btn-danger" id="checkboxDeleteButton" disabled>
                                    <i class="bi bi-trash mr-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @if ($administrators->isEmpty())
                    <div class="text-center p-5">
                        <h3 >No <span class="text-danger">Administrators</span> Yet.</h3>
                        <p> Click the <span class="text-info">"Add"</span> button to add an administrator.</p>
                    </div>
                @else
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-right">
                                        <label class="form-check-label" for="deleteMasterCheckbox">Delete?</label>
                                        <input type="checkbox" id="deleteMasterCheckbox">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($administrators as $administrator)
                                    <tr>
                                        <td>{{ $administrator->user->lastname ?? 'N/A'}}</td>
                                        <td>{{ $administrator->user->name ?? 'N/A' }}</td>
                                        <td>{{ $administrator->department ?? 'N/A' }}</td>
                                        <td>{{ $administrator->position ?? 'N/A' }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="{{ route('administrator.show', $administrator->id) }}" class="mr-2"> <i class="bi bi-person"></i> View</a>
                                                <a href="{{ route('administrator.edit', $administrator->id) }}"> <i class="bi bi-person-gear"></i>  Edit</a>
                                                <form method="post" action="{{ route('administrator.destroy', $administrator->id) }}" class="deleteAdminForm">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn text-danger"> <i class="bi bi-person-x"></i> Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <input type="checkbox" class="deleteItemCheckboxes" data-admin-id="{{ $administrator->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center mt-4">{{ $administrators->links() }} </div>
                    </div>
                    <!-- /.card-body -->
                @endforelse
            </div>
            <!-- /. card -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>

<!-- Administrator JS -->
<script src="{{ asset('dist/js/pages/administrator.js') }}"></script>

{{-- container end --}}
@endsection
