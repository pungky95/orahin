<!--begin::Base Path (base relative path for assets of this page) -->
<base href="{{asset('back_page')}}">

<!--end::Base Path -->
<meta charset="utf-8"/>
<title>{{config('app.name')}} | @yield('title')</title>
<meta name="description" content="Updates and statistics">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--begin::Fonts -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
    WebFont.load({
        google: {
            "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
        },
        active: function () {
            sessionStorage.fonts = true;
        }
    });
</script>

<!--end::Fonts -->

<!--begin::Page Vendors Styles(used by this page) -->
<link href="{{asset('vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet"
      type="text/css"/>
@yield('css')
<!--end::Page Vendors Styles -->

<!--begin:: Global Mandatory Vendors -->
<link href="{{asset('vendors/general/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet"
      type="text/css"/>
<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<link href="{{asset('vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}"
      rel="stylesheet"
      type="text/css"/>
<link href="{{asset('vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css')}}"
      rel="stylesheet"
      type="text/css"/>
<link href="{{asset('vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css')}}"
      rel="stylesheet"
      type="text/css"/>
<link href="{{asset('vendors/general/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}"
      rel="stylesheet"
      type="text/css"/>
<link href="{{asset('vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/general/summernote/dist/summernote.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('vendors/general/toastr/build/toastr.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/general/sweetalert2/dist/sweetalert2.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('vendors/custom/vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('vendors/custom/vendors/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/custom/vendors/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/general/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('vendors/general/socicon/css/socicon.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>

<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Styles(used by all pages) -->
<link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
<!--end::Global Theme Styles -->

<!--begin::Layout Skins(used by all pages) -->
<link href="{{asset('css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/skins/brand/light.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/skins/aside/dark.css')}}" rel="stylesheet" type="text/css"/>

<!--end::Layout Skins -->
@include('favicon.favicon')
