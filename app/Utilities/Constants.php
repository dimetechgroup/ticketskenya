<?php

namespace App\Utilities;

class Constants
{
    const KOBO_CURRENCY = 100;

    const EVENT_STATUS_PENDING = 'pending';
    const EVENT_STATUS_APPROVED = 'approved';
    const EVENT_STATUS_CANCELLED = 'cancelled';
    const EVENT_STATUS_COMPLETED = 'completed';

    const CURRENCY_USD = 'USD';
    const CURRENCY_KES = 'KES';

    const PAYMENT_STATUS_PENDING = 'pending';
    const PAYMENT_STATUS_SUCCESSFUL = 'successful';
    const PAYMENT_STATUS_FAILED = 'failed';
    const PAYMENT_STATUS_REFUNDED = 'refunded';

    const ORDER_ITEM_STATUS_VALID = 'valid';
    const ORDER_ITEM_STATUS_USED = 'used';
    const ORDER_ITEM_STATUS_CANCELLED = 'cancelled';
    const ORDER_ITEM_STATUS_DENIED = 'denied';
}
