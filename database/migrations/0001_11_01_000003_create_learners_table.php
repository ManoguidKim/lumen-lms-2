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

            // These fields are related to assessment details, hindi attribute ng learner. A learner can have multiple assessments
            // $table->string('assessment_title')->nullable();
            // $table->string('assessment_type')->comment('full_qualification', 'coc', 'renewal')->nullable();

            $table->string('client_type')->coment(
                'tvet_graduating_student',
                'tvet_graduate',
                'industry_worker',
                'k12',
                'owf'
            )->nullable();

            // These should be integrated in the users table 
            // $table->string('surname')->nullable();
            // $table->string('firstname')->nullable();
            // $table->string('middle_name')->nullable();
            // $table->string('middle_initial', 5)->nullable();
            // $table->string('name_extension', 10)->nullable();

            // These are personal data so these shoud be encrypted. Use text in migration
            $table->text('address_number_street')->nullable();
            $table->text('address_barangay')->nullable();
            $table->text('address_city')->nullable();
            $table->text('address_district')->nullable();
            $table->text('address_province')->nullable();
            $table->text('address_region')->nullable();
            $table->text('address_zip_code', 10)->nullable();

            $table->text('mother_name')->nullable();
            $table->text('father_name')->nullable();

            $table->text('sex')->comment('male', 'female')->nullable();
            $table->text('civil_status')->comment('single', 'married', 'widow', 'separated')->nullable();

            $table->text('contact_tel')->nullable();
            $table->text('contact_mobile')->nullable();
            $table->text('contact_email')->nullable();
            $table->text('contact_fax')->nullable();
            $table->text('contact_others')->nullable();


            $table->text('educational_attainment_others')->nullable();


            $table->text('birth_date')->nullable();
            $table->text('birth_place')->nullable();


            // Age is a calculated value so it should not be entered into the database. 
            // $table->integer('age')->nullable();

            // End of Personal data that should be encrypted

            $table->string('educational_attainment')->comment(
                'elementary_graduate',
                'high_school_graduate',
                'tvet_graduate',
                'college_level',
                'college_graduate',
                'others'
            )->nullable();

            $table->string('employment_status')->comment(
                'casual',
                'job_order',
                'probationary',
                'permanent',
                'self_employed',
                'ofw'
            )->nullable();



            $table->string('registration_type')->comment('online', 'onsite')->default('onsite');

            $table->timestamps();

            // Let's not use soft deletes
            // $table->softDeletes();

            // JSON Fields for Detailed Records

            // Do you know how to manage if the user will have to enter additional work experiences in the future? 
            $table->json('work_experiences')->nullable();
            $table->json('trainings')->nullable();
            $table->json('licensure_examination')->nullable();
            $table->json('competency_assessment')->nullable();
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
