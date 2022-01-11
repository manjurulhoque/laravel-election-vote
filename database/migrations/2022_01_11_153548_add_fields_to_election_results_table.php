<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToElectionResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('election_results', function (Blueprint $table) {
            $table->unsignedBigInteger('party_id')->nullable();

            $table->foreign('party_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('election_results', function (Blueprint $table) {
            $table->dropColumn('party_id');
        });
    }
}
