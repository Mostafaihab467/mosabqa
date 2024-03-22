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
                            action="@if(isset($selectedItem)){{route('categories.update', @$selectedItem->id)}}@else{{route('categories.store')}}@endif"
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
                            <div class="d-flex">
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
                                <div class="mb-5 col-md-6">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="appear" value="1"
                                               id="appear"
                                               @if(@$selectedItem->appear)checked="checked"@endif/>
                                        <label class="form-check-label" for="appear">
                                            {{__('admin.Appear on register page')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                @include('pages.categories.includes.repeater')
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
                            <a href="{{route('categories.index')}}" class="btn btn-secondary">{{__('admin.cancel')}}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content wrapper-->
    </div>
@endsection
@section('pageScripts')
    <script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    <script>
        $(document).ready(function () {
            console.log('ready')
            $('#repeater').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo',
                    'textarea-input': 'bar',
                },

                show: function () {
                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        });
    </script>

@endsection
