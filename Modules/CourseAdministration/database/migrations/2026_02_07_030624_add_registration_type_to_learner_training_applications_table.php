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
            $table->enum('registration_type', ['online', 'onsite'])
                ->default('online');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learner_training_applications', function (Blueprint $table) {
            $table->dropColumn('registration_type');
        });
    }
};
