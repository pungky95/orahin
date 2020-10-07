<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="description" content="Login {{ config('app.name', 'Laravel') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700", "Exo+2:300,400,500,600,700,800"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{asset('back/css/pages/general/login/login-6.min.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('back/vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('back/css/style.bundle.min.css') }}" rel="stylesheet" type="text/css"/>

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ asset('back/css/skins/header/base/light.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('back/css/skins/header/menu/light.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('back/css/skins/brand/dark.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('back/css/skins/aside/dark.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet" type="text/css"/>

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}"/>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v6 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile auth-page">
            <div class="kt-grid__item  kt-grid__item--order-tablet-and-mobile-2  kt-grid kt-grid--hor kt-login__aside">
                <div class="kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__body">
                            <div class="text-center mb-5">
                                <a href="javascript:;">
                                    <img src="{{ asset('img/ppproperti-logo.png') }}" class="w-50 img-fluid">
                                </a>
                            </div>
                            <div class="kt-login__logo">
                                <a href="{{ url('/') }}">
                                    <img src="{{ asset('img/westown-logo-full.png') }}" class="w-50 img-fluid">
                                </a>
                            </div>
                            @yield('content')
                        </div>
                        <div class="kt-login__footer d-none d-md-block">
                            <div class="text-center">
                                <a href="https://play.google.com/store/apps/details?id=com.CassanaVertex.WestownView"
                                   target="_blank">
                                    <img src="{{ asset('img/playstore-logo-with-barcode.png') }}"
                                         class="w-75 img-fluid">
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="kt-login__account">
                        <span class="kt-login__account-msg">
                            Don't have an account yet ?
                        </span>&nbsp;&nbsp;
                        <a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>
                    </div> --}}
                </div>
            </div>
            <div class="kt-grid__item kt-grid__item--fluid kt-grid__item--center kt-grid kt-grid--ver kt-login__content">
                <div class="kt-login__section">
                    <div class="kt-login__block mx-5">
                        <h3 class="kt-login__title">
                            Welcome,
                            <br/>to {{config('app.name')}} Admin Dashboard
                        </h3>
                        <div class="kt-login__desc">
                            Please login to start your session
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->

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

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('back/vendors/global/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/js/scripts.bundle.min.js') }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('back/js/pages/login/login-general.js') }}" type="text/javascript"></script>

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>