<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function paymentWeb(Request $request)
    {
        // استرداد المستخدم المصادق عليه
        $user = auth()->guard('api')->user();
        // استرداد المفاتيح السرية من المتغيرات البيئية
        $apiSecretKey = env('CHARGILY_API_SECRET_KEY');
        $apiSecretKeyTest = env('CHARGILY_API_SECRET_KEY_TEST');

        $validator = Validator::make($request->all(), [
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
        $currency = 'DZD'; // التأكد من استخدام الأحرف الكبيرة للعملة
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
            CURLOPT_URL => "https://pay.chargily.net/api/v2/checkouts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $apiSecretKey",
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

    public function index()
    {
        $payments = Payment::all();
        return view('payment', compact('payments'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        // Create payment
        $payment = Payment::create([
            'description' => $request->description,
            'amount' => $request->amount,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Payment created successfully.');
    }

    public function update(Request $request, Payment $payment)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($payment->image) {
                Storage::disk('public')->delete($payment->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $payment->image;
        }

        // Update payment
        $payment->update([
            'description' => $request->description,
            'amount' => $request->amount,
            'image' => $imagePath,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        // Delete the image if it exists
        if ($payment->image) {
            Storage::disk('public')->delete($payment->image);
        }

        // Delete the payment
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
