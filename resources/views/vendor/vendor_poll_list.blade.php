@extends('layouts.app')

@section('title', 'Vendor Poll List')

@section('extra_css')
<style>
    .poll-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        background: #fff;
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
<div class="container mt-4">
    <h3 class="mb-4">Vendor Poll List</h3>

    @foreach($polls as $poll)
        <div class="poll-card">
            <h5>{{ $poll->title }}</h5>
            <small>Start: {{ $poll->start_time }} </small>

            <hr>

            @foreach($poll->questions as $question)
                <div class="mb-4">
                    <h6>Q{{ $loop->iteration }}. {{ $question->question_text }}</h6>

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
            @endforeach
        </div>
    @endforeach
</div>
@endsection

@section('extra_js')
@endsection
