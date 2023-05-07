<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCredithourToExamSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_subjects', function (Blueprint $table) {
            $table->decimal('credit_hour')->nullable();
        });
        Schema::table('exam_subject_parts', function (Blueprint $table) {
            $table->decimal('credit_hour')->nullable();
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
            //
            $table->dropColumn('credit_hour');
        });
        Schema::table('exam_subject_parts', function (Blueprint $table) {
            //
            $table->dropColumn('credit_hour');
        });
    }
}
