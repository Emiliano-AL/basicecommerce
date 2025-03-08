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

    public function list(): Response
    {
        $products = Product::
            with('category')
            ->orderBy('created_at', 'desc')
            ->get();
        return Inertia::render('admin/index', [
            'products' => $products,
        ]);
    }

    public function add(): Response
    {
        $categories = Category::all();
        return Inertia::render('admin/products/add', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        $product = new Product(
            $request->only(['name', 'price', 'category_id'])
        );
        $product->save();
        return redirect()->route('products.list');
    }

    public function edit(Product $product): Response
    {
        return Inertia::render('admin/products/edit', [
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        $product->update(
            $request->only(['name', 'price', 'category_id'])
        );
        return redirect()->route('products.list');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.list');
    }

}
