<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class paymentController extends Controller
{
    public function PaymentWeb(Request $request)
    {
        $apiSecretKey = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://pay.chargily.net/test/api/v2/checkouts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n  \"amount\": 1000,\n  \"currency\": \"dzd\",\n  \"success_url\": \"https://example.com\"\n}",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $apiSecretKey",
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $signature = isset($_SERVER['HTTP_SIGNATURE']) ? $_SERVER['HTTP_SIGNATURE'] : null;

        $payload = file_get_contents('php://input');

        if (!$signature) {
            exit;
        }

        $computedSignature = hash_hmac('sha256', $payload, $apiSecretKey);

        if (!hash_equals($signature, $computedSignature)) {
            exit();
        } else {
            $event = json_decode($payload);

            switch ($event->type) {
                case 'checkout.paid':
                    $checkout = $event->data;
                    break;
                case 'checkout.canceled':
                    $checkout = $event->data;
                    break;
                case 'checkout.failed':
                    $checkout = $event->data;
                    break;
            }
        }
        http_response_code(200);

        if ($err) {
            return response()->json("cURL Error #:" . $err);
        } else {
            return response()->json("cURL success #:" . $checkout);
        }
    }
}
