<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateOrderStatus(Request $request, $id)
    {

        $order = Order::find($id);
        $order->status = $request->status;
        if ($request->status == 'delivered') {
            $order->delivered_date = DB::raw("CURRENT_DATE");
            $order->save();
            return redirect()->back()->with('success', 'Order delivered!');
        } elseif ($request->status == 'canceled') {
            $order->canceled_date = DB::raw("CURRENT_DATE");
            $order->save();
            return redirect()->back()->with('success', 'Order canceled!');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $order_items = $order->orderItems;
        return view('admin.order.show', compact('order', 'order_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order_items = OrderItem::where('order_id', $order->id)->get();
        foreach ($order_items as $item) {
            $item->delete();
        }
        $order->delete();

        return redirect()->back()->with('success', 'Order Deleted successfully');
    }

    public function deleteAll()
    {
        $orders = Order::get();
        if (!$orders->isEmpty()) {
            foreach ($orders as $order) {
                $order->delete();
                $order_items = OrderItem::where('order_id', $order->id)->get();
                foreach ($order_items as $item) {
                    $item->delete();
                }
            }
            return redirect()->back()->with('success', 'All orders deleted succesfully');
        } else {
            return redirect()->back()->with('failed', 'There is none order for delete');
        }
    }
}