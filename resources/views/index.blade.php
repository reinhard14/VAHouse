@extends('layouts.admin-master-layout')

@section('content')

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="my-class">Dashboard for {{ auth()->user()->administrator->department ?? 'Super-admin'}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $users->count() }}</h3>
                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $agents->count() }}</h3>
                            <p>Applicants</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $admins->count() }}</h3>
                            <p>Admin users</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-person-fill-gear"></i>
                        </div>
                        <a href="{{ route('administrator.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $recentUsers->count() }}</h3>
                            <p>Newly registered users</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-person-fill-exclamation"></i>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            {{-- FILTERS ROW --}}
            <div class="row">
                <div class="col">
                </div>
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5 class="mb-3">
                            Latest Applicants
                        </h5>

                        <table class="table table-hover table-no-top-border">
                            <tbody>
                                @foreach ($latestUsers as $loopIndex => $user)
                                    <tr>
                                        {{-- <td style="{{ $loopIndex === 0 ? 'border-top: 0;' : '' }}"> --}}
                                        <td @if ($loop->first) class="no-top-border" @endif>
                                            {{ $user->name ?? '' }} {{ $user->lastname ?? '' }}
                                            <small class="d-block"> {{ $user->email ?? ''}} </small>
                                        </td>
                                        {{-- <td style="{{ $loopIndex === 0 ? 'border-top: 0;' : '' }}"> --}}
                                        <td @if ($loop->first) class="no-top-border" @endif>
                                            <strong>
                                                {{ $user->employments()->latest('created_at')->first()?->job_position ?? '' }}
                                            </strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

@endsection
