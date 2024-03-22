@extends('main.master.master')
@section('pageContent')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            {{--@include('main.master.includes.toolbar', [
    'title' => __('admin.Dashboard'),
     ])--}}
            <div class="container-fluid">
                @role('student')
                    @if(Auth::user()->grade && Auth::user()->grade >= \App\Models\Lookup::where('name', 'success_percentage')->first()->value)
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
                        <h1 class="text-danger">
                            {{__('admin.You have failed the test')}}
                        </h1>
                        <h1 class="text-danger">
                            {{__('admin.Your grade is')}} {{Auth::user()->grade}}
                        </h1>
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
