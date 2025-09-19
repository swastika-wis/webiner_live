@foreach($polls as $index => $poll)
    {{-- Poll Wrapper --}}
    <div class="poll-wrapper" style="{{ $index > 0 ? 'display:none;' : '' }}">

        <p class="m-0 text-theme title-header">{{ $poll->title }}</p>

        <div id="poll_box">
        <!-- <form id="user_poll_form">
            @csrf
            <input type="hidden" name="participant_id" value="{{ session('webuser')->id }}">
            <input type="hidden" name="poll_id" value="{{ $poll->id }}">

            @foreach($poll->questions as $question)
                @if($question->question_type == "text")
                    <h4 class="mt-3 qs-name">{{ $question->question_text }}</h4>
                @else 
                    <img src="{{ asset('/storage/app/public/' . $question->question_image) }}" 
                         style="height:100px" alt="Question Image" class="img-fluid">
                @endif

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

            <button type="submit" class="btn btn-success mt-3" onclick="submitRecord()">Save</button>
        </form> -->
         
         <form id="user_poll_form">
          @csrf
            <input type="hidden" name="participant_id" value="{{ session('webuser')->id }}">
            <input type="hidden" name="poll_id" value="{{ $poll->id }}">

            @foreach($poll->questions as $question)
                <!-- Step 1 -->
                <div class="wizard-step @if($loop->iteration==1) active @endif " id="step{{$loop->iteration}}">
                  <h5 class="qs-name">Question {{$loop->iteration}}: 
                    @if($question->question_type == "text")
                    {{ $question->question_text }}</h5>
                @else 
                  </h5><img src="{{ asset('/storage/app/public/' . $question->question_image) }}" 
                         style="height:100px" alt="Question Image" class="img-fluid">
                @endif

                <input type="hidden" name="questions[{{ $question->id }}][question_id]" value="{{ $question->id }}">
                  @foreach($question->options as $option)
                    <div class="form-check mt-3">
                      <input type="radio"
                               class="form-check-input"
                               id="option_{{ $option->id }}"
                               name="questions[{{ $question->id }}][option_id]"
                               value="{{ $option->id }}">
                        <label class="form-check-label" for="option_{{ $option->id }}">
                            {{ $option->option_text }}

                    </div>
                  
                  @endforeach

                  <button type="button" class="btn btn-primary mt-3 nextBtn">Next</button>
              </div>
              
            @endforeach
            
          <!-- Step 2 -->
        <!-- <div class="wizard-step" id="step2">
          <h5 class="qs-name">Question 2: What is your favorite animal?</h5>
          <div class="form-check mt-3">
            <input class="form-check-input" type="radio" name="q2" id="q2a" value="Cat" required>
            <label class="form-check-label" for="q2a">Cat</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q2" id="q2b" value="Dog" required>
            <label class="form-check-label" for="q2b">Dog</label>
          </div>
          <button type="button" class="btn btn-secondary mt-3 prevBtn">Back</button>
          <button type="button" class="btn btn-primary mt-3 nextBtn">Next</button>
        </div> -->

      <!-- Step 3 -->
      <!-- <div class="wizard-step" id="step3">
        <h5 class="qs-name">Question 3: Which season do you prefer?</h5>
        <div class="form-check mt-3">
          <input class="form-check-input" type="radio" name="q3" id="q3a" value="Summer" required>
          <label class="form-check-label" for="q3a">Summer</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="q3" id="q3b" value="Winter" required>
          <label class="form-check-label" for="q3b">Winter</label>
        </div>
        <button type="button" class="btn btn-secondary mt-3 prevBtn">Back</button>
        <button type="button" class="btn btn-primary mt-3 nextBtn">Next</button>
      </div> -->

      <!-- Final Step -->
      <div class="wizard-step" id="step4">
        <h5 class="qs-name">Review & Submit</h5>
        <p class="mt-3">Thank you for answering the poll. Click submit to finish.</p>
        <button type="button" class="btn btn-secondary mt-3 prevBtn">Back</button>
        <button type="submit" class="btn btn-success mt-3" onclick="submitRecord()">Submit</button>
      </div>
    </form>
        </div>
    </div>
@endforeach

<script>
    $(document).ready(function () {
      let currentStep = 1;
      const totalSteps = 4;

      function showStep(step) {
        $(".wizard-step").removeClass("active");
        $("#step" + step).addClass("active");

        $(".step").removeClass("active");
        for (let i = 1; i <= totalSteps; i++) {
          if (i < step) {
            $("#stepCircle" + i).addClass("completed");
          } else {
            $("#stepCircle" + i).removeClass("completed");
          }
        }
        $("#stepCircle" + step).addClass("active");
      }

      $(".nextBtn").click(function () {
        // validate current step radios
        const currentForm = $("#step" + currentStep);
        const radio = currentForm.find("input[type='radio']");
        if (radio.length && !radio.is(":checked")) {
          alert("Please select an option before proceeding.");
          return;
        }
        if (currentStep < totalSteps) {
          currentStep++;
          showStep(currentStep);
        }
      });

      $(".prevBtn").click(function () {
        if (currentStep > 1) {
          currentStep--;
          showStep(currentStep);
        }
      });
    });
  </script>
