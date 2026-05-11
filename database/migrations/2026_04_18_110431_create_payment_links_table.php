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
        Schema::create('payment_links', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('booking_id')->constrained()->onDelete('cascade');
            $blueprint->string('token')->unique();
            $blueprint->timestamp('expires_at');
            $blueprint->boolean('is_used')->default(false);
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_links');
    }
};
