<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Institution\Models\Center;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Unique Learners Identifier
            $table->string('uli')->nullable()->comment('Unique Learners Identifier');
            $table->string('picture_path')->nullable();

            // School Information
            $table->string('school_name')->nullable();
            $table->text('school_address')->nullable();

            // Client Type
            $table->string('client_type')->nullable()->comment('tvet_graduating_student, tvet_graduate, industry_worker, k12, ofw');

            // Personal data (encrypted) - using text type
            $table->text('address_number_street')->nullable();
            $table->text('address_barangay')->nullable();
            $table->text('address_city')->nullable();
            $table->text('address_district')->nullable();
            $table->text('address_province')->nullable();
            $table->text('address_region')->nullable();
            $table->text('address_zip_code')->nullable();

            // Parent Information (encrypted)
            $table->text('mother_name')->nullable();
            $table->text('father_name')->nullable();

            // Personal Details (encrypted)
            $table->text('sex')->nullable()->comment('male, female');
            $table->text('civil_status')->nullable()->comment('single, married, widow, separated');

            // Contact Information (encrypted)
            $table->text('contact_tel')->nullable();
            $table->text('contact_mobile')->nullable();
            $table->text('contact_email')->nullable();
            $table->text('contact_fax')->nullable();
            $table->text('contact_others')->nullable();

            // Birth Information (encrypted)
            $table->text('birth_date')->nullable();
            $table->text('birth_place')->nullable();

            // Educational Attainment
            $table->string('educational_attainment')->nullable()->comment('elementary_graduate, high_school_graduate, tvet_graduate, college_level, college_graduate, others');
            $table->text('educational_attainment_others')->nullable();

            // Employment Status
            $table->string('employment_status')->nullable()->comment('casual, job_order, probationary, permanent, self_employed, ofw');

            // Registration Type
            $table->string('registration_type')->default('onsite')->comment('online, onsite');

            // JSON Fields for Detailed Records
            $table->json('work_experiences')->nullable();
            $table->json('trainings')->nullable();
            $table->json('licensure_examination')->nullable();
            $table->json('competency_assessment')->nullable();

            $table->string('full_name_searchable')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'uli',
                'picture_path',
                'school_name',
                'school_address',
                'client_type',
                'address_number_street',
                'address_barangay',
                'address_city',
                'address_district',
                'address_province',
                'address_region',
                'address_zip_code',
                'mother_name',
                'father_name',
                'sex',
                'civil_status',
                'contact_tel',
                'contact_mobile',
                'contact_email',
                'contact_fax',
                'contact_others',
                'birth_date',
                'birth_place',
                'educational_attainment',
                'educational_attainment_others',
                'employment_status',
                'registration_type',
                'work_experiences',
                'trainings',
                'licensure_examination',
                'competency_assessment',
            ]);
        });
    }
};
