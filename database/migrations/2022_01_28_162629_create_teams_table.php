<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('image');
            $table->text('designation')->nullable();
            $table->text('extra')->nullable();
            $table->text('desc')->nullable();
            $table->text('addr')->nullable();
            $table->text('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('fb')->nullable();
            $table->text('li')->nullable();
            $table->text('tw')->nullable();
            $table->integer('sn')->default(0);
            $table->unsignedBigInteger('team_type_id');
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('teams');
    }
}
