<?php

namespace App\Http\Controllers\frontend;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Payment;
use App\Mail\OrderPlaced;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Notifications\Orders;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;


class CheckOutController extends Controller
{
    public $shippin_to_diffrent;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.checkout.index')->with([
            'discount' => $this->getNumbers()->get('discount'),
            'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
            'newTax' =>  $this->getNumbers()->get('newTax'),
            'newTotal' =>  $this->getNumbers()->get('newTotal'),
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {

        $validated = $request->validated();
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->subtotal = Cart::subtotal();
        $order->discount = isset(Session()->get('coupon')['discount']) ? Session()->get('coupon')['discount'] : 0.0;
        $order->tax = Cart::tax();
        $order->total = Cart::total();
        $order->firstname = $request->first_name;
        $order->lastname = $request->last_name;
        $order->email = $request->email;
        $order->mobile = $request->mobile;
        $order->address_line1 = $request->address1;
        $order->address_line2 = $request->address2;
        $order->city = $request->city;
        $order->province = $request->province;
        $order->country = $request->country;
        $order->zipcode = $request->zip;
        $order->status = 'ordered';
        $order->save();

        $this->sendNotifications();

        $payment = new Payment();
        $payment->user_id = Auth()->user()->id;
        $payment->total = Cart::total();
        $payment->payment_type = $request->paymentMethod;
        $payment->status = 'active';
        $payment->save();

        foreach (Cart::content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->user_id = Auth()->user()->id;
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->options = serialize($item->options);
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->save();
        }
        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug . ', ' . $item->qty;
        })->values()->toJson();
        if ($request->paymentMethod == 'cash') {
            $this->makeTransaction($order->id, 'cod', 'pending');
            $this->resetCart();
            session()->forget('coupon');
            Mail::send(new OrderPlaced($order));
            return redirect()->route('thankyou')->with('success', 'your payment has been successfully!');
        } elseif ($request->paymentMethod == 'credit') {
            $stripe = Stripe::make(env('STRIPE_KEY'));

            try {
                $charge = $stripe->charges()->create([
                    'amount' => $this->getNumbers()->get('newTotal'),
                    'currency' => 'CAD',
                    'source' => $request->stripeToken,
                    'description' => 'Order',
                    'receipt_email' => $request->email,
                    'metadata' => [
                        'contents' => $contents,
                        'quantity' => Cart::instance('default')->count(),
                        'discount' => collect(session()->get('coupon'))->toJson(),
                    ],
                ]);
                Cart::instance('default')->destroy();
                session()->forget('coupon');
                Mail::send(new OrderPlaced($order));
                return redirect()->route('thankyou')->with('success', 'your payment has been successfully!');
            } catch (CardErrorException  $e) {
                session()->flash('stripe_error', $e->getMessage());
            }
        }
    }

    public function resetCart()

    {
        Cart::instance('default')->destroy();
    }

    public function makeTransaction($order_id, $mode, $status)
    {
        $transaction = new Transaction();
        $transaction->user_id = Auth()->user()->id;
        $transaction->order_id = $order_id;
        $transaction->mode = $mode;
        $transaction->status = $status;
        $transaction->save();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon)->where('expiry_date', '>=', Carbon::today())->first();

        if (!$coupon) {
            return redirect()->route('checkout.index')->with('failed', 'invalid Or Exipred coupon ');
        }

        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $coupon->discount(Cart::subtotal()),
        ]);

        return redirect()->route('checkout.index')->with('success', 'coupon has been apply!');
    }

    public function removeCoupon()
    {
        session()->forget('coupon');

        return redirect()->route('checkout.index')->with('success', 'coupon has been removed!');
    }

    private function getNumbers()
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = ((Cart::subtotal()) - $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);
        return collect([
            'tax' => $tax,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
        ]);
    }

    public function sendNotifications()
    {
        $users = User::get();
        foreach ($users as $user) {
            if ($user->hasAnyRole('super-admin', 'admin', 'product-manager')) {
                $user->notify(new Orders('you have new order'));
            }
        }
        // dd($users->hasAnyRole('super-admin', 'admin', 'product-manager'));

        // $users->notify(new Orders('you have new order'));
        // foreach ($users->notifications as $notification) {
        //     dd($notification->data['order']);
        // }
    }
}