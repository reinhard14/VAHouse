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
                        <div class="row">
                            <div class="col">
                                <h5 class="mb-3">
                                    Latest Applicants
                                </h5>
                            </div>
                            <div class="col text-right">
                                @if($adminDepartment === 'Virtual Assistant Manager')
                                    <a href="{{ route('admin.users.vamIndex') }}" class="text-muted">Go</a>
                                @elseif($adminDepartment === 'Management Team')
                                    <a href="{{ route('admin.users.hrIndex') }}" class="text-muted">Go</a>
                                @else
                                    <a href="{{ route('admin.users.index') }}" class="text-muted">Go</a>
                                @endif
                            </div>
                        </div>

                        <table class="table table-hover table-no-top-border">
                            <tbody>
                                @foreach ($latestUsers as $loopIndex => $user)
                                    <tr>
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
                                        <td @if ($loop->first) class="no-top-border" @endif  style="padding-right: 0;" class="align-items-center">
                                            @if(!isset($user->status->status))
                                                N/A
                                            @else
                                                @php
                                                    $statusClasses = [
                                                        'New' => 'badge-success',
                                                        'For Initial Interview' => 'badge-secondary',
                                                        'Initial-Failed' => 'badge-danger',
                                                        'Initial-Passed' => 'badge-secondary',
                                                        'Incomplete' => 'badge-warning',
                                                        'Final-Failed' => 'badge-danger',
                                                        'For Review' => 'badge-secondary',
                                                        'Not Qualified' => 'badge-danger',
                                                        'Ready for shortlisting' => 'badge-info',
                                                        'Onboarded' => 'badge-info',
                                                        'Inactive' => 'badge-warning',
                                                        'Hired' => 'badge-primary',
                                                        'Floating' => 'badge-warning',
                                                        'Terminated' => 'badge-danger'
                                                    ];

                                                    $status = $user->status->status;
                                                    $badgeClass = $statusClasses[$status] ?? 'badge-default';
                                                @endphp
                                            @endif
                                            <p class="text-right mb-0">
                                                @if (isset($status))
                                                    <small>
                                                        <span class="badge {{ $badgeClass }}" data-toggle="tooltip" title="Updated on: {{ $user->status->updated_at->diffForHumans(['parts'=>1]) ?? 'N/A' }}">
                                                            {{ $status }}
                                                        </span>
                                                    </small>
                                                @endif
                                            </p>

                                            <small class="text-muted text-right">
                                                {{ $user->employments()->latest('created_at')->first()?->job_position ?? '' }}
                                            </small>
                                        </td>
                                        {{-- <td @if ($loop->first) class="no-top-border" @endif style="padding-left: 0;">
                                        </td> --}}
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
                                    {{ $currentMonthUsers->count() }}
                                </h4>
                                <p class="text-muted">
                                    New Applicants
                                    <small class="d-block">(This Month)</small>
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
