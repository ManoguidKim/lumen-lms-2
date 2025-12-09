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
        Schema::create('training_courses', function (Blueprint $table) {

            $table->id();
            $table->uuid('uuid')->unique();

            $table->string('course_code')->unique();
            $table->string('course_name');
            $table->text('description')->nullable();
            $table->integer('duration_hours')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->boolean('is_tesda_course')->default(false);
            $table->string('tr_number')->nullable()->unique()->comment('This refers to TESDA course training regulation number. Required only if this is a  tesda course');

            $table->string('instructor')->nullable(); // connect to trainer later
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_courses');
    }
};
