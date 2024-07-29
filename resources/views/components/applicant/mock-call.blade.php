<!-- Add mock call modal -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<div id="mock-call-modal" class="modal fade" tabindex="-1">
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
                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id(); }}">
                <div class="modal-body">
                    <div class="row p-3">
                        <div class="col">
                            <label for="inbound_call" class="form-label">Inbound recorded mock call <strong>(32MB limit)</strong></label>
                            <input type="file" id="inbound_call" name="inbound_call" class="form-control">
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label for="outbound_call" class="form-label">Outbound recorded mock call <strong>(32MB limit)</strong></label>
                            <input type="file" id="outbound_call" name="outbound_call" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="saveMockCall" class="btn btn-primary btn-sm">
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
            $(this).attr('disabled', true);

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
                                        <div class="col-md-3" id="inboundShow">
                                            <label> Inbound: </label>
                                            <a href="` + baseUrl + `/` + response.mockcalls.inbound_call +`" target="_blank">Open</a>
                                        </div>
                                        `;
                    const outboundShow = `
                                        <div class="col-md-3" id="outboundShow">
                                            <label> Outbound: </label>
                                            <a href="` + baseUrl + `/` + response.mockcalls.outbound_call +`" target="_blank">Open</a>
                                        </div>
                                        `;

                    $('#inboundLabel').remove();
                    $('#inboundLink').remove();
                    $('#outboundLabel').remove();
                    $('#outboundLink').remove();
                    $('#callersRow').append(inboundShow);
                    $('#callersRow').append(outboundShow);

                },
                error: function(response) {
                    handleMockcallFormSubmission(response);
                }
            });

            setTimeout(() => {
                        $(this).removeAttr('disabled');
                    }, 10000);
        });
    });
</script>
