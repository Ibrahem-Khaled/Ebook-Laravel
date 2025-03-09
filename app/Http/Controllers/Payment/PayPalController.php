<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function checkout(Request $request)
    {
        $price = $request->price;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $order = [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "DZD", // العملة المستخدمة للدفع باستخدام بايبال هي الدينار الجزائري
                        "value" => $price // قيمة المبلغ المراد دفعه
                    ]
                ]
            ],
            "application_context" => [
                "cancel_url" => route('paypal.cancel'),
                "return_url" => route('paypal.success'),
            ]
        ];

        $response = $provider->createOrder($order);

        if (isset($response['id']) && $response['id'] != null) {
            // استخرج رابط الموافقة من بايبال
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return response()->json(['error' => 'فشلت عملية الدفع']);
    }

    // عند نجاح الدفع
    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        // يتم التقاط عملية الدفع باستخدام التوكن المرسل من بايبال
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // قم بتحديث بيانات الطلب في قاعدة البيانات هنا
            return redirect()->route('home')->with('success', 'تمت عملية الدفع بنجاح');
        }

        return redirect()->route('home')->with('error', 'فشلت عملية الدفع');
    }

    // في حالة إلغاء العملية
    public function cancel()
    {
        return redirect()->route('home')->with('error', 'تم إلغاء عملية الدفع');
    }

}
