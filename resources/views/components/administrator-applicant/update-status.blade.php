<!-- Update Status Modal -->

<div class="modal fade" id="update-status-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set status for this applicant</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>

            <form id="update-status-form-{{ $user->id }}" data-user-id="{{ $user->id }}">
                @csrf
                @method('put')
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="status">Status: </label>

                            <select name="status" class="form-control" required>
                                <option value="New" {{ old('status', $user->status->status ?? '') == 'New' ? 'selected' : '' }}>New</option>
                                <option value="For Initial Interview" {{ old('status', $user->status->status ?? '') == 'For Initial Interview' ? 'selected' : '' }}>For Initial Interview</option>
                                <option value="Initial-Failed" {{ old('status', $user->status->status ?? '') == 'Initial-Failed' ? 'selected' : '' }}>Initial - Failed</option>
                                <option value="Initial-Passed" {{ old('status', $user->status->status ?? '') == 'Initial-Passed' ? 'selected' : '' }}>Initial - Passed</option>
                                <option value="Incomplete" {{ old('status', $user->status->status ?? '') == 'Incomplete' ? 'selected' : '' }}>Incomplete</option>
                                <option value="Final-Failed" {{ old('status', $user->status->status ?? '') == 'Final-Failed' ? 'selected' : '' }}>Final - Failed</option>
                                <option value="For Review" {{ old('status', $user->status->status ?? '') == 'For Review' ? 'selected' : '' }}>For Review</option>
                                <option value="Not Qualified" {{ old('status', $user->status->status ?? '') == 'Not Qualified' ? 'selected' : '' }}>Not Qualified</option>
                                <option value="Ready for shortlisting" {{ old('status', $user->status->status ?? '') == 'Ready for shortlisting' ? 'selected' : '' }}>Ready for shortlisting</option>
                                <option value="Onboarded" {{ old('status', $user->status->status ?? '') == 'Onboarded' ? 'selected' : '' }}>Onboarded</option>
                                <option value="Inactive" {{ old('status', $user->status->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Hired" {{ old('status', $user->status->status ?? '') == 'Hired' ? 'selected' : '' }}>Hired</option>
                                <option value="Floating" {{ old('status', $user->status->status ?? '') == 'Floating' ? 'selected' : '' }}>Floating</option>
                                <option value="Terminated" {{ old('status', $user->status->status ?? '') == 'Terminated' ? 'selected' : '' }}>Terminated</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="tier">Tier: </label>

                            <select name="tier" class="form-control" required>
                                <option value="Tier 1" {{ old('tier', $user->tier->tier ?? '') == 'Tier 1' ? 'selected' : '' }}>Tier 1</option>
                                <option value="Tier 2" {{ old('tier', $user->tier->tier ?? '') == 'Tier 2' ? 'selected' : '' }}>Tier 2</option>
                                <option value="Tier 3" {{ old('tier', $user->tier->tier ?? '') == 'Tier 3' ? 'selected' : '' }}>Tier 3</option>
                                <option value="Master VA" {{ old('tier', $user->tier->tier ?? '') == 'Master VA' ? 'selected' : '' }}>Master VA</option>
                                <option value="Super VA" {{ old('tier', $user->tier->tier ?? '') == 'Super VA' ? 'selected' : '' }}>Super VA</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="lesson">Applicant's Lessons Status: </label>

                            <select name="lesson" class="form-control" required>
                                <option value="Incomplete" {{ old('lesson', $user->status->lesson ?? '') == 'Incomplete' ? 'selected' : '' }}>Incomplete</option>
                                <option value="In Progress" {{ old('lesson', $user->status->lesson ?? '') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ old('lesson', $user->status->lesson ?? '') == 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                    </div>

                    @if($user->status)
                        <div class="row mt-4">
                            <div class="col">
                                <strong>Updated by: </strong> {{ $user->status->updated_by ?? ''}}
                            </div>
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-arrow-clockwise"></i> Update
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-file-x  mr-1"></i> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var updateStatusRoute = '{{ route("update.applicant.status", $user->id) }}';
</script>
