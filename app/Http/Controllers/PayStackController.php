<?php

namespace App\Http\Controllers;

use App\Http\Services\PayStackService;
use App\Models\Order;
use App\Utilities\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayStackController extends Controller
{
    private  PayStackService $paystack;
    public function __construct()
    {
        $this->paystack = new PayStackService();
    }

    public function paystackCallBack(Request $request)
    {

        $reference = $request->input('reference');

        try {
            // verify transaction
            $response = $this->paystack->verifyTransaction($reference);
            Log::info('Paystack Verify Transaction: ');
            Log::info($response);
            // check if response contains data
            // check if response contains data
            if (!isset($response['data'])) {
                //    throw new \Exception('Invalid response from Paystack');
                throw new \Exception('Invalid response from Paystack');
            }
            $data = $response['data'];



            // Check if $clientInvoiceRef is for order or subscription
            $order = Order::query()->where('paystack_reference', $reference)->firstOrFail();
            $order->payment_status = Constants::PAYMENT_STATUS_SUCCESSFUL;
            $order->save();
            // save payment details
            $payment = $order->payment()->create([
                'amount' => $data['amount'] / Constants::KOBO_CURRENCY,
                'currency' => $data['currency'],
                'payment_status' => Constants::PAYMENT_STATUS_SUCCESSFUL,
                'paystack_reference' => $data['reference'],
                'receipt_number' => $data['receipt_number'],
                'gateway_response' => json_encode($data),
                'gateway_status' => $data['status'],
                'gateway_response_id' => $data['id'],
                'gateway_channel' => $data['channel'],
            ]);

            // Send email to the attendees with the ticket


            return redirect()->route('successful.payment')->with('success', 'Payment processed successfully');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('successful.payment')->with('error', 'Error processing payment');
        }
    }
}
