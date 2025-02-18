<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketPurchaserequest;
use App\Http\Services\PayStackService;
use App\Models\Event;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ticket;
use App\Utilities\Constants;
use App\Utilities\GlobalUtilities;
use App\Utilities\PDFHandler;
use Da\QrCode\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PageController extends Controller
{
    use PDFHandler;
    private PayStackService $paystack;

    public function __construct()
    {
        $this->paystack = new PayStackService();
    }

    public function indexPage()
    {
        // Get all non-private events
        $events = Event::query()
            ->select(['id', 'slug', 'image', 'name', 'start_date', 'venue'])
            ->where('is_private', 0)
            ->orderByDesc('start_date');

        // Separate future & past events
        $current_future_events = $events->where('end_date', '>=', now())->get();
        $past_events = $events->where('end_date', '<', now())->get();

        return view('websites.welcome', compact('current_future_events', 'past_events'));
    }


    public function singleEvent(string $slug)
    {
        $event = Event::query()->where('slug', $slug)
            ->with(['tickets'])
            ->firstOrFail();
        return view('websites.event-details', compact('event'));
    }
    public function eventTicketBuy(string $slug, int $ticketId)
    {
        $event = Event::query()->where('slug', $slug)->firstOrFail();
        $ticket = $event->tickets()->where('id', $ticketId)->firstOrFail();
        return view('websites.event-ticket-buy', compact('event', 'ticket'));
    }
    public function contactPage(): View
    {
        return view('websites.contact');
    }

    public function purchaseTicket(TicketPurchaserequest $request, Ticket $ticket)
    {
        // display all php extensions installed
        // dd(phpinfo());
        // dd(get_loaded_extensions());

        $data = $request->validated();
        // generate qr code


        DB::beginTransaction();
        try {
            $orderNumber = GlobalUtilities::generateCode(Order::class, 'order_number', "ORD");
            // order number with prefix timestamp
            $orderNumberWIthPrefix = $orderNumber . '-' . time();

            // Create the order
            $order = $ticket->orders()->create([
                'order_number' => GlobalUtilities::generateCode(Order::class, 'order_number', "ORD"),
                'total_amount' => $ticket->price * intval($data['number_tickets']),
                'currency' => $ticket->currency,
                'payment_status' => Constants::PAYMENT_STATUS_PENDING,
                'paystack_reference' => $orderNumberWIthPrefix

            ]);
            // order item
            foreach ($data['attendees'] as $key => $attendee) {
                $order->orderItems()->create([

                    'ticket_id' => $ticket->id,
                    'quantity' => 1,
                    'amount' => $ticket->price,
                    'currency' => $ticket->currency,
                    'attendee_name' => $attendee['name'],
                    'attendee_email' => $attendee['email'],
                    'attendee_phone' => $attendee['phone_number'],
                    'status' => Constants::ORDER_ITEM_STATUS_VALID,
                    'qr_code' => $this->generateQrCode($order->order_number . $key),
                ]);
            }
            // get the first attendee
            $attendee = $data['attendees'][0];
            $total = $ticket->price * intval($data['number_tickets']) + $ticket->event->processing_fee;

            // redirect to payment page
            $payStackResponse = $this->paystack->initializeTransaction(
                $total,
                $attendee['email'],
                $orderNumberWIthPrefix,
                $ticket->currency,
                route('paystack.callback')
            );

            // Handle success response
            if ($payStackResponse['status'] === true) {
                DB::commit();
                //    open the payment page
                return redirect($payStackResponse['data']['authorization_url']);
            } else {
                Log::error($payStackResponse);
                throw new \Exception($payStackResponse['message']);
            }
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    private function generateQrCode(string $data): string
    {
        $qrCode = (new QrCode($data))
            ->setSize(250)
            ->setMargin(5);
        // generate unique file name
        $fileName = 'qr-code-' . time() . '.png';
        $pathName = 'qr-codes/' . $fileName;
        Storage::disk('public')->put($pathName, $qrCode->writeString());
        return $pathName;
    }

    public function successfulPayment(Request $request)
    {
        return view('websites.successful-payment');
    }

    public function downloadTicket(int $orderItemId)
    {
        $orderItem = OrderItem::query()->with(['ticket.event'])->findOrFail($orderItemId);
        $view = view('pdfs.eventTicket', compact('orderItem'))->render();

        $fileName = $orderItem->order->order_number . '-' . $orderItem->id;
        return $this->downloadPDF($view, $fileName);
    }
}
