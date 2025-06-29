<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
        $request->validate([
            "name" => "required|string",
            "deskripsi" => "required|string",
            "harga" => "required|integer",
            "nutrisi" => "required|string",
            "stock" => "required|integer",
            "point" => "required|integer",
            "category_id" => "required|exists:categories,id",
            "image" => "nullable|image|max:2048",
        ]);

        $menu = new Menu();

        $menu->name = $request->name;
        $menu->deskripsi = $request->deskripsi;
        $menu->harga = $request->harga;
        $menu->nutrisi = $request->nutrisi;
        $menu->point = $request->point;
        $menu->porsi = $request->porsi;
        $menu->category_id = $request->category_id;

        $menu->image = 'default.jpg';
        $menu->save();

        // Upload image jika ada
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = $menu->id . '.' . $ext;

            $path = public_path('images/menus');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            $file->move($path, $filename);
            $menu->image = $filename;
            $menu->save(); 
        }

        return redirect()->route('admin.dashboard')->with('Message', 'Menu '.$menu->name.' has been added');
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
        $request->validate([
            "name" => "required|string",
            "deskripsi" => "required|string",
            "harga" => "required|integer",
            "nutrisi" => "required|string",
            "stock" => "required|integer",
            "point" => "required|integer",
            "category_id" => "required|exists:categories,id",
            "image" => "nullable|image|max:2048",
        ]);

        $menu->name = $request->name;
        $menu->deskripsi = $request->deskripsi;
        $menu->harga = $request->harga;
        $menu->nutrisi = $request->nutrisi;
        $menu->stock = $request->stock;
        $menu->point = $request->point;
        $menu->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            $oldImagePath = public_path('images/menus/' . $menu->image);
            if ($menu->image && File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = $menu->id . '.' . $ext;
            $file->move(public_path('images/menus'), $filename);
            $menu->image = $filename;
        }

        $menu->save();

        return redirect()->route('admin.dashboard')->with('Message', 'Menu '.$menu->name.' has been updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->name;
        $menu->deskripsi;
        $menu->harga;
        $menu->nutrisi;
        $menu->stock;
        $menu->point;
        $menu->porsi;
        $menu->category_id;

        $menu->delete();

        return redirect()->route('admin.dashboard')->with('Message', 'Menu '.$menu->name.' has been deleted');
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
