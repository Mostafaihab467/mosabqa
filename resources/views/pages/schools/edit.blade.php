@extends('main.master.master')
@section('pageContent')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            @include('main.master.includes.toolbar')
            <div class="app-container container-fluid">
                <!--begin::table-->
                <div class="card">
                    <div class="card-body">
                        <form
                            action="@if(isset($selectedItem)){{route('schools.update', @$selectedItem->id)}}@else{{route('schools.store')}}@endif"
                            method="post">
                            @csrf
                            @if(isset($selectedItem))
                                @method('put')
                            @endif
                            <div class="mb-5 col-md-6">
                                <label for="name" class="form-label">{{__('admin.Name')}}</label>
                                <input type="text" class="form-control @error('name'){{'is-invalid'}}@enderror"
                                       id="name" name="name"
                                       value="{{old('name', @$selectedItem->name)}}">
                                @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
                            <a href="{{route('schools.index')}}" class="btn btn-secondary">{{__('admin.cancel')}}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content wrapper-->
    </div>
@endsection
@section('pageScripts')

@endsection
