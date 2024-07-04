@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Account Details:
                </div>

                <div class="card-body">
                    @include('includes.messages')

                    <div class="row mt-5">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary mr-2"><i class="bi bi-save me-1"></i>Edit</a>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary"><i class="bi bi-arrow-return-right me-1"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
