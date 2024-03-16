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
                            action="@if(isset($selectedItem)){{route('questions.update', @$selectedItem->id)}}@else{{route('questions.store')}}@endif"
                            method="post">
                            @csrf
                            @if(isset($selectedItem))
                                @method('put')
                            @endif
                            <div class="row">
                                <div class="mb-5 col-md-6">
                                    <label for="category_id" class="form-label">{{__('admin.Category')}}</label>
                                    <select class="form-select" data-control="select2"
                                            data-placeholder="{{__('admin.Select Category')}}" name="category_id"
                                            id="category_id" required>
                                        <option value=""></option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                    @if(old('category_id', @$selectedItem->category_id) == $category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-5 col-md-6">
                                    <label for="question_category_id" class="form-label">{{__('admin.Multi Categories')}}</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                            data-placeholder="{{__('admin.Select Category')}}" data-allow-clear="true" multiple="multiple" name="question_category[]"
                                            id="question_category_id">
                                        <option value=""></option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                    @if(in_array($category->id, $selectedCategories)) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('question_category_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-5 col-md-6">
                                    <label for="question" class="form-label">{{__('admin.Question')}}</label>
                                    <input type="text" class="form-control @error('question'){{'is-invalid'}}@enderror"
                                           id="question" name="question"
                                           value="{{old('question', @$selectedItem->question)}}">
                                    @error('question')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-5 col-md-6">
                                    <label for="name" class="form-label">{{__('admin.sora')}}</label>
                                    <input type="text" class="form-control @error('name'){{'is-invalid'}}@enderror"
                                           id="question" name="name"
                                           value="{{old('name', @$selectedItem->name)}}">
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-5">
                                @include('pages.questions.includes.repeater')
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
                            <a href="{{route('questions.index')}}" class="btn btn-secondary">{{__('admin.cancel')}}</a>
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
            $('#answers').repeater({
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
