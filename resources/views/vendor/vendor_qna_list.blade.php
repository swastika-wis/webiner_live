@extends('layouts.app')

@section('title', 'Question and Answer List')

@section('extra_css')

<link href="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.css" rel="stylesheet" >

@endsection

@section('content')
<div class="px-0 px-lg-5 my-4">
    <div class="card">
        <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-theme">All Question and Answers</h5>
    </div>
    
    <div class="card-body">
    <!-- <h3 class="mb-4">All Question and Answers</h3> -->

    <table class="table " id="qnaTable">
        <thead>
            <tr>
                <th style="min-width:200px">Ask By</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($qna_list as $qna)
                <tr>
                     <td>{{$qna->askBy->full_name}}</td>
                    <td>
                        <div class="show-qs">
                        {{$qna->question}}
                        </div>
                    </td>
                   
                    <td>
                        <textarea vlass="form-control" id="box_{{$qna->id}}" rows="5" cols="50">{{$qna->answer}}</textarea>
                    </td>
                    <td>
                        <button class="btn btn-primary" onclick="saveResponse('{{$qna->id}}')">Send</button>
                        <span class="text-info" id="message_{{$qna->id}}"></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection

@section('extra_js')


<script src="{{asset('/assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.js" ></script>

<script>
    let table = new DataTable('#qnaTable');
</script>

<script>
    var csrf_token = "<?php echo csrf_token()?>";
    
    function saveResponse(record_id)
    {
       var answer = $("#box_"+record_id).val();
       
       $.ajax({

        url: '{{ route("vendor-qna-submission") }}', 
        type: 'POST',
        data: {'_token':csrf_token,'record_id':record_id,'answer':answer},

        success: function(response) {
            $("#message_"+record_id).html("Message Sent");

             setTimeout(function() {
                    $("#message_"+record_id).fadeOut();
            }, 2000);
        }

       });
    }


    setTimeout(function() {
        location.reload();
    }, 20000); 
</script>
@endsection
