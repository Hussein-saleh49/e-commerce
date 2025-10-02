<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Counts
        $productscount = Product::count();
        $customerscount = Customer::count();
        $ordercount     = Order::count();

        // Revenue 
        $revenue = Order::where('status', 'completed')->sum('total');

        // Top products
        $topProducts = Product::select('products.id', 'products.name', DB::raw('SUM(order_product.quantity) as total_sold'))
            ->join('order_product', 'products.id', '=', 'order_product.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // Monthly Sales 
        $monthlySales = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total) as total_sales')
            )
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->pluck('total_sales', 'month');

        // Latest Orders
        $orders = Order::with('customer')->latest()->paginate(10);

        return view("pages.index", compact(
            "productscount",
            "customerscount",
            "ordercount",
            "orders",
            "topProducts",
            "revenue",
            "monthlySales"
        ));
    }
}

