<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
        <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @can('read_customer')
            <a class="dropdown-item" href="javascript:"
               onclick="getDetail('{{route('customer.show',['uid'=>$customer->uid])}}')"><i
                    class="la la-eye"></i> @lang('Detail')</a>
        @endcan
        @can('update_customer')
            <a class="dropdown-item" href="{{route('customer.edit',['uid'=>$customer->uid])}}"><i
                    class="la la-edit"></i> @lang('Edit')</a>
            <a class="dropdown-item" href="javascript:"
               onclick="updateStatus('{{route('customer.update.email_verified',['uid'=>$customer->uid])}}')"><i
                    class="la la-{{$customer->email_verified == true ? 'ban' : 'check'}}"
                ></i> {{$customer->email_verified == true ? __('Unverified') : __('Verified')}}</a>
        @endcan
        @can('delete_customer')
            <a class="dropdown-item" href="javascript:"
               onclick="remove('{{route('customer.destroy',['uid'=>$customer->uid])}}')"><i class="la la-trash"
                ></i> @lang('Delete')</a>
        @endcan
    </div>
</span>
