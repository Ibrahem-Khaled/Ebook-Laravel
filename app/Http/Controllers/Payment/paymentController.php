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
            CURLOPT_URL => "https://pay.chargily.net/test/api/v2/products",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n  \"name\": \"Super Product\"\n}",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer <live_sk_wyHSWYj0MrHw6Z1ZUiUPkqrZoBL2t6M2C6GXOyxy>",
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
