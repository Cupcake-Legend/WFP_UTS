<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function nutrition()
    {
        $categories = Category::with('menus')->get();
        return view('nutrition', compact('categories'));
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

    public function filterCategory(Request $request)
    {
        $category = $request->get('category');

        if ($category === 'All') {
            $menus = Menu::all();
        } else {
            $categoryModel = Category::where('name', $category)->first();

            if ($categoryModel) {
                $menus = Menu::where('category_id', $categoryModel->id)->get();
            } else {
                $menus = collect();
            }
        }

        $html = view('partials.menu-item', compact('menus'))->render();

        return response()->json(['html' => $html]);
    }
}
