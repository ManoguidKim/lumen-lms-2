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
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();

            $table->string('name');
            $table->string('short_name')->nullable();
            $table->string('code')->unique()->nullable()->comment('Center identification code');

            $table->enum('type', [
                'assessment_center',
                'training_center',
                'both'
            ])->default('both');

            $table->text('address')->nullable()->comment('Complete address for display');

            $table->string('contact_number')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('contact_landline')->nullable();
            $table->string('email')->nullable();

            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');
            $table->string('logo_path')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('code');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centers');
    }
};
