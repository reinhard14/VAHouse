@if(count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <p class="text-center">
                {{ $error }}
            </p>
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading text-center">Success!</h4>
            <p class="text-center">{{ session('success') }}</p>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" role="alert">
        <p class="text-center">
            {{ session('error') }}
        </p>
    </div>
@endif

@if(session('missing_files'))
    <div class="alert alert-warning" role="alert">
        <p class="text-center">"Please submit the missing files, as they are mandatory." </p>

        <ul class="text-center list-unstyled">
            @foreach (session('missing_files') as $file)
                <li>{{ $file }}</li>
            @endforeach
        </ul>

        <div class="text-right">
            <small>Go to <strong>Edit Profile</strong> -> File upload</small>
        </div>
    </div>
@endif
