<!--begin::Repeater-->
<div id="answers">
    <!--begin::Form group-->
    <div class="form-group">
        <div data-repeater-list="answers">
            @if(isset($selectedItem))
                @foreach($selectedItem->answers as $answer)
                    <div class="mb-5" data-repeater-item>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label">{{__('admin.Answer')}}</label>
                                <textarea name="answer" class="form-control mb-2 mb-md-0"
                                          placeholder="{{__('admin.Answer')}}">{{$answer->answer}}</textarea>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check form-check-custom form-check-solid mt-2 mt-md-11">
                                    <input class="form-check-input" type="checkbox" value="1"
                                           @if($answer->is_correct) checked @endif
                                           name="is_correct"/>
                                    <label class="form-check-label" for="form_checkbox">
                                        {{__('admin.Is Correct' )}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <a href="javascript:" data-repeater-delete
                                   class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                    <i class="fa fa-trash fs-5"></i>
                                    {{__('admin.Delete' )}}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mb-5" data-repeater-item>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="form-label">{{__('admin.Answer')}}</label>
                            <textarea name="answer" class="form-control mb-2 mb-md-0"
                                      placeholder="{{__('admin.Answer')}}"></textarea>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check form-check-custom form-check-solid mt-2 mt-md-11">
                                <input class="form-check-input" type="checkbox" value="1"
                                       name="is_correct"/>
                                <label class="form-check-label" for="form_checkbox">
                                    {{__('admin.Is Correct' )}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <a href="javascript:" data-repeater-delete
                               class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                <i class="fa fa-trash fs-5"></i>
                                {{__('admin.Delete' )}}
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
