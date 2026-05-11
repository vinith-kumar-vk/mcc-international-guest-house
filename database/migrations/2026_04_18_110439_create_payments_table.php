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
        Schema::create('payments', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('booking_id')->constrained()->onDelete('cascade');
            $blueprint->string('txnid')->unique();
            $blueprint->string('payu_id')->nullable();
            $blueprint->decimal('amount', 10, 2);
            $blueprint->string('currency', 3)->default('INR');
            $blueprint->string('status'); // initiated, success, failed, cancelled
            $blueprint->string('payment_mode')->nullable();
            $blueprint->text('error_message')->nullable();
            $blueprint->json('raw_response')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
