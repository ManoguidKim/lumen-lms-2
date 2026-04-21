<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_batch_attendances', function (Blueprint $table) {
            $table->renameColumn('check_in_time', 'first_check_in_time');
            $table->renameColumn('check_out_time', 'first_check_out_time');
        });

        Schema::table('student_batch_attendances', function (Blueprint $table) {
            $table->time('second_check_in_time')->nullable()->after('first_check_out_time');
            $table->time('second_check_out_time')->nullable()->after('second_check_in_time');
        });
    }

    public function down(): void
    {
        Schema::table('student_batch_attendances', function (Blueprint $table) {
            $table->dropColumn(['second_check_in_time', 'second_check_out_time']);
        });

        Schema::table('student_batch_attendances', function (Blueprint $table) {
            $table->renameColumn('first_check_in_time', 'check_in_time');
            $table->renameColumn('first_check_out_time', 'check_out_time');
        });
    }
};
