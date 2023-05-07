<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('no',100)->nullable();
            $table->string('name',100);
            $table->date('dob')->nullable();
            $table->unsignedTinyInteger('gender')->default(1);
            // $table->unsignedTinyInteger('religion_id')->default(1);;
            $table->string('email',100)->nullable();
            $table->string('phone',15)->nullable();
            $table->decimal('iq')->nullable();
            $table->decimal('height')->nullable();
            $table->decimal('weight')->nullable();
            $table->string('aadhar_no',100)->nullable();
            $table->text('mother_tounge')->nullable();

            
            $table->text('nationality')->nullable();
            $table->text('country')->nullable();
            $table->text('state')->nullable();
            $table->text('district')->nullable();
            $table->text('tehsil')->nullable();
            $table->text('town')->nullable();
            $table->text('block')->nullable();
            $table->unsignedTinyInteger('area_type')->nullable();
            $table->text('pin')->nullable();

            $table->string('father_name',100)->nullable();
            $table->string('father_aadhar_no',100)->nullable();
            $table->string('father_pan',100)->nullable();
            $table->string('father_email',100)->nullable();
            $table->string('father_phone',15)->nullable();
            $table->string('father_occupation',50)->nullable();
            $table->string('father_education',50)->nullable();

            $table->string('mother_name',100)->nullable();
            $table->string('mother_aadhar_no',100)->nullable();
            $table->string('mother_pan',100)->nullable();
            $table->string('mother_email',100)->nullable();
            $table->string('mother_phone',15)->nullable();
            $table->string('mother_occupation',50)->nullable();
            $table->string('mother_education',50)->nullable();


            $table->decimal('parent_income')->nullable();
            $table->boolean('bpl')->default(false);
            $table->string('bpl_certificate_no',30)->nullable();
            $table->date('bpl_issue_date')->nullable();
            $table->string('bpl_authority',150)->nullable();

            $table->string('gaurdian_name',100);
            $table->string('gaurdian_aadhar_no',100)->nullable();
            $table->string('gaurdian_email',100)->nullable();
            $table->string('gaurdian_phone',15)->nullable();
            $table->string('gaurdian_occupation',50)->nullable();
            $table->string('gaurdian_relation',50)->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('caste_id')->nullable();
            $table->unsignedBigInteger('scheme_id')->nullable();
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('religion_id')->references('id')->on('religions');
            $table->foreign('caste_id')->references('id')->on('castes');
            $table->foreign('scheme_id')->references('id')->on('schemes');
            $table->foreign('category_id')->references('id')->on('categories');



            $table->boolean('is_handicap')->default(false);
            $table->string('handicap')->nullable();
            $table->decimal('handicap_per')->default(0);

            $table->text('prev_achivements')->nullable();
            $table->text('prev_school')->nullable();
            $table->string('prev_school_code',30)->nullable();
            $table->string('prev_school_srn',30)->nullable();
            $table->date('prev_school_leave')->nullable();
            $table->text('prev_school_reason')->nullable();
            $table->text('prev_school_last')->nullable();
            $table->string('prev_school_grade',10)->nullable();
            $table->text('hobbies')->nullable();

            $table->boolean('is_mentally_chalanged')->default(false);
            $table->string('mentally_chalanged')->nullable();
            $table->decimal('mentally_chalanged_per')->default(0);
            

            $table->boolean('has_genetic_disorder')->default(false);
            $table->string('genetic_disorder')->nullable();

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
        Schema::dropIfExists('students');
    }
}
