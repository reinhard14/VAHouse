<!-- Add Notes Modal -->

<div class="modal fade long" id="add-notes-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add notes for this applicant</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>

            <form id="add-notes-form-{{ $user->id }}" data-user-id="{{ $user->id }}">
                @csrf
                 <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="reviewed_by" value="{{ Auth::user()->name }}">
                <input type="hidden" name="review_status" value="updated">

                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="notes">Note: </label>
                            <input class="form-control mb-2" type="text" name="notes" required>
                        </div>
                    </div>
                    <div id="notesShowCard-{{ $user->id }}">
                        @forelse ($user->reviews()->latest()->get() as $review)
                            <div class="row mt-3 px-3">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            Note: {{ $review->created_at->diffForHumans() }}
                                        </div>
                                        <div class="card-body">
                                            {{ $review->notes ?? '' }}
                                        </div>
                                        <div class="card-footer">
                                            <strong>Updated by: </strong> {{ $review->reviewed_by ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div id="rowNotesUnavailable-{{ $user->id }}" class="row">
                                <div class="col">
                                    <h5 class="text-center">Notes unavailable.</h5>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-pen mr-1"></i> Add
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-file-x mr-1"></i>Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var addNotesRoute = '{{ route("add.notes") }}';
</script>
