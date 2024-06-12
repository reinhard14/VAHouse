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
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $agents->count() }}</h3>
                            <p>Agents</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Department Name</th>
                                        <th>Manager</th>
                                        <th>Status</th>
                                        {{-- <th>Submissions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td>{{ $department->name }}</td>
                                            <td>Admin Name</td>
                                            <td><span class="badge badge-success">Vacant</span></td>
                                            {{-- <td>
                                                <div class="sparkbar" data-color="#00a65a" data-height="20">90/100</div>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <a href="{{ route('department.index') }}" class="btn btn-sm btn-secondary float-left">View All Departments</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Yearly Targets</h3>
                        </div>

                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <li class="item">
                                    <div class="info">
                                        <a href="javascript:void(0)" class="product-title"> Growth.
                                        <span class="badge badge-primary float-right">500</span></a>
                                        <span class="product-description">
                                            Increase the number of company employees.
                                        </span>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="info">
                                        <a href="javascript:void(0)" class="product-title"> Expand Client.
                                        <span class="badge badge-primary float-right">20</span></a>
                                        <span class="product-description">
                                            Increase the total number of clients.
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="card-footer text-center">
                            <a href="#" id="viewTarget">View All Targets</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

@endsection
