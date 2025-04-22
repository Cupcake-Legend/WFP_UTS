<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "isi" => "required|string",
            "order_id" => "required|integer|exists:orders,id"
        ]);

        $notification = new Notification();
        $notification->isi = $request->isi;
        $notification->order_id = $request->order_id;
        $notification->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        $notification->isi = $request->isi;
        $notification->order_id = $request->order_id;
        $notification->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
    }
}
