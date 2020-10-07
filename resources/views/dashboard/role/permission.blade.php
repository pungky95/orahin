@extends('dashboard.layouts.main')
@section('title',__('Role Permissions'))
@section('subheader_title',__('Dashboard'))
@section('Role','kt-menu__item--active')
@section('breadcrumb')
    <a href="{{route('role.index')}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link">
        @lang('Role Permission List')</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{route('role.edit',['id' => $role->id])}}"
       class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        @lang('Setting Role Permission')</a>
@endsection
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-edit-1"></i>
										</span>
                <h3 class="kt-portlet__head-title">
                    @lang(' Setting Role Permission') {{$role->name}}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{route('role.index')}}" class="btn btn-warning btn-elevate btn-icon-sm">
                            <i class="la la-angle-left"></i>
                            @lang('Back Role Permission List')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('update-role-permission',['id' => $role->id])}}" method="post"
              enctype="multipart/form-data">
            @csrf
            <div class="kt-portlet__body">
                <div class="row">
                    @foreach($permissions as $permission)
                        @php
                            $found = null;
                            if (isset($role)) {
                                $found = $role->hasPermissionTo($permission->name);
                            }

                            if (isset($user)) {
                                $found = $user->hasDirectPermission($permission->name);
                            }
                        $beautfyName = explode('_',$permission->name);
                        $beautfyName = ucwords($beautfyName[0] . ' ' . $beautfyName[1]);
                        @endphp

                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="kt-checkbox-list">
                                    <label
                                        class="kt-checkbox kt-checkbox--{{ Str::contains($permission->name, 'delete') ? 'danger' : 'success' }}">
                                        <input {{$found ? 'checked="checked"' : ''}} name="permissions[]"
                                               value="{{$permission->name}}"
                                               type="checkbox"> {{$beautfyName}}
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                </div>
            </div>
        </form>
    </div>
@endsection
