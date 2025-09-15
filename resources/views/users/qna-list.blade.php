@foreach ($qna_list as $item)
    <span>
        Question : {{$item->question}}
            -> {{$item->answer}}
    </span>
    <hr>

@endforeach