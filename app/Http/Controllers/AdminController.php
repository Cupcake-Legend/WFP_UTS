<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Reward;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('menus')->get();
        $menus = Menu::with('category')->get();
        $rewards = Reward::all();
        
        return view('admin.index', compact('categories', 'menus', 'rewards'));
    }
}
