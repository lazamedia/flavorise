<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id() ?: optional(\App\Models\User::orderBy('id')->first())->id;
        $activeShift = $userId ? \App\Models\Shift::where('user_id', $userId)->active()->first() : null;
        
        if (!$activeShift) {
            return redirect()->route('apps.shifts.index')->with('success', 'Buka shift terlebih dahulu untuk mengakses POS.');
        }

        // Get menus with categories for frontend
        $menus = Menu::with('category')->available()->orderByDesc('created_at')->get();
        $categories = Category::active()->orderBy('name')->get(['id','name']);

        return view('apps.pos.index', compact('menus', 'categories'));
    }

    public function checkout(Request $request)
    {
        try {
            // Validate the frontend cart data
            $data = $request->validate([
                'cart' => ['required', 'array', 'min:1'],
                'cart.*.menu_id' => ['required', 'exists:menus,id'],
                'cart.*.quantity' => ['required', 'integer', 'min:1'],
                'cart.*.unit_price' => ['required', 'numeric', 'min:0'],
                'payment_method' => ['required', 'in:cash,qris'],
                'paid_amount' => ['required', 'numeric', 'min:0'],
                'tax' => ['nullable', 'numeric', 'min:0'],
                'discount' => ['nullable', 'numeric', 'min:0'],
                'customer_notes' => ['nullable', 'string'],
                'subtotal' => ['required', 'numeric', 'min:0'],
                'total' => ['required', 'numeric', 'min:0'],
                'change_amount' => ['nullable', 'numeric', 'min:0'],
            ]);

            $cart = $data['cart'];
            $subtotal = (float) $data['subtotal'];
            $tax = (float) ($data['tax'] ?? 0);
            $discount = (float) ($data['discount'] ?? 0);
            $total = (float) $data['total'];
            $paymentMethod = $data['payment_method'];
            $paidAmount = (float) $data['paid_amount'];
            $changeAmount = (float) ($data['change_amount'] ?? 0);

            // Validate payment amount for cash transactions
            if ($paymentMethod === 'cash' && $paidAmount < $total) {
                return response()->json([
                    'success' => false,
                    'message' => 'Uang yang dibayarkan tidak cukup'
                ], 400);
            }

            // Verify cart items exist and prices are correct
            $menuIds = collect($cart)->pluck('menu_id');
            $menus = Menu::whereIn('id', $menuIds)->get()->keyBy('id');
            
            foreach ($cart as $item) {
                $menu = $menus->get($item['menu_id']);
                if (!$menu) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Menu tidak ditemukan: ' . $item['menu_id']
                    ], 400);
                }
                
                // Verify price (allow small floating point differences)
                if (abs($menu->price - $item['unit_price']) > 0.01) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Harga menu tidak sesuai: ' . $menu->name
                    ], 400);
                }
            }

            // Get or create user and shift
            $userId = auth()->id();
            if (!$userId) {
                $userId = optional(User::query()->orderBy('id')->first())->id;
            }
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan untuk membuat transaksi.'
                ], 400);
            }

            $shift = Shift::where('user_id', $userId)->active()->first();
            if (!$shift) {
                $shift = Shift::create([
                    'user_id' => $userId,
                    'shift_date' => now()->toDateString(),
                    'start_time' => now()->format('H:i'),
                    'opening_cash' => 0,
                    'status' => 'active',
                ]);
            }

            // Create transaction
            $transaction = Transaction::create([
                'user_id' => $userId,
                'shift_id' => $shift->id,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => $discount,
                'total' => $total,
                'payment_method' => $paymentMethod,
                'paid_amount' => $paidAmount,
                'change_amount' => $changeAmount,
                'customer_notes' => $data['customer_notes'] ?? null,
                'status' => 'completed',
            ]);

            // Create transaction items
            foreach ($cart as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'menu_id' => $item['menu_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['quantity'] * $item['unit_price'],
                    'notes' => null,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan. Kode: ' . $transaction->transaction_code,
                'transaction_code' => $transaction->transaction_code,
                'transaction_id' => $transaction->id
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('POS Checkout Error: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }

    // Remove these methods as they're no longer needed for frontend cart
    // public function addToCart() - removed
    // public function updateCart() - removed  
    // public function removeFromCart() - removed
    // public function clearCart() - removed
    // private function getCart() - removed
    // private function saveCart() - removed
    // private function calculateCartTotals() - removed
}