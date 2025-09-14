@extends('layouts.app')

@section('title', 'Host')



@section('extra_css')
<link href="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.css" rel="stylesheet" >

<style>
    /* Hide Zoom Workplace banner - WARNING: Not officially supported */
    .ReactModalPortal {
        display: none !important;
    }

    /* Make the modal body scrollable */
.modal-dialog {
    max-width: 800px;
    margin: 1.75rem auto;
}

.modal-content {
    height: 100%;
    display: flex;
    flex-direction: column;
}

/* Set a max height for the modal body and make it scrollable */
.modal-body {
    overflow-y: auto; /* Enables vertical scrolling */
    max-height: 500px; /* Adjust the height based on your preference */
}

/* Optional: Add space between the footer and content */
.modal-footer {
    margin-top: auto;
    padding: 1rem 1.5rem;
    border-top: 1px solid #dee2e6;
}


</style>
@endsection


@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-theme">Meetings</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="dataTable2" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Duration</th>
                        <th>Meeting Topic</th>
                        <td>Paticipant List</td>
                        <th colspan="2" class="text-center">Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($meetings as $meeting)
                    @php 
                        
                        $raw = $meeting->meeting_details;
                        $jsonPart = substr($raw, strpos($raw, '{'));
                        $data = json_decode($jsonPart, true);
                        $password=explode('pwd=',$data['join_url']);
                       //dd($data);
                        
                    @endphp 
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data['duration']}} Minutes</td>

                            <td>{{$data['topic']}}</td>

                            <td>
                                <a href="javascript:void(0)" onclick="showParticipantList('{{$data['id']}}')" class="btn btn-primary text-white btn-sm py-2 px-4 rounded-2">Show Participant List</a>                                
                            </td>

                            <td><a href="javascript:void(0)" class="btn btn-primary py-2 px-4 rounded-2 text-white" onclick="startMeeting('{{$data['id']}}','{{$password[1]}}')">Start</a></td>

                            <td>
                                {{-- <a href="javascript:void(0)" onclick="openPollModal('{{$data['id']}}')" class="btn btn-primary text-white btn-sm py-2 px-4 rounded-2">Create Poll</a>  --}}

                                <a href="{{route('vendor-create-poll',$data['id'])}}" class="btn btn-primary text-white btn-sm py-2 px-4 rounded-2">Create Poll</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


{{--  Participation Modal  --}}

<div class="modal fade" id="poll_modal" tabindex="-1" aria-labelledby="pollModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-scrollable">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="pollModalLabel">Create Poll</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="pollTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="create-tab" data-bs-toggle="tab" data-bs-target="#create-tab-pane" type="button" role="tab">Create Poll</button>

                        
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info-tab-pane" type="button" role="tab">Poll Info</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3">

                    <!-- Create Poll Tab -->
                    <div class="tab-pane fade show active" id="create-tab-pane" role="tabpanel">
                        <form id="poll-form">
                            @csrf
                            <input type="hidden" name="meeting_id" id="poll_meeting_id">

                            <!-- Poll Meta -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="poll-title" class="form-label">Poll Title</label>
                                    <input type="text" class="form-control" id="poll-title" name="title" placeholder="Enter poll title" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="poll-start" class="form-label">Start Time</label>
                                    <input type="datetime-local" class="form-control" id="poll-start" name="start_time">
                                </div>
                                <div class="col-md-3">
                                    <label for="poll-end" class="form-label">End Time</label>
                                    <input type="datetime-local" class="form-control" id="poll-end" name="end_time">
                                </div>
                            </div>

                            <!-- Questions Section -->
                            <div id="questions-container">
                                <!-- One question block -->
                                <div class="question-block border rounded p-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">Question 1</h6>
                                        <button type="button" class="btn btn-sm btn-danger remove-question d-none">Remove</button>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Question Type</label>
                                        <select class="form-select question-type" name="questions[0][type]">
                                            <option value="text">Text</option>
                                            <option value="image">Image</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 question-text">
                                        <label class="form-label">Question Text</label>
                                        <input type="text" class="form-control" name="questions[0][text]" placeholder="Enter your question">
                                    </div>

                                    <div class="mb-3 question-image d-none">
                                        <label class="form-label">Upload Image</label>
                                        <input type="file" class="form-control" name="questions[0][image]">
                                    </div>

                                    <!-- Options -->
                                    <div class="options-container">
                                        <label class="form-label">Options</label>
                                        <div class="option-item input-group mb-2">
                                            <input type="text" class="form-control" name="questions[0][options][]" placeholder="Enter option">
                                            <button type="button" class="btn btn-outline-danger remove-option">X</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-link add-option">+ Add Option</button>
                                </div>
                            </div>

                            <button type="button" class="btn btn-outline-primary mt-2" id="add-question">+ Add Question</button>
                        </form>
                    </div>

                    <!-- Poll Info Tab -->
                    <div class="tab-pane fade" id="info-tab-pane" role="tabpanel">
                        <div id="poll_list"></div>
                    </div>
                    
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="poll-form">Save Poll</button>
            </div>
        </div>
    </div>
</div>


{{--  Create Poll for a particular vendor --}}

<div class="modal fade" id="poll_modal" tabindex="-1" aria-labelledby="pollModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-scrollable">
        <div class="modal-content">
            
            <div class="modal-body">

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item active" role="presentation">
                        <button class="nav-link active" id="poll-tab" data-bs-toggle="tab" data-bs-target="#poll-tab-pane" type="button" role="tab">Create Poll</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="info-poll-tab" data-bs-toggle="tab" data-bs-target="#info-poll-tab-pane" type="button" role="tab">Poll Info</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3">

                    
                    <!-- Create Poll Tab -->
                    <div class="tab-pane fade show active" id="poll-tab-pane" role="tabpanel">
                        <form id="poll-form">
                            @csrf
                            <input type="hidden" name="meeting_id" id="poll_meeting_id" >
                            <div class="mb-3">
                                <label for="poll-question" class="form-label">Poll Question</label>
                                <input type="text" class="form-control" id="poll-question" name="question" placeholder="Enter your poll question" required>
                            </div>

                            <div id="poll-options" class="mb-3">
                                <label class="form-label">Poll Options</label>
                                
                                <!-- Additional options will be added here -->
                                <div id="additional-options"></div>

                                <button type="button" id="add-option" class="btn btn-link">+ Add Option</button>
                            </div>
                        </form>
                    </div>

                    <!-- Poll Info Tab -->
                    <div class="tab-pane fade" id="info-poll-tab-pane" role="tabpanel">
                        <div id="poll_list">
                            
                        </div>
                    </div>
                    
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="poll-form">Save Poll</button>
            </div>
        </div>
    </div>
</div>


@endsection


@section('extra_js')
<script src="{{asset('/assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="https://source.zoom.us/4.0.5/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/4.0.5/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/4.0.5/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/4.0.5/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/4.0.5/zoom-meeting-4.0.5.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    
    
    async function getSignature(meetingNumber, role) {
        // Call Laravel API route
        const response = await fetch("{{ url('/api/zoom-signature') }}", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                meetingNumber: meetingNumber,
                role: role
            }),
        });
        return await response.json();
    }

    function startMeeting(meetingNumber,passWord) {
        const role = 1; // 0 = attendee, 1 = host

        getSignature(meetingNumber, role).then(({ signature, sdkKey }) => {

            ZoomMtg.init({
                leaveUrl: "https://webideasolution.in/webiner/vendor-dashboard",
                patchJsMedia: true,
                success: () => {
                    ZoomMtg.join({
                        signature: signature,
                        sdkKey: @json(env('ZOOM_SDK_KEY')),
                        meetingNumber: meetingNumber,
                        userName: @json(Auth::guard('vendoruser')->user()?->user_name),
                        userEmail: @json(Auth::guard('vendoruser')->user()?->user_name),
                        passWord: passWord,
                        success: (res) => console.log("Join success", res),
                        error: (err) => console.error("Join error", err),
                    });
                },
                error: (err) => console.error("Init error", err),
            });
        });
    }

        
    document.addEventListener("DOMContentLoaded", function () {
        const targetNode = document.getElementById('zmmtg-root');
        
        if (!targetNode) return;
    
        const observer = new MutationObserver((mutationsList, observer) => {
            const banner = targetNode.querySelector('.meeting-app__branding');
            if (banner) {
                banner.style.display = 'none';
            }
    
            const loading = targetNode.querySelector('.ReactModalPortal');
            if (loading) {
                loading.style.display = 'none';
            }
        });
    
        observer.observe(targetNode, { childList: true, subtree: true });
    });
    
    function showParticipantList(meetingNumber)
    {
        const csrfToken = "{{ csrf_token() }}";
        $.ajax({
            headers: {'X-CSRF-TOKEN': csrfToken},
            url: "{{ route('partcipant-list') }}",
            method: 'POST',
            data: {
                meeting_number: meetingNumber
            },
            success: function(response) {
                $("#participant_modal").modal('show');
                $("#participants_list").html(response.data.participants);            
                
                setTimeout(function () {
                    if ($.fn.DataTable.isDataTable('#participants_list')) {
                        $('#participants_list').DataTable().destroy();  // Destroy previous DataTable instance
                    }
                    $('#participants_list').DataTable();  // Initialize DataTable
                }, 100); 
                
            },
        });
    }

 function openPollModal(meeting_id)
 {
    $("#poll_meeting_id").val(meeting_id);
    $("#poll_modal").modal('show');
 }



 // store poll data
 $('#poll-form').on('submit', function(e) {
    e.preventDefault();  
    var formData = $("#poll-form").serialize();
    $.ajax({
        url: '{{ route("vendor-poll-submission") }}',  // The route where we will send data
        type: 'POST',
        data: formData,
        success: function(response) {
            Swal.fire({
                title: "Good job!",
                text: "Poll Created!",
                icon: "success"
                });

            $("#poll-form").trigger("reset");
        },
        error: function(xhr, status, error) {
            
            Swal.fire({
                icon: "error",
                text: "Something went wrong!",
                
                });
        }
    });
});

$("#poll-tab").click(function(){
    $("#poll-form").trigger("reset");    
});

$("#info-poll-tab").click(function(){
        var meeting_id = $("#poll_meeting_id").val();
        $.ajax({
            // url: '{{ route("vendor-poll-list",'+meeting_id+') }}',
            url: '/vendor-poll-list/' + meeting_id,
            success: function(response) {
                $("#poll_list").html(response.data);        
            }
        });
    });
</script>


<script>
$(document).ready(function () {
    let questionIndex = 0; // Track question number

    // Add Question
    $("#add-question").click(function () {
        questionIndex++;
        let questionHtml = `
        <div class="question-block border rounded p-3 mb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Question ${questionIndex + 1}</h6>
                <button type="button" class="btn btn-sm btn-danger remove-question">Remove</button>
            </div>

            <div class="mb-3">
                <label class="form-label">Question Type</label>
                <select class="form-select question-type" name="questions[${questionIndex}][type]">
                    <option value="text">Text</option>
                    <option value="image">Image</option>
                </select>
            </div>

            <div class="mb-3 question-text">
                <label class="form-label">Question Text</label>
                <input type="text" class="form-control" name="questions[${questionIndex}][text]" placeholder="Enter your question">
            </div>

            <div class="mb-3 question-image d-none">
                <label class="form-label">Upload Image</label>
                <input type="file" class="form-control" name="questions[${questionIndex}][image]">
            </div>

            <!-- Options -->
            <div class="options-container">
                <label class="form-label">Options</label>
                <div class="option-item input-group mb-2">
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Enter option">
                    <button type="button" class="btn btn-outline-danger remove-option">X</button>
                </div>
            </div>
            <button type="button" class="btn btn-link add-option">+ Add Option</button>
        </div>`;

        $("#questions-container").append(questionHtml);
    });

    // Remove Question
    $(document).on("click", ".remove-question", function () {
        $(this).closest(".question-block").remove();
    });

    // Add Option
    $(document).on("click", ".add-option", function () {
        let container = $(this).siblings(".options-container");
        let questionIdx = container.closest(".question-block").index(); // get current question index
        let optionHtml = `
            <div class="option-item input-group mb-2">
                <input type="text" class="form-control" name="questions[${questionIdx}][options][]" placeholder="Enter option">
                <button type="button" class="btn btn-outline-danger remove-option">X</button>
            </div>`;
        container.append(optionHtml);
    });

    // Remove Option
    $(document).on("click", ".remove-option", function () {
        $(this).closest(".option-item").remove();
    });

    // Toggle Question Type (text / image)
    $(document).on("change", ".question-type", function () {
        let block = $(this).closest(".question-block");
        if ($(this).val() === "text") {
            block.find(".question-text").removeClass("d-none");
            block.find(".question-image").addClass("d-none");
        } else {
            block.find(".question-text").addClass("d-none");
            block.find(".question-image").removeClass("d-none");
        }
    });
});
</script>


@endsection

