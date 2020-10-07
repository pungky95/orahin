<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin:: Global Mandatory Vendors -->
<script src="{{asset('vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/general/popper.js/dist/umd/popper.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/general/bootstrap/dist/js/bootstrap.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/general/moment/min/moment.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/custom/jquery-price-format/jquery.priceformat.min.js')}}"></script>
<script src="{{asset('vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/custom/js/vendors/bootstrap-timepicker.init.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/general/bootstrap-daterangepicker/daterangepicker.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/general/toastr/build/toastr.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/general/sweetalert2/dist/sweetalert2.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/custom/js/vendors/sweetalert2.init.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/general/select2/dist/js/select2.full.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/general/js-cookie/src/js.cookie.js')}}"
        type="text/javascript"></script>
<script src="{{asset('vendors/general/sticky-js/dist/sticky.min.js')}}"
        type="text/javascript"></script>
<!--end:: Global Mandatory Vendors -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{asset('js/scripts.bundle.js')}}" type="text/javascript"></script>
<script>
    $('.price').priceFormat({
        prefix: 'Rp',
        centsLimit: 0,
        centsSeparator: ',',
        thousandsSeparator: '.',
    });

    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }
    // DatePicker
    $('.datepicker').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows
    });

    function logout() {
        swal.fire({
            title: '@lang('Are you sure to sign out?')',
            text: "@lang('Your session will be lost')",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: '@lang('Cancel')',
            confirmButtonText: "@lang('Yes, Sign out now!')"
        }).then(function (result) {
            if (result.value) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    function updateStatus(url, text = 'Update status') {
        swal.fire({
            title: "@lang('Are you sure?')",
            text: text,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: '@lang('Cancel')',
            confirmButtonText: "@lang('Yes, do it!')"
        }).then(function (result) {
            if (result.value) {
                $("#update-form").attr('action', url);
                document.getElementById('update-form').submit();
            }
        });
    }

    function remove(url) {
        swal.fire({
            title: '@lang('Are you sure?')',
            text: "@lang('You be unable to revert this!')",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: '@lang('Cancel')',
            confirmButtonText: '@lang('Yes, delete it!')'
        }).then(function (result) {
            if (result.value) {
                $("#destroy-form").attr('action', url);
                document.getElementById('destroy-form').submit();
            }
        });
    }

    @if(session('success-sweetalert'))
    swal.fire(
        "Success!",
        "{{ session('success-sweetalert') }}",
        "success"
    );
    @elseif(session('error-sweetalert'))
    swal.fire(
        "Error!",
        "{{ session('error-sweetalert') }}",
        "error"
    );
    @elseif(session('warning-sweetalert'))
    swal.fire(
        "Warning!",
        "{{ session('warning-sweetalert') }}",
        "warning"
    );
    @endif

    @if(session('success'))
    toastr.success("{{ session('success') }}");
    @elseif(session('error'))
    toastr.error("{{ session('error') }}");
    @elseif(session('warning'))
    toastr.warning("{{ session('warning') }}");

    @endif

    function getDetail(url) {
        $.get(url,
            function (result) {
                $('#detail').html(result);
                $('#modal').modal('show');
            });
    }
</script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="{{asset('vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
@yield('js')
<!--end::Page Vendors -->
