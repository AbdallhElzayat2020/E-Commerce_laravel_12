<?php

namespace App\Http\Controllers\Website;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Website\OrderService;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Website\OrderShipping\OrderShippingRequest;
use App\Services\Website\MyFatoorahService;
use App\Notifications\CreateOrderNotification;

class CheckoutController extends Controller
{
    protected $orderService, $myFatoorahService;

    public function __construct(OrderService $orderService, MyFatoorahService $myFatoorahService)
    {
        $this->orderService = $orderService;
        $this->myFatoorahService = $myFatoorahService;
    }

    public function showCheckoutPage()
    {
        return view('frontend.pages.checkout');
    }

    public function checkout(OrderShippingRequest $request)
    {
        $shipping = $request->validated();

        // get invoice value from cart
        $invoiceValue = $this->orderService->getInvoiceValue($shipping);
        if ($invoiceValue < 1 || $invoiceValue == null) {
            return redirect()->back()->with('error', 'Cart is empty');
        }


        $data = [
            'CustomerName' => $shipping['first_name'] . ' ' . $shipping['last_name'],
            'NotificationOption' => 'LNK',
            'InvoiceValue' => $invoiceValue,
            'DisplayCurrencyIso' => 'EGP',
            'CustomerEmail' => $shipping['user_email'],
            'CallBackUrl' => 'http://localhost:8000/checkout/callback',
            'ErrorUrl' => 'http://localhost:8000/checkout/error',
            'Language' => app()->getLocale() == 'ar' ? 'ar' : 'en',
        ];
        $data = $this->myFatoorahService->checkout($data);

        // return $data;
        if ($url = $data["Data"]["InvoiceURL"]) {
            // store order
            $createOrder = $this->orderService->createOrder($shipping);
            if (!$createOrder) {
                Session::flash('error', 'Something went wrong');
                return redirect()->route('website.checkout.index');
            }
            // store transaction
            $createTransaction = $this->orderService->createTransaction($data, $createOrder->id);
            if (!$createTransaction) {
                Session::flash('error', 'Something went wrong');
                return redirect()->route('website.checkout.index');
            }
            return redirect($url);
        } else {
            Session::flash('error', 'Something went wrong');
            return redirect()->route('website.checkout.index');
        }
    }

    public function callback(Request $request)
    {
        $data = [];
        $data['key'] = $request->paymentId;
        $data['KeyType'] = 'paymentId';

        $response = $this->myFatoorahService->getPaymentStatus($data);

        // Change Order Status
        $transaction = Transaction::where('transaction_id', $response['Data']['InvoiceId'])->first();

        if ($transaction && $response['Data']['InvoiceStatus'] == 'Paid') {
            // Use a valid enum value for orders.status (pending, processing, shipped, delivered, cancelled)
            Order::where('id', $transaction->order_id)
                ->where('user_id', $transaction->user_id)
                ->update(['status' => 'processing']);

            $this->orderService->clearUserCart(auth('web')->user()->cart);


            // send notification to admin
            //            $order = Order::where('id', $order_id)->where('user_id', $user_id)->first();
            //            $admins = Admin::all();
            //            foreach ($admins as $admin) {
            //                $admin->notify(new CreateOrderNotification($order));
            //            }

            Session::flash('success', 'Payment successful');
            return redirect()->route('website.checkout.index');
        }
        Session::flash('error', 'Payment failed');
        return redirect()->route('website.checkout.index');
    }

    public function error()
    {
        // task set order status canceled
        Session::flash('error', 'Payment Failed try again Latter!');
        return redirect()->route('website.checkout.index');
    }
}
