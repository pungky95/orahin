<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class XenditPaymentCallbackController extends Controller
{
    public function callback(Request $request)
    {
        try {
            $xenditCallbackPayload = $request->all();
            Log::info('Xendit Callback Payload : ' . json_encode($xenditCallbackPayload));
            // Test Purpose
            if ($xenditCallbackPayload['id'] == '579c8d61f23fa4ca35e52da4') {
                return response()->json('Success', 200);
            }
            if ($xenditCallbackPayload['status'] === 'PAID' || $xenditCallbackPayload['status'] === 'SETTLED') {
                $order = Order::where('invoice_number', $xenditCallbackPayload['external_id'])->where('status', 'Awaiting Payment')->first();
                if (!$order) {
                    throw new Exception('Order not found');
                }
                $order->update([
                    'status' => 'Pending',
                    'third_party_payment_json_callback' => json_encode($xenditCallbackPayload),
                    'third_party_payment_status' => $xenditCallbackPayload['status']
                ]);
            } else if ($xenditCallbackPayload['status'] === 'EXPIRED') {
                $order = Order::where('invoice_number', $xenditCallbackPayload['external_id'])->where('status', 'Awaiting Payment')->first();
                if (!$order) {
                    throw new Exception('Order not found');
                }
                $order->update([
                    'status' => 'Expired',
                    'third_party_payment_json_callback' => json_encode($xenditCallbackPayload),
                    'third_party_payment_status' => $xenditCallbackPayload['status']
                ]);
            }
            return response()->json('Success', 200);
        } catch (Exception $e) {
            Log::error('Xendit Payment Callback : ' . $e->getMessage());
            return response()->json('Something was wrong : ' . $e->getMessage(), 400);
        }

    }
}
