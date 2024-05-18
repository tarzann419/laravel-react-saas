<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeatureResource;
use App\Http\Resources\PackageResource;
use App\Models\Feature;
use App\Models\Packages;
use App\Models\Transactions;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    public function index()
    {
        $packages = Packages::all();
        $features = Feature::where('active', true)->get();

        return inertia('Credit/Index', [
            'packages' => PackageResource::collection($packages),
            'features' => FeatureResource::collection($features),
            'success' => session('success'),
            'error' => session('error'),
        ]);
    }

    public function buyCredits(Packages $package)
    {
        // stripe payment gateway
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $checkout_session = $stripe->checkout->sessions->create([
            // 'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $package->name . '-' . $package->credits . ' Credits',
                        ],
                        'unit_amount' => $package->price * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('credit.success', [], true), // generating absoolute urls because they would be passed to stripe
            'cancel_url' => route('credit.cancel', [], true), // generating absoolute urls because they would be passed to stripe
        ]);

        Transactions::create([
            'price' => $package->price,
            'credits' => $package->credits,
            'user_id' => auth()->id(),
            'package_id' => $package->id,
            'session_id' => $checkout_session->id,
            'status' => 'pending',
        ]);

        return redirect($checkout_session->url);
    }

    public function success()
    {
        // stripe success return callback url
        return to_route('credit.index')->with('success', 'Payment Successful');
    }

    public function cancel()
    {
        // stripe cancel return callback url
        return to_route('credit.index')->with('error', 'Payment failed. Please try again');
    }

    public function webhook(Request $request)
    {
        // stripe webhook url
        // after completing the payment, stripe will send a webhook to this url
        // then we perform the necessary actions like updating the users available credits
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');
        // get the entire payload
        $payload = @file_get_contents('php://input');
        // get the signature sent by stripe
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;
        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // invalid signature 
            return response('', 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $transaction = Transactions::where('session_id', $session->id)->first();

                if ($transaction && $transaction->status === 'pending') {
                    $transaction->status = 'paid';
                    $transaction->save();

                    // add to the users credit balance
                    $transaction->user->available_credits += $transaction->credits;
                    $transaction->user->save();
                }

            default:
                echo 'Received unexpected event type' . $event->type;
        }

        return response(''); // returns defualt of 200. so that tells stripe that all successful
    }
}
