@extends('main.auth.auth')
@section('pageContent')
    <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
        <!--begin::Form-->
        <div class="d-flex flex-center flex-column flex-lg-row-fluid">
            @include('layouts.alert')
            <!--begin::Wrapper-->
            <div class="w-lg-500px p-10">
                <!--begin::Form-->
                <form class="form w-100" id="kt_sign_in_form"
                      action="{{route('login')}}" method="post">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">{{__('admin.Sign In')}}</h1>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Nid-->
                        <div id="nid-group">
                            <label for="nid">
                                {{__('admin.Nid')}}
                            </label>
                            <input type="text" placeholder="{{__('admin.Nid')}}" name="nid" id="nid" autocomplete="off"
                                   class="form-control bg-transparent" required/>
                            <div class="fv-plugins message-container invalid-feedback"></div>
                        </div>
                        <!--end::Nid-->
                        <input type="hidden" name="email" value="">
                        <input type="hidden" name="password" value="">
                    </div>
                    <!--begin::Submit button-->
                    <div class="d-grid mb-10">
                        <button type="submit" id="sign_in_submit" class="btn btn-primary">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">{{__('admin.Sign In')}}</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">
                            {{__('admin.Please wait')}}...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                    </div>
                    <!--end::Submit button-->
                    <!--begin::Sign up-->
                    <div class="text-gray-500 text-center fw-semibold fs-6">
                        {{__('admin.Dont have an account')}}
                        <a href="{{route('register')}}"
                           class="link-primary">{{__('admin.Sign up')}}</a></div>
                    <!--end::Sign up-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Form-->
        <!--begin::Footer-->
        <div class="d-flex flex-center flex-wrap px-5">
            <!--begin::Links-->
            <div class="d-flex fw-semibold text-primary fs-base">
                <a href="tel:+201067554823" class="px-5" target="_blank">
                    <i class="fa-solid fa-phone" style="color: #3297FF;"></i>
                </a>
                <a href="https://keenthemes.com" class="px-5" target="_blank">
                    <i class="fa-brands fa-facebook-f" style="color: #3297FF;"></i>
                </a>
                <a href="https://mgahed.com/"
                   class="px-5" target="_blank">
                    <i class="fa-solid fa-m" style="color: #3297FF;"></i>
                </a>
            </div>
            <!--end::Links-->
        </div>
        <!--end::Footer-->
    </div>
@endsection

@section('pageScripts')
    <script>
        $(document).ready(function () {
            $('#sign_in_submit').on('click', function () {
                // prevent default action
                // event.preventDefault();
                let submitButton = $(this);
                submitButton.attr('data-kt-indicator', 'on');

                // Disable button to avoid multiple click
                submitButton.attr('disabled', 'disabled');

                let nid = $('input[name="nid"]').val();

                // ajax request to get data by nid
                $.ajax({
                    url: '{{route('auth.get-user-by-nid')}}',
                    type: 'POST',
                    data: {
                        _token: '{{csrf_token()}}',
                        nid: nid
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            $('input[name="email"]').val(response.data.email);
                            $('input[name="password"]').val(nid);
                            $('input[name="nid"]').addClass('is-valid');
                            $('#kt_sign_in_form').submit();
                        } else {
                            // Enable button
                            submitButton.removeAttr('disabled');
                            submitButton.removeAttr('data-kt-indicator');
                            $('input[name="nid"]').addClass('is-invalid');
                            $('#nid-group .invalid-feedback').text(response.message);
                        }
                    },
                    error: function (error) {
                        // Enable button
                        submitButton.removeAttr('disabled');
                        submitButton.removeAttr('data-kt-indicator');
                        $('input[name="nid"]').addClass('is-invalid');
                        console.log(error);
                        $('#nid-group .invalid-feedback').text(error.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endsection
