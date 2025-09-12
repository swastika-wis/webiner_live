@extends('layouts.app')

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
        .bottom-hide {
            background: #000;
            height: 70px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
@endsection


@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-theme">Meetings</h5>
    </div>
    <div class="card-body">
       
        @php 
            
            $raw = $meeting->meeting_details;
            $jsonPart = substr($raw, strpos($raw, '{'));
            $data = json_decode($jsonPart, true);
            $password=explode('pwd=',$data['join_url']);
            

        @endphp 

        <div class="pwa-webclient" style="z-index: 30000; width: 70%; height: 100%; top: 0px; left: 0px;">
            
            <div class="pwa-webclient__iframe-wrapper" style="position: relative;">
                <iframe class="pwa-webclient__iframe" width="100%" height="500px" id="webclient"
                    src="https://app.zoom.us/wc/{{$meeting->meeting_number}}/join?pwd={{$password[1]}}&amp;from=pwa"
                    role="presentation"></iframe>
                    <div class="bottom-hide"></div>
            </div>
        </div>

        <div class="pwa-webclient" style="position: absolute; z-index: 999; width: 27%; height: 100%; top: 50px; right: 0px;">
          <div class="poll-list" id="pollList">

             <h5 class="m-0 font-weight-bold text-theme">Polls</h5>
                <form id="user_poll">
                    @csrf
                    <input type="hidden" value="{{session('webuser')->id}}" name="participant_id">
                    @foreach($meeting_polls as $poll)

                            <h4 class="mt-3">{{$poll->question}}</h4>
                            <input type="hidden" value="{{$loop->iteration}}" name="poll_{{$loop->iteration}}">


                            @foreach($poll->options as $option)
                                <div>  <input type="radio" 
                                    name="poll_option_{{ $poll->id }}"  
                                    value="{{ $option->id }}" />
                                    {{$option->option}} </div>
                            @endforeach
                    @endforeach

                    <button type="submit" class="btn btn-success mt-3">Save</button>
                </form>


            </div>
          </div>


    </div>
</div>
@endsection

@section('extra_js')
<script src="{{asset('/assets/js/jquery-3.7.1.min.js')}}"></script>
<script>
  document.querySelector("#webclient").contentWindow
    .document.getElementById("input-for-name").value = "John Doe";
</script>

{{-- <script>
    $("#user_poll").submit(function(e){
        
        e.preventDefault();  
        var formData = $("#user_poll").serialize();
        $.ajax({
            url: '{{ route("user-poll-submission") }}',  // The route where we will send data
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


    setInterval(refreshPolls, 20000);

</script>
 --}}


 <script>
    $(document).ready(function () {
    
        function attachSubmitHandler() {
            $("#user_poll").off("submit").on("submit", function(e){
                e.preventDefault();  
                var formData = $(this).serialize();
    
                $.ajax({
                    url: '{{ route("user-poll-submission") }}',  // Your controller route
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
                    error: function(xhr){
                        console.error(xhr.responseText);
                        alert("Error submitting vote!");
                    }
                });
            });
        }
    
        function refreshPolls() {
            $.ajax({
                url: "{{ route('poll.list') }}",
                method: "GET",
                success: function (html) {
                    $("#pollList").html(html);
                    attachSubmitHandler(); // rebind after refreshing HTML
                },
                error: function () {
                    console.error("Error refreshing polls");
                }
            });
        }
    
        attachSubmitHandler(); // bind first time
        setInterval(refreshPolls, 20000); // auto refresh every 20 sec
    });
    </script>


@endsection

