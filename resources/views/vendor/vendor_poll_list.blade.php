@extends('layouts.app')

@section('title', 'Poll List')

@section('extra_css')
<style>
    .poll-card {
        /* border: 1px solid #ddd; */
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        background: #fff;
        box-shadow:0 2px 6px rgba(0,0,0,0.1)
    }
    .progress {
        height: 20px;
    }
    .poll-option {
        margin-bottom: 12px;
    }
</style>
@endsection

@section('content')
<div class="px-0 px-lg-5 my-4">
   <div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold text-theme">Vendor Poll List</h5>
        <a href="{{route('vendor-create-poll',$meeting_number)}}" class="btn btn-info">Create Poll</a>
    </div>
</div>
    
    <!-- <h3 class="mb-4">Vendor Poll List</h3> -->
    <div class="card-body">

    @foreach($polls as $poll)
        <div class="poll-card">
            
            <h5 class="poll-no"><strong>{{ $poll->title }}</strong></h5> ({{$poll->meeting_number}} <strong>{{$poll->meeting->topic??''}}</strong>)
            
            <div>Start: {{ $poll->start_time }} </div>

            <hr>

            @foreach($poll->questions as $question)
                <div class="mb-2 mb-lg-3">

                    @if($question->question_type === 'image' && $question->question_image)
                    Q{{ $loop->iteration }}.<img src="{{ asset('/storage/app/public/' . $question->question_image) }}" style="height:200px" alt="Question Image" class="img-fluid">
                    @else 
                        <h6>Q{{ $loop->iteration }}. {{ $question->question_text }}</h6>
                    @endif                    
                    <div class="vote-count-wrap">
                    @foreach($question->options as $option)
                        @php
                           $votes = $option->votes_count;
                        @endphp

                        <div class="poll-option">
                            <strong>{{ $option->option_text }}</strong>
                            <span class="float-end">{{ $votes }} votes </span>
                        </div>
                    @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    </div>
</div>
@endsection

@section('extra_js')
<script>
     setTimeout(function() {
        location.reload();
    }, 20000);
</script>
@endsection
