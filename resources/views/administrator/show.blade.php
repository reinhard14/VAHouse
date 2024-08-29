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
                        <li class="breadcrumb-item active"><a href="{{ route('administrator.show', $administrator->id) }}">View</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <!-- /.content-header -->

    <!-- general form elements disabled -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">View Administrator's Information</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="m-3">
                        <!-- text input -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <p> {{ $administrator->user->name }} {{ $administrator->user->lastname }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Age</label>
                                    <p>{{ $administrator->user->age }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <p> {{ $administrator->user->address }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Education</label>
                                    <p> {{  $administrator->user->education }} </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <p> {{ $administrator->user->email }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <p> {{ $administrator->user->contactnumber }} </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <p> {{ $administrator->user->gender }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department</label>
                                    <p> {{ $administrator->department }} </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Position</label>
                                    <p> {{ $administrator->position }} </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="small text-right">
                        <label>Created on:</label> {{ $administrator->created_at->diffForHumans() }}
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="{{ route('administrator.edit', $administrator->id) }}" class="btn btn-primary mr-2" role="button"><i class="bi bi-pencil"></i> Edit</a>
                        <form method="post" action="{{ route('administrator.destroy', $administrator->id) }}" class="mr-2" id="deleteViewForm">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger"> <i class="bi bi-x-square"></i> Delete</button>
                        </form>
                        <a href={{ route('administrator.index') }} class="btn btn-secondary" role="button"><i class="bi bi-arrow-left mr-1"></i>Back</a>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

</div>

<!-- Administrator JS -->
<script src="{{ asset('dist/js/pages/administrator.js') }}"></script>

{{-- container end --}}
@endsection
