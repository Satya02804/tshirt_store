<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        // Apply permission middleware to product management only
        $this->middleware('permission:create-products')->only(['store']);
        $this->middleware('permission:edit-products')->only(['update']);
        $this->middleware('permission:delete-products')->only(['delete']);
    }

    // Public - no auth needed
    public function index()
    {
        return view('T-shirt.tshirt');
    }

    //  Public - no auth needed
    public function fetchProducts()
    {
        $products = Product::all();
        return response()->json([
            'status' => 200,
            'products' => $products
        ]);
    }

   //  Check authentication and checkout permission (API endpoint)
    public function prepareCheckout()
    {
        // 1. Check if user is authenticated
        if (!auth()->check()) {
            return response()->json([
                'status' => 'guest',
                'url' => route('login'),
                'message' => 'Please login to checkout'
            ]);
        }
        // 2. Check if user has checkout permission
        if (!auth()->user()->can('checkout')) {
            return response()->json([
                'status' => 'unauthorized',
                'message' => 'You do not have permission to checkout. Contact administrator.',
                'redirect_url' => route('tshirt.index')
            ]);
        }

        // 3. User is authenticated and has permission
        return response()->json([
            'status' => 'authorized',
            'message' => 'Checkout authorized',
            'redirect_url' => route('checkout.page')
        ]);
    }

    //  Show checkout page (with permission check)
    public function showCheckout()
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to checkout');
        }

        // Check if user has checkout permission
        if (!auth()->user()->can('checkout')) {
            return redirect()->route('tshirt.index')
                ->with('error', 'You do not have permission to checkout. Please contact administrator.');
        }

        return view('Product.checkout');
    }

    // Product CRUD methods
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required|url',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        Product::create([
            'name' => $request->name,
            'url' => $request->url,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
        ]);

        return redirect('/dashboard')->with('success', 'T-shirt added successfully!');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if ($product) {
            $productName = $product->name;
            $product->delete();
            return redirect('/dashboard')->with('success', "'{$productName}' deleted successfully!");
        } else {
            return redirect('/dashboard')->with('error', 'Failed to delete product. Please try again!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required|url',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        $product = Product::find($id);

        if ($product) {
            $product->update([
                'name' => $request->name,
                'url' => $request->url,
                'price' => $request->price,
                'discount' => $request->discount ?? 0
            ]);
        }

        return redirect('/dashboard')->with('success', 'T-shirt updated successfully!');
    }
}
