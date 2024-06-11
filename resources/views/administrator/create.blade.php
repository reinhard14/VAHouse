@extends('layouts.admin-master-layout')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ">
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
                        <li class="breadcrumb-item active"><a href="{{ route('administrator.create') }}">Create</a></li>
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
                    <h3 class="card-title">Create an Administrator</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="m-3">
                        <form method="post" action="{{ route('administrator.store') }}" id="routeAdminForm">
                            @csrf
                            <input type="hidden" name="saving_option" id="savingOption" value="">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" class="form-control" placeholder="First name.." name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last name.." name="lastname" value="{{ old('lastname') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="contactnumber">Contact Number</label>
                                <input type="number" class="form-control" placeholder="Last name.." name="contactnumber" value="{{ old('contactnumber') }}" required>
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
                                <input type="text" class="form-control" placeholder="Enter position" name="position" value="{{ old('position') }}" required>
                            </div>

                            <hr class="alert-info mt-4">
                            <small class="p1 mb-1"> Account login Details: </small>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" placeholder="Email address.." name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Password.." name="password" data-toggle="password" required>
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="male" required>
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="female">
                                    <label class="form-check-label">Female</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mr-2"><ion-icon name="navigate-outline" class="mr-1"></ion-icon>Submit</button>
                                <a href="#" id="resetFieldButton" class="btn btn-outline-danger mr-2"><ion-icon name="backspace-outline" class="mr-1"></ion-icon>Reset Field</a>
                                <a href={{ route('administrator.index') }} button class="btn btn-secondary" ><i class="bi bi-arrow-left mr-1"></i> Back </a>
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
