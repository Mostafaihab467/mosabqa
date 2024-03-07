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
                            action="@if(isset($selectedItem)){{route('lookups.update', @$selectedItem->id)}}@endif"
                            method="post">
                            @csrf
                            @if(isset($selectedItem))
                                @method('put')
                            @endif
                            <div class="row">
                                <div class="mb-5 col-md-6">
                                    <label for="name" class="form-label">{{__('admin.Name')}}</label>
                                    <input type="text" class="form-control @error('name'){{'is-invalid'}}@enderror"
                                           id="name" name="name" readonly
                                           value="{{old('name', @$selectedItem->name)}}">
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div
                                    class="mb-5 col-md-6 @if(str_contains($selectedItem->name, 'date')){{'datePicker'}}@endif">
                                    <label for="value" class="form-label">{{__('admin.Value')}}</label>
                                    <input type="text" class="form-control @error('value'){{'is-invalid'}}@enderror"
                                           id="value" name="value"
                                           value="{{old('value', @$selectedItem->value)}}">
                                    @error('value')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-5 col-md-6">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="record_state" value="1"
                                               id="flexSwitchChecked"
                                               @if(@$selectedItem->record_state)checked="checked"@endif/>
                                        <label class="form-check-label" for="flexSwitchChecked">
                                            {{__('admin.Status')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
                            <a href="{{route('lookups.index')}}" class="btn btn-secondary">{{__('admin.cancel')}}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content wrapper-->
    </div>
@endsection
@section('pageScripts')
    <script>
        $(document).ready(function () {
            $(".datePicker input[name='value']").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
        });
    </script>

@endsection
