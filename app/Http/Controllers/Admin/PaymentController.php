<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackagePurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;


class PaymentController extends Controller
{
    public function buyPackage()
    {
        if (Auth::check()) {
            if (Auth::user()->utype == 'VDR') {
                return redirect()->route('vendor.package');
            } else {
                return redirect()->route('vdrregisterview');
            }
        } else {
            return redirect()->route('vdrregisterview');
        }
    }
    public function checkout($slug)
    {
        $package = Package::where('pslug', $slug)->firstOrFail();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $razorpayOrder = $api->order->create([
            'receipt' => 'order_rcpt_' . now()->timestamp,
            'amount' => $package->price * 100,
            'currency' => 'INR',
        ]);

        return view('payment.checkout', [
            'package' => $package,
            'razorpayOrder' => $razorpayOrder,
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'razorpay_signature' => 'required|string',
            'package_id' => 'required|exists:packages,id',
        ]);

        // Step 1: Signature verification
        $generatedSignature = hash_hmac(
            'sha256',
            $request->razorpay_order_id . '|' . $request->razorpay_payment_id,
            env('RAZORPAY_SECRET')
        );

        if ($generatedSignature !== $request->razorpay_signature) {
            \Log::warning('Razorpay signature mismatch', $request->all());
            return redirect()->back()->with('error', 'Payment verification failed!');
        }

        // Step 2: Save to DB
        $package = Package::findOrFail($request->package_id);
        $validUpto = now()->addDays($package->validity);

        PackagePurchase::create([
            'user_id' => auth()->id(),
            'package_id' => $package->id,
            'transcation_id' => $request->razorpay_payment_id,
            'amonut' => $package->price,
            'status' => 1,
            'valid_upto' => $validUpto,
            'count' => $package->count,
        ]);

        return redirect()->route('vendor.package')->with('success', 'Payment completed successfully!');
    }
}
