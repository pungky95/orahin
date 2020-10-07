<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
        <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @can('update_subcategory')
            <a class="dropdown-item" href="{{route('subcategory.edit',['id'=>$subcategory->id])}}"><i
                    class="la la-edit"></i> @lang('Edit')</a>
        @endcan
        @can('read_subcategory')
            <a class="dropdown-item" href="javascript:"
               onclick="getDetail('{{route('subcategory.show',['id'=>$subcategory->id])}}')"><i
                    class="la la-eye"></i> @lang('Detail')</a>
            <a class="dropdown-item" href="javascript:"
               onclick="updateStatus('{{route('subcategory.update.status',['id'=>$subcategory->id])}}')"><i
                    class="la la-{{$subcategory->status == 'Activate' ? 'ban' : 'check'}}"
                ></i> {{$subcategory->status == 'Active' ? __('Deactivate') : __('Activate')}}</a>
        @endcan
        @can('delete_subcategory')
            <a class="dropdown-item" href="javascript:"
               onclick="remove('{{route('subcategory.destroy',['id'=>$subcategory->id])}}')"><i class="la la-trash"
                ></i> @lang('Delete')</a>
        @endcan
    </div>
</span>
