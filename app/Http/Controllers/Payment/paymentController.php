<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class paymentController extends Controller
{
    public function paymentWeb(Request $request)
    {
        // استرداد المستخدم المصادق عليه
        $user = auth()->guard('api')->user();
        // استرداد المفاتيح السرية من المتغيرات البيئية
        $apiSecretKey = env('CHARGILY_API_SECRET_KEY');
        $apiSecretKeyTest = env('CHARGILY_API_SECRET_KEY_TEST');

        $validator = validator::make($request->all(), [
            'price' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // إعداد البيانات للدفع
        $amount = $request->price;
        $currency = 'dzd'; // التأكد من استخدام الأحرف الكبيرة للعملة
        $successUrl = route('payment.page.successfuly', $user->id);

        // إنشاء الحمولة للطلب
        $payload = json_encode([
            'amount' => $amount,
            'currency' => $currency,
            'success_url' => $successUrl,
        ]);


        // إعداد جلسة cURL
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://pay.chargily.net/test/api/v2/checkouts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $apiSecretKeyTest",
                "Content-Type: application/json"
            ],
        ]);

        // تنفيذ الطلب وجلب الاستجابة
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        // التحقق من وجود أخطاء وإرجاع الاستجابة المناسبة
        if ($err) {
            return response()->json(['error' => "cURL Error: $err"], 500);
        } else {
            $decodedResponse = json_decode($response, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return response()->json(['success' => $decodedResponse], 200);
            } else {
                return response()->json(['error' => 'Invalid JSON response from API'], 500);
            }
        }
    }
}
