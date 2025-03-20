@extends('layouts.va.va-layout')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 offset-md-1">
            <div class="row my-4">
                <div class="col">
                    <h3>Edit Profile</h3>
                </div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col">
                    <ul class="nav nav-profile">
                        <li class="nav-item">
                            <a class="nav-link active profile-edit-nav pr-5" href="#personal-details" data-toggle="tab">Personal Details </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link profile-edit-nav pr-5" href="#job-information" data-toggle="tab">Job Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link profile-edit-nav pr-5" href="#file-uploads" data-toggle="tab">File uploads</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            @include('includes.messages')
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="personal-details">
                                    @include('user.partials.personal-details')
                                </div>

                                <div class="tab-pane fade" id="job-information">
                                    @include('user.partials.job-information')
                                </div>
                                <div class="tab-pane fade" id="file-uploads">
                                    @include('user.partials.file-uploads')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row pb-5">
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/user-end/edit-profile.js') }}"></script>

<script>
    $(document).ready(function () {
        let activeTab = "{{ session('tab') }}";

        if (activeTab) {
            $('.nav-link[href="' + activeTab + '"]').tab('show');
        }
    });
</script>


@endsection
