<?php

namespace App\Http\Services;

use App\Utilities\GlobalUtilities;
use Illuminate\Support\Facades\Http;

class SmsGateWay
{
    public GlobalUtilities $globalUtilities;

    public function __construct()
    {
        $this->globalUtilities = new GlobalUtilities();
    }



    public function sendSms(string $phone, string $message): array
    {
        $dataSend = [
            [
                'mobile_number' => $this->globalUtilities->internationalPhoneNumber($phone),
                'message' => $message
            ]
        ];
        $response = $this->sendRequest($dataSend);
        return $response;
    }

    private function sendRequest(array $data): array
    {
        $dataSend = [];
        foreach ($data as $key => $value) {
            //mobile_number
            $dataSend[$key]['mobile_number'] = $value['mobile_number'];
            //message
            $dataSend[$key]['message'] = $value['message'];
            //message_type
            $dataSend[$key]['message_type'] = "promotional";
            //message_ref
            $dataSend[$key]['message_ref'] = time();
        }

        // Send request crossgate
        $url = "https://sms.crossgatesolutions.com:18095/v1/bulksms/messages";
        $data = [
            "profile_code" => config('app.crossgate.profile_code'),
            "messages" => $dataSend,
            "dlr_callback_url" => route('grossgate.callback')
        ];
        $headers = [
            "profile_code" => config('app.crossgate.profile_code'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'api-key' => config('app.crossgate.api_key')
        ];
        // Send request
        $response = Http::withHeaders($headers)->post($url, $data);
        return $response->json();
    }
}
