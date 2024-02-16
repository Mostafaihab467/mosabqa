<div class="container-fluid mt-5">
    @session('errors')
    <!--begin::Alert-->
    <div class="alert alert-dismissible alert-danger d-flex flex-column flex-sm-row p-5 mb-10">
        <!--begin::Icon-->
        <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span
                class="path2"></span></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <!--begin::Title-->
            <h4 class="mb-2 light">{{session('error') ?? __('admin.Whoops! Something went wrong.')}}</h4>
            <!--end::Title-->
            <!--begin::Content-->
            <span>
                @foreach($errors->all() as $error)
                    <span>{{$error}}</span>
                @endforeach
            </span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Close-->
        <button type="button"
                class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                data-bs-dismiss="alert">
            <i class="fa fa-times fs-1 text-light"></i>
        </button>
        <!--end::Close-->
    </div>
    <!--end::Alert-->
    @endsession

    @if(session('success'))
        <!--begin::Alert-->
        <div class="alert alert-dismissible alert-success d-flex flex-column flex-sm-row p-5 mb-10">
            <!--begin::Icon-->
            <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span
                    class="path2"></span></i>
            <!--end::Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column justify-content-center text-light pe-0 pe-sm-10">
                <!--begin::Title-->
                <h4 class="light">{{session('success')}}</h4>
                <!--end::Title-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Close-->
            <button type="button"
                    class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                    data-bs-dismiss="alert">
                <i class="fa fa-times fs-1 text-light"></i>
            </button>
            <!--end::Close-->
        </div>
        <!--end::Alert-->
    @endif
    @if(session('error') && !session('errors'))
        <!--begin::Alert-->
        <div class="alert alert-dismissible alert-danger d-flex flex-column flex-sm-row p-5 mb-10">
            <!--begin::Icon-->
            <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span
                    class="path2"></span></i>
            <!--end::Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column justify-content-center text-light pe-0 pe-sm-10">
                <!--begin::Title-->
                <h4 class="light">{{session('error')}}</h4>
                <!--end::Title-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Close-->
            <button type="button"
                    class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                    data-bs-dismiss="alert">
                <i class="fa fa-times fs-1 text-light"></i>
            </button>
            <!--end::Close-->
        </div>
        <!--end::Alert-->
    @endif
</div>
