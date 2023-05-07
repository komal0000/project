<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExamSubjectPartIdToExamMarkPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_mark_parts', function (Blueprint $table) {
            $table->unsignedBigInteger('exam_subject_part_id');
            $table->foreign('exam_subject_part_id')->references('id')->on('exam_subject_parts');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_mark_parts', function (Blueprint $table) {
            //
            $table->dropForeign(['exam_subject_part_id']);

        });
    }
}
