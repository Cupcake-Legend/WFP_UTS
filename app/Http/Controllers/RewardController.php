<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\RewardDetail;
use Illuminate\Http\Request;

class RewardController extends Controller
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
            "poin" => "required|integer",
            "menu_id" => "required|integer|exists:menus,id",
        ]);

        $reward = new Reward();
        $reward->name = $request->name;
        $reward->poin = $request->poin;
        $reward->menu_id = $request->menu_id;

        $reward->save();

        return redirect()->route('admin.dashboard')->with('Message', 'Reward ' . $reward->name . ' has been added');
    }

    public function claimReward($rewardId)
    {
        RewardDetail::where('reward_id', $rewardId)
            ->where('user_id', auth()->id())
            ->update(['is_claimed' => 'YES']);

        return redirect()->route("index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Reward $reward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reward $reward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reward $reward)
    {
        $reward->name = $request->name;
        $reward->poin = $request->poin;
        $reward->menu_id = $request->menu_id;

        $reward->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reward $reward)
    {
        $reward->name;
        $reward->delete();

        return redirect()->route('admin.dashboard')->with('Message', 'Reward ' . $reward->name . ' has been deleted');
    }
}
