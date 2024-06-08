@extends('layouts.admin-master-layout')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="ml-2">Department</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('department.index') }}">Department</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('department.show', $department->id) }}">Show</a></li>
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
                    <div class="d-flex align-items-center justify-content-between">
                        <h3>Forms for {{ $department->name }}</h3>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-form-modal"><i class="bi bi-clipboard2-plus mr-1"></i>Add Form</button>
                    </div>
                </div>

                <div class="card-body">
                    @if($department->forms->isEmpty())
                        <div class="text-center p-5">
                            <h3>No <span class="text-primary">forms</span> created yet.</h3>
                            <p>Click the "Add" button to create a new form for this department.</p>
                        </div>
                    @else
                        <main>
                            @foreach ($department->forms as $form)
                                {{-- Form Header --}}
                                <div class="row mb-3 border-bottom">
                                    <div class="col-2 border border-right-0">
                                        <h4>{{ $form->name }}</h4>
                                    </div>

                                    <div class="col-2 d-flex align-items-center justify-content-around border border-left-0">
                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse/expand form view.">
                                            <a href="#collapseForm{{ $form->id }}" role="button" data-bs-toggle="collapse"
                                                id="collapseFormIcon{{ $form->id }}" data-form-id="{{ $form->id }}"
                                                class="bi bi-box-arrow-in-up-left mr-2">
                                            </a>
                                        </div>

                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Edit form.">
                                            <a href="#edit-form-modal{{ $form->id }}" class="bi bi-pencil-square" data-bs-toggle="modal"></a>
                                        </div>

                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Delete form.">
                                            <form action="{{ route('form.destroy', $form->id) }}" method="POST" class="formDelete">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn text-danger bi bi-x-square"></button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col d-flex justify-content-end">
                                        <a href="#create-input-modal{{ $form->id }}" class="btn btn-outline-primary" data-bs-toggle="modal"><i class="bi bi-plus-square"></i> Add Input</a>
                                    </div>
                                </div>

                                {{-- Form Inputs --}}
                                <div class="row departmentForm mb-5">
                                    <div class="col p-2 border border-secondary">
                                        @if($form->inputs->isEmpty())
                                            <div class="collapse" id="collapseForm{{ $form->id }}">
                                                <div class="text-center mt-3 p-3">
                                                    <h4 class="text-danger">No input yet for {{ $form->name }} </h4>
                                                    <p>Click the "Add Input" button to add a new input.</p>
                                                </div>
                                            </div>

                                        @else
                                            @foreach ($form->inputs as $input)
                                                <div class="collapse show" id="collapseForm{{ $input->form_id }}">
                                                    {{-- 2 fields --}}
                                                    <div class="row justify-content-center mb-1">
                                                        <div class="col-6 d-flex">
                                                            <div class="input-group">
                                                                <label class="col-3" for="{{ $input->label }}">{{ $input->name }} @if ($input->required === 'required') * @endif</label>
                                                                <input type="{{ $input->type }}" class="form-control" placeholder="{{ $input->label }}">
                                                            </div>

                                                            <form action="{{ route('input.destroy', $input->id) }}" method="POST" class="inputDelete"
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete input.">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="hidden" name="department_id" value="{{ $input->form->department_id }}">
                                                                <button type="submit" class="btn text-danger bi bi-x-square"></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </main>
                    @endif
                </div>

                <div class="row mb-3">
                    <div class="col text-center">
                        <a href="{{ route('department.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left mr-1"></i> Back</a>
                    </div>
                </div>
            </div>
            <!-- /. card -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>

<x-department.form.create-form-modal :dept="$department" />

@foreach ($department->forms as $form)
    <x-department.form.edit-form-modal :form="$form" />
    <x-department.form.input.create-input-modal :form="$form" />
@endforeach

<script src="{{ asset('dist/js/pages/department/show-department.js') }}"></script>
<script src="{{ asset('dist/js/pages/department/input.js') }}"></script>

@endsection
