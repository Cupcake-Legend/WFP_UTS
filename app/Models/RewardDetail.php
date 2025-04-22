<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RewardDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "reward_id",
        "user_id",
        "is_claimed"
    ];

    protected $attributes = [
        "is_claimed" => "NO"
    ];



    public function reward(): BelongsTo
    {
        return $this->belongsTo(Reward::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
