<?php

namespace App\Http\Controllers;

use App\Models\RewardDetail;
use Illuminate\Http\Request;

class RewardDetailController extends Controller
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
            'reward_id' => 'required|exists:rewards,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $rewardDetail = new RewardDetail();

        $rewardDetail->reward_id = $request->reward_id;
        $rewardDetail->user_id = $request->user_id;
        $rewardDetail->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(RewardDetail $rewardDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RewardDetail $rewardDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RewardDetail $rewardDetail)
    {
        $request->validate([
            'reward_id' => 'required|exists:rewards,id',
            'user_id' => 'required|exists:users,id',
            'is_claimed' => 'required|in:YES,NO'
        ]);


        $rewardDetail->reward_id = $request->reward_id;
        $rewardDetail->user_id = $request->user_id;
        $rewardDetail->is_claimed = $request->is_claimed;
        $rewardDetail->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RewardDetail $rewardDetail)
    {
        $rewardDetail->delete();
    }
}
