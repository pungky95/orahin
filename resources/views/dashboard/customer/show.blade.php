<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customer Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <table style="width:100%;" class="table table-bordered">
                    <tr>
                        <th>Photo Profile</th>
                        <td style="text-align: center">
                            <img style="width: 280px;" src="{{$customer->photo_profile}}" alt="{{$customer->name}}">
                        </td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{$customer->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$customer->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{isset($customer->phone_number) ? $customer->phone_number : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{isset($customer->gender) ? $customer->gender : '-'}}</td>
                    </tr>
                    <tr>
                        <th>Email Verified</th>
                        <td>
                            <span class="kt-badge kt-badge--{{$customer->email_verified == true ? 'success' : 'danger'}} kt-badge--inline">{{$customer->email_verified === 1 ? 'Verified' : 'Unverified'}}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>



