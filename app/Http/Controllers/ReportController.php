<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function mostFoodCategory()
    {
        $most = Category::withCount('menus')
            ->orderByDesc('menus_count')
            ->first();

        return view('reports.most_food_category', compact('most'));
    }

    public function highestAvgPriceCategory()
    {
        $data = DB::table('categories')
            ->select('categories.name', DB::raw('AVG(menus.harga) as average_price'))
            ->join('menus', 'categories.id', '=', 'menus.category_id')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('average_price')
            ->first();

        return view('reports.highest_avg_price_category', compact('data'));
    }

    public function menuCountPerCategory()
    {
        $data = DB::table('categories')
            ->select('categories.name', DB::raw('COUNT(menus.id) as total'))
            ->leftJoin('menus', 'categories.id', '=', 'menus.category_id')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        return view('reports.menu_count_per_category', compact('data'));
    }
    public function mostExpensiveAndCheapestMenu()
    {
        $max = DB::table('menus')->orderByDesc('harga')->first();
        $min = DB::table('menus')->orderBy('harga')->first();

        return view('reports.most_expensive_and_cheapest', compact('max', 'min'));
    }

    public function avgPricePerCategory()
    {
        $data = DB::table('menus')
            ->join('categories', 'menus.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', DB::raw('AVG(menus.harga) as avg_price'))
            ->groupBy('categories.id', 'categories.name')
            ->get();

        return view('reports.avg_price_per_category', compact('data'));
    }
}
