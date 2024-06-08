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
