<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use LukePOLO\LaraCart\Facades\LaraCart;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cartItems = LaraCart::getItems();
        $subTotal = LaraCart::subTotal(false);
        $shipping = 15;
        return view('frontend.cart.checkout', compact('cartItems', 'subTotal', 'shipping'));
    }

    public function placeOrder(Request $request)
    {
        if ($request->new_shipping_address)
            $shipping_address = ShippingAddress::create([
                'name' => $request->shipping_name,
                'email' => $request->shipping_email,
                'mobile_number' => $request->shipping_mobile_number,
                'address' => $request->shipping_address,
                'country' => $request->shipping_country,
                'city' => $request->shipping_city,
                'state' => $request->shipping_state,
                'zip_code' => $request->shipping_zip_code,
                'user_id' => auth()->user()->id,
            ]);
        else {
            // Todo: Handle this case
            $shipping_address = ShippingAddress::where('user_id', auth()->user()->id)->where('default', true)->find();
        }
        $order = Order::create([
            'total_price' => LaraCart::subTotal(false) + 15,
            'shipping_price' => 15,
            'payment_type' => $request->payment,
            'user_id' => auth()->user()->id,
            'shipping_address_id' => $shipping_address->id
        ]);
        foreach (LaraCart::getItems() as $cartItem)
            $order->products()->attach($cartItem->id, [
                'size_id' => 2, //$cartItem->size_id,
                'quantity' => $cartItem->qty,
                'color' => $cartItem->color,
            ]);
        LaraCart::emptyCart();
        return redirect()->route('index');
    }
}
