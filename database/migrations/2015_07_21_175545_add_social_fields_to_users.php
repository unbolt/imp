<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('twitter', 191)->nullable();
            $table->string('youtube', 191)->nullable();
            $table->string('facebook', 191)->nullable();
            $table->text('profile_message')->nullable();
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
            //
            $table->dropColumn('twitter');
            $table->dropColumn('youtube');
            $table->dropColumn('facebook');
            $table->dropColumn('profile_message');
        });
    }
}
