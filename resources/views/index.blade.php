@extends('layouts.admin-master-layout')

@section('content')

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="my-class">Dashboard</h1>
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
                    <div class="small-box bg-danger">
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

            {{-- <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Virtual Assistants</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th><span></span></th>
                                        <th><span>Form completed</span></th>
                                        <th><span>Level</span></th>
                                        <th><span>Status</span></th>
                                        <th><span>Tier</span></th>
                                        <th><span>Incomplete</span></th>
                                        <th><span>LMS</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Beginner</td>
                                        <td>New</td>
                                        <td>13</td>
                                        <td>13</td>
                                        <td>7/13</td>
                                        <td>6/13</td>
                                        <td>1/13</td>
                                    </tr>
                                    <tr>
                                        <td>Intermediate</td>
                                        <td>Hired</td>
                                        <td>13</td>
                                        <td>13</td>
                                        <td>7/13</td>
                                        <td>6/13</td>
                                        <td>1/13</td>
                                    </tr>
                                    <tr>
                                        <td>Seasoned</td>
                                        <td>Hired</td>
                                        <td>13</td>
                                        <td>13</td>
                                        <td>7/13</td>
                                        <td>6/13</td>
                                        <td>1/13</td>
                                    </tr>
                                    <tr>
                                        <td>All</td>
                                        <td>Hired</td>
                                        <td>13</td>
                                        <td>13</td>
                                        <td>7/13</td>
                                        <td>6/13</td>
                                        <td>1/13</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- /.row -->

            {{-- FILTERS ROW --}}
            {{-- <div class="row">
                <div class="col">
                    <div class="accordion">
                        <div id="collapseOne" class="collapse show">
                            <div class="accordion-body">
                                <form method="GET" action="#">
                                    @csrf
                                    <div class="form-row">
                                        @php
                                            $fields = ['websites',
                                                        'tools',
                                                        'skills',
                                                        'softskills',
                                                        'experiences',
                                                        'statuses',
                                                        'tiers',
                                                        'LMS',
                                                    ];
                                            $count = 0;
                                        @endphp

                                        @foreach ($fields as $index => $field)
                                            @if ($count % 2 == 0 && $count != 0)
                                                </div>
                                                <div class="form-row">
                                            @endif

                                            <div class="form-group col-md-4 mb-3">
                                                @if ($field=='experience')
                                                    <label for="{{ $field }}" class="d-block">Years of {{ ucfirst($field) }}s:</label>
                                                @else
                                                    <label for="{{ $field }}" class="d-block">{{ ucfirst($field) }}:</label>
                                                @endif

                                                <select id="{{ $field }}" name="{{ $field }}[]" class="form-control select2" data-placeholder="Select {{ $field }}" multiple="multiple">
                                                    @foreach (${"unique" . ucfirst($field)} as $item)
                                                        <option value="{{ $item }}" {{ in_array($item, request()->query($field, [])) ? 'selected' : '' }}>
                                                            {{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach

                                        @php $count++; @endphp

                                        <div class="form-group col-md-12 mb-3 d-flex justify-content-around">
                                            <div class="col-md-4">
                                                <input type="checkbox" id="display" name="display" value="checked" {{ $displayIncompleteApplicants === null ? '' : 'checked' }}>
                                                <label for="display">Display incomplete accounts?</label>
                                            </div>
                                            <div class="col-md-4" id="view_col">
                                                <p> <label> Current view - </label>
                                                    @if ($sortByLastname)
                                                        Last Name: <span class="badge badge-info"> {{ $sortByLastname }}</span>
                                                    @elseif ($sortByFirstname)
                                                        First Name: <span class="badge badge-info">{{ $sortByFirstname }}</span>
                                                    @elseif ($sortByDateSubmitted)
                                                        Date Submitted: <span class="badge badge-info"> {{ $sortByDateSubmitted }}</span>
                                                    @else
                                                        Default
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <button type="submit" class="btn btn-primary btn-sm px-5">
                                                    <i class="bi bi-search"></i> Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

@endsection
