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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('currency')->default('KES')->nullable();
            $table->enum('payment_status', ['pending', 'successful', 'failed', 'refunded'])->default('pending');
            $table->string('paystack_reference')->nullable();
            $table->string('receipt_number')->nullable();
            $table->json('gateway_response')->nullable();
            $table->string('gateway_status')->nullable();
            $table->string('gateway_response_id')->nullable();
            $table->string('gateway_channel')->nullable();


            $table->timestamps();
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
