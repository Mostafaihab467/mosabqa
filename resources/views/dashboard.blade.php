@extends('main.master.master')
@section('pageContent')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            {{--@include('main.master.includes.toolbar', [
    'title' => __('admin.Dashboard'),
     ])--}}
            @php
                $userQuestionsCount = \DB::table('user_question_answers')->where('user_id', Auth::id())->where('category_id', Auth::user()->category_id)->count();
                $answeredQuestionsCount = \DB::table('user_question_answers')->where('user_id', Auth::id())->where('category_id', Auth::user()->category_id)->whereNotNull('is_correct')->count();
                $categories = \DB::table('user_question_answers')->where('user_id', Auth::id())->pluck('category_id')->unique();
            @endphp
            <div class="container-fluid h-100">
                @role('student')
                    @if(\App\Models\Lookup:: where('name', 'exam_start_date')->first()->value > now())
                        <h1 class="text-center d-flex flex-column h-100 align-content-center justify-content-center">
                            <span class="text-danger" style="font-size: 50px;">
                                {{__('admin.The test has not started yet')}}
                            </span>
                        </h1>
                    @else
                        @if($categories->count() <= 1)
                            <a href="{{route('student.questions')}}" class="btn btn-primary">
                                {{__('admin.Start test')}}
                            </a>
                        @else
                            @if(Auth::user()->grade && Auth::user()->grade >= \App\Models\Lookup::where('name', 'success_percentage')->first()->value)
                                <h1>
                                    <span class='text-success'>
                                        {{__('admin.Congratulations, you have passed the exam with grade') . " " . getDgree(auth()->id())}}%
                                    </span>
                                </h1>
                                <h1>
                                    {{__('admin.Your serial number is')}} {{Auth::user()->serial}}
                                </h1>
                            @elseif(is_null(Auth::user()->grade))
                                <h1>
                                    {{__('admin.You have not taken the test yet')}}
                                    <a href="{{route('student.questions')}}" class="btn btn-primary">
                                        {{__('admin.Start test')}}
                                    </a>
                                </h1>
                            @else
                                @if($userQuestionsCount == $answeredQuestionsCount)
                                    <h1 class="text-danger">
                                        {{__('admin.You have failed the test')}}
                                    </h1>
                                    <h1 class="text-danger">
                                        {{__('admin.Your grade is')}} {{Auth::user()->grade}}
                                    </h1>
                                @else
                                <a href="{{route('student.questions')}}" class="btn btn-primary">
                                    {{__('admin.Start test')}}
                                </a>
                                @endif
                            @endif
                    @endif
                @else
                    <h1>
                        {{Auth::user()->roles->first()->name}}
                    </h1>
                @endrole
            </div>
        </div>
        <!--end::Content wrapper-->
    </div>
@endsection
