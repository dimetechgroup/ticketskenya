<?php

namespace App\Http\Controllers;

use App\Http\Services\PayStackService;
use App\Models\Order;
use App\Models\OrderItem;
use App\Notifications\TicketEvent;
use App\Utilities\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class PayStackController extends Controller
{
    private  PayStackService $paystack;
    public function __construct()
    {
        $this->paystack = new PayStackService();
    }

    public function paystackCallBack(Request $request)
    {




        DB::beginTransaction();

        try {
            $reference = $request->input('reference');
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

            // update ticket sold_quantity
            $ticket = $order->ticket()->increment('sold_quantity', count($order->orderItems));

            // save payment details
            $payment = $order->payment()->create([
                'amount' => ($data['amount'] / Constants::KOBO_CURRENCY),
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
            foreach ($order->orderItems as $key => $orderItem) {
                $orderItem->status = Constants::ORDER_ITEM_STATUS_VALID;
                $orderItem->save();
                Notification::route('mail', $orderItem->attendee_email)->notify(new TicketEvent($orderItem));
            }


            DB::commit();

            return redirect()->route('successful.payment')->with('success', 'Payment processed successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return redirect()->route('landing.page')->with('error', 'Error processing payment');
        }
    }
}
