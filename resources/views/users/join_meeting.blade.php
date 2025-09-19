@extends('layouts.app-user')

@section('title', 'Paticipent')


@section('styles')
<style>
    footer.action-bar.action-bar__footer {
        display: none;
    }

    iframe {
        width: 100%;
        height: 1000px;
    }

    /* .bottom-hide {
            background: #000;
            height: 70px;
            position: absolute;
            bottom: 0;
            width: 100%;
        } */


    /* Wizard step circles */
    .step-indicator {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .step-indicator .step {
        width: 35px;
        height: 35px;
        line-height: 35px;
        border-radius: 50%;
        background: #ccc;
        color: #fff;
        text-align: center;
        margin: 0 8px;
        font-weight: bold;
        transition: background 0.3s;
    }

    .step.active {
        background: #20b2aa;
    }

    .step.completed {
        background: #28a745;
    }

    /* Hide steps */
    .wizard-step {
        display: none;
    }

    .wizard-step.active {
        display: block;
    }
</style>
@endsection


@section('content')
<div class="card shadow mb-4 user-box">

    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-theme">Meetings</h5>
    </div>
    <div class="card-body">

        @php

        // $raw = $meeting->meeting_details;
        // $jsonPart = substr($raw, strpos($raw, '{'));
        // $data = json_decode($jsonPart, true);
        // $password=explode('pwd=',$data['join_url']);

        $meeting_id = $meeting->meeting_number;
        $password = $meeting->meeting_password;


        @endphp

        <div class="pwa-webclient left-sidebar">

            <div class="pwa-webclient__iframe-wrapper" style="position: relative;">
                <div class="top-banner">

                    <img src="{{asset('/assets/img/bg.jpeg')}}" alt="">
                </div>


                {{-- <iframe class="pwa-webclient__iframe" width="100%" height="500px" id="webclient"
                        src="https://app.zoom.us/wc/{{$meeting->meeting_number}}/join?pwd={{$password}}&amp;from=pwa&amp;uname={{session('webuser')->full_name}}"
                role="presentation"></iframe>
                <div class="bottom-hide"></div> --}}

                <div class="position-relative">
                    <div class="top-hide"></div>
                <iframe class="pwa-webclient__iframe" width="100%" height="500px" id="webclient"
                    src="https://app.zoom.us/wc/{{$meeting->meeting_number}}/join?pwd={{$password}}&amp;from=pwa&amp;uname={{session('webuser')->full_name}}"
                    role="presentation"></iframe>
                
                <div class="bottom-hide">
                    {{-- <marquee behavior="scroll" direction="left">Welcome to the meeting!</marquee> --}}
                </div>
                </div>

            </div>
            <!-- <div class="top-hide"></div>
                <div class="bottom-hide"></div> -->
        </div>

        <div class="pwa-webclient right-sidebar">

            <div class="question-box bg-white">
                <p class="title-header mb-0">Ask Question</p>
                <div id="qna_alert"></div>
                <form id="user_qna">
                    @csrf
                    <input type="hidden" name="meeting_id" value="{{$meeting->meeting_number}}">
                    <input type="hidden" name="participant_id" value="{{session('webuser')->id}}">
                    <textarea name="user_question" id="question_box" cols="30" rows="5"></textarea>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

                <div id="qnabox">
                    
                </div>
            </div>
            <div class="poll-list" id="pollList">

                <div class="poll-wrapper">
                    <p class="m-0 text-theme title-header">Polls Coming Soon!</p>
                    <div class="p-3">
                        Polls will be available shortly!
                    </div>
                </div>
            </div>
        </div>




    </div>
    @endsection

    @section('extra_js')
    <script src="{{asset('/assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        //   document.querySelector("#webclient").contentWindow
        //     .document.getElementById("input-for-name").value = "John Doe";
    </script>

    {{-- <script>
    $("#user_poll").submit(function(e){
        
        e.preventDefault();  
        var formData = $("#user_poll").serialize();
        $.ajax({
            url: '{{ route("user-poll-submission") }}', // The route where we will send data
    type: 'POST',
    data: formData,
    success: function(response) {

    }
    });

    });


    function refreshPolls() {
    $.ajax({
    url: "{{ route('poll.list') }}",
    method: "GET",
    success: function (html) {
    $("#pollList").html(html);
    },
    error: function () {
    console.error("Error refreshing polls");
    }
    });
    }


    setInterval(refreshPolls, 50000);

    </script>
    --}}


    <script>
        $(document).ready(function() {

            function attachSubmitHandler() {
                $("#user_poll").off("submit").on("submit", function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();

                    $.ajax({
                        url: '{{ route("user-poll-submission") }}', // Your controller route
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Optionally show a success message
                            // if(response.success){
                            //     alert(response.message ?? "Your vote has been saved!");
                            // } else {
                            //     alert("Something went wrong!");
                            // }

                            refreshPolls(); // refresh after vote submission
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert("Error submitting vote!");
                        }
                    });
                });
            }

            function refreshPolls() {

                $.ajax({
                    url: "{{ route('poll.list',$meeting->meeting_number) }}",
                    method: "GET",
                    success: function(html) {
                        $("#pollList").html(html);
                        attachSubmitHandler(); // rebind after refreshing HTML
                    },
                    error: function() {
                        console.error("Error refreshing polls");
                    }
                });
            }

            function refreshQNA() {

                $.ajax({
                    url: "{{ route('qna.list', ['ask_by' => session('webuser')->id, 'meeting_number' => $meeting->meeting_number]) }}",
                    method: "GET",
                    success: function(html) {
                        $("#qnabox").html(html);
                    },
                    error: function() {
                        console.error("Error refreshing polls");
                    }
                });

            }
            attachSubmitHandler();
            setInterval(refreshPolls, 20000);
            setInterval(refreshQNA, 20000);

        });


        $("#user_qna").on("submit", function(e) {
            e.preventDefault();


            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route("user-qna-submission") }}', // Your controller route
                type: 'POST',
                data: formData,
                success: function(response) {
                    $("#question_box").val("");
                    $("#qna_alert").html(`
            <div style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px;">
                Question submitted successfully!
            </div>
        `).fadeIn();

                    // Auto-hide the message after 3 seconds
                    setTimeout(function() {
                        $("#qna_alert").fadeOut();
                    }, 3000);
                }
            });
        });


        function submitRecord() {
            
            $("#user_poll_form").off("submit").on("submit", function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route("user-poll-submission") }}', // Your controller route
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alert("Poll submitted successfully!");
                    }

                });

            });
        }
    </script>




    @endsection