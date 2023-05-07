<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamMarkPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_mark_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_mark_id');
            $table->foreign('exam_mark_id')->references('id')->on('exam_marks');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->decimal('marks')->default(0);
            $table->decimal('per')->default(0);
            $table->boolean('absent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_mark_parts');
    }
}
