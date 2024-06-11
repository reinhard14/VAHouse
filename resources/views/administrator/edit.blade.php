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
                        <li class="breadcrumb-item"><a href="{{ route('administrator.index') }}">Administrators</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('administrator.edit', $administrator -> id) }}">Edit</a></li>
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
                    <h3 class="card-title">Edit an Administrator</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="m-3">
                        <form method="post" action="{{ route('administrator.update', $administrator->id) }}" id="routeAdminEditForm">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="saving_option" id="savingOption" value="">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" class="form-control" value="{{ $administrator->user->name }}" name="name" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" value="{{ $administrator->user->lastname }}" name="lastname" required>
                            </div>
                            <div class="form-group">
                                <label for="contactnumber">Contact Number</label>
                                <input type="number" class="form-control" value="{{ $administrator->user->contactnumber }}" name="contactnumber" required>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select class="form-control" id="department" name="department" {{ $departments->isEmpty() ? 'disabled' : ''}}>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->name }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" class="form-control" value="{{ $administrator->position }}" name="position" required>
                            </div>

                            <hr class="alert-info mt-4">
                            <small class="p1 mb-1">
                            Account login Details:
                            </small>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" value="{{ $administrator->user->email }}" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" value="male" {{ $administrator->gender === 'male' ? 'checked' : '' }}>
                                            <label class="form-check-label">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" value="female" {{ $administrator->gender === 'female' ? 'checked' : '' }}>
                                            <label class="form-check-label">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary mr-2"><i class="bi bi-arrow-clockwise"></i> Update</button>
                                <a href="#" id="resetFieldButton" class="btn btn btn-outline-danger mr-2 mr-2"><i class="bi bi-x-square"></i> Reset Field</button>
                                <a href="{{ route('administrator.index') }}" class="btn btn-secondary" role="button"><i class="bi bi-arrow-left mr-1"></i> Back</a>
                            </div>
                        </form>
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
<script src="{{ asset('dist/js/pages/administrator.js') }}"></script>

{{-- container end --}}
@endsection
