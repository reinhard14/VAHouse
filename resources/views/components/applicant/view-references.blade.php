<!-- View references Modal -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<div id="view-references-modal-{{ Auth::id() }}" class="modal fade long" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View References Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <div class="modal-body">
                @if(!isset($user->references) && is_null($user->references))
                    <h5>No references submitted yet.</h5>
                @else
                    <div class="row mb-2">
                        <div class="col">
                            <strong>Incase of Emergency</strong>
                            <p>{{ $user->references->emergency_number }} - {{ $user->references->emergency_person }} - {{ $user->references->emergency_relationship }}</p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <strong>Date of Commencement</strong>
                            <p>{{ $user->references->start_date }} </p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <strong>Department / Direct Client Name</strong>
                            <p>{{ $user->references->department }} </p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <strong for="team_leader" class="form-label">Team Leader / Direct Client Name</strong>
                            <p>{{ $user->references->team_leader }} </p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <strong>How did you learn about the job opening?</strong>
                            <p>{{ $user->references->referral }} </p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <strong>Preferred shift</strong>
                            <p>{{ $user->references->preferred_shift }} </p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <strong>Work Status</strong>
                            <p>{{ $user->references->work_status }} </p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <strong>Services Offered</strong>
                            @foreach ($user->references->services_offered  as $service)
                                <p>{{ $service }} </p>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="bi bi-file-x"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

