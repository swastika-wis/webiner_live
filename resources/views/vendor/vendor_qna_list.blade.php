@extends('layouts.app')

@section('title', 'Question and Answer List')

@section('extra_css')

<link href="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.css" rel="stylesheet" >

@endsection

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">All Question and Answers</h3>

    <table class="table " id="qnaTable">
        <thead>
            <tr>
                <th>Question</th>
                <th>Ask By</th>
                <th>Answer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($qna_list as $qna)
                <tr>
                    <td>{{$qna->question}}</td>
                    <td>{{$qna->askBy->full_name}}</td>
                    <td>
                        <textarea vlass="form-control" id="box_{{$qna->id}}" rows="2">{{$qna->answer}}</textarea>
                    </td>
                    <td>
                        <button class="btn btn-info" onclick="saveResponse('{{$qna->id}}')">Send</button>
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

        }

       });
    }
</script>
@endsection
