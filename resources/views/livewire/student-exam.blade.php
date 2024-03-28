@php use App\Models\UserQuestionAnswers; @endphp
<div>
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            @if($question && $startExam)
                @include('main.master.includes.toolbar')
            @endif
            <div class="app-container container-fluid">
                <!--begin::table-->
                <div class="card">
                    <div class="card-body">
                        @if($question && $startExam)
                            <form wire:submit="nextQuestion">
                                <div class="row">
                                    <div class="mb-5 col-md-12">
                                        <h1 dir="rtl">{{@$question->question}}</h1>
                                        <input type="hidden" name="question_id" value="{{$question->id}}"
                                               wire:model="question_id"/>
                                    </div>
                                    <hr>
                                    @foreach($question->answers as $answer)
                                        <div class="mb-5 col-md-12">
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input dir="rtl" class="form-check-input" type="radio" name="answer_id"
                                                       wire:model="answer_id"
                                                       value="{{$answer->id}}" id="answer{{$answer->id}}"/>
                                                <label dir="rtl" class="form-check-label fs-1"
                                                       for="answer{{$answer->id}}">
                                                    {{$answer->answer}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="mb-5 col-md-12">
                                        <button wire:loading.attr="disabled" type="submit" id="submitBtn"
                                                class="btn btn-primary">
                                            <span wire:loading>
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </span>
                                            <span wire:loading.remove>
                                                {{__('admin.Next')}}
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="row">
                                <div class="mb-5 col-md-12">
                                    <h1>{!!$msg!!}</h1>
                                    @php
                                        $checkExtraQuestion = UserQuestionAnswers::query()->where('user_id', Auth::id())
                                        ->where('category_id', \App\Models\Category::where('name', env('EXTRA_CATEGORY'))->first()->id)->first();
                                    @endphp
                                    @if(!$checkExtraQuestion && \App\Models\Lookup:: where('name', 'exam_start_date')->first()->value <= now())
                                        <div class="fs-1">
                                            {{__('admin.Start extra exam')}} {{env('EXTRA_CATEGORY')}}
                                            <a class="btn btn-primary"
                                               href="{{route('student.questions', ['category_id' => \App\Models\Category::where('name', env('EXTRA_CATEGORY'))->first()->id])}}">{{__('admin.Start test')}}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('pageScripts')
    @script
    <script>
        $(document).ready(function () {
            document.addEventListener('contentChanged', function (e) {
                for (i = 0; i < 10000; i++) {
                    window.clearInterval(i);
                }
                timerFunction(e.detail)
            });
        });
        timerFunction({{$timer}})

        function timerFunction(count) {
            var intervalx = setInterval(function () {
                count--;
                // $wire.decreaseTimer();

                if (count >= 0) {
                    $("#timer").text(count);
                } else {
                    clearInterval(intervalx);
                    $("#timer").text("0");
                }
                if (count === 0) {
                    document.getElementById('submitBtn').click();
                }
            }, 1000);
        }


        $(document).on("keydown", function (event) {
            // Check if the pressed key is F5 (keyCode 116) and prevent its default action
            if (event.keyCode === 116) {
                event.preventDefault();
            }
            if (event.ctrlKey && event.keyCode === 82) {
                event.preventDefault();
            }

            // disable ctrl+shift+r
            if (event.ctrlKey && event.shiftKey && event.keyCode === 82) {
                event.preventDefault();
            }
        });
    </script>
    @endscript
@endsection
