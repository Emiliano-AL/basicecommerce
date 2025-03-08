<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->get();
        $categories = Category::all();
        return Inertia::render('products/index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function show(Product $product): Response
    {
        return Inertia::render('products/detail', [
            'product' => $product,
        ]);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');
        $product = Product::find($productId);

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
