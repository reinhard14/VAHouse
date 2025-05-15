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
                    <div class="card p-3">
                        <p><i class="bi bi-briefcase-fill"></i> New Applicants (Monthly)</p>
                        <h1>{{ $recentUsers->count() }}</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="card p-3">
                        <p><i class="bi bi-briefcase-fill"></i> Total Users</p>
                        <h1>{{ $users->count() }}</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="card p-3">
                        <p><i class="bi bi-briefcase-fill"></i> Applicants</p>
                        <h1>{{ $agents->count() }}</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="card p-3">
                        <p><i class="bi bi-briefcase-fill"></i> Admin Account</p>
                        <h1>{{ $admins->count() }}</h1>
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
                                        <td @if ($loop->first) class="no-top-border align-middle" @endif style="padding-right: 0;" class="align-items-center">
                                            @if (!isset($user->information->photo_formal) || is_null($user->information->photo_formal))
                                                <img src="{{ asset('dist/img/user_default.png') }}" alt="va-avatar" class="dashboard-image">
                                            @else
                                                <img src="{{ asset('storage/' . $user->information->photo_formal) }}" alt="va-photo" class="dashboard-image">
                                            @endif
                                        </td>
                                        <td @if ($loop->first) class="no-top-border" @endif style="padding-left: 0;">
                                            {{ $user->name ?? '' }} {{ $user->lastname ?? '' }}
                                            <small class="d-block text-muted"> {{ $user->email ?? ''}} </small>
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
            <div class="row">
                <div class="col"></div>
                <div class="col-md-4">
                    <div class="card p-3">
                        <div class="row text-center">
                            <div class="col">
                                <h4>
                                    15
                                </h4>
                                <p class="text-muted">
                                    New Applicants
                                </p>
                            </div>
                            <div class="col">
                                 <h4>
                                    150
                                </h4>
                                <p class="text-muted">
                                    Verified Applicants
                                </p>
                            </div>
                        </div>
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
