<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
        <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="{{route('role.permission',['id'=>$role->id])}}"><i
                class="la la-unlock"></i> @lang('Permission')</a>
        <a class="dropdown-item" href="{{route('role.edit',['id'=>$role->id])}}"><i
                class="la la-edit"></i> @lang('Edit')</a>
     <a class="dropdown-item" href="javascript:"
        onclick="getDetail('{{route('role.show',['id'=>$role->id])}}')"><i
             class="la la-eye"></i> Detail</a>
        <a class="dropdown-item" href="javascript:"
           onclick="remove('{{route('role.destroy',['id'=>$role->id])}}')"><i class="la la-trash"
            ></i> @lang('Delete')</a>
    </div>
</span>
