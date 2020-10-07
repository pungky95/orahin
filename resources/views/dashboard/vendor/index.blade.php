@extends('dashboard.layouts.main')
@section('title',__('Vendor'))
@section('subheader_title',__('Dashboard'))
@section('Customer Management','kt-menu__item--open')
@section('Vendor','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('vendor.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Vendor List')</a>
@endsection
@section('js')
    <script>
        const vendorList = async () => {
            const table = $('#vendorList');
            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: '{{route('vendor.list')}}',
                columns: [
                    {name: 'id', visible: false, orderable: false, searchable: false},
                    {name: 'name'},
                    {name: 'status_badge'},
                    {name: 'id_card_verified_badge'},
                    {name: 'action', responsivePriority: -1, searchable: false, orderable: false},
                ],
            });
        };
        $(document).ready(function () {
            vendorList();
        });
    </script>
@endsection
@section('content')
    @include('dashboard.layouts.component.delete')
    @include('dashboard.layouts.component.status_update')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-list-1"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Vendor List
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('create_vendor')
                            <a href="{{route('vendor.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
            <table class="table table-striped- table-bordered table-hover table-checkable" id="vendorList">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('Name')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('ID Card Verified')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
    <div id="detail"></div>
@endsection
