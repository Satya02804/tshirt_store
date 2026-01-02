<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // 1. Validate Input (Added payment_method)
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|string', // ✅ Added validation
            'cart' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            $totalAmount = 0;
            $orderItemsData = [];

            foreach ($request->cart as $item) {
                $product = Product::find($item['id']);

                if ($product) {
                    // Calculate discounted price
                    $price = $product->price;
                    if($product->discount > 0) {
                        $price = round($product->price - ($product->price * ($product->discount / 100)));
                    }

                    $qty = isset($item['quantity']) ? $item['quantity'] : 1;

                    // Calculate total based on Quantity
                    $totalAmount += ($price * $qty);

                    $orderItemsData[] = [
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'price' => $price
                    ];
                }
            }

            // Create Master Order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'total_price' => $totalAmount,
                'shipping_address' => $request->address,
                'phone' => $request->phone,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            // Save Order Items
            foreach ($orderItemsData as $data) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $data['product_id'],
                    'quantity' => $data['quantity'],
                    'price' => $data['price']
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Order placed successfully!',
                'redirect_url' => route('tshirt.index')
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => 'Failed to place order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function myOrders()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Product.myOrder', compact('orders'));
    }
}
