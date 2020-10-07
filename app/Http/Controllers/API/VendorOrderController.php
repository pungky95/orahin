<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderShowDetailResource;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class VendorOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'per_page' => 'numeric|max:25|min:1',
            'search' => 'nullable|string',
            'status_filter' => 'nullable|in:Awaiting Payment,Pending,Expired,Rejected,Approved,Processed,Finished',
            'start_date_filter' => 'nullable|date',
            'end_date_filter' => 'nullable|date',
            'sort_by' => 'nullable|in:status,created_at|required_with:order_by',
            'order_by' => 'nullable|in:asc,desc|required_with:sort_by'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $orders = Order::query();
        $orders->leftJoin('order_details as od', 'orders.id', 'od.order_id')
            ->leftJoin('services as s', 's.id', 'od.service_id')
            ->leftJoin('vendors as v', 'v.id', 's.vendor_id')
            ->select('orders.*');
        if (Auth::check()) {
            $orders->where('v.customer_uid', $request->user()->uid);
        }
        if ($request->filled('search')) {
            $orders->orWhere('services.name', 'like', '%' . $request->search . '%')
                ->orWhere('orders.invoice_number', 'like', '%' . $request->search . '%')
                ->orWhere('orders.address', 'like', '%' . $request->search . '%')
                ->orWhere('orders.date', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status_filter')) {
            $orders->where('orders.status', $request->status_filter);
        }
        if ($request->filled('start_date_filter') && !$request->filled('end_date_filter')) {
            $orders->whereDate('orders.date', '>=', $request->start_date_filter);
        }
        if (!$request->filled('start_date_filter') && $request->filled('end_date_filter')) {
            $orders->whereDate('orders.date', '<=', $request->end_date_filter);
        }
        if ($request->filled('start_date_filter') && $request->filled('end_date_filter')) {
            $orders->whereDate('orders.date', '>=', $request->start_date_filter)
                ->whereDate('orders.date', '<=', $request->end_date_filter);
        }
        if ($request->filled('sort_by') && $request->filled('order_by')) {
            $orders->orderBy($request->sort_by, $request->order_by);
        }
        return OrderResource::collection($orders->simplePaginate($request->per_page));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderShowDetailResource
     */
    public function show(Order $order)
    {
        return new OrderShowDetailResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return OrderShowDetailResource
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Approved,Rejected,Processed',
        ]);
        $requestData['status'] = $request->status;
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        if ($order->status !== 'Pending' && $requestData['status'] != 'Processed') {
            return errorResponse([Lang::get('vendor_order_api.error_message_' . strtolower($requestData['status']))], 400);
        }
        if ($requestData['status'] == 'Processed' && $order->status != 'Approved') {
            return errorResponse([Lang::get('vendor_order_api.error_message_processed')], 400);
        }
        DB::beginTransaction();
        try {
            $order->update($requestData);
            DB::commit();
            return new OrderShowDetailResource($order);
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
    }
}
