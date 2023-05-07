<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodeToExamSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_subjects', function (Blueprint $table) {
            $table->string('code',20)->nullable();
        });
        Schema::table('exam_subject_parts', function (Blueprint $table) {
            $table->string('code',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_subjects', function (Blueprint $table) {
            $table->dropColumn('code');
        });

        Schema::table('exam_subject_parts', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
}
