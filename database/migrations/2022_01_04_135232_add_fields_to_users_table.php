<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('city')->nullable();
            $table->integer('age')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->integer('nid')->nullable();
            $table->integer('mobile')->nullable();
            $table->boolean('is_married')->nullable();
            $table->unsignedBigInteger('party_id')->nullable();
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
            $table->dropColumn('city');
            $table->dropColumn('age');
            $table->dropColumn('dob');
            $table->dropColumn('gender');
            $table->dropColumn('nid');
            $table->dropColumn('mobile');
            $table->dropColumn('is_married');
            $table->dropColumn('party_id');
        });
    }
}
