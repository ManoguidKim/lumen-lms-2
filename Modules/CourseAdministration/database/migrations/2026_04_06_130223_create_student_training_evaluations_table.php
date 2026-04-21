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
        Schema::create('student_training_evaluations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            // Context
            $table->foreignId('training_batch_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('training_requirement_id')
                ->constrained()
                ->cascadeOnDelete();

            // Student being evaluated
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Rating (1–5)
            $table->unsignedTinyInteger('rating')
                ->comment('1 to 5 rating');

            // Optional remarks
            $table->text('remarks')->nullable();

            // Evaluator (trainer/admin)
            $table->foreignId('evaluated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Timestamp of evaluation
            $table->timestamp('evaluated_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_training_evaluations');
    }
};
