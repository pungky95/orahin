<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
        <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @can('update_vendor')
            <a class="dropdown-item" href="{{route('vendor.edit',['id'=>$vendor->id])}}"><i
                    class="la la-edit"></i> @lang('Edit')</a>
            <a class="dropdown-item" href="javascript:"
               onclick="updateStatus('{{route('vendor.update.status',['id'=>$vendor->id])}}')"><i
                    class="la la-{{$vendor->status == 'Activate' ? 'ban' : 'check'}}"
                ></i> {{$vendor->status == 'Active' ? __('Deactivate') : __('Activate')}}</a>
        @endcan
        @can('read_vendor')
            <a class="dropdown-item" href="javascript:"
               onclick="getDetail('{{route('vendor.show',['id'=>$vendor->id])}}')"><i
                    class="la la-eye"></i> Detail</a>
        @endcan
        @can('delete_vendor')
            <a class="dropdown-item" href="javascript:"
               onclick="remove('{{route('vendor.destroy',['id'=>$vendor->id])}}')"><i class="la la-trash"
                ></i> @lang('Delete')</a>
        @endcan
    </div>
</span>
