<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Show checkout page for cart items
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $cartItems = [];
        $total = 0;

        if ($user) {
            // Get cart items for authenticated user
            $cartItems = $user->cart()->with('product')->get();
            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->final_price;
            });
        } else {
            // Handle guest checkout if needed
            return redirect()->route('login')->with('message', 'Vui lòng đăng nhập để thanh toán');
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống');
        }

        return view('checkout.index', compact('cartItems', 'total'));
    }

    /**
     * Show checkout page for direct product purchase
     */
    public function buyNow(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock
        ]);

        $quantity = $request->input('quantity', 1);
        $total = $quantity * $product->final_price;

        // Create a temporary cart item for buy now
        $cartItem = (object) [
            'product' => $product,
            'quantity' => $quantity,
            'subtotal' => $total
        ];

        return view('checkout.buy-now', compact('cartItem', 'total', 'product'));
    }

    /**
     * Process checkout
     */
    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string|in:momo,zalopay,bank_transfer,cod',
            'shipping_name' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_district' => 'required|string|max:100',
            'notes' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();
            $orderNumber = 'ORD-' . strtoupper(Str::random(8));

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => $orderNumber,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'shipping_name' => $request->shipping_name,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_district' => $request->shipping_district,
                'notes' => $request->notes,
                'subtotal' => 0,
                'shipping_fee' => 30000, // 30k shipping fee
                'total' => 0,
            ]);

            $subtotal = 0;

            // Handle buy now or cart checkout
            if ($request->has('buy_now_product_id')) {
                // Buy now checkout
                $product = Product::findOrFail($request->buy_now_product_id);
                $quantity = $request->input('buy_now_quantity', 1);
                
                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->final_price,
                    'total' => $quantity * $product->final_price,
                ]);

                $subtotal = $quantity * $product->final_price;

                // Update product stock
                $product->decrement('stock', $quantity);
                $product->incrementSoldCount($quantity);
            } else {
                // Cart checkout
                $cartItems = $user->cart()->with('product')->get();
                
                foreach ($cartItems as $cartItem) {
                    $order->items()->create([
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                        'price' => $cartItem->product->final_price,
                        'total' => $cartItem->quantity * $cartItem->product->final_price,
                    ]);

                    $subtotal += $cartItem->quantity * $cartItem->product->final_price;

                    // Update product stock
                    $cartItem->product->decrement('stock', $cartItem->quantity);
                    $cartItem->product->incrementSoldCount($cartItem->quantity);
                }

                // Clear cart
                $user->cart()->delete();
            }

            // Update order totals
            $order->update([
                'subtotal' => $subtotal,
                'total' => $subtotal + $order->shipping_fee,
            ]);

            DB::commit();

            // Redirect to payment gateway or success page based on payment method
            return $this->handlePayment($order, $request->payment_method);

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Có lỗi xảy ra trong quá trình xử lý đơn hàng: ' . $e->getMessage());
        }
    }

    /**
     * Handle different payment methods
     */
    private function handlePayment(Order $order, $paymentMethod)
    {
        switch ($paymentMethod) {
            case 'momo':
                return $this->processMoMoPayment($order);
            case 'zalopay':
                return $this->processZaloPayPayment($order);
            case 'bank_transfer':
                return $this->processBankTransfer($order);
            case 'cod':
                return $this->processCOD($order);
            default:
                return redirect()->route('checkout.success', $order);
        }
    }

    /**
     * Process MoMo payment
     */
    private function processMoMoPayment(Order $order)
    {
        // MoMo integration would go here
        // For now, redirect to success page
        $order->update(['payment_status' => 'processing']);
        return redirect()->route('checkout.success', $order)
            ->with('success', 'Đơn hàng đã được tạo thành công! Vui lòng thanh toán qua MoMo.');
    }

    /**
     * Process ZaloPay payment
     */
    private function processZaloPayPayment(Order $order)
    {
        // ZaloPay integration would go here
        // For now, redirect to success page
        $order->update(['payment_status' => 'processing']);
        return redirect()->route('checkout.success', $order)
            ->with('success', 'Đơn hàng đã được tạo thành công! Vui lòng thanh toán qua ZaloPay.');
    }

    /**
     * Process bank transfer
     */
    private function processBankTransfer(Order $order)
    {
        $order->update(['payment_status' => 'pending']);
        return redirect()->route('checkout.success', $order)
            ->with('success', 'Đơn hàng đã được tạo thành công! Vui lòng chuyển khoản theo thông tin được cung cấp.');
    }

    /**
     * Process COD
     */
    private function processCOD(Order $order)
    {
        $order->update(['payment_status' => 'pending']);
        return redirect()->route('checkout.success', $order)
            ->with('success', 'Đơn hàng đã được tạo thành công! Bạn sẽ thanh toán khi nhận hàng.');
    }

    /**
     * Show success page
     */
    public function success(Order $order)
    {
        // Make sure user can only see their own orders
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        $order->load(['items.product']);
        
        return view('checkout.success', compact('order'));
    }
}