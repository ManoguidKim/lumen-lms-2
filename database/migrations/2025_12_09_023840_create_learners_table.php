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
        Schema::create('learners', function (Blueprint $table) {

            $table->id();
            $table->string('uli')->nullable()->comment('Unique Learners Identifier');
            $table->string('picture_path')->nullable();

            $table->string('school_name')->nullable();
            $table->text('school_address')->nullable();

            $table->string('assessment_title')->nullable();
            $table->enum('assessment_type', ['full_qualification', 'coc', 'renewal'])->nullable();

            $table->enum('client_type', [
                'tvet_graduating_student',
                'tvet_graduate',
                'industry_worker',
                'k12',
                'owf'
            ])->nullable()->comment('Type of learner/client');

            $table->string('surname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('middle_initial', 5)->nullable();
            $table->string('name_extension', 10)->nullable();

            $table->string('address_number_street')->nullable();
            $table->string('address_barangay')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_district')->nullable();
            $table->string('address_province')->nullable();
            $table->string('address_region')->nullable();
            $table->string('address_zip_code', 10)->nullable();

            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();

            $table->enum('sex', ['male', 'female'])->nullable();
            $table->enum('civil_status', ['single', 'married', 'widow', 'separated'])->nullable();

            $table->string('contact_tel')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_fax')->nullable();
            $table->string('contact_others')->nullable();

            $table->enum('educational_attainment', [
                'elementary_graduate',
                'high_school_graduate',
                'tvet_graduate',
                'college_level',
                'college_graduate',
                'others'
            ])->nullable();
            $table->string('educational_attainment_others')->nullable();

            $table->enum('employment_status', [
                'casual',
                'job_order',
                'probationary',
                'permanent',
                'self_employed',
                'ofw'
            ])->nullable();

            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->integer('age')->nullable();

            $table->enum('registration_type', ['online', 'onsite'])->comment('Method of registration')->default('onsite');

            $table->timestamps();
            $table->softDeletes();

            // JSON Fields for Detailed Records
            $table->json('work_experiences')->nullable();
            $table->json('trainings')->nullable();
            $table->json('licensure_examination')->nullable();
            $table->json('competency_assessment')->nullable();

            $table->index('uli');
            $table->index(['surname', 'firstname']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learners');
    }
};
