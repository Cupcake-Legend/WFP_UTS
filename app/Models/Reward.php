<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "poin",
        "menu_id"
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function rewardDetails(): HasMany
    {
        return $this->hasMany(RewardDetail::class);
    }
}
