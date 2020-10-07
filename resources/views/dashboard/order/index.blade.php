@extends('dashboard.layouts.main')
@section('title',__('Order'))
@section('subheader_title',__('Dashboard'))
@section('Order','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('order.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Order List')</a>
@endsection
@section('js')
    <script>
        const companyList = async () => {
            const table = $('#companyList');
            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: '{{route('order.list')}}',
                columns: [
                    {name: 'id', visible: false, orderable: false, searchable: false},
                    {name: 'invoice_number'},
                    {name: 'customer_info'},
                    {name: 'status_badge'},
                    {name: 'date'},
                    {name: 'total'},
                    {name: 'action', responsivePriority: -1, searchable: false, orderable: false},
                ],
                order: [[5, 'desc']]
            });
        };
        $(document).ready(function () {
            companyList();
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
                    Order List
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="companyList">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('Invoice Number')</th>
                    <th>@lang('Customer Info')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Date')</th>
                    <th>@lang('Total')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
    <div id="detail"></div>
@endsection
