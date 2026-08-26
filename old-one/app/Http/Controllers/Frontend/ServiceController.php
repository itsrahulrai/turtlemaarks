<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\CartService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function index()
    {
        $services = Service::active()->orderBy('sort_order')->paginate(12);
        return view('site.services.index', compact('services'));
    }

    public function show(string $slug)
    {
        $service = Service::active()->where('slug', $slug)->firstOrFail();
        $related = Service::active()->where('id', '!=', $service->id)->orderBy('sort_order')->limit(3)->get();

        return view('site.services.show', compact('service', 'related'));
    }

    public function addToCart(Request $request, Service $service)
    {
        $data = $request->validate([
            'quantity' => 'nullable|integer|min:1|max:10',
        ]);

        $this->cartService->addService($service->id, $data['quantity'] ?? 1);

        return back()->with('success', 'Service added to cart.');
    }
}
