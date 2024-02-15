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
        // Save user's shipping address
        if ($request->ship_to_different_address) {
            $shippingAddress = ShippingAddress::create([
                'name' => $request->shipping_location_name,
                'email' => $request->shipping_location_email,
                'phone_number' => $request->shipping_location_phone,
                'address' => $request->shipping_location_address,
                'country' => $request->shipping_address_country,
                'city' => $request->shipping_location_city,
                'state' => $request->shipping_location_state,
                'zip_code' => $request->shipping_location_zip_code,
            ]);
        }

        // Create Order
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'shipping_address_id' => $shippingAddress->id,
            'payment_type' => $request->payment,
            'sub_total' => LaraCart::subTotal(false),
            'shipping' => 15
        ]);

        // Save products to the above order
        foreach (LaraCart::getItems() as $cartItem)
            $order->products()->attach($order->id, [
                'product_id' => $cartItem->id,
                'size_id' => 2,
                'color' => $cartItem->color,
                'quantity' => $cartItem->qty
            ]);

        // Todo: Proceed to payment
    }
}
