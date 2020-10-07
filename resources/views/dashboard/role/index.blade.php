@extends('dashboard.layouts.main')
@section('title',__('Role'))
@section('subheader_title',__('Dashboard'))
@section('Role','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('role.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Role List')</a>
@endsection
@section('js')
    <script>
        const roleList = async () => {
            const table = $('#roleList');
            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: '{{route('role.list')}}',
                columns: [
                    {name: 'id', visible: false, orderable: false, searchable: false},
                    {name: 'name'},
                    {name: 'action', responsivePriority: -1, searchable: false, orderable: false},
                ],
            });
        };
        $(document).ready(function () {
            roleList();
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
                    Role List
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-primary btn-icon-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-ellipsis-h"></i> Aksi
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">Pilih Aksi</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="{{route('role.create')}}"
                                           class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la la-plus"></i>
                                            <span class="kt-nav__link-text">New Record</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
        <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="roleList">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('Name')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
    <div id="detail"></div>
@endsection
