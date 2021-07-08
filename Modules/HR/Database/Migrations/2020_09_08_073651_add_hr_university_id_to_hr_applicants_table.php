<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHrUniversityIdToHrApplicantsTable extends Migration
{
    public function up()
    {
        Schema::table('hr_applicants', function (Blueprint $table) {
            $table->foreignId('hr_university_id')->nullable()->constrained('hr_universities');
        });
    }

    public function down()
    {
        Schema::table('hr_applicants', function (Blueprint $table) {
            $table->dropForeign(['hr_university_id']);
            $table->dropColumn('hr_university_id');
        });
    }
}
