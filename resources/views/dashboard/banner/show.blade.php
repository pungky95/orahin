<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Banner Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{$banner->name}}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            <img width="500" src="{{$banner->image}}">
                        </td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td>{{$banner->start_date}}</td>
                    </tr>
                    <tr>
                        <th>End Date</th>
                        <td>{{$banner->end_date}}</td>
                    </tr>
                    <tr>
                        <th>Link</th>
                        <td>{{$banner->link}}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;">{!! $banner->description !!}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><span
                                class="kt-badge kt-badge--{{$banner->status == 'Active' ? 'success' : 'danger'}} kt-badge--inline">{{$banner->status}}</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <a href="javascript:"
                   onclick="remove('{{route('bulletin.destroy',['id' => $banner->id])}}')"
                   class="btn btn-danger btn-elevate btn-icon-sm">
                    <i class="la la-trash"></i>
                    Delete
                </a>
                <a href="{{route('bulletin.edit',['id' => $banner->id])}}"
                   class="btn btn-info btn-elevate btn-icon-sm">
                    <i class="la la-edit"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>



