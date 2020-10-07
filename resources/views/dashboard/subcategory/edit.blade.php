@extends('dashboard.layouts.main')
@section('title',__('Sub-Subcategory'))
@section('subheader_title',__('Dashboard'))
@section('Category Management','kt-menu__item--open')
@section('Sub-Subcategory','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('subcategory.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link">
        @lang('Sub-Subcategory List')</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{route('subcategory.edit',['id' => $subcategory->id])}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Sub-Subcategory Edit')</a>
@endsection
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-edit-1"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    @lang('Edit Sub-Subcategory')
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{route('subcategory.index')}}" class="btn btn-warning btn-elevate btn-icon-sm">
                            <i class="la la-angle-left"></i>
                            @lang('Back Sub-Subcategory List')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('subcategory.update',['id' => $subcategory->id])}}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="kt-portlet__body">
                @include('dashboard.subcategory.form',['formMode' => 'edit'])
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                </div>
            </div>
        </form>
    </div>
@endsection
