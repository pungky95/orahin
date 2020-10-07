<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Xendit\Xendit;

trait XenditPayment
{
    function __construct()
    {
        $this->setApiKey = Xendit::setApiKey(env('XENDIT_API_KEY'));
    }

    public function createInvoice(array $params)
    {
        try {
            $paymentMethods = explode('|', env('XENDIT_PAYMENT_METHOD'));
            $configEnv = [
                'should_send_email' => env('XENDIT_SHOULD_SEND_EMAIL'),
                'invoice_duration' => env('XENDIT_INVOICE_DURATION'),
                'success_redirect_url' => env('XENDIT_SUCCESS_REDIRECT'),
                'failure_redirect_url' => env('XENDIT_FAILED_REDIRECT'),
                'payment_methods' => $paymentMethods
            ];
            $params = array_merge($configEnv, $params);
            $this->setApiKey;
            $invoice = \Xendit\Invoice::create($params);
            return $invoice;
        } catch (\Exception $e) {
            Log::error('Xendit create invoice error :' . $e->getMessage());
        }

    }

    public function getInvoice(string $transactionId)
    {
        $this->setApiKey = \Xendit\Invoice::retrieve($transactionId);
        return \Xendit\Invoice::retrieve($transactionId);
    }

    public function expireInvoice(string $transactionId)
    {
        return \Xendit\Invoice::expireInvoice($transactionId);
    }
}
