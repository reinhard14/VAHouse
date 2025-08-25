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
        <p class="text-center"><strong>Incomplete profile</strong> will not be evaluated by our HR. Please pass complete profile and pass the missing file/s. </p>

        <ul class="text-center list-unstyled">
            @foreach (session('missing_files') as $file)
                <li>{{ $file }}</li>
            @endforeach
        </ul>

        <div class="text-right">
            <small class="font-italic">
                Go to ->
                @unless (Route::is('user.edit'))
                    <a href="{{ route('user.edit', $user->id) }}" class="text-orange">
                        <strong>Edit Profile</strong>
                    </a>
                    ->
                @endunless
                File uploads
            </small>
        </div>
    </div>
@endif
