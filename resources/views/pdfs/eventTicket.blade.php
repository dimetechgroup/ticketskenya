<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Event Ticket</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .ticket {

            width: 100%;
            display: flex;
            border: 3px solid #000;
            padding: 0px;
            background: #f8f9fa;
            position: relative;
        }

        .left-section {
            width: 60%;
            max-width: 530px;
            padding: 20px;
            background: #fff;
            border-right: 1px solid #000;
            left: 0;
            top: 0;

        }

        .right-section {
            width: 40%;
            max-width: 350px;
            text-align: center;
            padding: 0px;
            color: #000;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            position: absolute;
            right: 0;
            top: 0;

        }

        .qr-code img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }


        .event-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .event-details p {
            margin: 5px 0;
            font-size: 14px;
        }


        .event-image img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #000;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="left-section">
            <div class="event-image">
                <img src="{{ asset($orderItem->ticket->event->image_url) }}" alt="Event Image">
            </div>
            <div class="event-details">
                <p class="event-title">{{ $orderItem->ticket->event->name }}</p>
                <p><strong>Date & Time:</strong> {{ $orderItem->ticket->event->start_date->format('M d, Y h:i A') }} -
                    {{ $orderItem->ticket->event->end_date->format('M d, Y h:i A') }}</p>
                <p><strong>Venue:</strong> {{ $orderItem->ticket->event->venue }}</p>
                <p><strong>Ticket Type:</strong> {{ $orderItem->ticket->name }}</p>
                <p><strong>Price:</strong>
                    {{ $orderItem->ticket->currency . ' ' . number_format($orderItem->ticket->price) }}</p>
                <p><strong>Order Ref:</strong> {{ $orderItem->order->order_number }}</p>
                <p><strong>Order Date:</strong> {{ $orderItem->order->created_at->format('M d, Y @ h:i A') }}</p>
            </div>
        </div>
        <div class="right-section">
            <div class="qr-code">
                <img src="{{ asset('storage/' . $orderItem->qr_code) }}" alt="QR Code">
            </div>
            <p style="font-size: 14px; font-weight: bold;">Scan to Validate</p>
        </div>
    </div>
    <div class="footer">
        <p>Contact: <a href="tel:+254708178500" style="color: #000; text-decoration: none;">0708178500</a> | <a
                href="mailto:info@ticketskenya.com"
                style="color: #000; text-decoration: none;">info@ticketskenya.com</a></p>
    </div>
</body>

</html>
