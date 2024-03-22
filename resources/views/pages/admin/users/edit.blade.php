@extends('main.master.master')
@section('pageContent')
    @php
        $successPercentage = \App\Models\Lookup::where('name', 'success_percentage')->first()->value;
    @endphp
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            @include('main.master.includes.toolbar')
            <div class="app-container container-fluid">
                <!--begin::table-->
                <div class="card">
                    <div class="card-body">
                        <div>
                            @role('super-admin|admin')
                            <div class="row">
                                <div class="mb-5 col-md-6">
                                    <label for="name" class="form-label">{{__('admin.Name')}}</label>
                                    <input type="text" class="form-control"
                                           id="name" disabled
                                           value="{{@$selectedItem->name}}">
                                </div>
                                <div class="mb-5 col-md-6">
                                    <label for="category" class="form-label">{{__('admin.Category')}}</label>
                                    <input type="text" class="form-control"
                                           id="category" disabled
                                           value="{{@$selectedItem->category->name}}">
                                </div>
                                <div class="mb-5 col-md-6">
                                    <label for="gender" class="form-label">{{__('admin.Gender')}}</label>
                                    <input type="text" class="form-control"
                                           id="gender" disabled
                                           value="{{@$selectedItem->gender}}">
                                </div>
                                <div class="mb-5 col-md-6">
                                    <label for="birth_date" class="form-label">{{__('admin.Birth date')}}</label>
                                    <input type="text" class="form-control"
                                           id="birth_date" disabled
                                           value="{{@$selectedItem->birth_date}}">
                                </div>
                                <div class="mb-5 col-md-6">
                                    <label for="role" class="form-label">{{__('admin.Role')}}</label>
                                    <input type="text" class="form-control"
                                           id="role" disabled
                                           value="{{@$selectedItem->role}}">
                                </div>
                                <div class="mb-5 col-md-6">
                                    <label for="degree" class="form-label">{{__('admin.Degree')}}</label>
                                    <input type="text"
                                           class="pe-none form-control {{is_numeric($selectedItem->degree) && $selectedItem->degree >= $successPercentage ? 'is-valid' : 'is-invalid'}}"
                                           id="degree"
                                           value="{{@$selectedItem->degree}} %">
                                    @if(is_numeric($selectedItem->degree) && $selectedItem->degree >= $successPercentage)
                                        <h2 class="valid-feedback">{{__('admin.Pass')}}</h2>
                                    @else
                                        <h2 class="invalid-feedback">{{__('admin.Fail')}}</h2>
                                    @endif
                                </div>
                            </div>
                            @else
                                <div class="mb-5 col-md-6">
                                    <label for="degree" class="form-label">{{__('admin.Degree')}}</label>
                                    <input type="text"
                                           class="pe-none form-control {{is_numeric($selectedItem->degree) && $selectedItem->degree >= $successPercentage ? 'is-valid' : 'is-invalid'}}"
                                           id="degree"
                                           value="{{@$selectedItem->degree}} %">
                                    @if(is_numeric($selectedItem->degree) && $selectedItem->degree >= $successPercentage)
                                        <h2 class="valid-feedback">{{__('admin.Pass')}}</h2>
                                    @else
                                        <h2 class="invalid-feedback">{{__('admin.Fail')}}</h2>
                                    @endif
                                </div>
                            @endrole
                            <hr>
                            <div class="table-responsive">
                                <table id="usersQuestionsTable"
                                       class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                                    <thead>
                                    <tr class="fw-semibold fs-6 text-gray-800">
                                        <th>{{__('admin.Question')}}</th>
                                        <th>{{__('admin.Category')}}</th>
                                        <th>{{__('admin.User answer')}}</th>
                                        <th>{{__('admin.Right answer')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($selectedItem->userQuestionAnswers as $item)
                                        <tr>
                                            <td dir="rtl">{{$item->question->question}}</td>
                                            <td dir="rtl">{{$item->question->name}}</td>
                                            <td dir="rtl" @if(in_array($item->answer_id, $item->question->answers->pluck('id')->toArray())) class="text-success" @else class="text-danger" @endif>
                                                {{@$item->answer->answer ?? '-'}}
                                            </td>
                                            <td dir="rtl">{{@$item->question->answers[0]->answer}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content wrapper-->
    </div>
@endsection
