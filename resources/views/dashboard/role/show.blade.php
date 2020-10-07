<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Role Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{$role->name}}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <a href="javascript:"
                   onclick="remove('{{route('role.destroy',['id'=>$role->id])}}')"
                   class="btn btn-danger btn-elevate btn-icon-sm">
                    <i class="la la-trash"></i>
                    Delete
                </a>
                <a href="{{route('role.edit',['id' => $role->id])}}"
                   class="btn btn-info btn-elevate btn-icon-sm">
                    <i class="la la-edit"></i>
                    Edit
                </a>
                <a href="{{route('role.permission',['id' => $role->id])}}"
                   class="btn btn-warning btn-elevate btn-icon-sm">
                    <i class="la la-unlock"></i>
                    Permissions
                </a>
            </div>
        </div>
    </div>
</div>


