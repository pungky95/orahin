<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subcategory Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" class="table table-bordered">
                    <tr>
                        <th>Image</th>
                        <td><img src="{{$subcategory->image}}" alt="{{$subcategory->name}}" width="500"></td>
                    </tr>
                    <tr>
                        <th>Category Name</th>
                        <td>{{$subcategory->category->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{$subcategory->name}}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                @can('delete_subcategory')
                    <a href="javascript:"
                       onclick="remove('{{route('subcategory.destroy',['id' => $subcategory->id])}}')"
                       class="btn btn-danger btn-elevate btn-icon-sm">
                        <i class="la la-trash"></i>
                        Delete
                    </a>
                @endcan
                @can('update_subcategory')
                    <a href="{{route('subcategory.edit',['id' => $subcategory->id])}}"
                       class="btn btn-info btn-elevate btn-icon-sm">
                        <i class="la la-edit"></i>
                        Edit
                    </a>
                @endcan
            </div>
        </div>
    </div>
</div>



