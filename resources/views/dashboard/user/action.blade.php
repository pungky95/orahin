<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
        <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
    <a class="dropdown-item" href="{{route('user.edit',['id'=>$user->id])}}"><i
            class="la la-edit"></i> @lang('Edit')</a>
       <a class="dropdown-item" href="javascript:"
          onclick="getDetail('{{route('user.show',['id'=>$user->id])}}')"><i
               class="la la-eye"></i> Detail</a>
        <a class="dropdown-item" href="javascript:"
           onclick="remove('{{route('user.destroy',['id'=>$user->id])}}')"><i class="la la-trash"
            ></i> @lang('Delete')</a>
    </div>
</span>

