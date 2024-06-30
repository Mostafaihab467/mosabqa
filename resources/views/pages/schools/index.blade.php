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
                        @include('pages.schools.includes.table')
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
            $('#schoolsTable').dataTable({
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
    <script>
        function deleteItem(elem, id) {
            elem.addEventListener('click', e =>{
                e.preventDefault();

                Swal.fire({
                    html: `{{__('admin.Are you sure you want to delete this item?')}}`,
                    icon: "warning",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "{{__('admin.Yes, delete it')}}",
                    cancelButtonText: '{{__('admin.No, cancel')}}',
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{route('schools.destroy', '')}}/" + id,
                            type: 'DELETE',
                            data: {
                                _token: "{{csrf_token()}}"
                            },
                            success: function (data) {
                                if (data.success) {
                                    $('#school_' + id).remove();
                                    Swal.fire({
                                        icon: "success",
                                        text: data.message,
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        text: data.message,
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                }
                            },
                            error: function (data) {
                                Swal.fire({
                                    icon: "error",
                                    text: data.responseJSON.message,
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                            }
                        });
                    }
                });
            });
        }
    </script>
@endsection
