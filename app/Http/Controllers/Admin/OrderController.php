<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User; // <-- أضف هذا
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * عرض لوحة معلومات المدير مع الإحصائيات.
     */
    public function dashboard()
    {
        $totalRevenue = Order::sum('total_price');
        $totalOrders = Order::count();
        // نحصي المستخدمين الذين ليسوا مديرين
        $totalCustomers = User::where('role', 'user')->count(); 

        // جلب أحدث 5 طلبات مع أسماء المستخدمين
        $latestOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'latestOrders'
        ));
    }

    /**
     * عرض قائمة بجميع الطلبات.
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * عرض طلب محدد.
     */
    public function show(Order $order)
    {
        $order->load('user', 'items.product');
        $statuses = Order::STATUSES;
        return view('admin.orders.show', compact('order', 'statuses'));
    }
    
    /**
     * تحديث حالة الطلب.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', Rule::in(Order::STATUSES)],
        ]);
        
        $order->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Order status has been updated successfully!');
    }
}