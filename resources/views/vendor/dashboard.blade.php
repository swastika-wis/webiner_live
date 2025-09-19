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
    /* max-height: 500px;  */
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
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold text-theme">Meetings -</h5>
        
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="dataTable2" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Topic</th>
                        <td>Paticipant List</td>
                        <th>Start Meeting</th>
                        <th>Participants Login Link</th>
                        <th colspan="2" class="text-center">Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($meetings as $meeting)
                    @php 
                        
                        // $raw = $meeting->meeting_details;
                        // $jsonPart = substr($raw, strpos($raw, '{'));
                        // $data = json_decode($jsonPart, true);
                        // $password=explode('pwd=',$data['join_url']);
                       //dd($data);

                       $meeting_id = $meeting->meeting_number;
                       $password = $meeting['meeting_password'];

                        
                    @endphp 
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            {{-- <td>{{$data['duration']}} Minutes</td> --}}

                            <td>{{$meeting->topic}}</td>

                            <td>
                                <!-- <a href="{{route('vendor-join-meeting',["meeting_id"=>$meeting_id,"password"=>$password])}}">Click</a> -->
                                <a href="javascript:void(0)" onclick="showParticipantList('{{$meeting_id}}')" class="btn btn-primary text-white btn-sm py-2 px-4 rounded-2">Show Participant List</a>                                
                            </td>

                            <td>
                                <!-- <a href="javascript:void(0)" class="btn btn-primary py-2 px-4 rounded-2 text-white" onclick="startMeeting('{{$meeting_id}}','{{$password}}')">Start</a> -->


                                <a href="{{route('vendor-join-meeting',["meeting_id"=>$meeting_id,"password"=>$password])}}" class="btn btn-primary py-2 px-4 rounded-2 text-white" target="_blank">Join Meeting</a>
                        
                        </td>


                          


                            <td>
                                <a href="{{route('user-login',$meeting->meeting_number)}}" target="_blank" class="btn btn-primary py-2 px-4 rounded-2 text-white">Participants Login Link</a>
                            </td>
                            <td>
                                {{-- <a href="javascript:void(0)" onclick="openPollModal('{{$data['id']}}')" class="btn btn-primary text-white btn-sm py-2 px-4 rounded-2">Create Poll</a>  --}}

                                <a href="{{route('vendor-create-poll',$meeting_id)}}" class="btn btn-primary text-white btn-sm py-2 px-4 rounded-2">Create Poll</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade" id="participant_modal" tabindex="-1" aria-labelledby="tabModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered"> <!-- modal-lg for wider modal -->
        <div class="modal-content">
          
            <div class="modal-body">

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                     <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="participation-table-tab" data-bs-toggle="tab" data-bs-target="#table-tab-pane" type="button" role="tab">All Participants</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info-tab-pane" type="button" role="tab">Active Participants</button>
                    </li>
                   
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3">


                    <!-- Table Tab -->
                    <div class="tab-pane fade show active" id="table-tab-pane" role="tabpanel">
                        <div class="table-scroll">
                            <table class="table table-bordered table-hover" id="participants_list">
                            </table>
                        </div>
                    </div>

                    <!-- Info Tab -->
                    <div class="tab-pane fade show " id="info-tab-pane" role="tabpanel">
                         <div class="table-scroll">
                            <table class="table table-bordered table-hover" id="active_participants_list">
                            </table>
                        </div>
                    </div>                    
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div>
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" data-bs-dismiss="modal" onclick="showEmailModal()" >Send Email to ALL</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Email Body Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="emailModalLabel">Enter Email Content</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <div class="mb-3">
              <label for="emailSubject" class="form-label">Subject</label>
              <input type="text" class="form-control" id="emailSubject" placeholder="Subject of the email" required>
            </div>
          
            <div class="mb-3">
              <label for="emailBody" class="form-label">Email Body</label>
              <textarea class="form-control" id="emailBody" rows="6" placeholder="Write your email here..." required></textarea>
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" form="emailForm" class="btn btn-primary" onclick="sendMailButton()">Send</button>
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
                $("#active_participants_list").html(response.data.active_participants);

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
                text: "Something went wrong!"
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
            url: '/vendor-poll-list/' + meeting_id,
            success: function(response) {
                $("#poll_list").html(response.data);        
            }
        });
    });

    

function showEmailModal()
{
    $("#emailBody").val("");
    $("#emailSubject").val();
    $("#emailModal").modal('show');
}
function sendMailButton()
    {
        const emailBody = $("#emailBody").val();
        const emailSubject = $("#emailSubject").val();
        
        var selectedIds = [];
        $('input[name="participants"]:checked').each(function() {
            selectedIds.push($(this).val());
        });


        if (selectedIds.length > 0) {
            
            $.ajax({
                url: '{{route("send-bulk-email")}}', 
                type: 'POST',
                data: {
                    ids: selectedIds, 
                    _token: '{{ csrf_token() }}',
                    emailBody:emailBody,
                    emailSubject:emailSubject
                },
                success: function(response) {
                    alert('Bulk email sent successfully!');
                },
                error: function(error) {
                    alert('Failed to send bulk email.');
                }
            });
        } else {
            alert('Please select at least one participant.');
        }

    }

</script>


// <script>
// $(document).ready(function () {
//     let questionIndex = 0; // Track question number

//     // Add Question
//     $("#add-question").click(function () {
//         questionIndex++;
//         let questionHtml = `
//         <div class="question-block border rounded p-3 mb-3">
//             <div class="d-flex justify-content-between align-items-center mb-2">
//                 <h6 class="mb-0">Question ${questionIndex + 1}</h6>
//                 <button type="button" class="btn btn-sm btn-danger remove-question">Remove</button>
//             </div>

//             <div class="mb-3">
//                 <label class="form-label">Question Type</label>
//                 <select class="form-select question-type" name="questions[${questionIndex}][type]">
//                     <option value="text">Text</option>
//                     <option value="image">Image</option>
//                 </select>
//             </div>

//             <div class="mb-3 question-text">
//                 <label class="form-label">Question Text</label>
//                 <input type="text" class="form-control" name="questions[${questionIndex}][text]" placeholder="Enter your question">
//             </div>

//             <div class="mb-3 question-image d-none">
//                 <label class="form-label">Upload Image</label>
//                 <input type="file" class="form-control" name="questions[${questionIndex}][image]">
//             </div>

//             <!-- Options -->
//             <div class="options-container">
//                 <label class="form-label">Options</label>
//                 <div class="option-item input-group mb-2">
//                     <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Enter option">
//                     <button type="button" class="btn btn-outline-danger remove-option">X</button>
//                 </div>
//             </div>
//             <button type="button" class="btn btn-link add-option">+ Add Option</button>
//         </div>`;

//         $("#questions-container").append(questionHtml);
//     });

//     // Remove Question
//     $(document).on("click", ".remove-question", function () {
//         $(this).closest(".question-block").remove();
//     });

//     // Add Option
//     $(document).on("click", ".add-option", function () {
//         let container = $(this).siblings(".options-container");
//         let questionIdx = container.closest(".question-block").index(); // get current question index
//         let optionHtml = `
//             <div class="option-item input-group mb-2">
//                 <input type="text" class="form-control" name="questions[${questionIdx}][options][]" placeholder="Enter option">
//                 <button type="button" class="btn btn-outline-danger remove-option">X</button>
//             </div>`;
//         container.append(optionHtml);
//     });

//     // Remove Option
//     $(document).on("click", ".remove-option", function () {
//         $(this).closest(".option-item").remove();
//     });

//     // Toggle Question Type (text / image)
//     $(document).on("change", ".question-type", function () {
//         let block = $(this).closest(".question-block");
//         if ($(this).val() === "text") {
//             block.find(".question-text").removeClass("d-none");
//             block.find(".question-image").addClass("d-none");
//         } else {
//             block.find(".question-text").addClass("d-none");
//             block.find(".question-image").removeClass("d-none");
//         }
//     });
// });
// </script>


@endsection

