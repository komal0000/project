<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitlesToServiceTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_types', function (Blueprint $table) {
            $table->text('home_tiles')->nullable();
            $table->text('home_title')->nullable();
            $table->text('home_desc')->nullable();
            $table->text('home_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_types', function (Blueprint $table) {
            $table->dropColumn('home_tiles');
            $table->dropColumn('home_title');
            $table->dropColumn('home_desc');
            $table->dropColumn('home_image');
        });
    }
}
