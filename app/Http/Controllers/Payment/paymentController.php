<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class paymentController extends Controller
{
    public function PaymentWeb()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://pay.chargily.net/test/api/v2/checkouts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n  \"items\": [\n    {\n      \"price\": \"12\",\n      \"quantity\": 1\n    }\n  ],\n  \"amount\": 123,\n  \"currency\": \"dza\",\n  \"payment_method\": \"<string>\",\n  \"success_url\": \"<string>\",\n  \"customer_id\": \"<string>\",\n  \"failure_url\": \"<string>\",\n  \"webhook_endpoint\": \"<string>\",\n  \"description\": \"<string>\",\n  \"locale\": \"<string>\",\n  \"shipping_address\": \"<string>\",\n  \"collect_shipping_address\": true,\n  \"percentage_discount\": 123,\n  \"amount_discount\": 123,\n  \"metadata\": [\n    {}\n  ]\n}",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer <token>",
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
}
