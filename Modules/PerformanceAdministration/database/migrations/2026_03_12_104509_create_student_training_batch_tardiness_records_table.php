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
        Schema::create('student_training_batch_tardiness_records', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();

            $table->foreignId('training_batch_id')
                ->constrained('training_batches')
                ->name('stbtr_training_batch_id_foreign') // ✅ short custom name
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained('users')
                ->name('stbtr_user_id_foreign') // ✅ short custom name
                ->onDelete('cascade');

            $table->date('tardiness_date');
            $table->time('expected_check_in_time');
            $table->time('actual_check_in_time');
            $table->unsignedInteger('minutes_late');

            $table->enum('severity', ['minor', 'moderate', 'severe'])->default('minor');

            $table->text('remarks')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_training_batch_tardiness_records');
    }
};
