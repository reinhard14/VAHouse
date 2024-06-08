@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Welcome to VA House Corporation') }}</div>

                <div class="card-body">
                    @include('includes.messages')

                    <h4 class="text-center mt-3">
                        Separate list by using a comma <span class="text-danger">","</span>
                        or press the <span class="text-danger">space bar</span> . {{ $user->id }}
                    </h4>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <small>
                                Note: Field with "<span class="text-danger">*</span>" is a required field.
                            </small>
                        </div>
                    </div>


                    <form method="post" action="{{ route('user.store') }}" id="scoresForm">
                        @csrf

                        <div class="form-group">
                            <label for="websites"><span class="text-danger">*</span> List all the <span class="text-primary">websites</span> used:</label>
                            <select id="websites" name="websites[]" class="select2" multiple="multiple" style="width: 100%;" required>
                                <option value="none">None</option>
                            </select>
                            <small class="d-flex justify-content-end">
                                Select "<span class="text-danger">None</span>" if nothing is applicable.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="applications"><span class="text-danger">*</span> List all the <span class="text-primary">applications</span> used:</label>
                            <select id="applications" name="applications[]" class="select2" multiple="multiple" style="width: 100%;" required>
                                <option value="none">None</option>
                            </select>
                            <small class="d-flex justify-content-end">
                                Select "<span class="text-danger">None</span>" if nothing is applicable.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="tools"><span class="text-danger">*</span> List all the <span class="text-primary">tools</span> used:</label>
                            <select id="tools" name="tools[]" class="select2" multiple="multiple" style="width: 100%;" required>
                                <option value="none">None</option>
                            </select>
                            <small class="d-flex justify-content-end">
                                Select "<span class="text-danger">None</span>" if nothing is applicable.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="skills"><span class="text-danger">*</span> List all the <span class="text-primary">skills</span> you have: </label>
                            <select id="skills" name="skills[]" class="select2" multiple="multiple" style="width: 100%;" required>
                                <option value="none">None</option>
                            </select>
                            <small class="d-flex justify-content-end">
                                Select "<span class="text-danger">None</span>" if nothing is applicable.
                            </small>
                        </div>

                        <div class="form-group mb-5">
                            <label for="softskills"><span class="text-danger">*</span> List all the <span class="text-primary">Soft skills</span> you possess:</label>
                            <select id="softskills" name="softskills[]" class="select2" multiple="multiple" style="width: 100%;" required>
                                <option value="none">None</option>
                            </select>
                            <small class="d-flex justify-content-end">
                                Select "<span class="text-danger">None</span>" if nothing is applicable.
                            </small>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="bi bi-file-arrow-down me-1"></i>Submit</button>
                            <a href="#" id="resetFieldButton" class="btn btn-outline-danger mr-2"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset Field</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('dist/js/pages/user-end/index.js') }}"></script>

@endsection
