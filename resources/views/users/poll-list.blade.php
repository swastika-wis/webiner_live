<h5 class="m-0 font-weight-bold text-theme">Polls k</h5>
<form id="user_poll">
    @csrf
    <input type="hidden" value="{{ session('webuser')->id }}" name="participant_id">

    @foreach($meeting_polls as $poll)
        <h4 class="mt-3">{{ $poll->question }}</h4>

        @foreach($poll->options as $option)
            <div>
                <input type="radio" name="poll_option_{{ $poll->id }}" value="{{ $option->id }}">
                {{ $option->option }}
            </div>
        @endforeach
    @endforeach

    <button type="submit" class="btn btn-success mt-3">Save</button>
</form>
