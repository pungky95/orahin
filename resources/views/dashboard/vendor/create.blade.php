@extends('dashboard.layouts.main')
@section('title',__('Vendor'))
@section('subheader_title',__('Dashboard'))
@section('Customer Management','kt-menu__item--open')
@section('Vendor','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('vendor.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link">
        @lang('Vendor List')</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{route('vendor.create')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Create Vendor')</a>
@endsection
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-plus"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    @lang('Create Vendor')
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{route('vendor.index')}}" class="btn btn-warning btn-elevate btn-icon-sm">
                            <i class="la la-angle-left"></i>
                            @lang('Back Vendor List')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('vendor.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="kt-portlet__body">
                @include('dashboard.vendor.form',['formMode' => 'create'])
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                </div>
            </div>
        </form>
    </div>
@endsection
