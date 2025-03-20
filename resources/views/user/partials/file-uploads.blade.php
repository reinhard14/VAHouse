<div class="row">
    <div class="col">
        <!-- Progress Bar -->
        <div id="upload-progress">
            <div id="upload-progress-text">
                <div id="progress-bar">0%</div>
            </div>
        </div>

        <!-- Spinner -->
        <div id="loading-spinner">
            <p>Uploading... <span class="spinner-border text-primary"></span></p>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col">
        <form id="autoUploadForm">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="">Valid ID</label>
                </div>
                <div class="col text-right">
                    <a class="nav-link text-orange" href="#" data-bs-toggle="modal" data-bs-target="#guidelinesModal">Read Complete Guidelines</a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <input type="file" id="photo_id" name="photo_id" class="form-control file-upload"
                            data-allowed-types="image/jpeg,image/png,image/gif"
                            accept="image/*"
                            data-upload-url="{{ route('user.update-valid-id') }}"
                            required
                    >
                    <small class="text-muted">Upload at least 2 Primary and Secondary Valid ID. See valid ID <a href="#">here</a> </small>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col">
        <label for="">CV or Resume</label>
        <input type="file" id="resume" name="resume" class="form-control file-upload"
                data-upload-url="{{ route('user.update-resume') }}"
                accept="application/pdf"
                data-allowed-types="application/pdf"
                required
        >
    </div>
</div>

<div class="row mb-4">
    <div class="col">
        <label for="">DISC Result</label>
        <input type="file" id="disc_results" name="disc_results" class="form-control file-upload"
                data-upload-url="{{ route('user.update-disc') }}"
                accept="application/pdf"
                data-allowed-types="application/pdf"
                required
        >
        <small class="text-muted">Upload your latest DISC result. To take DISC assessment,
            <a href="https://discpersonalitytesting.com/free-disc-test/" target="_blank"> click here</a>
        </small>
    </div>
</div>

<div class="row mb-4">
    <div class="col">
        <label for="">Portfolio</label>
        <input type="file" id="portfolio" name="portfolio" class="form-control file-upload"
                data-upload-url="{{ route('user.update-portfolio') }}"
                accept="application/pdf"
                data-allowed-types="application/pdf"
                required
        >
    </div>
</div>

<div class="row mb-4">

    <div class="col">
        <label for="">Video Introduction</label>
        <input type="file" id="videolink" name="videolink" class="form-control file-upload"
                data-upload-url="{{ route('user.update-video') }}"
                accept="video/*"
                data-allowed-types="video/mp4,video/mpeg,video/quicktime,video/webm,video/x-msvideo"
                required
        >
        <small class="text-muted">Upload at least 2 minute video introduction.
            <a href="https://drive.google.com/file/d/1aJqNFMcso-kGSfjCYYmWg88-cWIkKu19/view" target="_blank">
                Click here
            </a> for a sample video introduction
        </small>
    </div>
</div>

{{-- <div class="row mb-4">
    <div class="col"> --}}
        {{-- NO DB Col yet. --}}
        {{-- <label for="">Career/Skill Certifications</label>
        <input type="file" id="photo_id" name="photo_id" class="form-control file-upload" --}}
                {{-- create routes for this --}}
                {{-- data-upload-url="{{ route('user.update-valid-id') }}"
                accept=".jpeg, .jpg, .png"
                data-allowed-types="image/jpeg,image/png,image/gif,application/pdf"
                required
        >
        <small class="text-muted">Please compile your certifications in .pdf file format </small>
    </div>
</div> --}}

    @php
        $positions = $user->information->positions ?? '';
        $searchTerms = ['Callers', 'Tech VAs', 'General VA'];

        $matchFound = array_filter($searchTerms, fn($term) => str_contains($positions, $term));
    @endphp

    @if(!empty($matchFound))
        <div class="row mb-4">
            <div class="col">
                <label for="">Sample Mock Call</label>
                <small class="d-block text-muted mb-3">Upload at least 2-minute mock-call each. <a href="#">Click here</a> for a sample mockcall</small>
                <span class="d-block">Inbound</span>
                <input type="file" id="inbound_call" name="inbound_call" class="form-control file-upload"
                        data-upload-url="{{ route('user.update-inbound') }}"
                        accept=".mp4,.avi,.wmv,.mp3,.wav,.aac,.flac,.ogg,.wma"
                        data-allowed-types="video/mp4,video/x-msvideo,video/x-ms-wmv,audio/mpeg,audio/wav,audio/aac,audio/flac,audio/ogg,audio/x-ms-wma"
                        required
                >
                <span class="d-block pt-3">Outbound</span>
                <input type="file" id="outbound_call" name="outbound_call" class="form-control file-upload"
                        data-upload-url="{{ route('user.update-outbound') }}"
                        accept=".mp4,.avi,.wmv,.mp3,.wav,.aac,.flac,.ogg,.wma"
                        data-allowed-types="video/mp4,video/x-msvideo,video/x-ms-wmv,audio/mpeg,audio/wav,audio/aac,audio/flac,audio/ogg,audio/x-ms-wma"
                        required
                >

            </div>
        </div>
    @endif

<x-applicant.guidelines />

<script src="{{ asset('dist/js/pages/user-end/file-upload.js') }}"></script>
