@foreach($polls as $poll)
    <h5 class="m-0 font-weight-bold text-theme"> {{ $poll->title }}</h5>

    <form>
        @csrf
        <input type="hidden" name="participant_id" value="{{ session('webuser')->id }}">
        <input type="hidden" name="poll_id" value="{{ $poll->id }}">

        @foreach($poll->questions as $question)
            <h4 class="mt-3">{{ $question->question_text }}</h4>
            <input type="hidden" name="questions[{{ $question->id }}][question_id]" value="{{ $question->id }}">

            @foreach($question->options as $option)
                <div class="form-check">
                    <input type="radio"
                           class="form-check-input"
                           id="option_{{ $option->id }}"
                           name="questions[{{ $question->id }}][option_id]"
                           value="{{ $option->id }}">
                    <label class="form-check-label" for="option_{{ $option->id }}">
                        {{ $option->option_text }}
                    </label>
                </div>
            @endforeach
        @endforeach

        <button type="submit" class="btn btn-success mt-3">Save</button>
    </form>
@endforeach
