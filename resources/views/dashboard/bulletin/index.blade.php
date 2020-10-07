@extends('dashboard.layouts.main')
@section('title',__('Bulletin'))
@section('subheader_title',__('Dashboard'))
@section('Bulletin Management','kt-menu__item--open')
@section('Bulletin','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('bulletin.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Bulletin List')</a>
@endsection
@section('js')
    <script>
        const bulletinList = async () => {
            const table = $('#bulletinList');
            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: '{{route('bulletin.list')}}',
                columns: [
                    {name: 'id', visible: false, orderable: false, searchable: false},
                    {name: 'job_name'},
                    {name: 'salary'},
                    {name: 'action', responsivePriority: -1, searchable: false, orderable: false},
                ],
            });
        };
        $(document).ready(function () {
            bulletinList();
        });
    </script>
@endsection
@section('content')
    @include('dashboard.layouts.component.delete')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-list-1"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Bulletin List
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('create_bulletin')
                            <a href="{{route('bulletin.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
            <table class="table table-striped- table-bordered table-hover table-checkable" id="bulletinList">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('Job Name')</th>
                    <th>@lang('Salary')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
    <div id="detail"></div>
@endsection
