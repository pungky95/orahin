<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vendor Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <table style="width: 100%" class="table table-bordered">
                    <tr>
                        <th>Customer</th>
                        <td>{{$vendor->customer->name}}</td>
                    </tr>
                    <tr>
                        <th>Logo</th>
                        <td><img width="500" title="{{$vendor->name . '-logo'}}" src="{{$vendor->logo}}"
                                 alt="{{$vendor->name . ' logo'}}"></td>
                    </tr>
                    <tr>
                        <th>ID Card</th>
                        <td><img width="500" title="{{$vendor->name . '-id-card'}}" src="{{$vendor->id_card}}"
                                 alt="{{$vendor->name . '-id-card'}}">
                        </td>
                    </tr>
                    <tr>
                        <th>ID Card With Customer</th>
                        <td><img width="500" title="{{$vendor->name . '-id-card-with-customer'}}"
                                 src="{{$vendor->id_card_with_customer}}"
                                 alt="{{$vendor->name . '-id-card-with-customer'}}">
                        </td>
                    </tr>
                    <tr>
                        <th>National Identity Number</th>
                        <td>{{$vendor->national_identity_number}}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{$vendor->name}}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;">{!! $vendor->description !!}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$vendor->phone}}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{$vendor->address()->exists() ? $vendor->address_detail:''}}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><span
                                class="kt-badge kt-badge--{{$vendor->status == 'Active' ? 'success':'danger'}} kt-badge--inline">{{$vendor->status}}
                            </span></td>
                    </tr>
                    <tr>
                        <th>ID Card Verified</th>
                        <td><span
                                class="kt-badge kt-badge--{{$vendor->id_card_verified === 'Verified' ? 'success':'danger'}} kt-badge--inline">{{$vendor->id_card_verified}}
                            </span></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                @can('update_vendor')
                    @if($vendor->id_card_verified != 'Verified')
                        <a href="javascript:"
                           onclick="updateStatus('{{route('vendor.update.id_card.verify',['id'=>$vendor->id])}}','Verify ID Card')"
                           class="btn btn-success btn-elevate btn-icon-sm"><i
                                class="la la-check"
                            ></i> Verify ID Card</a>
                    @endif
                    @if($vendor->id_card_verified != 'Reject')
                        <a href="javascript:"
                           onclick="updateStatus('{{route('vendor.update.id_card.reject',['id'=>$vendor->id])}}','Reject ID Card')"
                           class="btn btn-danger btn-elevate btn-icon-sm"><i
                                class="la la-times"
                            ></i> Reject ID Card</a>
                    @endif
                @endcan
                @can('delete_vendor')
                    <a href="javascript:"
                       onclick="remove('{{route('vendor.destroy',['id' => $vendor->id])}}')"
                       class="btn btn-danger btn-elevate btn-icon-sm">
                        <i class="la la-trash"></i>
                        Delete
                    </a>
                @endcan
                @can('read_vendor')
                    <a href="{{route('vendor.edit',['id' => $vendor->id])}}"
                       class="btn btn-info btn-elevate btn-icon-sm">
                        <i class="la la-edit"></i>
                        Edit
                    </a>
                @endcan
            </div>
        </div>
    </div>
</div>



