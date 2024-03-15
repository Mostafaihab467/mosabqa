<!--begin::Repeater-->
<div id="repeater">
    <!--begin::Form group-->
    <div class="form-group">
        <div data-repeater-list="repeater">
            @if(isset($selectedCategories) && $selectedCategories->count() > 0)
                @foreach($selectedCategories as $selectedCategory)
                    <div class="mb-5" data-repeater-item>
                        <div class="form-group row">
                            <div class="mb-5 col-md-6">
                                <label for="child" class="form-label">{{__('admin.Category')}}</label>
                                <select class="form-select form-select-solid"  name="child"
                                        required>
                                    <option value="">{{__('admin.Select Category')}}</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                                @if($selectedCategory->child == $category->id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('child')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-2">
                                <label class="form-label" for="questionsNo">{{__('admin.No of questions')}}</label>
                                <input type="number" class="form-control @error('question'){{'is-invalid'}}@enderror"
                                       name="questionsNo"
                                       value="{{old('questionsNo', $selectedCategory->no_of_questions)}}">
                                @error('questionsNo')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <a href="javascript:;" data-repeater-delete
                                   class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                    <i class="fa fa-trash fs-5"></i>
                                    {{__('admin.Delete')}}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mb-5" data-repeater-item>
                    <div class="form-group row">
                        <div class="mb-5 col-md-6">
                            <label for="child" class="form-label">{{__('admin.Category')}}</label>
                            <select class="form-select form-select-solid" name="child"
                                    required>
                                <option value="">{{__('admin.Select Category')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('child')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-5 col-md-2">
                            <label class="form-label" for="questionsNo">{{__('admin.No of questions')}}</label>
                            <input type="number" class="form-control @error('question'){{'is-invalid'}}@enderror"
                                   name="questionsNo"
                                   value="{{old('questionsNo')}}">
                            @error('questionsNo')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <a href="javascript:;" data-repeater-delete
                               class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                <i class="fa fa-trash fs-5"></i>
                                {{__('admin.Delete')}}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group mt-5">
        <a href="javascript:" data-repeater-create class="btn btn-light-primary">
            <i class="fa fa-plus fs-3"></i>
            {{__('admin.Add')}}
        </a>
    </div>
    <!--end::Form group-->
</div>
<!--end::Repeater-->
