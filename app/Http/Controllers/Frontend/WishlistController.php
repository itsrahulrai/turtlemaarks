<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use App\Support\TmCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /** Public page — guests see the empty state with a prompt to sign in. */
    public function index()
    {
        $products = [];

        if (Auth::check()) {
            $ids = Wishlist::where('user_id', Auth::id())->pluck('product_id')->all();

            $products = array_values(array_filter(
                array_map(fn ($id) => TmCatalog::find((string) $id), $ids)
            ));
        }

        return view('site.wishlist', compact('products'));
    }

    public function toggle(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $existing = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            $existing->delete();
            $inWishlist = false;
            $message    = 'Removed from wishlist.';
        } else {
            Wishlist::create(['user_id' => Auth::id(), 'product_id' => $request->product_id]);
            $inWishlist = true;
            $message    = 'Added to wishlist!';
        }

        $count = Wishlist::where('user_id', Auth::id())->count();

        if ($request->expectsJson()) {
            return response()->json([
                'success'    => true,
                'inWishlist' => $inWishlist,
                'count'      => $count,
                'message'    => $message,
            ]);
        }

        return back()->with('success', $message);
    }

    public function clear(Request $request)
    {
        Wishlist::where('user_id', Auth::id())->delete();

        return $request->expectsJson()
            ? response()->json(['success' => true, 'count' => 0, 'message' => 'Wishlist cleared.'])
            : back()->with('success', 'Wishlist cleared.');
    }
}
