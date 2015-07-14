<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCharacterFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add Character name
            $table->string('character_name')->nullable();
            // Add Character ID
            $table->integer('character_id')->nullable();
            // Add Primary job
            $table->string('primary_job')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove character name
            $table->dropColumn('character_name');
            // Remove character ID
            $table->dropColumn('character_id');
            // Remove primary job
            $table->dropColumn('primary_job');
        });
    }
}
