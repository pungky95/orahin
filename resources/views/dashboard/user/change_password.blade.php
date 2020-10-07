@extends('dashboard.layouts.main')
@section('title',__('Change Password'))
@section('subheader_title',__('Dashboard'))
@section('Change Password','kt-widget__item--active')
@section('breadcrumb')
    <a href="{{route('change-password')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Change Password') </a>
@endsection
@section('content')
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>

        <!--End:: App Aside Mobile Toggle-->

        <!--Begin:: App Aside-->
    @include('dashboard.user.layouts.aside')

    <!--End:: App Aside-->

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">@lang('Change Password')
                                    <small>Change Password</small>
                                </h3>
                            </div>
                        </div>
                        <form class="kt-form kt-form--label-right" method="POST" action="{{route('change-password')}}">
                            @csrf
                            @method('patch')
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">@lang('Change Your Password')
                                                    :</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">@lang('Current Password')</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="password" class="form-control"
                                                       placeholder="@lang('Current password')" name="current_password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">@lang('New Password')</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="password" class="form-control"
                                                       placeholder="@lang('New password')" name="new_password">
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">@lang('Verify Password')</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="password" class="form-control"
                                                       placeholder="@lang('Verify password')"
                                                       name="new_password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div class="col-lg-9 col-xl-9">
                                            <button type="submit"
                                                    class="btn btn-brand btn-bold">@lang('Change Password')
                                            </button>&nbsp;
                                            <button type="reset" class="btn btn-secondary">@lang('Cancel')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--End:: App Content-->
    </div>
@endsection
