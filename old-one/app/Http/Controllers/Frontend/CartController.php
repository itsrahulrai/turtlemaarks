<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function index()
    {
        $items  = $this->cartService->getItems();
        $totals = $this->cartService->totals(session('coupon_code'));

        return view('site.cart', compact('items', 'totals'));
    }

    /** JSON payload consumed by the off-canvas cart drawer (assets/js/cart.js). */
    public function data()
    {
        $items  = $this->cartService->getItems();
        $totals = $this->cartService->totals(session('coupon_code'));

        return response()->json([
            'count'  => (int) $this->cartService->count(),
            'items'  => $items->map(fn ($i) => [
                'id'       => $i->id,
                'name'     => $i->name,
                'brand'    => $i->isService() ? 'Clinical Service' : ($i->product?->brand?->name ?? SITE_SHORT),
                'image'    => $i->image_url,
                'price'    => (float) $i->effective_price,
                'qty'      => (int) $i->quantity,
                'lineTotal'=> (float) $i->line_total,
            ])->values(),
            'totals' => [
                'subtotal' => (float) $totals['subtotal'],
                'discount' => (float) $totals['discount'],
                'shipping' => (float) $totals['shippingCharge'],
                'total'    => (float) $totals['total'],
            ],
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id'         => 'required|exists:products,id',
            'quantity'           => 'nullable|integer|min:1|max:50',
            'product_variant_id' => 'nullable|exists:product_variants,id',
        ]);

        $this->cartService->add(
            (int) $request->product_id,
            (int) $request->input('quantity', 1),
            $request->product_variant_id
        );

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item added to cart!',
                'count'   => $this->cartService->count(),
            ]);
        }

        return back()->with('success', 'Item added to cart!');
    }

    public function update(Request $request, int $cartId)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:50']);
        $this->cartService->update($cartId, (int) $request->quantity);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'totals'  => $this->cartService->totals(session('coupon_code')),
                'count'   => $this->cartService->count(),
            ]);
        }

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Request $request, int $cartId)
    {
        $this->cartService->remove($cartId);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'count'   => $this->cartService->count(),
            ]);
        }

        return back()->with('success', 'Item removed from cart.');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['coupon_code' => 'required|string']);
        $code   = strtoupper($request->coupon_code);
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon || !$coupon->isValid()) {
            $msg = 'Invalid or expired coupon.';
            return $request->expectsJson()
                ? response()->json(['success' => false, 'message' => $msg])
                : back()->with('error', $msg);
        }

        $subtotal = $this->cartService->getItems()->sum(fn ($i) => $i->line_total);
        if ($subtotal < $coupon->min_order_amount) {
            $msg = 'Minimum order amount ' . inr($coupon->min_order_amount) . ' required for this coupon.';
            return $request->expectsJson()
                ? response()->json(['success' => false, 'message' => $msg])
                : back()->with('error', $msg);
        }

        session(['coupon_code' => $code]);
        $totals = $this->cartService->totals($code);

        $msg = 'Coupon applied! You saved ' . inr($totals['discount']) . '.';

        return $request->expectsJson()
            ? response()->json(['success' => true, 'message' => $msg, 'totals' => $totals])
            : back()->with('success', $msg);
    }

    public function removeCoupon(Request $request)
    {
        session()->forget('coupon_code');

        return $request->expectsJson()
            ? response()->json([
                'success' => true,
                'message' => 'Coupon removed.',
                'totals'  => $this->cartService->totals(null),
            ])
            : back()->with('success', 'Coupon removed.');
    }
}
