<div class="form-group">
    <div class="input-group mb-3">
        <select name="type" id="qType" class="form-control" required>
            <option value="">--اختر المستوى--</option>
            <option value="ثلاثة اجزاء">ثلاثة اجزاء</option>
            <option value="ربع القران">ربع القران</option>
            <option value="نصف القران">نصف القران</option>
            <option value="ثلاث ارباع القران">ثلاث ارباع القران</option>
            <option value="القران كاملا">القران كاملا</option>
            <option value="اسأله ثقافيه">اسئله ثقافيه</option>
        </select>
        @error('type')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
        @enderror
    </div>
</div>
<h3 class="text-center">
    {{__('admin.You choose')}} <span id="count">0</span> {{__('admin.From')}} 15
</h3>
<div class="cards row">
    @php($countQuestions =  \App\Models\Question::where('type', 'ربع القران')->count())
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
