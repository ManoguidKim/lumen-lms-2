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
        Schema::table('learner_training_applications', function (Blueprint $table) {
            $table->foreignId('training_batch_id')->nullable()->after('training_course_id')->constrained('training_batches')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learner_training_applications', function (Blueprint $table) {
            $table->dropForeign(['training_batch_id']);
            $table->dropColumn('training_batch_id');
        });
    }
};
