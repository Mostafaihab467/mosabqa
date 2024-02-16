<div class="card shadow-sm">
    <div class="card-header collapsible cursor-pointer rotate active" data-bs-toggle="collapse"
         data-bs-target="#kt_docs_card_collapsible_details" aria-expanded="true">
        <h3 class="card-title">{{__('admin.Choose Questions')}}</h3>
        <div class="card-toolbar rotate-180">
            <i class="ki-duotone ki-down fs-1"></i>
        </div>
    </div>

    <div class="collapse show" id="kt_docs_card_collapsible_details">
        <div class="card-body">
            <div class="row mb-7">
                <div class="col md-6">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <select name="type" id="qType" class="form-control" required>
                                <option value="">--اختر المستوى--</option>
                                @foreach(\App\Models\Category::where('record_state', App\Enums\RecordState::ACTIVE->value)->get() as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="button" onclick="checkRandom()" class="btn btn-primary disabled" id="randomChoose">
                        {{__('admin.Random choose')}}
                    </button>
                </div>
            </div>
            <h3 class="text-center">
                {{__('admin.You choose')}} <span id="count">0</span> {{__('admin.From')}} 15
            </h3>
            <div class="cards row d-none" id="checkBoxCards">
                @php($countQuestions =  \App\Models\Question::where('category_id', 2)->count())
                @for($i = 0 ; $i < $countQuestions ; $i++)
                    <div class="card col-md-4 col-6">
                        <div class="form-check form-check-custom form-check-solid form-check-lg">
                            <input class="form-check-input" type="checkbox" value="" id="card{{$i}}" name="cards[]"/>
                            <label class="form-check-label" for="card{{$i}}">
                                {{__('admin.Choose')}}
                            </label>
                        </div>
                        <label for="card{{$i}}" class="mt-3">
                            <div class="card-body">
                            </div>
                        </label>
                    </div>
                @endfor

            </div>
        </div>
    </div>

</div>
