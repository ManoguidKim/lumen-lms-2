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
        Schema::create('training_batch_students', function (Blueprint $table) {

            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('training_batch_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->nullable()->constrained('learners')->onDelete('cascade');
            $table->date('enrollment_date');
            $table->string('enrollment_status')->default('enrolled');

            // Manually inputted fields -- I think
            $table->decimal('final_score', 5, 2)->nullable();
            $table->enum('final_grade', ['A', 'B', 'C', 'D', 'F', 'Incomplete'])->nullable();

            // Certification details
            $table->boolean('certificate_issued')->default(false);
            $table->date('certificate_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_batch_students');
    }
};
