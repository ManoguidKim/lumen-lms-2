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
        Schema::create('learner_training_applications', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('user_id');

            $table->foreignId('center_id');
            $table->foreignId('training_course_id');

            $table->string('application_number')->unique()->comment('Auto-generated application reference number');
            $table->date('application_date');

            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'enrolled',
                'cancelled'
            ])->default('pending');

            $table->foreignId('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->text('review_remarks')->nullable();

            $table->text('learner_remarks')->nullable()->comment('Additional notes from learner');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learner_training_applications');
    }
};
