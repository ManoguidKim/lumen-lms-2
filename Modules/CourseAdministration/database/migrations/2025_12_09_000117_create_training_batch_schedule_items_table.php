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
        // Create Training Batch Schedule Items Table
        Schema::create('training_batch_schedule_items', function (Blueprint $table) {

            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('training_batch_id')->constrained()->onDelete('cascade');
            $table->foreignId('training_schedule_item_id')->nullable()->constrained()->onDelete('set null');
            $table->string('session_title');
            $table->text('description')->nullable();

            $table->string('session_type');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_batch_schedule_items');
    }
};
