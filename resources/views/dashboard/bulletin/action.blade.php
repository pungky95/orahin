<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
        <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @can('update_bulletin')
            <a class="dropdown-item" href="{{route('bulletin.edit',['id'=>$bulletin->id])}}"><i
                    class="la la-edit"></i> @lang('Edit')</a>
        @endcan
        @can('read_bulletin')
            <a class="dropdown-item" href="javascript:"
               onclick="getDetail('{{route('bulletin.show',['id'=>$bulletin->id])}}')"><i
                    class="la la-eye"></i> @lang('Detail')</a>
        @endcan
        @can('delete_category')
            <a class="dropdown-item" href="javascript:"
               onclick="remove('{{route('bulletin.destroy',['id'=>$bulletin->id])}}')"><i class="la la-trash"
                ></i> @lang('Delete')</a>
        @endcan
    </div>
</span>
