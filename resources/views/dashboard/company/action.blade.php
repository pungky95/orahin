<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
        <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @can('update_company')
            <a class="dropdown-item" href="{{route('company.edit',['id'=>$company->id])}}"><i
                    class="la la-edit"></i> @lang('Edit')</a>
            <a class="dropdown-item" href="javascript:"
               onclick="updateStatus('{{route('company.update.status',['id'=>$company->id])}}')"><i
                    class="la la-{{$company->status == 'Activate' ? 'ban' : 'check'}}"
                ></i> {{$company->status == 'Active' ? __('Deactivate') : __('Activate')}}</a>
        @endcan
        @can('read_company')
            <a class="dropdown-item" href="javascript:"
               onclick="getDetail('{{route('company.show',['id'=>$company->id])}}')"><i
                    class="la la-eye"></i> Detail</a>
        @endcan
        @can('delete_company')
            <a class="dropdown-item" href="javascript:"
               onclick="remove('{{route('company.destroy',['id'=>$company->id])}}')"><i class="la la-trash"
                ></i> @lang('Delete')</a>
        @endcan
    </div>
</span>
