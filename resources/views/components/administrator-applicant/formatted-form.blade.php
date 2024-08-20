<!-- Formatted Form Modal -->

<div class="modal fade" id="formatted-form-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formatted Form</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>

            <div class="modal-body">
                <strong>{{ Str::title($user->name) }} {{ Str::title($user->middlename) }} {{ Str::title($user->lastname) }} {{ Str::title($user->suffix) }}</strong>
                <ul>
                    @foreach ($user->experiences as $experience)
                        <li>{{ Str::title($experience->duration) }} - {{ Str::title($experience->title) }}</li>
                    @endforeach

                    @php
                        $skills = [];

                        if (isset($user->skillsets->skill) && !is_null($user->skillsets->skill)) {
                            $skills = json_decode($user->skillsets->skill, true);
                        }
                    @endphp

                    @if (!empty($skills) && is_array($skills))
                        @foreach ($skills as $skill)
                            <li>{{ Str::title($skill) }}</li>
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
                            <li>{{ Str::title($tool) }}</li>
                        @endforeach

                    @else
                        <li>No tools used.</li>
                    @endif

                    @if (!empty($websites) && is_array($websites))
                        @foreach ($websites as $website)
                            <li>{{ Str::title($website) }}</li>
                        @endforeach

                    @else
                        <li>No websites used.</li>
                    @endif

                </ul>

                <div>
                    <small><strong>Intro Video Link:</strong></small>
                    <small class="d-block">{{ isset($user->information->videolink) ? route('view.pdf', $user->information->videolink) : 'N/A' }}</small>
                </div>

                <div>
                    <small><strong>CV Link:</strong></small>
                    <small class="d-block">{{ isset($user->information->resume) ? route('view.pdf', $user->information->resume) : 'N/A' }}</small></small>
                </div>

                <div>
                    <small><strong>Portfolio Link:</strong></small>
                    <small class="d-block">{{ isset($user->information->portfolio) ? route('view.pdf', $user->information->portfolio) : 'N/A' }}</small></small>
                </div>

                <div>
                    <small><strong>DISC Results:</strong></small>
                    <small class="d-block">{{ isset($user->information->disc_results) ? route('view.pdf', $user->information->disc_results) : 'N/A' }}</small></small>
                </div>

                <div>
                    <small><strong>Formal Photo:</strong></small>
                    <small class="d-block">{{ isset($user->information->photo_formal) ? route('view.pdf', $user->information->photo_formal) : 'N/A' }}</small></small>
                </div>

                @if (isset($user->mockcalls->inbound_call))
                    <div>
                        <small><strong>Mock Calls:</strong></small>
                        <small class="d-block">Inbound: {{ isset($user->mockcalls->inbound_call) ? route('view.pdf', $user->mockcalls->inbound_call) : 'N/A' }}</small></small>
                        <small class="d-block">Outbound: {{ isset($user->mockcalls->outbound_call) ? route('view.pdf', $user->mockcalls->outbound_call) : 'N/A' }}</small></small>
                    </div>
                @endif

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-file-x  mr-1"></i>Close</button>
            </div>
        </div>
    </div>
</div>
