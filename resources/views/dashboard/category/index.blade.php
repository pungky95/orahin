@extends('dashboard.layouts.main')
@section('title',__('Category'))
@section('subheader_title',__('Dashboard'))
@section('Category Management','kt-menu__item--open')
@section('Category','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('category.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Category List')</a>
@endsection
@section('js')
    <script>
        const categoryList = async () => {
            const table = $('#categoryList');
            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: '{{route('category.list')}}',
                columns: [
                    {name: 'id', visible: false, orderable: false, searchable: false},
                    {name: 'name'},
                    {name: 'status_badge'},
                    {name: 'action', responsivePriority: -1, searchable: false, orderable: false},
                ],
            });
        };
        $(document).ready(function () {
            categoryList();
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
                    Category List
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('create_category')
                            <a href="{{route('category.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
            <table class="table table-striped- table-bordered table-hover table-checkable" id="categoryList">
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
