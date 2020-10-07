<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('dashboard.order.index');
    }

    public function list(Request $request)
    {
        return Laratables::recordsOf(Order::class, function ($query) {
            return $query->leftJoin('customers as customer', 'customer.uid', 'orders.customer_uid')
                ->select('orders.*', 'customer.name', 'customer.email');
        });
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return array|Response|string
     * @throws Throwable
     */
    public function show(Order $order)
    {
        return view('dashboard.order.show', compact('order'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return array|string
     * @throws Throwable
     */
    public function update(Request $request, Order $order)
    {
        $this->validate($request, [
                'status' => 'required|in:Rejected|Finished'
            ]
        );
        $requestData = $request->all();
        DB::transaction(function () use ($requestData, $order) {
            Log::info('Before Update Order : ' . $order);
            $order->update($requestData);
            Log::info('After Update Order : ' . $order);
        });
        return redirect()->route('dashboard.order.index')->with('success', 'Order updated');
    }
}
