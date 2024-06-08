@extends('layouts.admin-master-layout')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="ml-2">Administrator</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active"><a href="#">Edit</a></li>
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
                    <h3 class="card-title">Edit User's Information</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row mb-3">
                        <!-- text input -->
                        <div class="col">
                            <label>First Name</label>
                            <input type="text" value="{{ $user->name }}">
                        </div>
                        <div class="col">
                            <label>Last Name</label>
                            <input type="text" value="{{ $user->lastname }}">
                        </div>
                        <div class="col">
                            <label>Email</label>
                            <input type="text" value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Form</th>
                                        <th>Department</th>
                                        <th>Answers Submitted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <pre >
                                        {{ dd($forms) }}
                                    </pre> --}}
                                    @foreach ($forms as $form)

                                    <tr>
                                        <td>
                                            {{ $form->name }}
                                        </td>
                                        <td>
                                            {{ $form->department->name }} - {{ $form->department->description }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.show-answers', ['user' => $user->email, 'form' => $form->id]) }}" class="btn btn-outline-info">View Answers</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <a href="#" class="btn btn-primary mr-2" role="button"><i class="bi bi-pencil"></i> Update</a>
                                <form method="post" action="#" class="mr-2" id="deleteViewForm">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-x-square"></i> Delete</button>
                                </form>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary" role="button"><i class="bi bi-arrow-left mr-1"></i>Back</a>
                            </div>
                        </div>
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
