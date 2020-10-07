@extends('dashboard.layouts.main')
@section('title',__('Category'))
@section('subheader_title',__('Dashboard'))
@section('Category Management','kt-menu__item--open')
@section('Category','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('category.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link">
        @lang('Category List')</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{route('category.edit',['id' => $category->id])}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Category Edit')</a>
@endsection
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-edit-1"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    @lang('Edit Category')
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{route('category.index')}}" class="btn btn-warning btn-elevate btn-icon-sm">
                            <i class="la la-angle-left"></i>
                            @lang('Back Category List')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('category.update',['id' => $category->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="kt-portlet__body">
                @include('dashboard.category.form',['formMode' => 'edit'])
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                </div>
            </div>
        </form>
    </div>
@endsection
