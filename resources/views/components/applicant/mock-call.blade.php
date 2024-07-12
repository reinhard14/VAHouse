<!-- Add mock call modal -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<div class="modal fade" id="mock-call-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Sample mock-calls</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>
            <div class="row text-center p-3">
                <div class="col fst-italic">
                    For CSR and Appointment Setters, please upload a sample file of your mock call below.
                </div>
            </div>
            <form id="callsForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id(); }}">
                <div class="modal-body">
                    <div class="row p-3">
                        <div class="col">
                            <label class="form-label" for="inbound_call">Inbound recorded mock call (10mb limit)</label>
                            <input id="inbound_call" name="inbound_call" type="file" class="form-control">
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label class="form-label" for="outbound_call">Outbound recorded mock call (10mb limit)</label>
                            <input id="outbound_call" name="outbound_call" type="file" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm" id="saveMockCall">
                        <i class="bi bi-plus-square mr-1"></i> Add
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-file-x"></i> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#saveMockCall').on('click', function(e){
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            var formData = new FormData();
            formData.append('inbound_call', $('#inbound_call')[0].files[0]);
            formData.append('outbound_call', $('#outbound_call')[0].files[0]);
            formData.append('user_id', $('#user_id').val());
            formData.append('_token', csrfToken);

            $.ajax({
                type: 'POST',
                url: '{{ route("user.mockcall") }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    const baseUrl = "{{ url('/storage') }}";
                    handleMockcallFormSubmission(response);
                    $('#mock-call-modal').modal('hide');

                    const inboundShow = `
                                        <div class="col-md-2" id="inboundShow">
                                            <label> Inbound: </label>
                                            <a href="` + baseUrl + `/` + response.mockcalls.inbound_call +`" target="_blank">Open</a>
                                        </div>
                                        `;
                    const outboundShow = `
                                        <div class="col-md-2" id="outboundShow">
                                            <label> Outbound: </label>
                                            <a href="` + baseUrl + `/` + response.mockcalls.outbound_call +`" target="_blank">Open</a>
                                        </div>
                                        `;
                    $('#callersRow').append(inboundShow);
                    $('#callersRow').append(outboundShow);
                },
                error: function(response) {
                    handleMockcallFormSubmission(response);
                }
            });
        });
    });
</script>
