<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use LukePOLO\LaraCart\Facades\LaraCart;

class CartController extends Controller
{

    public function index()
    {
        $cartItems = LaraCart::getItems();
        $subTotal = LaraCart::subTotal(false);
        $shipping = 15;
        return view('frontend.cart.cart', compact('cartItems', 'subTotal', 'shipping'));
    }

    public function addToCart(Product $product, Request $request)
    {
        LaraCart::add($product->id, $product->name, $request->quantity, $product->price, [
            'size' => $request->size,
            'color' => $request->color,
        ]);
        return redirect()->back()->with('success', 'You have added ' . $product->name . ' to your cart.');
    }

    public function removeFromCart(Product $product, Request $request)
    {
        $itemToBeRemoved = LaraCart::find(['id' => $product->id, 'color' => $request->color, 'size' => $request->size]);
        LaraCart::removeItem($itemToBeRemoved->getHash());
        return redirect()->back()->with('success', 'You have successfully removed product(s) from the cart.');
    }

    public function decreaseFromCart(Product $product, Request $request)
    {
        $itemQuantityToBeDecreased = LaraCart::find(['id' => $product->id, 'color' => $request->color, 'size' => $request->size]);
        LaraCart::updateItem($itemQuantityToBeDecreased->getHash(), 'qty', $itemQuantityToBeDecreased->qty - 1);
        return redirect()->back()->with('success', 'You have successfully decreased quantity of a product(s) from the cart.');
    }
}
