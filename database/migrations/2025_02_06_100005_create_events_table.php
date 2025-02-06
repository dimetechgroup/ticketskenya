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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('venue')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('event_date');
            $table->enum('status', ['draft', 'pending', 'approved', 'cancelled', 'completed'])->default('draft');
            $table->string('image')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->string('meeting_link')->nullable();
            $table->string('currency')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_email')->nullable();
            $table->decimal('processing_fee', 10, 2)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
