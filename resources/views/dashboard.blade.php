@extends('main.master.master')
@section('pageContent')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            @include('main.master.includes.toolbar', [
    'title' => __('admin.Dashboard'),
     ])
            @role('student')
            <h1>
                Student
            </h1>
            @else
                <h1>
                    {{Auth::user()->roles->first()->name}}
                </h1>
            @endrole
        </div>
        <!--end::Content wrapper-->
    </div>
@endsection
