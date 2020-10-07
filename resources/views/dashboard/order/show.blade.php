<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" class="table table-bordered">
                    <tr>
                        <th>Invoice</th>
                        <td>{{$order->invoice_number}}</td>
                    </tr>
                    <tr>
                        <th>Customer Name</th>
                        <td>{{$order->customer->name}}</td>
                    </tr>
                    <tr>
                        <th>Customer Phone Number</th>
                        <td>{{$order->customer->phone_number ?? '-'}}</td>
                    </tr>
                    <tr>
                        <th>Customer Email</th>
                        <td>{{$order->customer->email}}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{dateFormat($order->date,true)}}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{$order->address}}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{!!  $order->order_status !!}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>{{formatCurrency($order->total)}}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-header">
                <h5 class="modal-title">Order Detail Service</h5>
            </div>
            <div class="modal-body">
                <table width="80%" class="table table-bordered">
                    <tr>
                        <th>Vendor Logo</th>
                        <th>Vendor Name</th>
                        <th>Service Name</th>
                        <th>Service Description</th>
                        <th>Notes</th>
                        <th>Service Price</th>
                        <th>Service Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                    @foreach($order->orderDetails as $orderDetail)
                        <tr>
                            <td><img width="150px" src="{{$orderDetail->vendor->logo}}"
                                     alt="{{$orderDetail->vendor->name}}"></td>
                            <td>{{$orderDetail->vendor->name}}</td>
                            <td>{{$orderDetail->name}}</td>
                            <td>{{$orderDetail->description}}</td>
                            <td>{{$orderDetail->pivot->note ?? '-'}}</td>
                            <td>{{formatCurrency($orderDetail->pivot->price)}}</td>
                            <td>{{$orderDetail->pivot->quantity}}</td>
                            <td>{{formatCurrency($orderDetail->pivot->quantity * $orderDetail->pivot->price)}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>



