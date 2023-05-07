<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_mails', function (Blueprint $table) {
            $table->id();
            $table->text('subject');
            $table->text('emails');
            $table->text('mail');
            $table->boolean('sent')->default(false);
            $table->boolean('pulled')->default(false);
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
        Schema::dropIfExists('office_mails');
    }
}
