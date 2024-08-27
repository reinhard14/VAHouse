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
                                <input type="text" name="name" class="form-control" placeholder="First name.." value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Last name.." value="{{ old('lastname') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" name="age" class="form-control" min="18" placeholder="Age.." value="{{ old('age') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Transgender">Transgender</option>
                                    <option value="Non binary">Non-Binary/Non-Conforming</option>
                                    <option value="Prefer not to respond">Prefer not to respond</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="education">Highest Educational Attainment</label>
                                <select name="education" class="form-control">
                                    <option value="High School">High School</option>
                                    <option value="Senior High School">Senior High School</option>
                                    <option value="College Undergrad">College Undergrad</option>
                                    <option value="College Degree">College Degree</option>
                                    <option value="Master's Degree">Master's Degree</option>
                                    <option value="Professional Degree">Professional Degree</option>
                                    <option value="Doctorate Degree">Doctorate Degree</option>
                                    <option value="Vocational">Vocational</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="contactnumber">Contact Number</label>
                                <input type="number" class="form-control" placeholder="Contact number.." name="contactnumber" min="09" value="{{ old('contactnumber') }}" required>
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

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input id="address" type="text" class="form-control" placeholder="Enter address" name="address" value="{{ old('address') }}" required>
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
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/administrator/create.js') }}"></script>

{{-- container end --}}
@endsection
