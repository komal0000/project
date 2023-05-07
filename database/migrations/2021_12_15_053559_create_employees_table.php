<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('id_card',50)->unique();
            $table->string('name');
            $table->string('designation')->nullable();
            $table->unsignedTinyInteger('type')->default(0);
            $table->text('qualification')->nullable();
            $table->date('dob');
            $table->unsignedTinyInteger('gender')->default(1);
            $table->unsignedTinyInteger('religion')->default(1);;
            $table->string('email',100)->nullable();
            $table->string('phone_no',15)->nullable();
            $table->string('address',500)->nullable();
            $table->date('joining_date');
            $table->date('leave_date')->nullable();
            $table->string('signature')->nullable();
            $table->text('photo')->nullable();
            $table->text('desc')->nullable();
            $table->unsignedTinyInteger('shift')->default(1);
            $table->time('duty_start')->nullable();
            $table->time('duty_end')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
