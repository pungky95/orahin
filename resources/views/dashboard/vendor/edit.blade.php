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
    <a href="{{route('vendor.edit',['id' => $vendor->id])}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Vendor Edit')</a>
@endsection
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-edit-1"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    @lang('Edit Vendor')
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
        <form action="{{route('vendor.update',['id' => $vendor->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="kt-portlet__body">
                @include('dashboard.vendor.form',['formMode' => 'edit'])
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                </div>
            </div>
        </form>
    </div>
@endsection
