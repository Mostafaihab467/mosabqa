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
                        @include('pages.categories.includes.table')
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content wrapper-->
    </div>
@endsection
@section('pageScripts')
    <script>
        $(document).ready(function () {
            $('#categoriesTable').dataTable({
                "language": {
                    "lengthMenu": "{{__('admin.Show')}} _MENU_",
                    "search": "{{__('admin.Search')}}",
                },
                "dom":
                    "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });
        });
    </script>
@endsection
