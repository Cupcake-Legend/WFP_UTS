<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $menuId)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$menuId])) {
            $cart[$menuId]['quantity'] += 1;
        } else {
            $cart[$menuId] = [
                'quantity' => 1,
            ];
        }

        $request->session()->put("cart", $cart);
        return redirect()->back()->with('success', "Added to cart!");
    }

    public function showCheckout(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        $menuIds = array_keys($cart);

        $menus = Menu::whereIn('id', $menuIds)->get();

        foreach ($menus as $menu) {
            $menu->quantity = $cart[$menu->id]['quantity'];
        }

        $paymentMethods = PaymentMethod::all();

        return view('checkout', compact('menus', 'paymentMethods'));
    }

    public function updateCart(Request $request)
    {
        $quantities = $request->input('quantities');
        $porsis = $request->input('porsis');

        $cart = [];

        foreach ($quantities as $menuId => $qty) {
            $cart[$menuId] = [
                'quantity' => (int)$qty,
                'porsi' => $porsis[$menuId],
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()->route('checkout')->with('success', 'Cart updated!');
    }
    public function remove(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }
}
