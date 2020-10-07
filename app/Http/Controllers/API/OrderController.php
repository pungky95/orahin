<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderShowDetailResource;
use App\Models\Order;
use App\Models\Service;
use App\Traits\XenditPayment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use XenditPayment;

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
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
        if (Auth::check()) {
            $orders->where('customer_uid', $request->user()->uid);
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return OrderResource
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'date',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'address' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'note' => 'nullable|string|max:500',
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $requestData = $request->all();
        $requestData['invoice_number'] = strtoupper(uniqid(Carbon::parse()->format('YM')));
        $requestData['customer_uid'] = $request->user()->uid;
        DB::beginTransaction();
        try {
            $service = Service::where('id', ($requestData['service_id']))->where('status', 'Published')->first();
            if (!$service) {
                throw new Exception('Service not found');
            }
            $requestData['total'] = $service->price;
            $thirdPartyPayment = $this->createInvoice([
                    'external_id' => $requestData['invoice_number'],
                    'payer_email' => $request->user()->email,
                    'description' => 'Pembayaran Order Invoice ' . $requestData['invoice_number'],
                    'amount' => $requestData['total']
                ]
            );
            $requestData['third_party_payment_transaction_id'] = $thirdPartyPayment['id'];
            $requestData['third_party_payment_url'] = $thirdPartyPayment['invoice_url'];
            $requestData ['third_party_payment_json_callback'] = json_encode($thirdPartyPayment);
            $requestData['third_party_payment_status'] = $thirdPartyPayment['status'];
            $order = Order::create($requestData);
            Log::info('Store Order : ' . $order);
            $order->orderDetails()->attach($service->id, ['quantity' => 1, 'price' => $service->price, 'note' => $request->filled('note') ? $requestData['note'] : null]);
            DB::commit();
            return new OrderResource($order);
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
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
            'status' => 'required|in:Finished',
        ]);
        $requestData['status'] = $request->status;
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        if ($order->status !== 'Processed') {
            return errorResponse(Lang::get('vendor_order_api.error_message_finished'), 400);
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
}
