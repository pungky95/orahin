<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
        <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @can('update_event')
            <a class="dropdown-item" href="{{route('banner.edit',['id'=>$banner->id])}}"><i
                    class="la la-edit"></i> @lang('Edit')</a>
        @endcan
        @can('read_event')
            <a class="dropdown-item" href="javascript:"
               onclick="getDetail('{{route('banner.show',['id'=>$banner->id])}}')"><i
                    class="la la-eye"></i> @lang('Detail')</a>
        @endcan
        @can('delete_category')
            <a class="dropdown-item" href="javascript:"
               onclick="remove('{{route('banner.destroy',['id'=>$banner->id])}}')"><i class="la la-trash"
                ></i> @lang('Delete')</a>
        @endcan
    </div>
</span>
