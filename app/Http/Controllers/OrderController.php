<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $menus = Menu::all();
        return view('order', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'total' => 'required|integer',
            'status' => 'required|in:PROCESS,DONE',
            'order_method' => 'required|in:DINEIN,TAKEAWAY',
            'order_details' => 'required|array',
            'order_details.*.menu_id' => 'required|exists:menus,id',
            'order_details.*.notes' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $request->user_id,
                'payment_method_id' => $request->payment_method_id,
                'total' => $request->total,
                'status' => $request->status,
                'order_method' => $request->order_method,
            ]);

            foreach ($request->order_details as $orderDetail) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'menu_id' => $orderDetail['menu_id'],
                    'notes' => $orderDetail['notes'] ?? '',
                ]);
            }

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
        $order->status = $request->status;
        $order->order_method = $request->order_method;
        $order->total = $request->total;
        $order->save();

        if ($request->has('order_details')) {
            foreach ($request->order_details as $orderDetailData) {
                OrderDetail::updateOrCreate(
                    [
                        'order_id' => $order->id,
                        'menu_id' => $orderDetailData['menu_id']
                    ],
                    ['notes' => $orderDetailData['notes'] ?? '']
                );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->orderDetails()->delete();
        $order->delete();
    }
}
