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
        Schema::create('training_batches', function (Blueprint $table) {

            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('training_course_id')->constrained()->onDelete('cascade');
            $table->string('batch_code')->unique();
            $table->string('batch_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('max_participants')->default(0);
            // $table->enum('status', ['open', 'full', 'ongoing', 'completed', 'cancelled'])->default('open');
            $table->string('status')->default('open')->comment("['open', 'full', 'ongoing', 'completed', 'cancelled']");
            $table->string('instructor')->nullable(); // connect to trainer later
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
        Schema::dropIfExists('training_batches');
    }
};
