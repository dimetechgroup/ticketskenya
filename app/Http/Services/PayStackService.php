<?php

namespace App\Http\Services;

use App\Utilities\Constants;
use App\Utilities\Helpers;
use Illuminate\Support\Facades\Http;

class PayStackService
{
    private $paystack;
    public function __construct()
    {
        $this->paystack = [
            'public_key' => config('app.paystack.public_key'),
            'secret_key' => config('app.paystack.secret_key'),
        ];
    }
    private function sendRequest(string $url, array $fields = [], string $method = 'POST')
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->paystack['secret_key'],
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->$method($url, $fields);

        return $response->json();
    }

    public function initializeTransaction(float $amount, string $email, string $reference, string $currency = 'KES', string $callback_url = null)
    {
        $url = 'https://api.paystack.co/transaction/initialize';
        $fields = [
            'email' => $email,
            'amount' => $amount * Constants::KOBO_CURRENCY,
            'reference' => $reference,
            'currency' => $currency,
        ];
        if ($callback_url) {
            $fields['callback_url'] = $callback_url;
        }
        $response = $this->sendRequest($url, $fields);
        return $response;
    }

    /**
     * Summary of verifyTransaction
     * Confirm the status of a transaction
     * @param string $reference
     * @return mixed
     */
    public function verifyTransaction(string $reference)
    {
        $url = 'https://api.paystack.co/transaction/verify/' . $reference;
        $response = $this->sendRequest($url, [], 'GET');
        return $response;
    }

    /**
     * List Transactions
     * List transactions carried out on your integration
     * @param int $perPage
     * @param int $page
     * @param int $customer - Customer ID optional
     * @param string  $status - Transaction status optional -  ('failed', 'success', 'abandoned')
     * @return mixed
     */
    public function listTransactions(int $perPage = 50, int $page = 1, int $customer = null, string $status = null)
    {
        $url = 'https://api.paystack.co/transaction';
        $fields = [
            'perPage' => $perPage,
            'page' => $page,
            'customer' => $customer,
            'status' => $status,
        ];
        $response = $this->sendRequest($url, $fields, 'GET');
        return $response;
    }
}
