<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bulletin Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" class="table table-bordered">
                    <tr>
                        <th>Company Name</th>
                        <td>{{$bulletin->company->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{$bulletin->job_name}}</td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td>{{$bulletin->start_date}}</td>
                    </tr>
                    <tr>
                        <th>End Date</th>
                        <td>{{$bulletin->end_date}}</td>
                    </tr>
                    <tr>
                        <th>Salary</th>
                        <td>{{$bulletin->salary}} / {{$bulletin->time_period}}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;">{!! $bulletin->description !!}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <a href="javascript:"
                   onclick="remove('{{route('bulletin.destroy',['id' => $bulletin->id])}}')"
                   class="btn btn-danger btn-elevate btn-icon-sm">
                    <i class="la la-trash"></i>
                    Delete
                </a>
                <a href="{{route('bulletin.edit',['id' => $bulletin->id])}}"
                   class="btn btn-info btn-elevate btn-icon-sm">
                    <i class="la la-edit"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>



