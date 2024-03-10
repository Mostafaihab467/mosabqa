<div class="d-flex flex-lg-row-fluid w-lg-25 bgi-size-cover bgi-position-center"
     style="background-image: url({{asset('assets/media/misc/auth-bg.png')}})">
    <!--begin::Content-->
    <div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
        <!--begin::Logo-->
        <a href="/" class="mb-0 mb-lg-20">
            <img alt="Logo" src="{{asset('logo.png')}}" class="w-100"/>
        </a>
        <!--end::Logo-->
       {{-- <!--begin::Image-->
        <img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20"
             src="{{asset('assets/media/misc/auth-screens.png')}}" alt=""/>
        <!--end::Image-->--}}
        <!--begin::Title-->
        <h1 class="d-none d-lg-block text-white fs-2qx fw-bold text-center mb-7">
            {{__('admin.Login title')}}
        </h1>
        <!--end::Title-->
    </div>
    <!--end::Content-->
</div>
