<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
        <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @can('update_category')
            <a class="dropdown-item" href="{{route('category.edit',['id'=>$category->id])}}"><i
                    class="la la-edit"></i> @lang('Edit')</a>
            <a class="dropdown-item" href="javascript:"
               onclick="updateStatus('{{route('category.update.status',['id'=>$category->id])}}')"><i
                    class="la la-{{$category->status == 'Activate' ? 'ban' : 'check'}}"
                ></i> {{$category->status == 'Active' ? __('Deactivate') : __('Activate')}}</a>
        @endcan
        @can('read_category')
            <a class="dropdown-item" href="javascript:"
               onclick="getDetail('{{route('category.show',['id'=>$category->id])}}')"><i
                    class="la la-eye"></i> Detail</a>
        @endcan
        @can('delete_category')
            <a class="dropdown-item" href="javascript:"
               onclick="remove('{{route('category.destroy',['id'=>$category->id])}}')"><i class="la la-trash"
                ></i> @lang('Delete')</a>
        @endcan
    </div>
</span>
