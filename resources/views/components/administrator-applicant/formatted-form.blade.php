<!-- Formatted Form Modal -->

<div class="modal fade" id="formatted-form-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formatted Form</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <div class="modal-body">
                <strong>{{ $user->name }} {{ $user->lastname }} </strong>
                @php
                    $skills = [];

                    if (isset($user->skillsets->skill) && !is_null($user->skillsets->skill)) {
                        $skills = json_decode($user->skillsets->skill, true);
                    }
                @endphp

                <ul>
                    @if (!empty($skills) && is_array($skills))
                        @foreach ($skills as $skill)
                            <li>{{ $skill }}</li>
                        @endforeach

                    @else
                        <li>No skills available.</li>
                    @endif
                </ul>

                <strong>Tools & CRM</strong>
                @php
                    $tools = [];
                    $websites = [];

                    if (isset($user->skillsets->tool) && !is_null($user->skillsets->tool)) {
                        $tools = json_decode($user->skillsets->tool, true);
                    }

                    if(isset($user->skillsets->website) && !is_null($user->skillsets->website)) {
                        $websites = json_decode($user->skillsets->website, true);
                    }
                @endphp

                <ul>
                    @if ((!empty($tools) && is_array($tools)))
                        @foreach ($tools as $tool)
                            <li>{{ $tool }}</li>
                        @endforeach

                    @else
                        <li>No tools available.</li>
                    @endif

                    @if (!empty($websites) && is_array($websites))
                        @foreach ($websites as $website)
                            <li>{{ $website }}</li>
                        @endforeach

                    @else
                        <li>No websites available.</li>
                    @endif

                </ul>

                <div>
                    <small><strong>Intro Video Link</strong></small>
                    <small>{{ route('view.pdf', $user->information->videolink) }}</small>
                </div>

                <div>
                    <small><strong>CV Link</strong></small>
                    <small>{{ route('view.pdf', $user->information->resume) }}</small>
                </div>

                <div>
                    <small><strong>Portfolio Link</strong></small>
                    <small>{{ route('view.pdf', $user->information->portfolio) }}</small>
                </div>

                <div>
                    <small><strong>DISC Results</strong></small>
                    <small>{{ route('view.pdf', $user->information->disc_results) }}</small>
                </div>

                <div>
                    <small><strong>Formal Photo</strong></small>
                    <small>{{ route('view.pdf', $user->information->photo_formal) }}</small>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-file-x  mr-1"></i>Close</button>
            </div>
        </div>
    </div>
</div>
