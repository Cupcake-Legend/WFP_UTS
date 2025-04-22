<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view("menu", compact("menus"));
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
        //
        $request->validate([
            "name" => "required|string",
            "deskripsi" => "required|string",
            "harga" => "required|integer",
            "nutrisi" => "required|string",
            "stock" => "required|integer",
            "poin" => "required|integer",
            "porsi" => "required|in:Small,Medium,Large",
        ]);

        $menu = new Menu();
        $menu->name = $request->name;
        $menu->deskripsi = $request->deskripsi;
        $menu->harga = $request->harga;
        $menu->nutrisi = $request->nutrisi;
        $menu->stock = $request->stock;
        $menu->poin = $request->poin;
        $menu->porsi = $request->porsi;
        $menu->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->name = $request->name;
        $menu->deskripsi = $request->deskripsi;
        $menu->harga = $request->harga;
        $menu->nutrisi = $request->nutrisi;
        $menu->stock = $request->stock;
        $menu->poin = $request->poin;
        $menu->porsi = $request->porsi;
        $menu->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
    }
}
