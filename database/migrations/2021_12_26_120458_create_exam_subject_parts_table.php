<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSubjectPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_subject_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_subject_id');
            $table->foreign('exam_subject_id')->references('id')->on('exam_subjects');
            $table->string('subect_code',100)->nullable();
            $table->string('name',100)->default('TH');
            $table->decimal('fm')->default(100);
            $table->decimal('pm')->default(40);
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
        Schema::dropIfExists('exam_subject_parts');
    }
}
