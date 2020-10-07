<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Company Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" class="table table-bordered">
                    <tr>
                        <th>Logo</th>
                        <td><img width="500" src="{{$company->logo}}"></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{$company->name}}</td>
                    </tr>
                    <tr>
                        <th>Website</th>
                        <td><a href="{{$company->website}}">{{$company->website}}</a></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;">{!! $company->description !!}</td>
                    </tr>
                    <tr>
                        <th>Number of Bulletin</th>
                        <td>{{$company->bulletins()->whereStatus('Active')->count() ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><span
                                class="kt-badge kt-badge--{{$company->status == 'Active' ? 'success' : 'danger'}} kt-badge--inline">{{$company->status}}</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <a href="javascript:"
                   onclick="remove('{{route('company.destroy',['id' => $company->id])}}')"
                   class="btn btn-danger btn-elevate btn-icon-sm">
                    <i class="la la-trash"></i>
                    Delete
                </a>
                <a href="{{route('company.edit',['id' => $company->id])}}"
                   class="btn btn-info btn-elevate btn-icon-sm">
                    <i class="la la-edit"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>



