@extends('dashboard.layouts.main')
@section('title','Personal Information')
@section('subheader_title','Dashboard')
@section('Personal Information','kt-widget__item--active')
@section('breadcrumb')
    <a href="{{route('personal-information')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Personal Information </a>
@endsection
@section('js')
    <script>
        new KTAvatar("avatar");
    </script>
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
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">Personal Information
                                    <small>Update your personal information</small>
                                </h3>
                            </div>
                        </div>
                        <form class="kt-form kt-form--label-right" method="POST"
                              action="{{route('personal-information')}}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">@lang('User Info')</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">@lang('Avatar')</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-avatar kt-avatar--outline kt-avatar--circle"
                                                     id="avatar">
                                                    <div class="kt-avatar__holder"
                                                         style="background-image: url({{Auth::user()->avatar_url ? Auth::user()->avatar_url : asset('media/users/100_1.jpg')}}); ">
                                                    </div>
                                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title=""
                                                           data-original-title="Change avatar">
                                                        <i class="fa fa-pen"></i>
                                                        <input type="file" name="avatar"
                                                               accept=".png, .jpg, .jpeg">
                                                    </label>
                                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title=""
                                                          data-original-title="Cancel avatar">
                                                        <i class="fa fa-times"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="text"
                                                       value="{{Auth::user()->name ? Auth::user()->name : old('name')}}"
                                                       name="name">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Contact Info</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="la la-at"></i></span></div>
                                                    <input type="text" class="form-control"
                                                           value="{{Auth::user()->email ? Auth::user()->email : old('email')}}"
                                                           placeholder="Email" aria-describedby="basic-addon1"
                                                           name="email">
                                                </div>
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
                                            <button type="submit" class="btn btn-success">Submit</button>&nbsp;
                                            <button type="reset" class="btn btn-secondary">Cancel</button>
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
