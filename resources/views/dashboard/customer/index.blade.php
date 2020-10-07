@extends('dashboard.layouts.main')
@section('title',__('Customer'))
@section('subheader_title',__('Dashboard'))
@section('Customer Management','kt-menu__item--open')
@section('Customer','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('customer.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Customer List')</a>
@endsection
@section('js')
    <script>
        const customerList = async () => {
            const table = $('#customerList');
            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: '{{route('customer.list')}}',
                columns: [
                    {name: 'uid', visible: false, orderable: false, searchable: false},
                    {name: 'info'},
                    {name: 'gender'},
                    {name: 'email_verified_badge'},
                    {name: 'action', responsivePriority: -1, searchable: false, orderable: false},
                ],
            });
        };
        $(document).ready(function () {
            customerList();
        });
    </script>
@endsection
@section('content')
    @include('dashboard.layouts.component.status_update')
    @include('dashboard.layouts.component.delete')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-list-1"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Customer List
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('create_customer')
                            <a href="{{route('customer.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Record
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="customerList">
                <thead>
                <tr>
                    <th>@lang('ID')</th>
                    <th>@lang('Name')</th>
                    <th>@lang('Gender')</th>
                    <th>@lang('Email Verified')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
    <div id="detail"></div>
@endsection
