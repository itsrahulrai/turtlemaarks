<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Appointment;
use App\Models\Order;
use App\Models\ReturnRequest;
use App\Services\ImageService;
use App\Services\OrderService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerDashboardController extends Controller
{
    public function __construct(
        private OrderService $orderService,
        private ImageService $imageService
    ) {}

    public function index()
    {
        $user = Auth::user();

        $recentOrders = $user->orders()->with('items')->latest()->take(5)->get();
        $totalOrders  = $user->orders()->count();
        $totalSpent   = $user->orders()->where('payment_status', 'paid')->sum('total');
        $wishlistCount = $user->wishlists()->count();

        $nextAppointment = Appointment::with('service')
            ->where('user_id', $user->id)
            ->upcoming()
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->first();

        $totalAppointments    = Appointment::where('user_id', $user->id)->count();
        $upcomingAppointments = Appointment::where('user_id', $user->id)->upcoming()->count();

        return view('site.account.dashboard', compact(
            'user', 'recentOrders', 'totalOrders', 'totalSpent', 'wishlistCount',
            'nextAppointment', 'totalAppointments', 'upcomingAppointments'
        ));
    }

    public function orders(Request $request)
    {
        $query = Auth::user()->orders()->with('items.product')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('site.account.orders', compact('orders'));
    }

    public function orderShow(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        $order->load(['items.product', 'items.productVariant', 'payment', 'returnRequest']);

        return view('site.account.order-detail', compact('order'));
    }

    /** Public order tracker (also works for guests who know the order number). */
    public function tracking(Request $request)
    {
        $order = null;

        if ($request->filled('order')) {
            $query = Order::with('items')->where('order_number', trim($request->order));

            // Guests may only look up by exact order number; logged-in users see their own.
            $order = $query->first();
        }

        return view('site.order-tracking', compact('order'));
    }

    public function appointments()
    {
        $appointments = Appointment::with('service')
            ->where('user_id', Auth::id())
            ->orderByDesc('appointment_date')
            ->orderByDesc('appointment_time')
            ->paginate(10);

        return view('site.account.appointments', compact('appointments'));
    }

    public function cancelOrder(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);

        try {
            $this->orderService->cancel($order);
            return back()->with('success', 'Order cancelled successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function downloadInvoice(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        $order->load(['user', 'items.product']);

        $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));

        return $pdf->download('invoice-' . $order->order_number . '.pdf');
    }

    public function profile()
    {
        $user = Auth::user()->load('addresses');

        return view('site.account.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'   => 'required|string|max:100',
            'phone'  => 'nullable|string|max:15|unique:users,phone,' . $user->id,
            'dob'    => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'avatar' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('avatar')) {
            $this->imageService->delete($user->avatar);
            $data['avatar'] = $this->imageService->store($request->file('avatar'), 'avatars');
        }

        $user->update($data);

        return back()->with('success', 'Profile updated.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => $request->password]);

        return back()->with('success', 'Password changed successfully.');
    }

    public function addresses()
    {
        return redirect()->route('account.profile');
    }

    public function storeAddress(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'phone'         => 'required|string|max:15',
            'address_line1' => 'required|string|max:200',
            'address_line2' => 'nullable|string|max:200',
            'city'          => 'required|string|max:100',
            'state'         => 'required|string|max:100',
            'pincode'       => 'required|string|max:10',
            'type'          => 'nullable|in:home,work,other',
            'is_default'    => 'nullable|boolean',
        ]);

        $data['user_id'] = Auth::id();

        if (!empty($data['is_default'])) {
            Address::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        Address::create($data);

        return back()->with('success', 'Address added.');
    }

    public function deleteAddress(Address $address)
    {
        abort_unless($address->user_id === Auth::id(), 403);
        $address->delete();

        return back()->with('success', 'Address deleted.');
    }

    public function returnRequest(Request $request, Order $order)
    {
        abort_unless($order->user_id === Auth::id() && $order->canBeReturned(), 403);

        $data = $request->validate([
            'reason'      => 'required|string|max:200',
            'description' => 'nullable|string|max:1000',
            'images.*'    => 'nullable|image|max:2048',
        ]);

        $data['order_id'] = $order->id;
        $data['user_id']  = Auth::id();

        if ($request->hasFile('images')) {
            $data['images'] = app(ImageService::class)->storeMultiple($request->file('images'), 'returns');
        }

        ReturnRequest::create($data);

        return back()->with('success', 'Return request submitted.');
    }
}
