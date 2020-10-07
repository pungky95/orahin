@extends('dashboard.layouts.main')
@section('title',__('Subcategory'))
@section('subheader_title',__('Dashboard'))
@section('Category Management','kt-menu__item--open')
@section('Subcategory','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('subcategory.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Subcategory List')</a>
@endsection
@section('js')
    <script>
        const advancedSearch = async () => {
            $('#advance-search-toggle').click(function () {
                $('#advance-filter').toggle(200);
            });
        };
        const subCategoryList = async () => {
            const table = $('#sub-categoryList').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: '{{route('subcategory.list')}}',
                columns: [
                    {name: 'id', visible: false, orderable: false, searchable: false},
                    {name: 'name'},
                    {name: 'status_badge'},
                    {name: 'action', responsivePriority: -1, searchable: false, orderable: false},
                ],
            });
            $('#filter').click(() => {
                const categoryId = $('#category_id').val();
                const status = $('#status').val();
                table.ajax.url("{{ route('subcategory.list')}}" + '?category_id=' + categoryId + '&status=' + status).load();
            });
            $('#reset').click(() => {
                $('#category_id').val(null).trigger('change');
                $('#status').val(null).trigger('change');
                table.ajax.url("{{ route('subcategory.list')}}").load();
            });
        };
        const categorySelect = async () => {
            const $categorySelect = await $('#category_id').select2({
                placeholder: 'Select Category',
                width: '100%',
                ajax: {
                    url: "{{route('select2.category')}}",
                    type: "GET",
                    dataType: "json",
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response.results,
                            pagination: response.pagination
                        };
                    },
                    cache: true
                }
            });
        };
        $(document).ready(function () {
            subCategoryList();
            categorySelect();
            advancedSearch();
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
                    Subcategory List
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="javascript:" class="btn btn-brand btn-elevate btn-icon-sm" id="advance-search-toggle">
                            <i class="la la-search"></i>
                            Advance Filter
                        </a>
                        @can('create_subcategory')
                            <a href="{{route('subcategory.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Record
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Search Form -->
            <form id="advance-filter" class="kt-form kt-form--fit kt-margin-b-20" style="display:none"
                  action="javascript:">
                <div class="row kt-margin-b-20">
                    <div class="col-lg-6 kt-margin-b-10-tablet-and-mobile">
                        <label>Category</label>
                        <select id="category_id" class="form-control kt-input" data-col-index="2">
                        </select>
                    </div>
                    <div class="col-lg-6 kt-margin-b-10-tablet-and-mobile">
                        <label>Status</label>
                        <select id="status" class="form-control kt-input" data-col-index="6">
                            <option selected disabled value="">Select</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="kt-separator kt-separator--md kt-separator--dashed"></div>
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary btn-brand--icon" id="filter">
                            <span>
                                <i class="la la-filter"></i>
                                <span>Filter</span>
                            </span>
                        </button>
                        &nbsp;&nbsp;
                        <button class="btn btn-secondary btn-secondary--icon" id="reset">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="sub-categoryList">
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
