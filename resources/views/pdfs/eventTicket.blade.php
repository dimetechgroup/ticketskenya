{{-- resources/views/pdfs/eventTicket.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Event Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .ticket-container {
            width: 100%;
            max-width: 840px;
            margin: 0;
            background: #fff;
            padding: 0px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .ticket-container .header {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
            height: 100px;
        }

        .header .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 150px;
            height: 50px;
            z-index: 1;

        }

        .header .qr_code {
            position: absolute;
            right: 0;
            top: 0;
            width: 100px;
            height: 100px;
            z-index: 2;
        }

        .event-details {
            margin-top: 20px;
            width: 100%;
            position: relative;
            height: 350px;
        }

        .event-image img {
            position: absolute;
            left: 0;
            top: 0;
            width: 220px;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
            object-position: center;

        }

        .details {
            margin-left: 220px;
            padding: 10px;
            position: absolute;
            right: 0;

        }

        .details p {
            margin: 5px 0;
        }

        .footer {

            text-align: center;
            background: #42a26c;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            position: absolute;
            bottom: 0;
            width: 100%;

        }
    </style>
</head>

<body>
    <div class="ticket-container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="logo">
            <img src="{{ asset('storage/' . $orderItem->qr_code) }}" alt="{{ config('app.name') }}" class="qr_code">
        </div>
        <div class="event-details">
            <div class="event-image">
                <img src="{{ asset($orderItem->ticket->event->image_url) }}" alt="Event Poster">
            </div>
            <div class="details">
                <h3>{{ $orderItem->ticket->event->name }}</h3>
                <p><strong>Date & Time:</strong>
                    {{ $orderItem->ticket->event->start_date->format('M d, Y h:i A') . ' - ' . $orderItem->ticket->event->end_date->format('M d, Y h:i A') }}
                </p>
                <p><strong>Venue:</strong> {{ $orderItem->ticket->event->venue }}</p>
                <p><strong>Ticket Type:</strong> {{ $orderItem->ticket->name }}</p>
                <p><strong>Price:</strong>
                    {{ $orderItem->ticket->currency . ' ' . number_format($orderItem->ticket->price) }}</p>
                <p><strong>Order Ref:</strong> {{ $orderItem->order->order_number }}</p>
                <p><strong>Purchased by:</strong> {{ $orderItem->order->order_number }}</p>
                <p><strong>Order Date:</strong> {{ $orderItem->order->created_at->format('M d, Y @ h:i A') }}</p>
            </div>
        </div>
        <div class="footer">
            <p>Contact: <a href="tel:+254708178500">0708178500</a> | <a
                    href="mailto:info@ticketskenya.com">info@ticketskenya.com</a></p>
        </div>
    </div>
</body>

</html>
