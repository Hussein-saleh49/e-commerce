<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('orders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total'       => 'required|numeric|min:0',
            'status'      => 'required|in:pending,processing,completed,cancelled',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success','Order created successfully!');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        return view('orders.edit', compact('order','customers'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total'       => 'required|numeric|min:0',
            'status'      => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success','Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success','Order deleted successfully!');
    }
}
