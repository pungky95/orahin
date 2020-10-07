@extends('dashboard.layouts.main')
@section('title',__('User'))
@section('subheader_title',__('Dashboard'))
@section('User','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('user.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('User List')</a>
@endsection
@section('js')
    <script>
        const userList = async () => {
            const table = $('#userList');
            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: '{{route('user.list')}}',
                columns: [
                    {name: 'id', visible: false, orderable: false, searchable: false},
                    {name: 'role'},
                    {name: 'name'},
                    {name: 'email'},
                    {name: 'action', responsivePriority: -1, searchable: false, orderable: false},
                ],
            });
        };
        $(document).ready(function () {
            userList();
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
                    @lang('User List')
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{route('user.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            @lang('New Record')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="userList">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('Role')</th>
                    <th>@lang('Name')</th>
                    <th>@lang('Email')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
    <div id="detail"></div>
@endsection
