<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #f4f4f4;
        }

        .header .logo {
            width: 120px;
            height: 120px;
            border-radius: 10%;

        }

        .header .title {
            text-align: center;
            font-size: 24px;
            color: #333;
        }

        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            background-color: #28a745;
            color: #ffffff;
            padding: 12px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;

        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}">
            </div>
            <div class="title">
                Your Ticket for {{ $orderItem->ticket->event->name }} Has Been Generated
            </div>
        </div>
        <div class="content">
            <p>Thank you for registering. Your attendance is confirmed. Download the ticket attached to this email and
                present it at the gate.</p>
            <p><strong>Please do not scan the QR code</strong> as it will void your ticket.</p>
            <p>The event will be held at <strong>{{ $orderItem->ticket->event->venue }}</strong>, starting at
                <strong>{{ $orderItem->ticket->event->start_date }}</strong>. We look forward to seeing you there!
            </p>
        </div>
        <div class="button-container">
            <a href="{{ route('attendees.download-ticket', $orderItem) }}" class="button">Download Ticket</a>
        </div>
        <div class="footer">
            Thanks,<br>
            {{ config('app.name') }}
        </div>
    </div>
</body>

</html>
