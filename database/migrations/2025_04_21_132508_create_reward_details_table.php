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
            $table->foreignId('reward_id')->constrained('rewards');
            $table->foreignId('user_id')->constrained('users');
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
