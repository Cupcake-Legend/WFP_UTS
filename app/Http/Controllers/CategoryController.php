<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->deskripsi = $request->deskripsi;
        $category->save();

        return redirect()->route('admin.dashboard')->with('success', 'Category ' . $category->name . ' has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->deskripsi = $request->deskripsi;
        $category->save();
        return redirect()->route('admin.dashboard')->with('success', 'Category ' . $category->name . ' has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->name;
        $category->deskripsi;
        $category->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Category ' . $category->name . ' has been deleted');
    }
}
