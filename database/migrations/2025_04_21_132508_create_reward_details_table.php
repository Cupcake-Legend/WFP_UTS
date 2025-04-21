<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reward_details', function (Blueprint $table) {
            $table->foreign("reward_id")->references("id")->on("rewards");
            $table->foreign("user_id")->references("id")->on("users");
            $table->enum("is_claimed", ["YES", "NO"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_details');
    }
};
