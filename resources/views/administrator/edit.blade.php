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
                                <label for="age">Age</label>
                                <input name="age" type="number" class="form-control" value="{{ $administrator->user->age }}" required>
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="Male" {{ old('gender', $administrator->user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $administrator->user->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Transgender" {{ old('gender', $administrator->user->gender ?? '') == 'Transgender' ? 'selected' : '' }}>Transgender</option>
                                    <option value="Non binary" {{ old('gender', $administrator->user->gender ?? '') == 'Non-Binary/Non-Conforming' ? 'selected' : '' }}>Non-Binary/Non-Conforming</option>
                                    <option value="Prefer not to respond" {{ old('gender', $administrator->user->gender ?? '') == 'Prefer not to respond' ? 'selected' : '' }}>Prefer not to respond</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="education">Highest Educational Attainment</label>
                                <select name="education" class="form-control">
                                    <option value="High School" {{ old('education', $administrator->user->education ?? '') == 'High School' ? 'selected' : '' }}>High School</option>
                                    <option value="Senior High School" {{ old('education', $administrator->user->education ?? '') == 'Senior High School' ? 'selected' : '' }}>Senior High School</option>
                                    <option value="College Undergrad" {{ old('education', $administrator->user->education ?? '') == 'College Undergrad' ? 'selected' : '' }}>College Undergrad</option>
                                    <option value="College Degree" {{ old('education', $administrator->user->education ?? '') == 'College Degree' ? 'selected' : '' }}>College Degree</option>
                                    <option value="Master's Degree" {{ old('education', $administrator->user->education ?? '') == 'Master\'s Degree' ? 'selected' : '' }}>Master's Degree</option>
                                    <option value="Professional Degree" {{ old('education', $administrator->user->education ?? '') == 'Professional Degree' ? 'selected' : '' }}>Professional Degree</option>
                                    <option value="Doctorate Degree" {{ old('education', $administrator->user->education ?? '') == 'Doctorate Degree' ? 'selected' : '' }}>Doctorate Degree</option>
                                    <option value="Vocational" {{ old('education', $administrator->user->education ?? '') == 'Vocational' ? 'selected' : '' }}>Vocational</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="contactnumber">Contact Number</label>
                                <input name="contactnumber" type="number" class="form-control" value="{{ $administrator->user->contactnumber }}" required>
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

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input name="address" type="text" class="form-control" value="{{ $administrator->user->address }}" required>
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
                                <input type="password" class="form-control" name="password" data-toggle="password" required>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary mr-2"><i class="bi bi-arrow-clockwise"></i> Update</button>
                                <a href="#" id="resetFieldButton" class="btn btn btn-outline-danger mr-2 mr-2"><i class="bi bi-x-square"></i> Reset Field</a>
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
