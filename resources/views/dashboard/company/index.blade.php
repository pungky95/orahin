@extends('dashboard.layouts.main')
@section('title',__('Company'))
@section('subheader_title',__('Dashboard'))
@section('Bulletin Management','kt-menu__item--open')
@section('Company','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('company.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Company List')</a>
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
                ajax: '{{route('company.list')}}',
                columns: [
                    {name: 'id', visible: false, orderable: false, searchable: false},
                    {name: 'name'},
                    {name: 'status_badge'},
                    {name: 'action', responsivePriority: -1, searchable: false, orderable: false},
                ],
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
                    Company List
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('create_company')
                            <a href="{{route('company.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
            <table class="table table-striped- table-bordered table-hover table-checkable" id="companyList">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('Name')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
    <div id="detail"></div>
@endsection
