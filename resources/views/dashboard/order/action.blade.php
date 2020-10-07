<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
        <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @can('read_order')
            <a class="dropdown-item" href="javascript:"
               onclick="getDetail('{{route('order.show',['id'=>$order->id])}}')"><i
                    class="la la-eye"></i> Detail</a>
        @endcan
    </div>
</span>
