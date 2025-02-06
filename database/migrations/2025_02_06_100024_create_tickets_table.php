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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->string('currency')->default('KES');
            $table->integer('available_qty')->default(0);
            $table->longText('description')->nullable();
            $table->enum('status', ['draft', 'active', 'sold out', 'cancelled'])->default('draft');
            $table->integer('max_per_user')->default(100);
            $table->integer('min_per_user')->default(1);
            $table->string('promo_code')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
