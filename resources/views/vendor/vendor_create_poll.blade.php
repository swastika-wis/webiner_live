@extends('layouts.app')

@section('title', 'Create Poll')

@section('extra_css')
<style>
    .question-block {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        background: #f9f9f9;
    }
</style>
@endsection

@section('content')
<div class="px-0 px-lg-5 my-4">
    <div class="card">
        <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-theme">Create Poll</h5>
    </div>
    <div class="card-body">
        <!-- <h3 class="mb-4">Create Poll</h3> -->

        <form id="poll-form" method="POST" action="{{route('vendor-poll-submission')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="meeting_id" value="{{$meeting_id}}">

            <!-- Poll Title & Schedule -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Poll Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter poll title" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Start Time</label>
                    <input type="datetime-local" class="form-control" name="start_time">
                </div>
                {{-- <div class="col-md-3">
                    <label class="form-label">End Time</label>
                    <input type="datetime-local" class="form-control" name="end_time">
                </div> --}}
            </div>

            <!-- Questions Section -->
            <div id="questions-container">
                <!-- Default Question -->
                <div class="question-block">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0 font-weight-bold">Question 1</h6>
                        <button type="button" class="btn btn-sm btn-danger remove-question d-none">Remove</button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Question Type</label>
                            <select class="form-select question-type form-control" name="questions[0][type]">
                                <option value="text">Text</option>
                                <option value="image">Image</option>
                            </select>
                        </div>
                    
                    

                    <div class="mb-3 col-md-6 question-text">
                        <label class="form-label">Question Text</label>
                        <input type="text" class="form-control" name="questions[0][text]" placeholder="Enter your question">
                    </div>

                    <div class="mb-3 question-image d-none">
                        <label class="form-label">Upload Image</label>
                        <input type="file" class="form-control" name="questions[0][image]">
                    </div>

                    <div class="col-md-12">                    
                   
                            <!-- Options -->
                            <div class="options-container">
                                <label class="form-label">Options</label>
                                <div class="option-item input-group mb-2">
                                    <input type="text" class="form-control" name="questions[0][options][]" placeholder="Enter option">
                                    <button type="button" class="btn btn-outline-danger remove-option ml-3">X</button>
                                </div>
                            </div>
                        
                            <button type="button" class="btn btn-link add-option font-weight-bold">+ Add Option</button>
                        
                   
                    </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-outline-primary mt-2 font-weight-bold" id="add-question">+ Add Question</button>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-3 px-lg-5">Save Poll</button>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
$(document).ready(function () {
    let questionIndex = 0;

    // Add Question
    $("#add-question").click(function () {
        questionIndex++;
        let questionHtml = `
        <div class="question-block">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0 font-weight-bold">Question ${questionIndex + 1}</h6>
                <button type="button" class="btn btn-sm btn-danger remove-question">Remove</button>
            </div>
            
            <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label">Question Type</label>
                <select class="form-select question-type form-control" name="questions[${questionIndex}][type]">
                    <option value="text">Text</option>
                    <option value="image">Image</option>
                </select>
            </div>

            <div class="mb-3 question-text col-md-6">
                <label class="form-label">Question Text</label>
                <input type="text" class="form-control" name="questions[${questionIndex}][text]" placeholder="Enter your question">
            </div>

            <div class="mb-3 question-image d-none">
                <label class="form-label">Upload Image</label>
                <input type="file" class="form-control" name="questions[${questionIndex}][image]">
            </div>
            </div>

            <!-- Options -->
            <div class="options-container">
                <label class="form-label">Options</label>
                <div class="option-item input-group mb-2">
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Enter option">
                    <button type="button" class="btn btn-outline-danger remove-option ml-3">X</button>
                </div>
            </div>
            <button type="button" class="btn btn-link add-option font-weight-bold">+ Add Option</button>
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
        let questionIdx = container.closest(".question-block").index();
        let optionHtml = `
            <div class="option-item input-group mb-2">
                <input type="text" class="form-control" name="questions[${questionIdx}][options][]" placeholder="Enter option">
                <button type="button" class="btn btn-outline-danger remove-option ml-3">X</button>
            </div>`;
        container.append(optionHtml);
    });

    // Remove Option
    $(document).on("click", ".remove-option", function () {
        $(this).closest(".option-item").remove();
    });

    // Toggle Question Type
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
