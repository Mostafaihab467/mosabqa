<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale()=='ar' ? 'rtl' : 'ltr'}}"
      direction="{{app()->getLocale()=='ar' ? 'rtl' : 'ltr'}}"
      style="direction: {{app()->getLocale()=='ar' ? 'rtl' : 'ltr'}};">
<!--begin::Head-->
<head>
    <title></title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used by this page)-->
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
    <!--end::Vendor Stylesheets-->

    @if(app()->getLocale() == 'ar')
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{asset('assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>
        <!--end::Global Stylesheets Bundle-->
    @else
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
        <!--end::Global Stylesheets Bundle-->
    @endif

    @yield('pageScriptHead')

    @yield('pageCsCode')
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
      data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
      data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
      data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
<!--begin::Theme mode setup on page load-->
@include('main.auth.includes.head-scripts')
<!--end::Theme mode setup on page load-->
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        @include('main.master.includes.header')


        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            @include('main.master.includes.aside')
            <!--begin::Main-->
            @include('layouts.alert')
            @yield('pageContent')
            <!--end::Main-->
        </div>
    </div>
    <!--end::Page-->
</div>
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used by this page)-->
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used by this page)-->
<script src="{{asset('assets/js/custom/account/settings/signin-methods.js')}}"></script>
<script src="{{asset('assets/js/custom/account/settings/profile-details.js')}}"></script>
<script src="{{asset('assets/js/custom/account/settings/deactivate-account.js')}}"></script>
<script src="{{asset('assets/js/custom/pages/user-profile/general.js')}}"></script>
<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/create-campaign.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/two-factor-authentication.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
<script type="text/javascript">
    function ajaxSubmit($url, $div, $type = "POST", $V = null) {

        document.getElementById($div).innerHTML = "<div class='d-flex justify-content-center'><div class='spinner-border'><span class='sr-only'>Loading...</span></div></div>";

        $.ajax({
            type: $type,
            url: $url,
            success: function (data) {
                document.getElementById($div).style.display = "block";

                if ($V == 1) {
                    document.getElementById($div).value = data;
                } else {
                    document.getElementById($div).innerHTML = data;
                }
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
            complete: function (data) {
                // console.log(data);
            }
        });
    }

    function ajaxFormSubmit($url, $type = "POST", $formData = null) {

        $.ajax({
            url: $url,
            type: $type,
            dataType: "JSON",
            headers: {"X-CSRF-TOKEN": "{{csrf_token()}}"},
            data: $formData,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            }
        });
    }

    function jsUcfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

</script>
@yield('pageScripts')
</body>
<!--end::Body-->
</html>
