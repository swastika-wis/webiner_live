@foreach ($qna_list as $item)
<div class="qa-section">
    <!-- Question -->
    <div class="qa-item">
        <div class="qa-icon">
            <i class="fas fa-question"></i>
        </div>
        <div class="qa-question">
            {{$item->question}}
        </div>
    </div>

    <!-- Answer -->
    <div class="qa-item">
        <div class="qa-icon bg-success">
            <i class="fas fa-font"></i>
        </div>
        <div class="qa-answer">
            {{$item->answer}}
        </div>
    </div>

</div>


@endforeach